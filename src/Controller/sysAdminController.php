<?php
// src/Controller/purchaseController.php
namespace App\Controller;



use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Session\Storage\NativeSessionStorage;
use Symfony\Component\HttpFoundation\Session\Storage\Handler\NativeFileSessionHandler;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request; 
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use App\Entity\P17FirmsApplication;

class sysAdminController extends Controller
{

	/**
	* @Route("/sysAdminInit")
	*/        

    public function sysAdminInit()
        {
            require ('./web/classes/_standard.php');
            $array=object_to_array(json_decode($_REQUEST["data"]));
            
       $sessionStorage = new NativeSessionStorage(array(), new NativeFileSessionHandler());
       $session = new Session($sessionStorage);
       $session->start();
       $auth = $session->get('auth');
       //echo $auth;
       
       //$htmlContent = $this->render ( 'de/management.html.twig');
        
       $return = array();
       if (!$array["isHTML"]) {
           $htmlContent=file_get_contents ( './templates/de/sysAdmin.html');
           $return[] = array(
               'label' => 'html',
               'content' =>json_encode($htmlContent)
           );
       }
       
        return new JsonResponse($return);
                              
    }
    
    public function sysAdminNewFirmsInit()
    {
        require ('./web/classes/_standard.php');
        $array=object_to_array(json_decode($_REQUEST["data"]));
        
        $sessionStorage = new NativeSessionStorage(array(), new NativeFileSessionHandler());
        $session = new Session($sessionStorage);
        $session->start();
        //$auth = $session->get('auth');
        $auth = json_decode($session->get('auth'));
        
        $firmID = $auth->{'firmID'};
        
        $em = $this->getDoctrine()->getManager();
        $sql = "select *
            from p17_firms_application
            order by company asc";
        $rowsNewFirms=_db_rows($em,$sql);
        
        $return = array();
        if (!$array["isHTML"]) {
            $htmlContent=file_get_contents ( './templates/de/sysAdminNewFirms.html');
            $return[] = array(
                'label' => 'html',
                'content' =>json_encode($htmlContent)
            );
            $sql = "select * from p17_system_grid
		where
		modul='sysAdminNewFirms'";
            $rowGrid = _db_row($em,$sql);
            $return[] = array(
                'label' => 'rowGrid',
                'content' =>json_encode($rowGrid)
            );
        }
        $return[] = array(
            'label' => 'rowsNewFirms',
            'content' =>json_encode($rowsNewFirms)
        );
        
        return new JsonResponse($return);
        
    }
    
    public function sysAdminNewFirmsDelete(Request $request)
    {
        require ('./web/classes/_standard.php');
        $array = object_to_array(json_decode($_REQUEST["data"]));
        
        $sessionStorage = new NativeSessionStorage(array(), new NativeFileSessionHandler());
        $session = new Session($sessionStorage);
        $session->start();
        $auth = json_decode($session->get('auth'));
        $firmID = $auth->{'firmID'};
        $array["firmID"] = $firmID;
        // sent by dialogDelete
        $id = $array["id"];
        
        $em = $this->getDoctrine()->getEntityManager();
        $record = $em->getRepository(P17FirmsApplication::class)->find($id);
        $em->remove($record);
        $em->flush();
        
        $return = array();
        $return[] = array(
            'label' => 'success',
            'content' => json_encode('deleted')
        );
        
        return new JsonResponse($return);
    }
   
    public function sysAdminNewFirmsSave(Request $request)
    {
        require ('./web/classes/_standard.php');
        $array = object_to_array(json_decode($_REQUEST["data"]));
        
        $sessionStorage = new NativeSessionStorage(array(), new NativeFileSessionHandler());
        $session = new Session($sessionStorage);
        $session->start();
        $auth = json_decode($session->get('auth'));
        //$firmID = $auth->{'firmID'};
        $user = $auth->{'user'};
        $ownEmail = $auth->{'email'};
        $ownEmailPass = $auth->{'emailPass'};
        $ownCompany = $auth->{'company'};
        
        $array["user"] = $user;
        
        $newFirmID=$array["firmID"];

        $em = $this->getDoctrine()->getEntityManager();
            $sql="select applicationFirmID,company,country,postcode,city
             from p17_firms_application where firmID=$newFirmID";
            $row=_db_row($em,$sql);
            $applicationFirmID=$row["applicationFirmID"];
            $newCompany=$row["company"];
            $newCountry=$row["country"];
            $newPostcode=$row["postcode"];
            $newCity=$row["city"];
        
            unset($array["firmID"]);
            
            $irmID=_db_insert($em, "p17_firms", $array, $auth);
                            
        
            $from = $ownCompany . " <" . $ownEmail . ">";
            $mail = new PHPMailer(true); // Passing `true` enables exceptions
            try {
                $sql="select company,email from p17_firms where firmID=$applicationFirmID";
                $row=_db_row($em,$sql);
                $mailReceiver=$row["email"];
                $mailReceiverCompany=$row["company"];
                $mailSubject=utf8_decode("Antrag auf neue Firma");
                $mailMessage=utf8_decode("Die Übungsfirma <BR>".
                    "<b>".$newCompany."</b><BR>".
                    $newCountry." ".$newPostcode." ".$newCity."<BR>".
                    "wurde in den Firmenstamm aufgenommen.<BR><BR>".
                    "Mit freundlichen Grüßen<BR>".
                    "Übungsfirmenzentrale der Bayrischen Wirtschaftsschulen<BR>".
                    "gez. Michael Wolf");
                
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
                
                
                $mail->Body = $mailMessage;
                
                
                // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
                
                $mail->send();
                $success = "Benachrichtigung per E-Mail an $mailReceiver gesendet";
            } catch (Exception $e) {
                $success = "Probleme beim E-Mailversand, überprüfen Sie Ihre E-Mailadresse und das Passwort!";
                echo $success;
            }
            
            
            $return = array();
            $return[] = array(
                'label' => 'success',
                'content' => json_encode('saved')
            );
            
            return new JsonResponse($return);
    }
    
    public function sysAdminChangeFirmInit()
    {
        require ('./web/classes/_standard.php');
        $array=object_to_array(json_decode($_REQUEST["data"]));
        
        $sessionStorage = new NativeSessionStorage(array(), new NativeFileSessionHandler());
        $session = new Session($sessionStorage);
        $session->start();
        //$auth = $session->get('auth');
        $auth = json_decode($session->get('auth'));
        
        $firmID = $auth->{'firmID'};
        
        $em = $this->getDoctrine()->getManager();
        
        $return = array();
        if (!$array["isHTML"]) {
            $htmlContent=file_get_contents ( './templates/de/sysAdminChangeFirm.html');
            $return[] = array(
                'label' => 'html',
                'content' =>json_encode($htmlContent)
            );
        }
        
        return new JsonResponse($return);
        
    }
    
    public function sysAdminChangeFirm()
    {
        require ('./web/classes/_standard.php');
        $array=object_to_array(json_decode($_REQUEST["data"]));
        
        $sessionStorage = new NativeSessionStorage(array(), new NativeFileSessionHandler());
        $session = new Session($sessionStorage);
        $session->start();
        //$auth = $session->get('auth');
        $auth = json_decode($session->get('auth'));
        $userID=$auth->{'firmID'};
        $company=$array["company"];
        
        $em = $this->getDoctrine()->getManager();
                
        // get information for $_SESSION
        $sql = "select f.company,f.schoolNo,f.email,f.emailPass,f.IBAN,f.IPlocal
				from
				p17_user u, p17_firms f
				where
                f.company='$company'";
        
        $row=_db_row($em,$sql);
        $row["userID"]=$userID;
        
        $auth=json_encode($row);
        
        $session->set('auth', $auth);
        
        $return = array();
            $return[] = array(
                'label' => 'success',
                'content' =>json_encode("new Firm ".$company)
            );
        
        return new JsonResponse($return);
        
    }
    
    public function sysAdminGridInit()
    {
        require ('./web/classes/_standard.php');
        $array=object_to_array(json_decode($_REQUEST["data"]));
        
        $sessionStorage = new NativeSessionStorage(array(), new NativeFileSessionHandler());
        $session = new Session($sessionStorage);
        $session->start();
        //$auth = $session->get('auth');
        $auth = json_decode($session->get('auth'));
        
        $firmID = $auth->{'firmID'};
        
        $em = $this->getDoctrine()->getManager();
        
        $sql = "select *
            from p17_system_grid 
            order by modul asc";
        $rowsGrid=_db_rows($em,$sql);
        
        for ($i=0;$i<count($rowsGrid);$i++) {
        $dataModel=object_to_array(json_decode($rowsGrid[$i]["dataModel"]));
        
        if (isset($dataModel["table"])) {
            $fieldList=mysqlFieldList($em,$dataModel["table"]);
        } else {
            $fieldList=array();
            $fieldList[0]["FieldLabel"]="table not yet defined";
            $fieldList[0]["Type"]="";
        }
        for ($ii=0;$ii<count($fieldList);$ii++) {
            if ($fieldList[$ii]["Type"]!="")
                $fieldList[$ii]["FieldLabel"]=$fieldList[$ii]["Field"]." (".$fieldList[$ii]["Type"].")";
        }
        $rowsGrid[$i]["fieldList"]=$fieldList;
        }
        
        $sql = "select * from p17_system_grid
		where
		modul='sysAdminGrid'";
        $rowGrid = _db_row($em,$sql);
        
        
        $return = array();
        if (!$array["isHTML"]) {
            $htmlContent=file_get_contents ( './templates/de/sysAdminGrid.html');
            $return[] = array(
                'label' => 'html',
                'content' =>json_encode($htmlContent)
            );
            $sql = "select * from p17_system_grid
		where
		modul='sysAdminGrid'";
            $rowGrid = _db_row($em,$sql);
            $return[] = array(
                'label' => 'rowGrid',
                'content' =>json_encode($rowGrid)
            );
        }
        
        $return[] = array(
            'label' => 'rowsGrid',
            'content' =>json_encode($rowsGrid)
        );
        
        return new JsonResponse($return);
        
    }
    
    public function sysAdminGridSave(Request $request)
    {
        require ('./web/classes/_standard.php');
        $array = object_to_array(json_decode($_REQUEST["data"]));
        
        $sessionStorage = new NativeSessionStorage(array(), new NativeFileSessionHandler());
        $session = new Session($sessionStorage);
        $session->start();
        $auth = json_decode($session->get('auth'));
        $firmID = $auth->{'firmID'};
        $user = $auth->{'user'};
        $array["user"] = $user;
        $array["firmID"] = $firmID;
        $field = $array["field"];
        $array[$field]=$array["content"];
        
        if ($array["id"] == "")
            $array["id"] = - 1;
        $em = $this->getDoctrine()->getEntityManager();
            if ($array["id"] >= 0) {
                $arrayWhere = array(
                    "id" => $array["id"]
                );
                _db_update($em, "p17_system_grid", $array, $arrayWhere, $auth);
                $id = $array["id"];
            } else {
                unset($array["id"]);
                $id = _db_insert($em, "p17_system_grid", $array,  $auth);
            }
            
            $sql = "select * from p17_system_grid order by modul asc";
            $rowsGrid = _db_rows($em, $sql);
            for ($i=0;$i<count($rowsGrid);$i++) {
                $dataModel=object_to_array(json_decode($rowsGrid[$i]["dataModel"]));
                
                if (isset($dataModel["table"])) {
                    $fieldList=mysqlFieldList($em,$dataModel["table"]);
                } else {
                    $fieldList=array();
                    $fieldList[0]["FieldLabel"]="table not yet defined";
                    $fieldList[0]["Type"]="";
                }
                for ($ii=0;$ii<count($fieldList);$ii++) {
                    if ($fieldList[$ii]["Type"]!="")
                        $fieldList[$ii]["FieldLabel"]=$fieldList[$ii]["Field"]." (".$fieldList[$ii]["Type"].")";
                }
                $rowsGrid[$i]["fieldList"]=$fieldList;
            }
            
            $return = array();
            $return[] = array(
                'label' => 'success',
                'content' => json_encode('saved')
            );
            $return[] = array(
                'label' => 'rowsGrid',
                'content' => json_encode($rowsGrid)
            );
            
            return new JsonResponse($return);
    }

    public function sysAdminPrintTemplatesInit()
    {
        require ('./web/classes/_standard.php');
        $array=object_to_array(json_decode($_REQUEST["data"]));
        
        $sessionStorage = new NativeSessionStorage(array(), new NativeFileSessionHandler());
        $session = new Session($sessionStorage);
        $session->start();
        //$auth = $session->get('auth');
        $auth = json_decode($session->get('auth'));
        
        $firmID = $auth->{'firmID'};
        
        $em = $this->getDoctrine()->getManager();
        
        $sql = "select *
            from p17_templatesPdf order by division asc, name asc";
        $rowsTemplates=_db_rows($em,$sql);
        
        $return = array();
        if (!$array["isHTML"]) {
            $htmlContent=file_get_contents ( './templates/de/sysAdminPrintTemplates.html');
            $return[] = array(
                'label' => 'html',
                'content' =>json_encode($htmlContent)
            );
            $sql = "select * from p17_system_grid
		where
		modul='sysAdminPrintTemplates'";
            $rowGrid = _db_row($em,$sql);
            $return[] = array(
                'label' => 'rowGrid',
                'content' =>json_encode($rowGrid)
            );
        }
                
        $return[] = array(
            'label' => 'rowsTemplates',
            'content' =>json_encode($rowsTemplates)
        );
        
        return new JsonResponse($return);
        
    }
    
    public function sysAdminPrintTemplatesSave(Request $request)
    {
        require ('./web/classes/_standard.php');
        $array = object_to_array(json_decode($_REQUEST["data"]));
        
        $sessionStorage = new NativeSessionStorage(array(), new NativeFileSessionHandler());
        $session = new Session($sessionStorage);
        $session->start();
        $auth = json_decode($session->get('auth'));
        $firmID = $auth->{'firmID'};
        $user = $auth->{'user'};
        $array["user"] = $user;
        $array["firmID"] = $firmID;
        $lang = $array["lang"];
        $field="contentText_".$lang;
        
        $array[$field]=$array["content"];
        if ($array["id"] == "")
            $array["id"] = - 1;
            $em = $this->getDoctrine()->getEntityManager();
            if ($array["id"] >= 0) {
                $arrayWhere = array(
                    "id" => $array["id"]
                );
                _db_update($em, "p17_templatesPdf", $array, $arrayWhere, $auth);
                $id = $array["id"];
            } else {
                unset($array["id"]);
                $id = _db_insert($em, "p17_templatesPdf", $array,  $auth);
            }
            
            $sql = "select * from p17_templatesPdf order by division asc, name asc";
            $rowsTemplates = _db_rows($em, $sql);
            
            $return = array();
            $return[] = array(
                'label' => 'success',
                'content' => json_encode('saved')
            );
            // for called by _grid class return label=rows
            $return[] = array(
                'label' => 'rows',
                'content' => json_encode($rowsTemplates)
            );
            
            return new JsonResponse($return);
    }
    public function sysAdminMigrationDatabaseInit()
    {
        $title="dashboard";
        $date=date('d.m.Y');
        
        $sessionStorage = new NativeSessionStorage(array(), new NativeFileSessionHandler());
        $session = new Session($sessionStorage);
        $session->start();
        $auth = $session->get('auth');
        //echo $auth;
        
        $htmlContent=file_get_contents ( './templates/de/sysAdminMigration.html');
        
        $return = array();
        $return[] = array(
            'label' => 'html',
            'content' =>json_encode($htmlContent)
        );
        
        return new JsonResponse($return);
        
    }
    
    public function sysAdminMigrationDoIt()
    {
        $title="dashboard";
        $date=date('d.m.Y');
        
        $sessionStorage = new NativeSessionStorage(array(), new NativeFileSessionHandler());
        $session = new Session($sessionStorage);
        $session->start();
        $auth = $session->get('auth');
        //echo $auth;
        $em = $this->getDoctrine()->getEntityManager();
        
        
        $return = array();
        $return[] = array(
            'label' => 'success',
            'content' =>json_encode('.. wait')
        );
        
        return new JsonResponse($return);
        
    }
    
    public function sysAdminMigrationTriggerDoIt()
    {
        $title="dashboard";
        $date=date('d.m.Y');
        
        $sessionStorage = new NativeSessionStorage(array(), new NativeFileSessionHandler());
        $session = new Session($sessionStorage);
        $session->start();
        $auth = $session->get('auth');
        //echo $auth;
        $em = $this->getDoctrine()->getEntityManager();
        $sql = "SHOW tables";
        $result = $em->getConnection()->prepare($sql);
        $result->execute();
        $tables = $result->fetchAll();
        for ($i=0;$i<count($tables);$i++) {
            $table=$tables[$i]["Tables_in_portal17"];
            $sql = "SHOW COLUMNS from $table";
            $result = $em->getConnection()->prepare($sql);
            $result->execute();
            $arrayFields = $result->fetchAll();
            
            $isdateTime=false;
            $isuserID=false;
            $isexamDate=false;
            $isexamUser=false;
            
            for ($ii=0;$ii<count($arrayFields);$ii++) {
                if ($arrayFields[$ii]["Field"]=="dateTime")
                    $isdateTime=true;
                    if ($arrayFields[$ii]["Field"]=="userID")
                        $isuserID=true;
                        if ($arrayFields[$ii]["Field"]=="examDate")
                            $isexamDate=true;
                            if ($arrayFields[$ii]["Field"]=="examUser")
                                $isexamUser=true;
            }
            
            $lastField=$arrayFields[count($arrayFields)-1]["Field"];
            
            if (!$isuserID AND !$isdateTime) {
                $sql="ALTER TABLE $table
                ADD userID INT NULL DEFAULT NULL AFTER $lastField,
                ADD dateTime DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP AFTER userID;";
                $result = $em->getConnection()->prepare($sql);
                $result->execute();
            }
            
            if ($isuserID AND !$isdateTime) {
                $sql="ALTER TABLE $table
                ADD dateTime DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP AFTER $lastField;";
                $result = $em->getConnection()->prepare($sql);
                $result->execute();
            }
            
            if ($isexamDate) {
                $sql="ALTER TABLE $table
            DROP examDate";
                $result = $em->getConnection()->prepare($sql);
                $result->execute();
            }
            
            if ($isexamUser) {
                $sql="ALTER TABLE $table
            DROP examUserID";
                $result = $em->getConnection()->prepare($sql);
                $result->execute();
            }
            
            $triggerUpdate=$table."_update";
            $triggerInsert=$table."_insert";
            
            $sql="DROP TRIGGER IF EXISTS $triggerUpdate;
                CREATE DEFINER=hansk@localhost TRIGGER
                $triggerUpdate BEFORE UPDATE ON $table
                FOR EACH ROW
                BEGIN
                SET NEW.dateTime = NOW();
                if (NEW.userID is null)
                then set NEW.userID=1;
                else SET NEW.userID = @_userID;
                end if;
                insert into p17_user_activities
                    (NEW.userID,p17_table,table_id,action)
                    values (NEW.userID,'$table',OLD.id,'update');
                END";
                $result = $em->getConnection()->prepare($sql);
                $result->execute();
                
                $sql="DROP TRIGGER IF EXISTS $triggerInsert;
                CREATE DEFINER=hansk@localhost TRIGGER
                $triggerInsert BEFORE INSERT ON $table
                FOR EACH ROW BEGIN
                declare last_id int default 0;
                select auto_increment into last_id
                    from information_schema.tables
                    where table_name = $table and
                    table_schema = database();
                SET NEW.dateTime = NOW();
                if (NEW.userID is null)
                then set NEW.userID=1;
                else SET NEW.userID = @_userID;
                end if;
                insert into p17_user_activities
                    (NEW.userID,p17_table,table_id,action)
                    values (NEW.userID,'$table',last_id,'insert');
                END";
                
                $result = $em->getConnection()->prepare($sql);
                $result->execute();
                
                
                
        }
        
        
        
        $return = array();
        $return[] = array(
            'label' => 'success',
            'content' =>json_encode('.. wait')
        );
        
        return new JsonResponse($return);
        
    }
    
}

