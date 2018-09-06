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
use App\Entity\P17Firms;
use App\Entity\P17FirmsProducts;
use App\Entity\P17FirmsNumbers; 
use App\Entity\P17FirmsWbtime;

class managementFirmsController extends Controller
{

	/**
	* @Route("/managementFirms")
	*/        

    
    
    public function managementFirmsInit()
    {
        include ('./web/classes/_standard.php');
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
            $htmlContent=file_get_contents ( './templates/de/managementFirms.html');
            $return[] = array(
                'label' => 'html',
                'content' => json_encode($htmlContent)
            );
            $sql = "select * from p17_system_grid
		where
		modul='managementFirms'";
            $rowGrid = _db_row($em,$sql);
            
            
            $return[] = array(
                'label' => 'rowGrid',
                'content' =>json_encode($rowGrid)
            );
            
        }
        
       
        return new JsonResponse($return);
        
    }
    
    public function managementFirmsListInit()
    {
        include ('./web/classes/_standard.php');
        $array=object_to_array(json_decode($_REQUEST["data"]));
        
        
        $sessionStorage = new NativeSessionStorage(array(), new NativeFileSessionHandler());
        $session = new Session($sessionStorage);
        $session->start();
        $auth = json_decode($session->get('auth'));
        $firmID = $auth->{'firmID'};
        
        $em = $this->getDoctrine()->getManager();
        
        
        //$htmlContent = $this->render ( 'de/management.html.twig');
        
        $return = array();
        if (!$array["isHTML"]) {
            $htmlContent=file_get_contents ( './templates/de/managementFirmsList.html');
            $return[] = array(
                'label' => 'html',
                'content' => json_encode($htmlContent)
            );
            $sql = "select * from p17_system_grid
		where
		modul='managementFirms'";
            $rowGrid = _db_row($em,$sql);
            
            
            $return[] = array(
                'label' => 'rowGrid',
                'content' =>json_encode($rowGrid)
            );
            
        }
                
        return new JsonResponse($return);
        
    }
    
    public function managementFirmsAddressInit(Request $request)
    {
        include ('./web/classes/_standard.php');
        $array=object_to_array(json_decode($_REQUEST["data"]));
        
        $sessionStorage = new NativeSessionStorage(array(), new NativeFileSessionHandler());
        $session = new Session($sessionStorage);
        $session->start();
        $auth = json_decode($session->get('auth'));
        //$firmID = $auth->{'firmID'};
        $firmID=$array["firmID"];
        
        $em = $this->getDoctrine()->getManager();
        
        $sql="select f.* from p17_firms f where f.firmID=$firmID";
        $rowFirm=_db_row($em,$sql);
        
        $sql="select t.* from p17_firms_wbtime t where t.firmID=$firmID order by t.dow asc";
        $rowsWBTime=_db_rows($em,$sql);
                
        
        $return = array();
        $return[] = array(
            'label' => 'rowFirm',
            'content' => json_encode($rowFirm)
        );
        $return[] = array(
            'label' => 'rowsWBTime',
            'content' => json_encode($rowsWBTime)
        );
        
        return new JsonResponse($return);
        
    }

    
    
    
    public function managementFirmsProductsInit(Request $request)
    {
        include ('./web/classes/_standard.php');
        $array=object_to_array(json_decode($_REQUEST["data"]));
        
        $sessionStorage = new NativeSessionStorage(array(), new NativeFileSessionHandler());
        $session = new Session($sessionStorage);
        $session->start();
        $auth = json_decode($session->get('auth'));
        //$firmID = $auth->{'firmID'};
        $firmID=$array["firmID"];
        
        $em = $this->getDoctrine()->getManager();
        
        $sql = "select id from p17_firms_files
		where
		firmID=$firmID AND kind='catalogue'";
        $rowCatalogue = _db_row($em,$sql);
        
        $sql = "select * from p17_firms_products where firmID=$firmID order by name asc";
        $rowsProducts = _db_rows($em,$sql);
        
        $sql = "select distinct g.name as groupName,a.article_code,a.name,a.price,a.quantity_unit,v.percentage
				from p17_article_group g, p17_article a
				left join p17_vat v on v.vat_id=a.vat_id
				where
				g.firmID=$firmID AND
				a.group_id=g.id AND
				a.kind='S'
				order by g.name asc,a.article_code asc";
        $rowsArticles = _db_rows($em,$sql);
        
        $return = array();
       
        $return[] = array(
            'label' => 'rowCatalogue',
            'content' => json_encode($rowCatalogue)
        );
        $return[] = array(
            'label' => 'rowsArticles',
            'content' => json_encode($rowsArticles)
        );
        $return[] = array(
            'label' => 'rowsProducts',
            'content' => json_encode($rowsProducts)
        );
        
        return new JsonResponse($return);
        
    }
    
    
    public function managementFirmsFakturaInit(Request $request)
    {
        include ('./web/classes/_standard.php');
        $array=object_to_array(json_decode($_REQUEST["data"]));
        
        $sessionStorage = new NativeSessionStorage(array(), new NativeFileSessionHandler());
        $session = new Session($sessionStorage);
        $session->start();
        $auth = json_decode($session->get('auth'));
        $firmID = $auth->{'firmID'};
        $firmIDpartner=$array["firmID"];
        
        $em = $this->getDoctrine()->getManager();
    $sql = "select f.debitor,f.creditor,
	       f.minOrderValue as D_minOrderValue,f.carriageFree as D_carriageFree,
           f.rebate as D_rebate,
	       t.discount_days as D_discount_days,t.discount as D_discount,t.net_days as D_net_days
	       from p17_firms_numbers f,
	       p17_terms_of_payment t
	       where
	       f.firmID=$firmID AND
           f.firmIDpartner=$firmIDpartner AND
	       t.id=f.termPayment";
    //echo $sql;
    
    $rowDebitor = _db_row($em,$sql);
        
    $today = date('Y-m-d');

    $sql = "select
	       f.minOrderValue as C_minOrderValue,f.carriageFree as C_carriageFree,
           f.rebate as C_rebate,
	       t.discount_days as C_discount_days,t.discount as C_discount,t.net_days as C_net_days
	       from p17_firms_numbers f,
	       p17_terms_of_payment t
	       where
	       f.firmID=$firmIDpartner AND
           f.firmIDpartner=$firmID AND
	       t.id=f.termPayment";
    
    $rowCreditor = _db_row($em,$sql);
    
    $sql="select t.* from p17_terms_of_payment t order by t.id asc";
    $rowsTermPayment=_db_rows($em,$sql);
    
        $return = array();
        
        $return[] = array(
            'label' => 'rowDebitor',
            'content' => json_encode($rowDebitor)
        );
        $return[] = array(
            'label' => 'rowCreditor',
            'content' => json_encode($rowCreditor)
        );
        $return[] = array(
            'label' => 'rowsTermPayment',
            'content' =>json_encode($rowsTermPayment)
        );
        
                
        return new JsonResponse($return);
        
    }

    public function managementFirmsFakturaSave(Request $request)
    {
        require ('./web/classes/_standard.php');
        $array=object_to_array(json_decode($_REQUEST["data"]));
        
        $array["firmIDpartner"]=$array["firmID"];
        $array["minOrderValue"]=$array["D_minOrderValue"];
        $array["carriageFree"]=$array["D_carriageFree"];
        $array["rebate"]=$array["D_rebate"];
        $array["prepayment"]=$array["D_prepayment"];
        
        unset($array['firmID']);
        unset($array['D_minOrderValue']);
        unset($array['D_carriageFree']);
        unset($array['D_rebate']);
        unset($array['D_prepayment']);
        
        $sessionStorage = new NativeSessionStorage(array(), new NativeFileSessionHandler());
        $session = new Session($sessionStorage);
        $session->start();
        $auth = json_decode($session->get('auth'));
        $firmID = $auth->{'firmID'};
        
        $em = $this->getDoctrine()->getEntityManager();

        $arrayWhere=array("firmID" => $firmID,"firmIDpartner" => $array["firmIDpartner"]);
        _db_update($em,"p17_firms_numbers", $array, $arrayWhere, $auth);
        
        $return = array();
        $return[] = array(
            'label' => 'success',
            'content' =>json_encode('saved')
        );
        
        return new JsonResponse($return);
        
        
    }
    
    public function managementFirmsPurchaseInit()
    {
        include ('./web/classes/_standard.php');
        $array=object_to_array(json_decode($_REQUEST["data"]));
        
        $sessionStorage = new NativeSessionStorage(array(), new NativeFileSessionHandler());
        $session = new Session($sessionStorage);
        $session->start();
        $auth = $session->get('auth');
        //echo $auth;
        
        //$htmlContent = $this->render ( 'de/management.html.twig');
        
        $return = array();
        if (!$array["isHTML"]) {
            $htmlContent=file_get_contents ( './templates/de/managementFirmsPurchase.html');
            
            $return[] = array(
                'label' => 'html',
                'content' => json_encode($htmlContent)
            );
            
        }
        
        return new JsonResponse($return);
        
    }
    
    public function managementFirmsAccountancyInit()
    {
        include ('./web/classes/_standard.php');
        $array=object_to_array(json_decode($_REQUEST["data"]));
        
        $sessionStorage = new NativeSessionStorage(array(), new NativeFileSessionHandler());
        $session = new Session($sessionStorage);
        $session->start();
        $auth = $session->get('auth');
        //echo $auth;
        
        
        //$htmlContent = $this->render ( 'de/management.html.twig');
        
        $return = array();
        if (!$array["isHTML"]) {
            $htmlContent=file_get_contents ( './templates/de/managementFirmsAccountancy.html');
            $return[] = array(
                'label' => 'html',
                'content' => json_encode($htmlContent)
            );
            
        }
        
        return new JsonResponse($return);
        
    }
    
    public function managementFirmsNewFirmSave(Request $request)
    {
        require ('./web/classes/_standard.php');
        $array=object_to_array(json_decode($_REQUEST["data"]));
        
        $sessionStorage = new NativeSessionStorage(array(), new NativeFileSessionHandler());
        $session = new Session($sessionStorage);
        $session->start();
        $auth = json_decode($session->get('auth'));
        $array["applicationFirmID"] = $auth->{'firmID'};
        
        $em = $this->getDoctrine()->getEntityManager();
        
        $id = _db_insert($em, "p17_firms_application", $array,  $auth);
        $return = array();
        $return[] = array(
            'label' => 'success',
            'content' =>json_encode('Ihr Antrag wurde an die Zentrale geleitet. Sobald Ihr Antrag bearbeitet wurde, erhalten Sie eine Mitteilung per E-Mail.')
        );
        
        return new JsonResponse($return);
        
        
    }
    
}
