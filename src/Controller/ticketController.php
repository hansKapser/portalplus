<?php
// src/Controller/managementController.php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Session\Storage\NativeSessionStorage;
use Symfony\Component\HttpFoundation\Session\Storage\Handler\NativeFileSessionHandler;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ticketController extends Controller
{

	/**
	* @Route("/ticketsInit")
	*/        

    public function ticketInit()
        {
       
       $sessionStorage = new NativeSessionStorage(array(), new NativeFileSessionHandler());
       $session = new Session($sessionStorage);
       $session->start();
       $auth = $session->get('auth');
       //echo $auth;
       
       $htmlContent=file_get_contents ( './templates/de/management.html');
       //$htmlContent = $this->render ( 'de/management.html.twig');
        
       $return = array();
       $return[] = array(
       'label' => 'html',
       'content' =>json_encode($htmlContent)
       );
                              
        return new JsonResponse($return);
                              
    }
    
    public function managementTicketsListInit()
    {
        include ('./web/classes/_standard.php');
        
        $sessionStorage = new NativeSessionStorage(array(), new NativeFileSessionHandler());
        $session = new Session($sessionStorage);
        $session->start();
        //$auth = $session->get('auth');
        $auth = json_decode($session->get('auth'));
        
        $firmID = $auth->{'firmID'};
        $schoolNo = $auth->{'schoolNo'};
        
        $em = $this->getDoctrine()->getManager();
        
        $sql="select left(date,4) as year
                from p17_tickets
                where
                firmID=$firmID
                order by date desc limit 1";
        $rows=_db_rows($em,$sql);
        if (count($rows)==0) {
            $year=2010;
        } else {
            $year=$rows[0]["year"];
        }
        
        $sql = "select t.*,
                    u.userID,u.name as user_name,
                    team.id as teamID, team.name as team_name
                    from p17_tickets t
                    left join p17_user u on u.userID=t.userID 
                    left join p17_user_team team on team.id=t.userID
                    where
                    t.firmID=$firmID AND
                    left(t.date,4)='$year'
                    order by t.ticketID desc";
        $rowsTickets=_db_rows($em,$sql);
        
        $sql="select distinct left(date,4) as value,
                concat('Schuljahr ',left(date,4),'/',left(date,4)+1) as label
                from p17_postbook_in where firmID=$firmID
                order by value desc";
        $rowsSchoolYears=_db_rows($em,$sql);
        
        
        $sql = "select * from p17_system_grid
		where
		modul='managementTicketsList'";
        $rowGrid = _db_row($em,$sql);
        
        
        $htmlContent=file_get_contents ( './templates/de/managementTicketsList.html');
        
        $return = array();
        $return[] = array(
            'label' => 'html',
            'content' =>json_encode($htmlContent)
        );

        $return[] = array(
            'label' => 'rowsTickets',
            'content' =>json_encode($rowsTickets)
        );
        
        $return[] = array(
            'label' => 'rowsSchoolYears',
            'content' =>json_encode($rowsSchoolYears)
        );
        
        $return[] = array(
            'label' => 'rowGrid',
            'content' =>json_encode($rowGrid)
        );
        
        return new JsonResponse($return);
        
    }
    
    public function managementTicketsChangeData(Request $request)
    {
        require ('./web/classes/_standard.php');
        $array=object_to_array(json_decode($_REQUEST["data"]));
        
        $sessionStorage = new NativeSessionStorage(array(), new NativeFileSessionHandler());
        $session = new Session($sessionStorage);
        $session->start();
        $auth = json_decode($session->get('auth'));
        $firmID = $auth->{'firmID'};
        $user = $auth->{'user'};
        
        $year=$array["year"];
        
        $em = $this->getDoctrine()->getManager();
        
        $sql = "select t.*,
                    u.userID,u.name as user_name,
                    team.id as teamID, team.name as team_name
                    from p17_tickets t
                    left join p17_user u on u.userID=t.userID
                    left join p17_user_team team on team.id=t.userID
                    where
                    t.firmID=$firmID AND
                    left(t.date,4)='$year'
                    order by t.ticketID desc";
        $rowsTickets=_db_rows($em,$sql);
        
        $return = array();
        $return[] = array(
            'label' => 'rowsTickets',
            'content' =>json_encode($rowsTickets)
        );
        
        return new JsonResponse($return);
        
        
    }
    
    
    public function ticketsGetByDivision(Request $request)
    {
        require ('./web/classes/_standard.php');
        $array=object_to_array(json_decode($_REQUEST["data"]));
        
        $sessionStorage = new NativeSessionStorage(array(), new NativeFileSessionHandler());
        $session = new Session($sessionStorage);
        $session->start();
        $auth = json_decode($session->get('auth'));
        $firmID = $auth->{'firmID'};
        
        $division=$array["division"];
        $from_firmID=$array["from_firmID"];
        
        $em = $this->getDoctrine()->getManager();
        
        $sql="select t.* from p17_tickets t 
                where 
                firmID=$firmID AND 
                from_firmID=$from_firmID AND
                division='$division'
                order by date desc";
        $rowsTickets=_db_rows($em,$sql);
        
        $return = array();
        $return[] = array(
            'label' => 'rowsTickets',
            'content' =>json_encode($rowsTickets)
        );
        
        return new JsonResponse($return);
        
    }
    
    public function ticketGetFiles(Request $request)
    {
        require ('./web/classes/_standard.php');
        //$array=object_to_array(json_decode($_REQUEST["data"]));
        
        $sessionStorage = new NativeSessionStorage(array(), new NativeFileSessionHandler());
        $session = new Session($sessionStorage);
        $session->start();
        $auth = json_decode($session->get('auth'));
        $firmID = $auth->{'firmID'};
        
        $ticketID=$_REQUEST["ticketID"];
        
        
        $em = $this->getDoctrine()->getManager();
        $sql="select t.division,t.workflowStatus
            from p17_tickets t
            where t.ticketID=$ticketID";
        $row=_db_row($em,$sql);
        $division=$row["division"];
        $workflowStatus=$row["workflowStatus"];
        $sql="select f.id,f.ticketID,f.name,f.size,f.date
            from p17_files f
            where f.ticketID=$ticketID";
        $rowsFiles=_db_rows($em,$sql);
        
        $rowsFilesInternal=array();
        $arr_temp=explode(",",$workflowStatus);
        for ($i=0;$i<count($arr_temp);$i++) {
            $rowsFilesInternal[]["label"]=$arr_temp[$i];
            $rowsFilesInternal[]["value"]=$arr_temp[$i];
        }
        
        /*
         * collect internal files
         * not realy files only for print on the fly
         * some documents are already sent by E-Mail
         * let's walk through
         */
        
        $rowsFilesInternal=array();
        
        $sql = "select ticketID,
		orderID as id,
		voucher as type,
		date as sentDate,
		voucherDate as date,
		voucherNo,
		division
		from p17_postbook_out
		where
		ticketID=$ticketID";
        $rowsPostOut = _db_rows($em,$sql);
        
        /*
         * purchase division start
         */
        
        $sql = "select ticketID,
		'E' as division,
		orderID as id,
		date,voucherNo,'Bedarfsmeldung' as type,
        'BM' as form
		from p17_purchase_request
		where
		ticketID=$ticketID";
        $rows = _db_rows($em,$sql);
        
        if (count($rows) > 0)
            $rowsFilesInternal = array_merge($rowsFilesInternal, $rows);
            
        $sql = "select ticketID,
		'E' as division,
		orderID as id,
		date,voucherNo,'Anfrage' as type,
        'AN' as form
		from p17_purchase_enquiry
		where
		ticketID=$ticketID";
            $rows = _db_rows($em,$sql);
            if (count($rows) > 0)
                $rowsFilesInternal = array_merge($rowsFilesInternal, $rows);
                
        $sql = "select ticketID,
		'E' as division,
		orderID as id,
		purchaseDate as date,
		purchaseNo as voucherNo,
		'Bestellung' as type,
        'BE' as form,
        printForm,printLang
		from p17_purchasebook
		where
		ticketID=$ticketID";
                $rows = _db_rows($em,$sql);
                
                if (count($rows) > 0)
                    $rowsFilesInternal = array_merge($rowsFilesInternal, $rows);
                    
        $sql = "select ticketID,
		id,
		'E' as division,
		creditDate as date,
		creditNo as voucherNo,
		'Retour' as type,
        'ES' as form
		from p17_purchase_credit
		where
		ticketID=$ticketID";
                 $rows = _db_rows($em,$sql);
                 if (count($rows) > 0)
                     $rowsFilesInternal = array_merge($rowsFilesInternal, $rows);
                        
    /*
    * purchase divsion end
    */
                        
    /*
    * customers order division start
    */
                        
        $sql = "select o.ticketID,
		'V' as division,
		'Auftragsbestätigung' as type,
		o.orderID as id,
		o.orderDate as date,
		o.orderNo as voucherNo,
		o.dispatchDate,
		i.invoiceDate,
        'AB' as form,
        printForm,
        printLang
		from p17_orderbook o
			left join p17_order_invoice i
			on i.orderID=o.orderID
		where
		ticketID=$ticketID";
                 $row = _db_row($em,$sql);
                 $rows = array();
                        if (count($row) > 0 and $row["date"] != "0000-00-00")
                            $rows[] = $row;
                        if (count($row) > 0 and $row["dispatchDate"] != "0000-00-00") {
                            $row["type"] = "Lieferschein";
                            $row["LS"] = "LS";
                            $row["date"] = $row["dispatchDate"];
                            $rows[] = $row;
                        }
                        if (count($row) > 0 and $row["invoiceDate"] != "0000-00-00") {
                            $row["type"] = "Rechnung";
                            $row["form"] = "AR";
                            $row["date"] = $row["invoiceDate"];
                            $rows[] = $row;
                        }
                            
                        if (count($rows) > 0)
                            $rowsFilesInternal = array_merge($rowsFilesInternal, $rows);
                                
        $sql = "select ticketID,
		'V' as division,
		id,
		creditDate as date,
		creditNo as voucherNo,
		'Gutschrift' as type,
        'GS' as form
		from p17_order_credit
		where
		ticketID=$ticketID";
                 $rows = _db_rows($em,$sql);
                      if (count($rows) > 0)
                          $rowsFilesInternal = array_merge($rowsFilesInternal, $rows);
                                    
    /*
    * customers order divsion end
    */
                                    
    /*
    * walk through rowsPostOut
    */

    for ($i = 0; $i < count($rowsFilesInternal); $i ++) {
         $row = $rowsFilesInternal[$i];
         $division = $row["division"];
         $type = $row["type"];
         $form = $row["form"];
         $id = $row["id"];
         $date = $row["date"];
         $rowsFilesInternal[$i]["sent"] = "";
         
              for ($ii = 0; $ii < count($rowsPostOut); $ii ++) {
                   $rowPost = $rowsPostOut[$ii];
                                            
                   if ($rowPost["division"] == $row["division"] and $rowPost["type"] == $row["type"] and $rowPost["id"] == $row["id"] and $rowPost["date"] == $row["date"]) {
                       $rowsFilesInternal[$i]["sent"] = $rowPost["sentDate"];
                       break;
                   }
             }
     }

     $return = array();
        $return[] = array(
            'label' => 'rowsFiles',
            'content' =>json_encode($rowsFiles)
        );
        $return[] = array(
            'label' => 'rowsFilesInternal',
            'content' =>json_encode($rowsFilesInternal)
        );
        
        return new JsonResponse($return);
        
    }
    
}

