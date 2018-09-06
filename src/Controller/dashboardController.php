<?php
// src/Controller/dashboardController.php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Session\Storage\NativeSessionStorage;
use Symfony\Component\HttpFoundation\Session\Storage\Handler\NativeFileSessionHandler;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use App\Entity\P17Pinboard;


class dashboardController extends Controller
{

    /**
     *
     * @Route("/dashboard")
     */
    public function dashboard()
    {
        $title = "dashboard";
        $date = date('d.m.Y');
        
        $sessionStorage = new NativeSessionStorage(array(), new NativeFileSessionHandler());
        $session = new Session($sessionStorage);
        $session->start();
        $auth = $session->get('auth');
        // echo $auth;
        
        return $this->render('de/dashboard.html.twig', array(
            'title' => $title,
            'date' => $date
        ));
    }

    public function dashboardInit(Request $request)
    {
        require ('./web/classes/_standard.php');
        
        $sessionStorage = new NativeSessionStorage(array(), new NativeFileSessionHandler());
        $session = new Session($sessionStorage);
        $session->start();
        if (null === $session->get('auth')) {
            $return=array();
            $return[] = array(
                'label' => 'sessionLogout',
                'content' => json_encode('time over')
            );
            return new JsonResponse($return);
        }
        $auth = json_decode($session->get('auth'));
        
        
        
        $firmID = $auth->{'firmID'};
        $userID = $auth->{'userID'};
        $teamID = $auth->{'teamID'};
        $status = $auth->{'status'};
        
        $today = date('Y-m-d');
        
        
        $em = $this->getDoctrine()->getManager();
        
        $sql="select * from p17_firms where firmID=$firmID";
        $rowFirm=_db_row($em,$sql);
        
        $sql = "select f.firmID,f.company from p17_firms f order by firmID asc";
        $rowsFirms = _db_row($em, $sql);
        
        
        $return = array();
        $return[] = array(
            'label' => 'session',
            'content' => json_encode($auth)
        );
        $return[] = array(
            'label' => 'rowFirm',
            'content' => json_encode($rowFirm)
        );
        
        $return[] = array(
            'label' => 'rowOwnFirm',
            'content' => json_encode($rowFirm)
        );
        
        $return[] = array(
            'label' => 'rowsFirms',
            'content' => json_encode($rowsFirms)
        );
        
        
        return new JsonResponse($return);
    }
    
    public function dashboardDataInit(Request $request)
    {
        require ('./web/classes/_standard.php');
        
        $sessionStorage = new NativeSessionStorage(array(), new NativeFileSessionHandler());
        $session = new Session($sessionStorage);
        $session->start();
        $auth = json_decode($session->get('auth'));
        
        $firmID = $auth->{'firmID'};
        $userID = $auth->{'userID'};
        $teamID = $auth->{'teamID'};
        $status = $auth->{'status'};
        
        $today = date('Y-m-d');
        
        $em = $this->getDoctrine()->getManager();
        
        $sql="select f.*,
                if (i.id is null,0,1) as catalogue
                from p17_firms f
                left join p17_firms_files i on i.firmID=$firmID AND i.kind='catalogue'
                where f.firmID=$firmID";
        $rowFirm=_db_row($em,$sql);
        $schoolNo=$rowFirm["schoolNo"];
        
        $sql = "select f.firmID,f.company
		          from p17_firms f
                  where
                  schoolNo='$schoolNo'
                  order by f.company asc";
        $rowsSchoolFirms=_db_rows($em,$sql);
        
        $sql = "select f.firmID,f.company from p17_firms f order by firmID asc";
        $rowsFirms = _db_row($em, $sql);
        
        $sql = "select f.*,
                n.debitor,n.creditor,n.minOrderValue,n.carriageFree,
                n.rebate,n.termPayment,
                n.C_rating,n.D_rating,n.prepayment,
                s.name as school
             from p17_firms f
             left join p17_firms_numbers n on n.firmID=$firmID 
                    AND n.firmIDpartner=f.firmID
             left join p17_schools s on f.schoolNo=s.schoolNo
	           order by f.company asc";
        $rowsFirmsComplete = _db_rows($em, $sql);

        $sql="select * from p17_banks order by name asc";
        $rowsBanks=_db_rows($em,$sql);
                
        $sql = "select * from p17_calendar_categories";
        
        
        $rowsCalendarCategories = _db_rows($em,$sql);
        
        
        $sql="select *,
             concat(discount_days,' Tg. ',discount,'% Skonto, ',net_days,' Tg. netto') as name
             from p17_terms_of_payment";
        $rowsTermPayment = _db_rows($em, $sql);
        
        
        $sql="select d.* from p17_divisions d order by d.id asc";
        $rowsDivisions=_db_rows($em,$sql);
        
        $sql = "select * from p17_postbook_in_vouchers order by division asc, voucher asc";
        $rowsVoucher = _db_rows($em,$sql);
        
        
        
        
        $sql="select * from p17_vat order by vat_id asc";
        $rowsVAT = _db_rows($em, $sql);
        
        $return = array();
        $return[] = array(
            'label' => 'session',
            'content' => json_encode($auth)
        );
        $return[] = array(
            'label' => 'rowFirm',
            'content' => json_encode($rowFirm)
        );
        
        $return[] = array(
            'label' => 'rowOwnFirm',
            'content' => json_encode($rowFirm)
        );
        
        $return[] = array(
            'label' => 'rowsBanks',
            'content' => json_encode($rowsBanks)
        );
        
        $return[] = array(
            'label' => 'rowsFirms',
            'content' => json_encode($rowsFirms)
        );
        $return[] = array(
            'label' => 'rowsSchoolFirms',
            'content' => json_encode($rowsSchoolFirms)
        );
        $return[] = array(
            'label' => 'rowsFirmsComplete',
            'content' => json_encode($rowsFirmsComplete)
        );
        $return[] = array(
            'label' => 'rowsDivisions',
            'content' => json_encode($rowsDivisions)
        );
        $return[] = array(
            'label' => 'rowsVoucher',
            'content' => json_encode($rowsVoucher)
        );
                
        $return[] = array(
            'label' => 'rowsCalendarCategories',
            'content' => json_encode($rowsCalendarCategories)
        );
        
        $return[] = array(
            'label' => 'rowsTermPayment',
            'content' => json_encode($rowsTermPayment)
        );
        
        $return[] = array(
            'label' => 'rowsVAT',
            'content' => json_encode($rowsVAT)
        );
        
               
        
        return new JsonResponse($return);
    }
    
    public function dashboardDataArticleInit(Request $request)
    {
        require ('./web/classes/_standard.php');
        
        $sessionStorage = new NativeSessionStorage(array(), new NativeFileSessionHandler());
        $session = new Session($sessionStorage);
        $session->start();
        $auth = json_decode($session->get('auth'));
        
        $firmID = $auth->{'firmID'};
        $userID = $auth->{'userID'};
        $teamID = $auth->{'teamID'};
        $status = $auth->{'status'};
        
        $today = date('Y-m-d');
        
        $em = $this->getDoctrine()->getManager();
                
        $sql = "select a.*,g.id as group_id, g.name as group_name
		from p17_article a,
        p17_article_group g
		where a.firmID=$firmID AND
		g.id=a.group_id
		order by group_name asc";
        $rowsArticle = _db_rows($em, $sql);
        
        $sql = "select g.*
		from p17_article_group g
		where g.firmID=$firmID
		order by name asc";
        $rowsArticleGroups=_db_rows($em,$sql);
        
        $sql = "select v.*,g.firmID,g.name as group_name
		from p17_article_variation_group g, p17_article_variation v
		where
        g.firmID=$firmID AND
        v.variation_group_id=g.id
		order by group_name asc,v.name asc";
        $rowsArticleVariations=_db_rows($em,$sql);
        
        $sql = "select g.id as variation_group_id,g.name
		from p17_article_variation_group g
		where g.firmID=$firmID
		order by name asc";
        $rowsArticleCategories=_db_rows($em,$sql);
        
        $sql = "select v.*
                from p17_article_variation v, p17_article_variation_group g
                where
                g.firmID=$firmID AND
                v.variation_group_id=g.id";
        $rowsVariation = _db_rows($em, $sql);
        
        $sql = "select s.*,
                if (s.variation1_id=0,'',(select name from p17_article_variation where id=s.variation1_id)) as variation1,
		        if (s.variation2_id=0,'',(select name from p17_article_variation where id=s.variation2_id)) as variation2
                from p17_article_variation_spec s, p17_article a
                where
                a.firmID=$firmID AND
                s.article_id=a.id";
        $rowsVariationSpec = _db_rows($em, $sql);
        
        
        $return = array();
        
        $return[] = array(
            'label' => 'rowsOwnArticle',
            'content' => json_encode($rowsArticle)
        );
        $return[] = array(
            'label' => 'rowsOwnArticleGroups',
            'content' => json_encode($rowsArticleGroups)
        );
        $return[] = array(
            'label' => 'rowsOwnVariation',
            'content' => json_encode($rowsVariation)
        );
        
        $return[] = array(
            'label' => 'rowsOwnArticleVariations',
            'content' => json_encode($rowsArticleVariations)
        );
        
        $return[] = array(
            'label' => 'rowsOwnArticleCategories',
            'content' => json_encode($rowsVariation)
        );
        
        $return[] = array(
            'label' => 'rowsOwnVariationSpec',
            'content' => json_encode($rowsVariationSpec)
        );
        
        return new JsonResponse($return);
    }
    public function dashboardDataUserInit(Request $request)
    {
        require ('./web/classes/_standard.php');
        
        $sessionStorage = new NativeSessionStorage(array(), new NativeFileSessionHandler());
        $session = new Session($sessionStorage);
        $session->start();
        $auth = json_decode($session->get('auth'));
        
        $firmID = $auth->{'firmID'};
        $userID = $auth->{'userID'};
        $teamID = $auth->{'teamID'};
        $status = $auth->{'status'};
        
        $today = date('Y-m-d');
        
        $em = $this->getDoctrine()->getManager();
        
        $sql = "select u.*,
                    c.name as class_name,
                    p.name as profile_name,t.name as team_name
                    from p17_user u,
                    p17_user_classes c,
                    p17_user_profiles p,
                    p17_user_team t
                    where
                    u.firmID=$firmID AND
                    c.id=u.classID AND
                    p.id=u.profileID AND
                    t.id=u.teamID
                    order by u.user asc";
        $rowsUser=_db_rows($em,$sql);
        
        $sql = "select * from p17_user_team
		where
		firmID=$firmID
		order by name asc";
        $rowsTeam = _db_rows($em,$sql);
        
        $sql = "select * from p17_user_classes
		where
		firmID=$firmID
		order by name asc";
        $rowsClass = _db_rows($em,$sql);
        
        
        
        $return = array();
        
        $return[] = array(
            'label' => 'rowsUser',
            'content' => json_encode($rowsUser)
        );
        
        $return[] = array(
            'label' => 'rowsTeam',
            'content' => json_encode($rowsTeam)
        );
        $return[] = array(
            'label' => 'rowsClass',
            'content' => json_encode($rowsClass)
        );
        
        
        return new JsonResponse($return);
    }
    public function dashboardDataAccountancyInit(Request $request)
    {
        require ('./web/classes/_standard.php');
        
        $sessionStorage = new NativeSessionStorage(array(), new NativeFileSessionHandler());
        $session = new Session($sessionStorage);
        $session->start();
        $auth = json_decode($session->get('auth'));
        
        $firmID = $auth->{'firmID'};
        $userID = $auth->{'userID'};
        $teamID = $auth->{'teamID'};
        $status = $auth->{'status'};
        
        $today = date('Y-m-d');
        
        $em = $this->getDoctrine()->getManager();
        
        $sql = "select *, v.percentage*100 as steuer_prozent,
	case (left(kontonummer,1))
	WHEN '0' THEN '0 Anlagevermögen'
	WHEN '1' THEN '1 Finanzanlagen'
	WHEN '2' THEN '2 Umlaufvermögen'
	WHEN '3' THEN '3 Eigenkapital'
	WHEN '4' THEN '4 Verbindlichkeiten'
	WHEN '5' THEN '5 Erträge'
	WHEN '6' THEN '6 Betriebliche Aufwendung'
	WHEN '7' THEN '7 weitere Aufwendungen'
	WHEN '8' THEN '8 Abschlusskonten'
	ELSE 'sonstiges'
	END AS klasse
	from p17_fibu_sachkonten s
	left join p17_vat v on v.vat_id=s.steuerzeile
	where
	s.firmID=0
	order by kontonummer asc";
        
        
        $rowsSachkonten = _db_rows($em, $sql);
        
        $sql = "select f.company as name,n.debitor,n.creditor,'' as percentage
                from p17_firms_numbers n
                left join p17_firms f on f.firmID=n.firmIDpartner
                where
                n.firmID=$firmID
                order by name asc";
        $rowsPersonenkonten = _db_rows($em, $sql);
        
        
        $return = array();
        
        $return[] = array(
            'label' => 'rowsPersonenkonten',
            'content' => json_encode($rowsPersonenkonten)
        );
        
        $return[] = array(
            'label' => 'rowsSachkonten',
            'content' => json_encode($rowsSachkonten)
        );
        
        
        return new JsonResponse($return);
    }
    
    public function dashboardCalendarInit(Request $request)
    {
        require ('./web/classes/_standard.php');
        
        $sessionStorage = new NativeSessionStorage(array(), new NativeFileSessionHandler());
        $session = new Session($sessionStorage);
        $session->start();
        $auth = json_decode($session->get('auth'));
        
        $firmID = $auth->{'firmID'};
        $userID = $auth->{'userID'};
        $teamID = $auth->{'teamID'};
        $status = $auth->{'status'};
        
        $today = date('Y-m-d');
        
        $em = $this->getDoctrine()->getManager();
        $sql = "select c.* 
                from p17_calendar c, p17_calendar_categories g
		      where
		      c.firmID=$firmID AND
		      g.id=c.categoryID AND
		      g.statusRead=1 OR
		      c.userID=$userID AND
		      c.start is null AND
		      g.id=c.categoryID
		      order by c.start asc";
        $rowsCalendar = _db_rows($em, $sql);
        
        $sql = "select t.userID,t.ticketID,t.voucher 
                from p17_tickets t 
                left join p17_calendar c on c.ticketID=t.ticketID 
                where
                t.userID=$userID AND                
                c.id IS NULL";
        $rowsCalendarOpenTasks = _db_rows($em,$sql);
        
        $return = array();

        $return[] = array(
            'label' => 'rowsCalendar',
            'content' => json_encode($rowsCalendar)
        );
        
        $return[] = array(
            'label' => 'rowsCalendarOpenTasks',
            'content' => json_encode($rowsCalendarOpenTasks)
        );

        return new JsonResponse($return);
    }
    
    public function calendarLoadDrags(Request $request)
    {
        require ('./web/classes/_standard.php');
        
        $sessionStorage = new NativeSessionStorage(array(), new NativeFileSessionHandler());
        $session = new Session($sessionStorage);
        $session->start();
        
        $firmID=326;
        $userID=1;
        
        $today = date('Y-m-d');
        
        $em = $this->getDoctrine()->getManager();
        
        $sql = "select t.userID,t.ticketID,t.voucher
            from p17_tickets t
                left join p17_calendar c on c.ticketID=t.ticketID
                where c.id IS NULL AND t.firmID=$firmID AND
                t.userID=$userID";
        $rowsOpenTasks = _db_rows($em,$sql);
        
        $sql = "select * from p17_calendar_categories";
        $rowsCalendarCategories = _db_rows($em,$sql);
        
        $return = array();
         $return[] = array(
         'label' => 'rowsOpenTasks',
         'content' => json_encode($rowsOpenTasks)
         );
         $return[] = array(
         'label' => 'rowsCalendarCategories',
         'content' => json_encode($rowsCalendarCategories)
         );
        return new JsonResponse($return);
    }
    
    
    public function dashboardTasksInit(Request $request)
    {
        require ('./web/classes/_standard.php');
        
        $sessionStorage = new NativeSessionStorage(array(), new NativeFileSessionHandler());
        $session = new Session($sessionStorage);
        $session->start();
        $auth = json_decode($session->get('auth'));
        $firmID = $auth->{'firmID'};
        
        $today = date('Y-m-d');
        
        $em = $this->getDoctrine()->getManager();
        
        $sql = "select t.*,u.user,
	       (select count(id) from p17_files where ticketID=t.ticketID) as isFile
	       from p17_tickets t
	       left join p17_user u on u.userID=t.userID
	       where
	       t.firmID=$firmID AND
	       complete is null 
	       order by t.userID asc, t.date asc";
        
        $rowsTickets = _db_rows($em, $sql);
        $sql = "select u.userID,u.name as user_name,c.id as classID,c.name as class_name
		      from p17_user u
		      left join p17_user_classes c on c.id=u.classID
		      where
		      u.firmID=$firmID order by c.name asc, u.name asc";
        $rowsUser = _db_rows($em, $sql);
        
        $sql = "select *,id as teamID from p17_user_team
		      where
		      firmID=$firmID
		      order by name asc";
        
        $rowsTeam = _db_rows($em, $sql);
        
        $sql = "select distinct f.firmID,f.company,t.userID,t.teamID
            from p17_tickets t, p17_firms f
            where 
            t.firmID=$firmID AND
            f.firmID=t.from_firmID AND
            t.complete is null
            order by f.firmID asc";
        $rowsFirms = _db_rows($em, $sql);
        
        $return=array();
        $return[] = array(
            'label' => 'rowsTickets',
            'content' => json_encode($rowsTickets)
        );
        $return[] = array(
            'label' => 'rowsTicketTeam',
            'content' => json_encode($rowsTeam)
        );
        $return[] = array(
            'label' => 'rowsTicketUser',
            'content' => json_encode($rowsUser)
        );
        $return[] = array(
            'label' => 'rowsTicketFirms',
            'content' => json_encode($rowsFirms)
        );
        
        return new JsonResponse($return);
    }
    
    
    public function dashboardTasksGetOrderIDfromTicketID(Request $request)
    {
        require ('./web/classes/_standard.php');
        $array=object_to_array(json_decode($_REQUEST["data"]));
        
        $sessionStorage = new NativeSessionStorage(array(), new NativeFileSessionHandler());
        $session = new Session($sessionStorage);
        $session->start();
        $auth = json_decode($session->get('auth'));
        $firmID = $auth->{'firmID'};
        
        $ticketID=$array["ticketID"];
        $em = $this->getDoctrine()->getEntityManager();
        if ($array["division"]=="E") {
            $table="p17_purchasebook";
            $sql="select orderID from $table where ticketID=$ticketID";
            $rows=_db_rows($em,$sql);
            if (count($rows)==0) {
                $table="p17_purchase_request";
                $sql="select orderID from $table where ticketID=$ticketID";
                $rows=_db_rows($em,$sql);
                if (count($rows)>0) {
                    // new purchase order from request
                    $row=$rows[0];
                    $arrayT["ticketID"]=$ticketID;
                    $arrayT["firmID"]=$firmID;
                    $arrayT["supplier_company"]=$row["supplier_company"];
                    $arrayT["purchaseDate"]=date('d.m.Y');
                    $orderID = _db_insert($em, "p17_purchasebook", $arrayT, $auth);
                    $table="p17_purchasebook";
                }
            }
            
        } else {
            $table="p17_orderbook";
        }
        $sql="select orderID from $table where ticketID=$ticketID";
        $row=_db_row($em,$sql);
            
        
        $return = array();
        $return[] = array(
            'label' => 'row',
            'content' =>json_encode($row)
        );
        
        return new JsonResponse($return);
        
        
    }
    
    public function dashboardPinboardInit(Request $request)
    {
        require ('./web/classes/_standard.php');
        
        $sessionStorage = new NativeSessionStorage(array(), new NativeFileSessionHandler());
        $session = new Session($sessionStorage);
        $session->start();
        $auth = json_decode($session->get('auth'));
                
        $today = date('Y-m-d');
        
        $em = $this->getDoctrine()->getManager();
                
        $sql = "select id,date,subject,message,author,
                if (content is null,0,1) as isDocument,name
                from p17_pinboard
		          order by date desc";
        
        $rowsPinboard = _db_rows($em, $sql);
        
        $return = array();
        $return[] = array(
            'label' => 'rowsPinboard',
            'content' => json_encode($rowsPinboard)
        );
        
        return new JsonResponse($return);
    }
    
    public function dashboardPinboardSave(Request $request)
    {
        require ('./web/classes/_standard.php');
        
        if (isset($_FILES['file']['name'])) {
            $fileName = $_FILES['file']['name'];
            $tmpName = $_FILES['file']['tmp_name'];
            $fileSize = $_FILES['file']['size'];
            $fileType = $_FILES['file']['type'];
            $array=object_to_array(json_decode($_REQUEST["formData"]));
            $datei = fopen($tmpName, 'r');
            $content = fread($datei, $fileSize);
            fclose($datei);
            $array["content"]=$content;
            $array["size"]=$fileSize;
            $array["type"]=$fileType;
            $array["name"]=$fileName;
        } else {
            $array=object_to_array(json_decode($_REQUEST["data"]));
        }
        
        
        //$array=object_to_array(json_decode($_REQUEST["data"]));
        
        $sessionStorage = new NativeSessionStorage(array(), new NativeFileSessionHandler());
        $session = new Session($sessionStorage);
        $session->start();
        $auth = json_decode($session->get('auth'));
        $firmID = $auth->{'firmID'};
        $user = $auth->{'user'};       
        //$array["firmID"]=$firmID;
        
        $array["author"]=$user;
        
        $id=$array["id"];
        $em = $this->getDoctrine()->getEntityManager();
        if ($id>=0) {
        $arrayWhere=array("id" => $id);
        _db_update($em,"p17_pinboard", $array, $arrayWhere, $auth);
        $sql="select id from p17_pinboard where id=$id";
        $row=_db_row($em,$sql);
        
        } else {
            // insert
            unset($array['id']);
            $id=_db_insert($em,"p17_pinboard", $array,  $auth);
            $sql="select id from p17_pinboard where id=$id";
            $row=_db_row($em,$sql);
        }
        
        $return = array();
        $return[] = array(
            'label' => 'success1',
            'content' =>json_encode('saved')
        );
        $return[] = array(
            'label' => 'row',
            'content' =>json_encode($row)
        );
        
        return new JsonResponse($return);
        
        
    }
    
    public function dashboardPinboardDelete(Request $request)
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
        $record = $em->getRepository(P17Pinboard::class)->find($id);
        $em->remove($record);
        $em->flush();
        
        $return = array();
        $return[] = array(
            'label' => 'success',
            'content' =>json_encode('deleted')
        );
        
        return new JsonResponse($return);
        
        
    }
    
    
    public function dashboardMenuUpdate(Request $request)
    {
        require ('./web/classes/_standard.php');
        /*
         * if ($request->isXmlHttpRequest() || $request->query->get('showJson') == 1) {
         * $jsonData = array();
         * $idx = 0;
         */
        $sessionStorage = new NativeSessionStorage(array(), new NativeFileSessionHandler());
        $session = new Session($sessionStorage);
        $session->start();
        $auth = json_decode($session->get('auth'));
        
        $firmID = $auth->{'firmID'};
        $userID = $auth->{'userID'};
        $teamID = $auth->{'teamID'};
        $status = $auth->{'status'};
        
        $today = date('Y-m-d');
        
        $return = array();
        $return[] = array(
            'label' => 'success1',
            'content' => json_encode('menuUpdate nothing to do')
        );
        
        return new JsonResponse($return);
    }

    public function dashboardImap(Request $request)
    {
        require ('./web/classes/_standard.php');
        $array=object_to_array(json_decode($_REQUEST["data"]));
        
        $sessionStorage = new NativeSessionStorage(array(), new NativeFileSessionHandler());
        $session = new Session($sessionStorage);
        $session->start();
        $auth = json_decode($session->get('auth'));
        
        $firmID = $auth->{'firmID'};
        $today = date('Y-m-d');
        
        $em = $this->getDoctrine()->getManager();

            $query = "select email,emailPass,host 
                        from p17_firms where firmID=$firmID";
            $row = _db_row($em, $query);
            $mbox = imap_open("{mail.your-server.de:143}INBOX", $row["email"], $row["emailPass"]);
        
        
            $check = imap_check($mbox);
            if ($check->Nmsgs == 0) { imap_close($mbox); }
        
            $array_headers = imap_fetch_overview($mbox, "1:{$check->Nmsgs}", 0);
            $rowsIMAP = object_to_array($array_headers);
        
            imap_close($mbox);
        
        // lets have a look at postbook_in, is there an entry
        $query = "select p.uid 
                 from p17_postbook_in p
			     where
			     p.firmID=$firmID AND p.uid!=0";
        
        $rowsPE = _db_rows($em, $query);
        
        for ($i = 0; $i < count($rowsIMAP); $i ++) {
            $rowsIMAP[$i] = object_to_array($rowsIMAP[$i]);
            
            if (! isset($rowsIMAP[$i]["subject"]))
                $rowsIMAP[$i]["subject"] = "(ohne Betreff)";
            // echo $rowsIMAP[$i]["subject"]."\n";
            
            $rowsIMAP[$i]["subject"] = iconv_mime_decode($rowsIMAP[$i]["subject"]);
            
            $pos = strpos($rowsIMAP[$i]["subject"], '""') + 1;
            $temp = $rowsIMAP[$i]["subject"];
            $temp = str_replace('""', '"', $temp);
            $temp = str_replace('"', '"', $temp, $pos);
            $rowsIMAP[$i]["subject"] = $temp;
            
            $uid = $rowsIMAP[$i]["uid"];
            
            for ($ii = 0; $ii < count($rowsPE); $ii ++) {
                if ($rowsPE[$ii]["uid"] == $uid) {
                    $rowsIMAP[$i]["PE"] = 1;
                    break;
                } else {
                    $rowsIMAP[$i]["PE"] = 0;
                }
            }
            $rowsIMAP[$i]["from"] = iconv_mime_decode($rowsIMAP[$i]["from"]);
            $pos = strpos($rowsIMAP[$i]["from"], '""') + 1;
            $temp = $rowsIMAP[$i]["from"];
            $temp = str_replace('""', '"', $temp);
            $temp = str_replace('"', '"', $temp, $pos);
            $rowsIMAP[$i]["from"] = $temp;
        }
        
        $return = array();
        $return[] = array(
            'label' => 'rowsIMAP',
            'content' => json_encode($rowsIMAP)
        );
        $return[] = array(
            'label' => 'rowsPE',
            'content' => json_encode($rowsPE)
        );
        
        return new JsonResponse($return);
    }

    public function dashboardImapMessage(Request $request)
    {
        require ('./web/classes/_standard.php');
        require ('./web/classes/_imap_class.php');
        $array=object_to_array(json_decode($_REQUEST["data"]));
        
        $sessionStorage = new NativeSessionStorage(array(), new NativeFileSessionHandler());
        $session = new Session($sessionStorage);
        $session->start();
        
        $auth = json_decode($session->get('auth'));
       
        
        $firmID = $auth->{'firmID'};
        $today = date('Y-m-d');
        $uid=$array["uid"];
        
        $em = $this->getDoctrine()->getManager();
        
        $query = "select email,emailPass,host
                        from p17_firms where firmID=$firmID";
        $row = _db_row($em, $query);
        $mbox = imap_open("{mail.your-server.de:143}INBOX", $row["email"], $row["emailPass"]);
        $check = imap_check($mbox);
        if ($check->Nmsgs == 0) { imap_close($mbox); }
        
        $messageArray=getMessage($mbox,$uid);
        
        $rowMessage = $messageArray[0];
        $rowFiles = $messageArray[1];
               
        imap_close($mbox);
        
        
        $return = array();
        $return[] = array(
            'label' => 'rowMessage',
            'content' => json_encode($rowMessage)
        );
        $return[] = array(
            'label' => 'rowFiles',
            'content' => json_encode($rowFiles)
        );
        
        return new JsonResponse($return);
    }
    
    public function dashboardImapFolders(Request $request)
    {
        require ('./web/classes/_standard.php');
        require ('./web/classes/_imap_class.php');
        $array=object_to_array(json_decode($_REQUEST["data"]));
        
        $sessionStorage = new NativeSessionStorage(array(), new NativeFileSessionHandler());
        $session = new Session($sessionStorage);
        $session->start();
        
        $auth = json_decode($session->get('auth'));
        
        
        $firmID = $auth->{'firmID'};
        $today = date('Y-m-d');
        
        $em = $this->getDoctrine()->getManager();
        
        $query = "select email,emailPass,host
                        from p17_firms where firmID=$firmID";
        $row = _db_row($em, $query);
        $mbox = imap_open("{mail.your-server.de:143}INBOX", $row["email"], $row["emailPass"]);
        $arrayFolders = getFolder($mbox);
        //$list = imap_list($mbox, "{mail.your-server.de:143}", "*");
        imap_close($mbox);
        sort($arrayFolders);
        $rowsFolders=array();
        
        for ($i=0;$i<count($arrayFolders);$i++) {
            $arrayFolders[$i]=str_replace("INBOX.","",$arrayFolders[$i]);
            if (strstr($arrayFolders[$i],".")) {
                $pos=strpos($arrayFolders[$i],".");
                $rowsFolders[$i]["group"]=substr($arrayFolders[$i],0,$pos);
                $rowsFolders[$i]["label"]=substr($arrayFolders[$i],$pos+1);
                $rowsFolders[$i]["value"]="INBOX.".$arrayFolders[$i];                
            } else {
                $rowsFolders[$i]["group"]=" Posteingang";
                $rowsFolders[$i]["label"]=$arrayFolders[$i];
                $rowsFolders[$i]["value"]="INBOX.".$arrayFolders[$i];
                
            }
        }
        
        $array=array();
        for ($i=0;$i<count($arrayFolders);$i++) {
            if ($rowsFolders[$i]["group"]==" Posteingang") {
            $label=$rowsFolders[$i]["label"];
            $found=false;
            for ($ii=0;$ii<count($rowsFolders);$ii++) {
                if ($rowsFolders[$ii]["group"]==$label) {
                    $found=true;
                    break;
                }
                
            }
            if (!$found)
                $array[]=$rowsFolders[$i];
            } else {
                $array[]=$rowsFolders[$i];
            }
        }
        usort($array,"sortImapFolders");
        $rowsFolders=$array;

        
        $return = array();
        $return[] = array(
            'label' => 'rowsFolders',
            'content' => json_encode($rowsFolders)
        );
        
        return new JsonResponse($return);
    }
    
    public function dashboardImapFoldersMove(Request $request)
    {
        require ('./web/classes/_standard.php');
        require ('./web/classes/_imap_class.php');
        $array=object_to_array(json_decode($_REQUEST["data"]));
        
        $sessionStorage = new NativeSessionStorage(array(), new NativeFileSessionHandler());
        $session = new Session($sessionStorage);
        $session->start();
        
        $auth = json_decode($session->get('auth'));
        
        $firmID = $auth->{'firmID'};
        $today = date('Y-m-d');
        $uid=$array["uid"];
        $folder=$array["folder"];
        
        
        $em = $this->getDoctrine()->getManager();
        
        $query = "select email,emailPass,host
                        from p17_firms where firmID=$firmID";
        $row = _db_row($em, $query);
        
        $mbox = imap_open("{mail.your-server.de:143}INBOX", $row["email"], $row["emailPass"]);
        
        imap_mail_move($mbox, $uid, $folder,CP_UID);
        imap_expunge($mbox);
        
        imap_close($mbox);
                
        $return = array();
        $return[] = array(
            'label' => 'success1',
            'content' => json_encode('verschoben')
        );
        
        return new JsonResponse($return);
    }
    
    public function dashboardImapAttachmentShow(Request $request)
    {
        require ('./web/classes/_standard.php');
        require ('./web/classes/_imap_class.php');
        $array=object_to_array(json_decode($_REQUEST["data"]));
        
        $sessionStorage = new NativeSessionStorage(array(), new NativeFileSessionHandler());
        $session = new Session($sessionStorage);
        $session->start();
        
        $auth = json_decode($session->get('auth'));
        
        
        $firmID = $auth->{'firmID'};
        $today = date('Y-m-d');
        $uid=$array["uid"];
        $filename=$array["filename"];
        
        $em = $this->getDoctrine()->getManager();
        
        $query = "select email,emailPass,host
                        from p17_firms where firmID=$firmID";
        $row = _db_row($em, $query);
        $mbox = imap_open("{mail.your-server.de:143}INBOX", $row["email"], $row["emailPass"]);
        $check = imap_check($mbox);
        if ($check->Nmsgs == 0) { imap_close($mbox); }
        
        $files = getAttachment($mbox,$uid);
        
        
        
        for ($i = 0; $i < count($files); $i ++) {
            if ($filename == "" and $files[$i]["fileName"] != "")
                $filename = $files[$i]["fileName"];
                
                if ($filename == $files[$i]["fileName"] or str_replace(" ", "%20", $filename) == $files[$i]["fileName"]) {
                    $type = $files[$i]["fileType"];
                    $content = $files[$i]["content"];
                    if (strstr("jpg gif jpeg png", strtolower($type))) {
                        $type = "image/" . $type;
                    } else {
                        $type = "application/" . $type;
                    }
                    
                    header("Content-Type: " . $type);
                    
                    header("Content-Disposition: inline; filename=". $filename. ";");
                    echo stripslashes($content);
                }
        }
        $return = array();
        $return[] = array(
            'label' => 'dummy',
            'content' => json_encode('')
        );
        return new JsonResponse($return);
    }
    
    public function dashboardImapPostinCheck(Request $request)
    {
        require ('./web/classes/_standard.php');
        require ('./web/classes/_imap_class.php');
        $array=object_to_array(json_decode($_REQUEST["data"]));
        
        $sessionStorage = new NativeSessionStorage(array(), new NativeFileSessionHandler());
        $session = new Session($sessionStorage);
        $session->start();
        $auth = json_decode($session->get('auth'));
        $firmID = $auth->{'firmID'};
        
        $em = $this->getDoctrine()->getEntityManager();

        $sql = "select uid from p17_postbook_in
			where
			firmID=$firmID AND
			uid!=0";
        $rowsPE = _db_rows($em,$sql);
           
        $return = array();
        $return[] = array(
            'label' => 'rowsPE',
            'content' =>json_encode($rowsPE)
        );
        
        return new JsonResponse($return);
        
        
    }
    public function dashboardImapPostinSave(Request $request)
    {
        require ('./web/classes/_standard.php');
        require ('./web/classes/_imap_class.php');
        $array=object_to_array(json_decode($_REQUEST["data"]));
        
        $sessionStorage = new NativeSessionStorage(array(), new NativeFileSessionHandler());
        $session = new Session($sessionStorage);
        $session->start();
        $auth = json_decode($session->get('auth'));
        $firmID = $auth->{'firmID'};
        $user = $auth->{'user'};
        //$array["firmID"]=$firmID;
        $array["firmID"]=$firmID;
        $ticketID=$array["voucherNoInternal"];
        $array["ticketID"]=$ticketID;
        $uid=$array["uid"];
        
        $em = $this->getDoctrine()->getEntityManager();
        
        $from_company=$array["from_company"];
        $sql="select firmID from p17_firms where company='$from_company'";
        $row=_db_row($em,$sql);
        $array["from_firmID"]=$row["firmID"];
        
        
        if ($ticketID>=0) {
            $sql="select voucherOpen from p17_tickets where ticketID=$ticketID";
            $row=_db_row($em,$sql);
            $voucherOpen=$row["voucherOpen"];
            if ($voucherOpen!="")
                $voucherOpen.=",";
                $voucherOpen.=$array["voucher"];
                $arrayTicket=array();
                $arrayTicket["voucherOpen"]=$voucherOpen;
                
                $arrayWhere=array("ticketID" => $ticketID);
                _db_update($em,"p17_tickets",$arrayTicket,$arrayWhere,$auth);
        } else {
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
        }
        
        if ($array["sender_company"]=='')
            $array["sender_company"]=$from_company;
            
            $array["user"]=$user;
            unset($array['id']);
            $id=_db_insert($em,"p17_postbook_in", $array,  $auth);
            
            
            $query = "select email,emailPass,host
                        from p17_firms where firmID=$firmID";
            $row = _db_row($em, $query);
            $mbox = imap_open("{mail.your-server.de:143}INBOX", $row["email"], $row["emailPass"]);
            $check = imap_check($mbox);
            if ($check->Nmsgs == 0) { imap_close($mbox); }
            
            $message="";
            if ($array["saveMessage"]==1) {
                $messageArray=getMessage($mbox,$uid);
                $message = $messageArray[0];
            }
            
            $files = getAttachment($mbox,$array["uid"]);
            
            imap_close($mbox);
            
            for ($i = 0; $i < count($files); $i ++) {
                $arrayFile=$files[$i];
                $arrayFile["firmID"]=$firmID;
                $arrayFile["ticketID"]=$ticketID;
                $arrayFile["message"]=$message;
                $fileID=_db_insert($em,"p17_files",$arrayFile, $auth);
            }
            
            if ($message!="" AND count($files)>0) {
                $arrayFile=array();
                $arrayFile["fileName"]='E-Mail Message';
                $arrayFile["name"]='E-Mail Message';
                $arrayFile["size"]=0;
                $arrayFile["type"]="";
                
                $arrayFile["firmID"]=$firmID;
                $arrayFile["ticketID"]=$ticketID;
                $arrayFile["message"]=$message;
                $fileID=_db_insert($em,"p17_files",$arrayFile, $auth);
            }
            
            $sql = "select uid from p17_postbook_in
			where
			firmID=$firmID AND
			uid!=0";
            $rowsPE = _db_rows($em,$sql);
            
            $return = array();
            $return[] = array(
                'label' => 'success',
                'content' =>json_encode('saved')
            );
            $return[] = array(
                'label' => 'rowsPE',
                'content' =>json_encode($rowsPE)
            );
            
            return new JsonResponse($return);
            
            
    }
    
    public function dashboardImapReplySend(Request $request)
    {
        require ('./web/classes/_standard.php');
        require ('./vendor/autoload.php');
        
        if (isset($_FILES['file']['name'])) {
        $fileName = $_FILES['file']['name'];
        $tmpName = $_FILES['file']['tmp_name'];
        $fileSize = $_FILES['file']['size'];
        $fileType = $_FILES['file']['type'];
        $array=object_to_array(json_decode($_REQUEST["formData"]));
        } else {
        $array=object_to_array(json_decode($_REQUEST["data"]));
        }
        
        $sessionStorage = new NativeSessionStorage(array(), new NativeFileSessionHandler());
        $session = new Session($sessionStorage);
        $session->start();
        
        $auth = json_decode($session->get('auth'));
        
        $firmID = $auth->{'firmID'};
        $ownEmail=$auth->{'email'};
        $ownEmailPass=$auth->{'emailPass'};
        $ownCompany=$auth->{'company'};
        
        $today = date('Y-m-d');
        $mailReceiver=$array["mailReceiver"];
        $mailSubject=$array["mailSubject"];
        $mailMessage=$array["mailMessage"];
        $mailCC=$array["mailCC"];
        $em = $this->getDoctrine()->getEntityManager();
        
        $error=false;
        $mailReceiverCompany="";
        
        if (!strstr($mailReceiver,"@")) {
            
            $sql="select email from p17_firms where company='$mailReceiver'";
            if (_db_rows($em,$sql)>0) {
            $row=_db_row($em,$sql);
            $mailReceiverCompany=$mailReceiver;
            $mailReceiver=$row["email"];
            } else {
                $error=true;
            }
        } else {
            if (strstr($mailReceiver,"<")) {
                $pos=strpos($mailReceiver,"<");
                $mailReceiverCompany=substr($mailReceiver,0,$pos-1);
                $mailReceiver=substr($mailReceiver,$pos);
                $mailReceiver=str_replace("<", "", $mailReceiver);
                $mailReceiver=str_replace(">", "", $mailReceiver);
            }
        }
        
        if (!$error) {
            $from=$ownCompany." <".$ownEmail.">";
            $mail = new PHPMailer(true);                                // Passing `true` enables exceptions
            try {
                //Server settings
                $mail->SMTPDebug = 0;                                   // 2: Enable verbose debug output
                $mail->isSMTP();                                        // Set mailer to use SMTP
                $mail->Host = 'mail.your-server.de';                    // Specify main and backup SMTP servers
                $mail->SMTPAuth = true;                                 // Enable SMTP authentication
                $mail->Username = $ownEmail;                            // SMTP username
                $mail->Password = $ownEmailPass;                        // SMTP password
                $mail->SMTPSecure = 'tls'; // 'tls';                    // Enable TLS encryption, `ssl` also accepted
                $mail->Port = 587;                                      // TCP port to connect to
                
                //Recipients
                $mail->setFrom($ownEmail, $ownCompany);
                $mail->addAddress($mailReceiver,$mailReceiverCompany);  // Add a recipient
                //$mail->addAddress('contact@example.com');             // Name is optional
                //$mail->addReplyTo('info@example.com', 'Information');
                if ($array["mailCC"]==1) {
                $mail->addBCC($ownEmail);
                //$mail->addBCC('bcc@example.com');
                }
                
                //Attachments
                if (isset($tmpName)) {
                    $mail->addAttachment($tmpName, $fileName);    // Optional name
                }
                
                //Content
                $mail->isHTML(true);                                  // Set email format to HTML
                $mail->Subject = $mailSubject;
                $mail->Body    = $mailMessage;
                //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
                
                $mail->send();
                $success="E-Mail verschickt";
            } catch (Exception $e) {
                $success="Probleme beim E-Mailversand, überprüfen Sie Ihre E-Mailadresse und das Passwort!";
            }
        } else {
            $success="keine E-Mailadresse gefunden";
        }
                

        $return = array();
        $return[] = array(
            'label' => 'success',
            'content' => json_encode($success)
        );
        return new JsonResponse($return);
    }
    
    
}

