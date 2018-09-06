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
use App\Entity\P17PostbookIn;
use App\Entity\P17PostbookInVouchers;

class managementPostinController extends Controller
{

	/**
	* @Route("/managementCompanyMaster")
	*/        

    
    
    public function managementPostinBoxInit()
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
        $sql="select left(date,4) as year
                from p17_postbook_in 
                where
                firmID=$firmID
                order by date desc limit 1";
        $rows=_db_rows($em,$sql);
        if (count($rows)==0) {
            $year=2010;
        } else {
            $year=$rows[0]["year"];
        }
        
        $schoolYears=schoolYears($em,$firmID,"p17_postbook_in","date");
        $schoolYearFrom=$schoolYears[0]["from"];
        $schoolYearTo=$schoolYears[0]["to"];
        
        $sql = "select p.*,t.userID,u.userID,u.user as ticket_user,team.id as teamID,team.name as ticket_team
		from p17_postbook_in p
		left join p17_tickets t on p.ticketID=t.ticketID
		left join p17_user u on t.userID=u.userID
		left join p17_user_team team on team.id=t.teamID
		where p.firmID=$firmID AND
        p.date>='$schoolYearFrom' AND
        p.date<='$schoolYearTo'
        order by p.date desc";
        $rowsPostin=_db_rows($em,$sql);
        /*
        $sql="select f.firmID,f.company from p17_firms f order by f.company asc";
        $rowsFirms=_db_rows($em,$sql);

        $sql="select d.* from p17_divisions d order by d.id asc";
        $rowsDivisions=_db_rows($em,$sql);
        
        $sql = "select * from p17_postbook_in_vouchers order by division asc, voucher asc";
        $rowsVoucher = _db_rows($em,$sql);
        
        $sql = "select u.userID,u.name as user_name,c.id as classID,c.name as class_name
		from p17_user u
		left join p17_user_classes c on c.id=u.classID
		where
		u.firmID=$firmID order by c.id asc, c.name asc, u.name asc";
        $rowsUser = _db_rows($em,$sql);
        
        $sql = "select * from p17_user_team
		where
		firmID=$firmID
		order by name asc";
        $rowsTeam = _db_rows($em,$sql);
        */
        $sql="select distinct left(date,4) as value,
                concat('Schuljahr ',left(date,4),'/',left(date,4)+1) as label
                from p17_postbook_in where firmID=$firmID
                order by value desc";
        $rowsSchoolYears=_db_rows($em,$sql);
        
        $return = array();
        if (!$array["isHTML"]) {
            $htmlContent=file_get_contents ( './templates/de/managementPostinBox.html');
            $return[] = array(
                'label' => 'html',
                'content' => json_encode($htmlContent)
            );
            $sql = "select * from p17_system_grid
		where
		modul='managementPostinBox'";
            $rowGrid = _db_row($em,$sql);
            
            $return[] = array(
                'label' => 'rowGrid',
                'content' =>json_encode($rowGrid)
            );
            
        }
        
        $return[] = array(
            'label' => 'rowsPostin',
            'content' =>json_encode($rowsPostin)
        );
        /*
        $return[] = array(
            'label' => 'rowsFirms',
            'content' =>json_encode($rowsFirms)
        );
        $return[] = array(
            'label' => 'rowsDivisions',
            'content' =>json_encode($rowsDivisions)
        );
        $return[] = array(
            'label' => 'rowsVoucher',
            'content' =>json_encode($rowsVoucher)
        );
        $return[] = array(
            'label' => 'rowsUser',
            'content' =>json_encode($rowsUser)
        );
        $return[] = array(
            'label' => 'rowsTeam',
            'content' =>json_encode($rowsTeam)
        );
        */
        $return[] = array(
            'label' => 'rowsSchoolYears',
            'content' =>json_encode($rowsSchoolYears)
        );
        
        return new JsonResponse($return);
        
    }


    public function managementPostinBoxSave(Request $request)
    {
        require ('./web/classes/_standard.php');
        $array=object_to_array(json_decode($_REQUEST["data"]));
        
        $sessionStorage = new NativeSessionStorage(array(), new NativeFileSessionHandler());
        $session = new Session($sessionStorage);
        $session->start();
        $auth = json_decode($session->get('auth'));
        $firmID = $auth->{'firmID'};
        $user = $auth->{'user'};
        
        $array["firmID"]=$firmID;
        if ($array["id"]=="")
            $array["id"]=-1;
        $em = $this->getDoctrine()->getEntityManager();
        if ($array["id"]>=0) {
            $arrayWhere=array("id" => $array["id"]);
            _db_update($em,"p17_postbook_in", $array, $arrayWhere, $auth);
            $id=$array["id"];
        } else {
            $from_company=$array["from_company"];
            $sql="select firmID from p17_firms where company='$from_company'";
            $row=_db_row($em,$sql);
            $array["from_firmID"]=$row["firmID"];
            $today=date('Y-m-d');
            $arrayTicket=array();
            $arrayTicket["firmID"]=$firmID;
            $arrayTicket["masterID"]=0;
            $arrayTicket["userID"]=$array["userID"];
            $arrayTicket["teamID"]=$array["teamID"];
            $arrayTicket["classID"]=0;
            $arrayTicket["date"]=$today;
            $arrayTicket["division"]=$array["division"];
            $arrayTicket["from_firmID"]=$array["from_firmID"];
            $arrayTicket["from_company"]=$from_company;
            $arrayTicket["sender_company"]=$from_company;
            $arrayTicket["voucher"]=$array["voucher"];
            $arrayTicket["voucherNoExternal"]=$array["voucherNo"];
            $arrayTicket["voucherDateExternal"]=$array["voucherDate"];
            $arrayTicket["voucherNoInternal"]=$array["voucherNoInternal"];
            $arrayTicket["voucherOpen"]=$array["voucher"];
            $arrayTicket["workflowStatus"]='';
            $arrayTicket["complete"]='0000-00-00';
            
            $arrayTicket["user"]=$user;
            $arrayTicket["initiatorUser"]=$user;
            
            $ticketID=_db_insert($em,"p17_tickets",$arrayTicket, $auth);
            $array["ticketID"]=$ticketID;
            if ($array["sender_company"]=='')
                $array["sender_company"]=$from_company;
            $array["uid"]=0;
            $array["user"]=$user;
            unset($array['id']);
            $id=_db_insert($em,"p17_postbook_in", $array,  $auth);
            
        }
        
        $sql="select * from p17_postbook_in where id=$id";
        $row=_db_row($em,$sql);
        
        $return = array();
        $return[] = array(
            'label' => 'success',
            'content' =>json_encode('saved')
        );
        $return[] = array(
            'label' => 'row',
            'content' =>json_encode($row)
        );
        
        return new JsonResponse($return);
        
        
    }
    
    public function managementPostinBoxDelete(Request $request)
    {
        require ('./web/classes/_standard.php');
        $array=object_to_array(json_decode($_REQUEST["data"]));
        
        $sessionStorage = new NativeSessionStorage(array(), new NativeFileSessionHandler());
        $session = new Session($sessionStorage);
        $session->start();
        $auth = json_decode($session->get('auth'));
        $firmID = $auth->{'firmID'};
        $array["firmID"]=$firmID;
        $id=$array["id"];
        
        $em = $this->getDoctrine()->getEntityManager();
        $record = $em->getRepository(P17PostbookIn::class)->find($id);
        $em->remove($record);
        $em->flush();
        
        $return = array();
        $return[] = array(
            'label' => 'success',
            'content' =>json_encode('saved')
        );
        
        return new JsonResponse($return);
        
        
    }


    public function managementPostinVoucherInit()
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
        
        $sql="select d.* from p17_divisions d order by d.id asc";
        $rowsDivisions=_db_rows($em,$sql);
        
        $sql = "select * from p17_postbook_in_vouchers order by division asc, voucher asc";
        $rowsVoucher = _db_rows($em,$sql);
        
        
        
        
        $return = array();
        if (!$array["isHTML"]) {
            $htmlContent=file_get_contents ( './templates/de/managementPostinVoucher.html');
            $return[] = array(
                'label' => 'html',
                'content' => json_encode($htmlContent)
            );
            $sql = "select * from p17_system_grid
		          where
		          modul='managementPostinVoucher'";
            $rowGrid = _db_row($em,$sql);
            $return[] = array(
                'label' => 'rowGrid',
                'content' =>json_encode($rowGrid)
            );
            
        }
        
        $return[] = array(
            'label' => 'rowsDivisions',
            'content' =>json_encode($rowsDivisions)
        );
        
        $return[] = array(
            'label' => 'rowsVoucher',
            'content' =>json_encode($rowsVoucher)
        );
        
        
        return new JsonResponse($return);
        
    }
    
    public function managementPostinChangeData(Request $request)
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
        $schoolYears = schoolYears($em, $firmID, "p17_postbook_in", "date", $year);
        $schoolYearFrom = $schoolYears[0]["from"];
        $schoolYearTo = $schoolYears[0]["to"];
        
        
        
        $sql = "select p.*,t.userID,u.userID,u.user as ticket_user,team.id as teamID,team.name as ticket_team
		from p17_postbook_in p
		left join p17_tickets t on p.ticketID=t.ticketID
		left join p17_user u on t.userID=u.userID
		left join p17_user_team team on team.id=t.teamID
		where p.firmID=$firmID AND
        p.date>='$schoolYearFrom' AND
        p.date<='$schoolYearTo'
        order by p.date desc";
        $rowsPostin=_db_rows($em,$sql);
             
            $return = array();
            $return[] = array(
                'label' => 'rowsPostin',
                'content' =>json_encode($rowsPostin)
            );
            
            return new JsonResponse($return);
            
            
    }
    
    public function managementPostinVoucherSave(Request $request)
    {
        require ('./web/classes/_standard.php');
        $array=object_to_array(json_decode($_REQUEST["data"]));
        
        $sessionStorage = new NativeSessionStorage(array(), new NativeFileSessionHandler());
        $session = new Session($sessionStorage);
        $session->start();
        $auth = json_decode($session->get('auth'));
        $firmID = $auth->{'firmID'};
        $array["firmID"]=$firmID;
        
        
        $em = $this->getDoctrine()->getEntityManager();

        if ($array["id"]=="")
            $array["id"]=-1;
        $em = $this->getDoctrine()->getEntityManager();
        
        if ($array["id"]>=0) {
          $arrayWhere=array("id" => $array["id"]);
          _db_update($em,"p17_postbook_in_vouchers", $array, $arrayWhere, $auth);
          $id=$array["id"];
        } else {
          unset($array['id']);
          $id=_db_insert($em,"p17_postbook_in_vouchers", $array,  $auth);
        }
        
        $return = array();
        $return[] = array(
            'label' => 'success',
            'content' =>json_encode('saved')
        );
        
        return new JsonResponse($return);
        
        
    }

    public function managementPostinVoucherDelete(Request $request)
    {
        require ('./web/classes/_standard.php');
        $array=object_to_array(json_decode($_REQUEST["data"]));
        
        $sessionStorage = new NativeSessionStorage(array(), new NativeFileSessionHandler());
        $session = new Session($sessionStorage);
        $session->start();
        $auth = json_decode($session->get('auth'));
        $firmID = $auth->{'firmID'};
        $array["firmID"]=$firmID;
        
        $id=$array["id"];
        $em = $this->getDoctrine()->getEntityManager();
        $record = $em->getRepository(P17PostbookInVouchers::class)->find($id);
        $em->remove($record);
        $em->flush();
        
        $return = array();
        $return[] = array(
            'label' => 'success',
            'content' =>json_encode('saved')
        );
        
        return new JsonResponse($return);
        
        
    }
    
}
