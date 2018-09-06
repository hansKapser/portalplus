<?php
// src/Controller/indexController.php
// use Symfony\Component\HttpFoundation\Session\Storage\PhpBridgeSessionStorage;
namespace App\Controller;

use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Session\Storage\NativeSessionStorage;
use Symfony\Component\HttpFoundation\Session\Storage\Handler\NativeFileSessionHandler;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Twig\Node\Expression\Binary\AndBinary;

class printController extends Controller
{

    var $orderID = 123;

    /**
     *
     * @Route("/purchasePrint")
     */
    public function purchasePrint(Request $request)
    {
        require ('./web/classes/_standard.php');
        //require ('./web/classes/_print.php');
        
        require ('./web/classes/tcpdf/config/tcpdf_config.php');
        require ('./web/classes/tcpdf/tcpdf.php');
        require ('./web/classes/_tcpdf_init.php');
        
        $sessionStorage = new NativeSessionStorage(array(), new NativeFileSessionHandler());
        $session = new Session($sessionStorage);
        $session->start();
        
        $auth = json_decode($session->get('auth'));
        $firmID = $auth->{'firmID'};
        
        if (isset($_FILES['file']['name'])) {
            $fileNameAttachment = $_FILES['file']['name'];
            $tmpName = $_FILES['file']['tmp_name'];
            $fileSize = $_FILES['file']['size'];
            $fileType = $_FILES['file']['type'];
            $array = object_to_array(json_decode($_REQUEST["formData"]));
        } else {
            $array = object_to_array(json_decode($_REQUEST["data"]));
        }
        if (isset($array["cb_form"]))
            /* cb_form 
             * comes from preview standard.js filesInternal 
             */
            $array[$array["cb_form"]]=1;
        
        if (!isset($array["_debug"]))
            $array["_debug"]=0;
             
        $orderID = $array["orderID"];
        if (! isset($array["sendEmail"]))
            $array["sendEmail"] = 0;
        
        $em = $this->getDoctrine()->getManager();
        
        $pdf = tcpdf_init();
        $pdf->AddPage('P', 'A4');
        
        $pdfP = new pdfParser();
        $pdfP->em = $em;
        $pdfP->division = "E";
        $pdfP->lang = $array["printLang"];
        $printForm = $array["printForm"];
        
        $sql = "select p.*,u.name as user_name 
                from p17_purchasebook p 
                left join p17_user u on u.user=p.user
                where 
                p.orderID=$orderID";
        $rowOrder = _db_row($em, $sql);
        $supplier_firmID=$rowOrder["supplier_firmID"];
        
        $sql = "select *,
            if ('$printForm'='UeBW',bank,'getinBank') as bank,
            if ('$printForm'='UeBW',IBAN,getin_IBAN) as IBAN
             from p17_firms where firmID=$firmID";
        $rowSender = _db_row($em, $sql);
        
        $supplier_firmID = $rowOrder["supplier_firmID"];
        $sql = "select * from p17_firms where firmID=$supplier_firmID";
        $rowReceiver = _db_row($em, $sql);
        
        $termPayment = $rowOrder["termPayment"];
        $sql = "select * from p17_terms_of_payment where id=$termPayment";
        $rowTerms = _db_row($em, $sql);
        
        $sql = "select p.*,v.percentage*100 as percentage,
        p.quantity_unit as unity,
		if (p.variation1_id=0,'',(select name from p17_article_variation where id=p.variation1_id)) as variation1,
		if (p.variation2_id=0,'',(select name from p17_article_variation where id=p.variation2_id)) as variation2
		from p17_purchase_positions p
        left join p17_vat v on v.vat_id=p.vat_id
		where p.orderID=$orderID
		order by p.article_code asc";
        $rowsPosition = _db_rows($em, $sql);
        $pdfP->countPositions = count($rowsPosition);
        
        $content = "";
        
        $hawaliFirmID=isHAWALI($em,$supplier_firmID);
        
        $array["sendEmail"]=0;
        
        if ($hawaliFirmID>0 AND 
            $array["cb_BE"] == 1 AND 
            $array["sendEmail"]==0) {
                
            $pdfP->hawaliFirmID = $hawaliFirmID;
            $pdfP->orderID = $orderID;
            $pdfP->rowSender=$rowReceiver;
            $pdfP->rowsReceiver=$rowSender;
            $temp=$rowSender;
            $rowSender=$rowReceiver;
            $rowReceiver=$temp;
            
            $sql="select * from p17_hawali
                    where firmID=$hawaliFirmID";
            $rowHawali=_db_row($em,$sql);
            if (substr($rowHawali["lastOrderNo"],0,4)<date('Y')) {
                $lastOrderNo=date('Y').'-'.strzero(1,5);
            } else {
                $lastOrderNo=date('Y').'-'.strzero(substr($rowHawali["lastOrderNo"],5,4)+1,5);
            }
                
                $rowOrder["orderNo"]=$lastOrderNo;
                $rowOrder["orderDate"]=date('Y-m-d');
                $rowSender["debitor"]='24'.strzero($firmID,3);
                
                /* Recalc
                 * recalculatation with hawali conditions
                 */
                $arr_temp=$pdfP->pintHawaliRecalc($rowHawali,$rowOrder,$rowsPosition);
                $rowOrder=$arr_temp[0];
                $rowsPosition=$arr_temp[1];
                $rowInvoice=$arr_temp[2];
                
                $rowInvoice["invoiceNo"]=$rowOrder["orderNo"];
                $rowInvoice["invoiceDate"]=$rowOrder["orderDate"];
                
            $pdfP->lang = $rowHawali["lang"];
                
            $pdfP->template = "auftrag_AB";
            $content = $pdfP->printBody();
            
            if ($content != "")
                $content .= "\$pdf->AddPage('P', 'A4');\n";
            $pdfP->template = "auftrag_LS";
                $content .= $pdfP->printBody();
            
            if ($content != "")
                $content .= "\$pdf->AddPage('P', 'A4');\n";
            $pdfP->template = "auftrag_WZ";
                $content .= $pdfP->printBody();
                    
                switch ($rowOrder["dispatch"]) {
                    case "DHL":
                        $pdfP->template = "auftrag_BBP_DHL";
                        break;
                    case "DHLP":
                        $pdfP->template = "auftrag_BBP_DHLP";
                        break;
                    default:
                        $pdfP->template = "auftrag_BBP_FB";
                        break;
                }
            $rowsPackage=array();
            
            // dispatch informations
            $sql="select * from p17_firms where firmID=$firmID";
            $row=_db_row($em,$sql);
            
            $rowOrder["partner_company"]=$row["company"];            
            $rowOrder["street"]=$row["street"];
            $rowOrder["country"]=$row["country"];
            $rowOrder["postcode"]=$row["postcode"];
            $rowOrder["city"]=$row["city"];
            $rowOrder["dispatchDate"]=date('Y-m-d');
            
            $rowDispatch=array();
            $rowDispatch["carrier"]="BaySped GmbH";
            $rowDispatch["carrierCompany"]="BaySped GmbH";
            $rowDispatch["carrierStreet"]="BodenseeStraß 20";
            $rowDispatch["carrierCountry"]="DE";
            $rowDispatch["carrierPostcode"]="87700";
            $rowDispatch["carrierCity"]="Memmingen";
            $rowDispatch["carrierPlate"]="MM-BY 1";
            $rowDispatch["signSender"] = "gez. caretaker";
            $rowDispatch["signCarrier"] = "gez. trucker";
            if ($rowOrder["deliveryCondition"] == "unfrei") {
                $rowOrder["deliveryCondition"] = "unfrei, " . $rowOrder["shippingCosts"] . " EUR";
                $rowDispatch["free"] = "";
                $rowDispatch["notfree"] = "X";
            } else {
                $rowDispatch["free"] = "X";
                $rowDispatch["notfree"] = "";
            }
            
            $row["article_id"]="";
            $row["article_code"]="";
            $row["variation1"]="";
            $row["variation2"]="";
            $row["name"]="";
            $row["text"]="Handelswaren";
            $row["quantity"]=1;
            $row["unity"]="Stk.";
            $row["retourCredit"]="1";
            $row["price"]="1";
            $row["discount"]="1";
            $row["sumPosition"]="1";
            $rowsPackage[]=$row;
            
            $pdfP->countPackagePositions = count($rowsPackage);
                
                if ($content != "")
                    $content .= "\$pdf->AddPage('P', 'A4');\n";
                    
                $content .= $pdfP->printBody();

                if ($content != "")
                    $content .= "\$pdf->AddPage('P', 'A4');\n";
                    $pdfP->template = "auftrag_ES";
                        
                $content .= $pdfP->printBody();
                
                if ($content != "")
                    $content .= "\$pdf->AddPage('P', 'A4');\n";
                    $pdfP->template = "auftrag_AR";
                                        
                $content .= $pdfP->printBody();
                    
            $array["cb_BE"] == 0;
            unset($array["cb_BE"]);
            
        }
        
        
        
        if (isset($array["cb_BE"]) AND $array["cb_BE"] == 1) {
            $pdfP->template = "bestellung_BE";
            $content = $pdfP->printBody();
        }
        
        if (isset($array["cb_TV"]) AND $array["cb_TV"] == 1) {
            if ($content != "")
                $content .= "\$pdf->AddPage('P', 'A4');\n";
            $pdfP->template = "bestellung_TV";
            $content .= $pdfP->printBody();
        }
        
        if (isset($array["cb_WE"]) AND $array["cb_WE"] == 1) {
            if ($content != "")
                $content .= "\$pdf->AddPage('P', 'A4');\n";
            $pdfP->template = "bestellung_WE";
            $content .= $pdfP->printBody();
        }
        
        if (isset($array["cb_ES"]) AND $array["cb_ES"] == 1) {
            if ($content != "")
                $content .= "\$pdf->AddPage('P', 'A4');\n";
            $pdfP->template = "bestellung_ES";
            
            $sql = "select p.*,
				if (p.variation1_id=0,'',(select name from p17_article_variation where id=p.variation1_id)) as variation1,
				if (p.variation2_id=0,'',(select name from p17_article_variation where id=p.variation2_id)) as variation2
				from p17_purchase_credit c,
				p17_purchase_credit_positions p
				where
				c.orderID=$orderID AND
				p.creditID=c.id";
            $rowsPackage = _db_rows($em, $sql);
            $pdfP->countPackagePositions = count($rowsPackage);
            
            $content .= $pdfP->printBody();
        }
        
        if (isset($array["cb_GB"]) and $array["cb_GB"] > 0) {
            if ($content != "")
                $content .= "\$pdf->AddPage('P', 'A4');\n";
            $id = $array["cb_GB"];
            $sql = "select subject,message from p17_purchase_messages where id=$id";
            $row = _db_row($em, $sql);
            $rowOrder["subject"] = $row["subject"];
            $rowOrder["message"] = $row["message"];
            $pdfP->template = "bestellung_GB";
            $content .= $pdfP->printBody();
        }
        
        /*
         * check images needs array
         */
        if (count($pdfP->rowSender)==0)
            $pdfP->rowSender=$rowSender;
        if (count($pdfP->rowReceiver)==0)
            $pdfP->rowReceiver=$rowReceiver;
        if (count($pdfP->rowsPosition)==0)
            $pdfP->rowsPosition=$rowsPosition;
                
        $arrayContent = explode("\n", $content);
        for ($i = 0; $i < count($arrayContent); $i ++) {
            if (strstr($arrayContent[$i], "getImageData(")) {
                $arrayContent[$i] = str_replace("getImageData(", "getImageData(\$em,", $arrayContent[$i]);
                $isImage=$pdfP->isImage($arrayContent[$i]);
                
                if (!$isImage)
                    $arrayContent[$i]="";
                
            }
            if ($array["_debug"] == 1)
                echo $arrayContent[$i] . "<BR>";
            
                //echo $pdfP->template."\n";
            eval($arrayContent[$i]);
        }
        
        if ($array["sendEmail"] == 0)
            $pdf->Output('', 'I');
        
        if ($array["sendEmail"] == 1) {
            if (isset($rowOrder["subject"])) {
                $mailSubject = utf8_decode(str_replace(" ", "_", $rowOrder["subject"]));
            } else {
                $mailSubject = utf8_decode(str_replace(" ", "_", $rowOrder["purchaseNo"]));
            }
            
            $fileName = $mailSubject . ".pdf";
            $mailMessage = "sent by portalPlus/PHPMailer ";
            $pdfString = $pdf->Output($fileName, 'S');
            $ownEmail = $auth->{'email'};
            $ownEmailPass = $auth->{'emailPass'};
            $ownCompany = $auth->{'company'};
            $mailReceiver = $rowReceiver["email"];
            $mailReceiverCompany = $rowReceiver["company"];
            
            $from = $ownCompany . " <" . $ownEmail . ">";
            $mail = new PHPMailer(true); // Passing `true` enables exceptions
            try {
                // Server settings
                $mail->SMTPDebug = 0; // 2: Enable verbose debug output
                $mail->isSMTP(); // Set mailer to use SMTP
                $mail->Host = 'mail.your-server.de'; // Specify main and backup SMTP servers
                $mail->SMTPAuth = true; // Enable SMTP authentication
                $mail->Username = $ownEmail; // SMTP username
                $mail->Password = $ownEmailPass; // SMTP password
                $mail->SMTPSecure = 'tls'; // 'tls'; // Enable TLS encryption, `ssl` also accepted
                $mail->Port = 587; // TCP port to connect to
                                   
                // Recipients
                $mailReceiver = "hans@kapser.de";
                $mail->setFrom($ownEmail, $ownCompany);
                $mail->addAddress($mailReceiver, $mailReceiverCompany); // Add a recipient
                                                                       // $mail->addAddress('contact@example.com'); // Name is optional
                                                                       // $mail->addReplyTo('info@example.com', 'Information');
                                                                       // if ($array["mailCC"]==1) {
                                                                       // $mail->addBCC($ownEmail);
                                                                       // $mail->addBCC('bcc@example.com');
                                                                       // }
                
                $mail->isHTML(true);
                $mail->Subject = $mailSubject;
                // Attachments
                
                if (isset($tmpName)) {
                    // perhaps additionaly uploaded file
                    if (strstr($fileType, "image")) {
                        $mail->AddEmbeddedImage($tmpName, "attachment", $fileNameAttachment);
                        $mail->Body = $mailMessage . '<HR>' . '<img alt="' . $fileNameAttachment . '" src="cid:attachment">';
                    } else {
                        $mail->addAttachment($tmpName, $fileNameAttachment);
                        $mail->Body = $mailMessage;
                    }
                } else {
                    $mail->Body = $mailMessage;
                }
                
                $mail->addStringAttachment($pdfString, "$mailSubject.pdf", 'base64', 'application/pdf'); // Optional name
                                                                                                          
                // Content
                                                                                                          // Set email format to HTML
                                                                                                          
                // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
                
                $mail->send();
                $success = "E-Mail sent to $mailReceiver";
            } catch (Exception $e) {
                $success = "Probleme beim E-Mailversand, überprüfen Sie Ihre E-Mailadresse und das Passwort!";
                echo $success;
            }
        } // endif array["email"]==1
        
        if ($array["sendEmail"] == 1) {
            $return = array();
            $return[] = array(
                'label' => 'success',
                'content' => json_encode($success)
            );
            
            return new JsonResponse($return);
        } else {
            return "";
        }
    }

    public function purchasePrintPrepare(Request $request)
    {
        require ('./web/classes/_standard.php');
        $sessionStorage = new NativeSessionStorage(array(), new NativeFileSessionHandler());
        $session = new Session($sessionStorage);
        $session->start();
        
        $auth = json_decode($session->get('auth'));
        $firmID = $auth->{'firmID'};
        
        $array = object_to_array(json_decode($_REQUEST["data"]));
        $orderID = $array["orderID"];
        
        $em = $this->getDoctrine()->getManager();
        
        // get workflowStatus
        $workflowStatus = "BE,TV,WE";
        
        $sql = "select * from p17_purchasebook where orderID=$orderID";
        $row = _db_row($em, $sql);
        $ticketID = $row["ticketID"];
        
        if ($row["incomingDate"] != "0000-00-00")
            $workflowStatus .= ",ES";
        
        $sql = "select ticketID from p17_purchase_enquiry where ticketID=$ticketID";
        if (count(_db_rows($em, $sql)) > 0)
            $workflowStatus .= ",AN";
        
        $sql = "select ticketID from p17_purchase_request where ticketID=$ticketID";
        if (count(_db_rows($em, $sql)) > 0)
            $workflowStatus .= ",BM";
        
        $sql = "select id,subject from p17_purchase_messages where orderID=$orderID";
        $rowsPurchaseMessages = _db_rows($em, $sql);
        
        $return = array();
        $return[] = array(
            'label' => 'workflowStatus',
            'content' => json_encode($workflowStatus)
        );
        
        if (count($rowsPurchaseMessages) > 0) {
            $return[] = array(
                'label' => 'rowsPurchaseMessages',
                'content' => json_encode($rowsPurchaseMessages)
            );
        }
        return new JsonResponse($return);
    }

    public function sellingPrint(Request $request)
    {
        require ('./web/classes/_standard.php');
        require ('./web/classes/_print.php');
        
        require ('./web/classes/tcpdf/config/tcpdf_config.php');
        require ('./web/classes/tcpdf/tcpdf.php');
        require ('./web/classes/_tcpdf_init.php');
        
        $sessionStorage = new NativeSessionStorage(array(), new NativeFileSessionHandler());
        $session = new Session($sessionStorage);
        $session->start();
        
        $auth = json_decode($session->get('auth'));
        $firmID = $auth->{'firmID'};
        
        if (isset($_FILES['file']['name'])) {
            $fileNameAttachment = $_FILES['file']['name'];
            $tmpName = $_FILES['file']['tmp_name'];
            $fileSize = $_FILES['file']['size'];
            $fileType = $_FILES['file']['type'];
            $array = object_to_array(json_decode($_REQUEST["formData"]));
        } else {
            $array = object_to_array(json_decode($_REQUEST["data"]));
        }
        
        if (isset($array["cb_form"]))
            /* cb_form
             * comes from preview standard.js filesInternal
             */
            $array[$array["cb_form"]]=1;
            
            if (!isset($array["_debug"]))
                $array["_debug"]=0;
                
        $orderID = $array["orderID"];
        if (! isset($array["sendEmail"]))
            $array["sendEmail"] = 0;
        
        $em = $this->getDoctrine()->getManager();
        
        $pdf = tcpdf_init();
        $pdf->AddPage('P', 'A4');
        
        $pdfP = new pdfParser();
        $pdfP->em = $em;
        $pdfP->division = "V";
        $pdfP->lang = $array["printLang"];
        $printForm = $array["printForm"];
        
        $sql = "select p.*,u.name as user_name
                from p17_orderbook p
                left join p17_user u on u.user=p.user
                where
                p.orderID=$orderID";
        $rowOrder = _db_row($em, $sql);
        $customer_firmID=$rowOrder["customer_firmID"];
        
        $sql = "select f.*,
            if ('$printForm'='UeBW',f.bank,'getinBank') as bank,
            if ('$printForm'='UeBW',f.IBAN,getin_IBAN) as IBAN,
            n.debitor
            from p17_firms f
            left join p17_firms_numbers n on n.firmID=$firmID AND n.firmIDpartner=$customer_firmID
            where f.firmID=$firmID";
        $rowSender = _db_row($em, $sql);
        
        $customer_firmID = $rowOrder["customer_firmID"];
        $sql = "select * from p17_firms where firmID=$customer_firmID";
        $rowReceiver = _db_row($em, $sql);
        
        $termPayment = $rowOrder["termPayment"];
        $sql = "select * from p17_terms_of_payment where id=$termPayment";
        $rowTerms = _db_row($em, $sql);
        
        $sql = "select p.*,v.percentage*100 as percentage,
        p.quantity_unit as unity,
		if (p.variation1_id=0,'',(select name from p17_article_variation where id=p.variation1_id)) as variation1,
		if (p.variation2_id=0,'',(select name from p17_article_variation where id=p.variation2_id)) as variation2
		from p17_order_positions p
        left join p17_vat v on v.vat_id=p.vat_id
		where p.orderID=$orderID
		order by p.article_code asc";
        $rowsPosition = _db_rows($em, $sql);
        for ($i=0;$i<count($rowsPosition);$i++) {
            $rowsPosition[$i]["variation1_name"]=$rowsPosition[$i]["variation1"];
            $rowsPosition[$i]["variation2_name"]=$rowsPosition[$i]["variation2"];
        }
        $pdfP->countPositions = count($rowsPosition);
        
        $content = "";
        
        if (isset($array["cb_AB"]) AND $array["cb_AB"] == 1) {
            $pdfP->template = "auftrag_AB";
            $content = $pdfP->printBody();
        }
        
        if (isset($array["cb_WES"]) AND $array["cb_WES"] == 1) {
            if ($content != "")
                $content .= "\$pdf->AddPage('P', 'A4');\n";
            $pdfP->template = "auftrag_WES";
            $content .= $pdfP->printBody();
        }
        
        if (isset($array["cb_LS"]) AND $array["cb_LS"] == 1) {
            if ($content != "")
                $content .= "\$pdf->AddPage('P', 'A4');\n";
            $pdfP->template = "auftrag_LS";
            $content .= $pdfP->printBody();
        }
        
        if (isset($array["cb_BBP"]) AND $array["cb_BBP"] == 1) {
            switch ($rowOrder["dispatch"]) {
                case "DHL":
                    $pdfP->template = "auftrag_BBP_DHL";
                    break;
                case "DHLP":
                    $pdfP->template = "auftrag_BBP_DHLP";
                    break;
                default:
                    $pdfP->template = "auftrag_FB";
                    break;
            }
            
            if ($content != "")
                $content .= "\$pdf->AddPage('P', 'A4');\n";
                
            $content .= $pdfP->printBody();
        }
        
        if (isset($array["cb_ES"]) AND $array["cb_ES"] == 1) {
            if ($content != "")
                $content .= "\$pdf->AddPage('P', 'A4');\n";
                $pdfP->template = "auftrag_ES";
                $sql = "select p.*,
				if (p.variation1_id=0,'',(select name from p17_article_variation where id=p.variation1_id)) as variation1,
				if (p.variation2_id=0,'',(select name from p17_article_variation where id=p.variation2_id)) as variation2
				from p17_order_package_positions p
				where
				p.orderID=$orderID";
                $rowsPackage = _db_rows($em, $sql);
                $pdfP->countPackagePositions = count($rowsPackage);
                
                $content .= $pdfP->printBody();
        }
        
        if (isset($array["cb_WZ"]) AND $array["cb_WZ"] == 1) {
            if ($content != "")
                $content .= "\$pdf->AddPage('P', 'A4');\n";
                $pdfP->template = "auftrag_WZ";
                $content .= $pdfP->printBody();
        }
        
        if (isset($array["cb_AR"]) AND $array["cb_AR"] == 1) {
            if ($content != "")
                $content .= "\$pdf->AddPage('P', 'A4');\n";
                $pdfP->template = "auftrag_AR";
                
                $sql="select * from p17_order_invoice where orderID=$orderID";
                $rowInvoice = _db_row($em, $sql);
                
                $content .= $pdfP->printBody();
        }
        
        if (isset($array["cb_GS"]) AND $array["cb_GS"] == 1) {
            if ($content != "")
                $content .= "\$pdf->AddPage('P', 'A4');\n";
            $pdfP->template = "bestellung_GS";
            
            $sql = "select p.*,
				if (p.variation1_id=0,'',(select name from p17_article_variation where id=p.variation1_id)) as variation1,
				if (p.variation2_id=0,'',(select name from p17_article_variation where id=p.variation2_id)) as variation2
				from p17_order_credit c,
				p17_order_credit_positions p
				where
				c.orderID=$orderID AND
				p.creditID=c.id";
            $rowsPackage = _db_rows($em, $sql);
            $pdfP->countPackagePositions = count($rowsPackage);
            
            $content .= $pdfP->printBody();
        }
        
        if (isset($array["cb_GB"]) and $array["cb_GB"] > 0) {
            if ($content != "")
                $content .= "\$pdf->AddPage('P', 'A4');\n";
            $id = $array["cb_GB"];
            $sql = "select subject,message from p17_order_messages where id=$id";
            $row = _db_row($em, $sql);
            $rowOrder["subject"] = $row["subject"];
            $rowOrder["message"] = $row["message"];
            $pdfP->template = "bestellung_GB";
            $content .= $pdfP->printBody();
        }
        
        $arrayContent = explode("\n", $content);
        for ($i = 0; $i < count($arrayContent); $i ++) {
            if (strstr($arrayContent[$i], "getImageData("))
                $arrayContent[$i] = str_replace("getImageData(", "getImageData(\$em,", $arrayContent[$i]);
            if ($array["_debug"] == 1)
                echo $arrayContent[$i] . "<BR>";
            // echo $pdfP->template."\n";
            eval($arrayContent[$i]);
        }
        
        if ($array["sendEmail"] == 0)
            $pdf->Output('', 'I');
        
        if ($array["sendEmail"] == 1) {
            if (isset($rowOrder["subject"])) {
                $mailSubject = utf8_decode(str_replace(" ", "_", $rowOrder["subject"]));
            } else {
                $mailSubject = utf8_decode(str_replace(" ", "_", $rowOrder["orderNo"]));
            }
            
            $fileName = $mailSubject . ".pdf";
            $mailMessage = "sent by portalPlus/PHPMailer ";
            $pdfString = $pdf->Output($fileName, 'S');
            $ownEmail = $auth->{'email'};
            $ownEmailPass = $auth->{'emailPass'};
            $ownCompany = $auth->{'company'};
            $mailReceiver = $rowReceiver["email"];
            $mailReceiverCompany = $rowReceiver["company"];
            
            $from = $ownCompany . " <" . $ownEmail . ">";
            $mail = new PHPMailer(true); // Passing `true` enables exceptions
            try {
                // Server settings
                $mail->SMTPDebug = 0; // 2: Enable verbose debug output
                $mail->isSMTP(); // Set mailer to use SMTP
                $mail->Host = 'mail.your-server.de'; // Specify main and backup SMTP servers
                $mail->SMTPAuth = true; // Enable SMTP authentication
                $mail->Username = $ownEmail; // SMTP username
                $mail->Password = $ownEmailPass; // SMTP password
                $mail->SMTPSecure = 'tls'; // 'tls'; // Enable TLS encryption, `ssl` also accepted
                $mail->Port = 587; // TCP port to connect to
                                   
                // Recipients
                $mailReceiver = "hans@kapser.de";
                $mail->setFrom($ownEmail, $ownCompany);
                $mail->addAddress($mailReceiver, $mailReceiverCompany); // Add a recipient
                                                                       // $mail->addAddress('contact@example.com'); // Name is optional
                                                                       // $mail->addReplyTo('info@example.com', 'Information');
                                                                       // if ($array["mailCC"]==1) {
                                                                       // $mail->addBCC($ownEmail);
                                                                       // $mail->addBCC('bcc@example.com');
                                                                       // }
                
                $mail->isHTML(true);
                $mail->Subject = $mailSubject;
                // Attachments
                
                if (isset($tmpName)) {
                    // perhaps additionaly uploaded file
                    if (strstr($fileType, "image")) {
                        $mail->AddEmbeddedImage($tmpName, "attachment", $fileNameAttachment);
                        $mail->Body = $mailMessage . '<HR>' . '<img alt="' . $fileNameAttachment . '" src="cid:attachment">';
                    } else {
                        $mail->addAttachment($tmpName, $fileNameAttachment);
                        $mail->Body = $mailMessage;
                    }
                } else {
                    $mail->Body = $mailMessage;
                }
                
                $mail->addStringAttachment($pdfString, "$mailSubject.pdf", 'base64', 'application/pdf'); // Optional name
                                                                                                          
                // Content
                                                                                                          // Set email format to HTML
                                                                                                          
                // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
                
                $mail->send();
                $success = "E-Mail sent to $mailReceiver";
            } catch (Exception $e) {
                $success = "Probleme beim E-Mailversand, überprüfen Sie Ihre E-Mailadresse und das Passwort!";
                echo $success;
            }
        } // endif array["email"]==1
        
        if ($array["sendEmail"] == 1) {
            $return = array();
            $return[] = array(
                'label' => 'success',
                'content' => json_encode($success)
            );
            
            return new JsonResponse($return);
        } else {
            return "";
        }
    }

    public function sellingPrintPrepare(Request $request)
    {
        require ('./web/classes/_standard.php');
        $sessionStorage = new NativeSessionStorage(array(), new NativeFileSessionHandler());
        $session = new Session($sessionStorage);
        $session->start();
        
        $auth = json_decode($session->get('auth'));
        $firmID = $auth->{'firmID'};
        
        $array = object_to_array(json_decode($_REQUEST["data"]));
        $orderID = $array["orderID"];
        
        $em = $this->getDoctrine()->getManager();
        
        // get workflowStatus
        $workflowStatus = "AB";
        
        $sql = "select * from p17_orderbook where orderID=$orderID";
        $row = _db_row($em, $sql);
        $ticketID = $row["ticketID"];

        $sql = "select * from p17_stock_transaction where orderID=$orderID AND division='V' AND transaction='O'";
        $rows = _db_row($em, $sql);
        if (count($rows)>0)
            /* WES
             * @todo: define auftrag_WES in p17_templatesPdf
             */
           // $workflowStatus .= ",WES";
            
        if ($row["dispatchDate"] != "0000-00-00")
            $workflowStatus .= ",LS,BBP,ES,WZ";
        
        $sql = "select * from p17_order_invoice where orderID=$orderID";
        $rows = _db_row($em, $sql);
        if (count($rows)>0)
            $workflowStatus .= ",AR";
        
        $sql = "select * from p17_order_credit where orderID=$orderID";
            $rows = _db_row($em, $sql);
            if (count($rows)>0)
                $workflowStatus .= ",GS";
                
            
        $sql = "select id,subject from p17_order_messages where orderID=$orderID";
        $rowsSellingMessages = _db_rows($em, $sql);
        
        $return = array();
        $return[] = array(
            'label' => 'workflowStatus',
            'content' => json_encode($workflowStatus)
        );
        
        if (count($rowsSellingMessages) > 0) {
            $return[] = array(
                'label' => 'rowsSellingMessages',
                'content' => json_encode($rowsSellingMessages)
            );
        }
        return new JsonResponse($return);
    }
    public function accountancyJournalPrint(Request $request)
    {
        require ('./web/classes/_standard.php');
        require ('./web/classes/_print.php');
        
        require ('./web/classes/tcpdf/config/tcpdf_config.php');
        require ('./web/classes/tcpdf/tcpdf.php');
        require ('./web/classes/_tcpdf_init.php');
        
        $sessionStorage = new NativeSessionStorage(array(), new NativeFileSessionHandler());
        $session = new Session($sessionStorage);
        $session->start();
        
        $auth = json_decode($session->get('auth'));
        $firmID = $auth->{'firmID'};
        
        if (isset($_FILES['file']['name'])) {
            $fileNameAttachment = $_FILES['file']['name'];
            $tmpName = $_FILES['file']['tmp_name'];
            $fileSize = $_FILES['file']['size'];
            $fileType = $_FILES['file']['type'];
            $array = object_to_array(json_decode($_REQUEST["formData"]));
        } else {
            $array = object_to_array(json_decode($_REQUEST["data"]));
        }
    
        echo "hier wi ar";
        
    
     return new JsonResponse();
}

}