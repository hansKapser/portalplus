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
use App\Entity\P17FirmsWbtime;

class managementCompanyMasterController extends Controller
{

	/**
	* @Route("/managementCompanyMaster")
	*/        

    
    
    public function managementCompanyMasterInit()
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
        
        
        //$htmlContent = $this->render ( 'de/management.html.twig');
        
        $return = array();
        
        if (!$array["isHTML"]) {
            $htmlContent=file_get_contents ( './templates/de/managementCompanyMaster.html');
            $return[] = array(
                'label' => 'html',
                'content' =>json_encode($htmlContent)
            );
        }
        
        return new JsonResponse($return);
        
    }

    public function managementCompanyMasterAddressInit()
    {
        require ('./web/classes/_standard.php');
        $array=object_to_array(json_decode($_REQUEST["data"]));
        
        $sessionStorage = new NativeSessionStorage(array(), new NativeFileSessionHandler());
        $session = new Session($sessionStorage);
        $session->start();
        $auth = json_decode($session->get('auth'));
        $firmID = $auth->{'firmID'};
        
        $em = $this->getDoctrine()->getManager();
        $sql="select t.* from p17_firms_wbtime t where t.firmID=$firmID order by t.dow asc";
        $rowsWBTime=_db_rows($em,$sql);
        
        /*
        $sql="select f.content from p17_firms_files f where f.firmID=$firmID AND f.kind='logo'";
        $row=_db_row($em,$sql);
        $bannerContent=$row["content"];
        */
        
        
        //$htmlContent = $this->render ( 'de/management.html.twig');
        
        $return = array();
        if (!$array["isHTML"]) {
            $htmlContent=file_get_contents ( './templates/de/managementCompanyMasterAddress.html');
            $return[] = array(
                'label' => 'html',
                'content' =>json_encode($htmlContent)
            );
        }
        
        $return[] = array(
            'label' => 'rowsWBTime',
            'content' => json_encode($rowsWBTime)
        );
        
        return new JsonResponse($return);
        
    }

    public function managementCompanyMasterAddressSave(Request $request)
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
        

        
        $arrayWhere=array("firmID" => $firmID);
        _db_update($em,"p17_firms", $array, $arrayWhere, $auth);
        
        $sql="select f.*,
                if (i.id is null,0,1) as catalogue 
                from p17_firms f
                left join p17_firms_files i on 
                i.firmID=$firmID AND i.kind='catalogue'
                where f.firmID=$firmID";
        $rowFirm=_db_row($em,$sql);
        
        $return = array();
        $return[] = array(
            'label' => 'success',
            'content' =>json_encode('saved')
        );
        $return[] = array(
            'label' => 'rowOwnFirm',
            'content' =>json_encode($rowFirm)
        );
        
        return new JsonResponse($return);
        
        
    }
    
    public function managementCompanyMasterWBTimeSave(Request $request)
    {
        require ('./web/classes/_standard.php');
        $array=object_to_array(json_decode($_REQUEST["data"]));
        
        $sessionStorage = new NativeSessionStorage(array(), new NativeFileSessionHandler());
        $session = new Session($sessionStorage);
        $session->start();
        $auth = json_decode($session->get('auth'));
        $firmID = $auth->{'firmID'};
        
        //$entityManager = $this->getDoctrine()->getManager();
        $id=$array["id"];
        $dow=$array["dow"];
        $bt_from=$array["bt_from"];
        $bt_to=$array["bt_to"];
        
        if ($array["id"]==-1) {
        /*
            echo $array["id"];
            $record = new P17FirmsWbtime();
            */
        $sql="insert into p17_firms_wbtime
                    (firmID,dow,bt_from,bt_to)
                    values
                    ($firmID,$dow,'$bt_from','$bt_to')";
            
        } else {
            // $record = $entityManager->getRepository(P17FirmsWbtime::class)->find($array["id"]);
            $sql="replace into p17_firms_wbtime
                    (id,firmID,dow,bt_from,bt_to)
                    values
                    ($id,$firmID,$dow,'$bt_from','$bt_to')";
            
        }
        $em = $this->getDoctrine()->getEntityManager();
        $rowsWBTime=_db_write($em,$sql);
        
        /*
        $record->setDow($array["dow"]);
        $record->setBtFrom($array["bt_from"]);
        $record->setBtTo($array["bt_from"]);
        $record->setFirmid(intval($firmID));
        
        $entityManager->persist($record);
        // actually executes the queries (i.e. the INSERT query)
        $entityManager->flush();
        */
        
        $em = $this->getDoctrine()->getManager();
        $sql="select t.* from p17_firms_wbtime t where t.firmID=$firmID order by t.dow asc";
        $rowsWBTime=_db_rows($em,$sql);
      
        
        $return = array();
        $return[] = array(
            'label' => 'rowsWBTime',
            'content' =>json_encode($rowsWBTime)
        );
        
        return new JsonResponse($return);
        
        
    }
    
    public function managementCompanyMasterWBTDelete(Request $request)
    {
        require ('./web/classes/_standard.php');
        $array=object_to_array(json_decode($_REQUEST["data"]));
        
        $sessionStorage = new NativeSessionStorage(array(), new NativeFileSessionHandler());
        $session = new Session($sessionStorage);
        $session->start();
        $auth = json_decode($session->get('auth'));
        $firmID = $auth->{'firmID'};
        
        $array=object_to_array(json_decode($_REQUEST["data"]));
        
        $id = $array["id"];
        
        $em = $this->getDoctrine()->getEntityManager();
        $record = $em->getRepository(P17FirmsWbtime::class)->find($id);
        
        $em->remove($record);
        $em->flush();
        
        $sql="select t.* from p17_firms_wbtime t where t.firmID=$firmID";
        $rowsWBTime=_db_rows($em,$sql);
        
        $return = array();
        $return[] = array(
            'label' => 'rowsWBTime',
            'content' =>json_encode($rowsWBTime)
        );
        
        return new JsonResponse($return);
        
    }
    
    
    public function managementCompanyMasterProductsInit()
    {
        require ('./web/classes/_standard.php');
        $array=object_to_array(json_decode($_REQUEST["data"]));
        
        $sessionStorage = new NativeSessionStorage(array(), new NativeFileSessionHandler());
        $session = new Session($sessionStorage);
        $session->start();
        $auth = json_decode($session->get('auth'));
        $firmID = $auth->{'firmID'};
        
        $em = $this->getDoctrine()->getManager();
        $sql="select p.* from p17_firms_products p where p.firmID=$firmID";
        $result = $em->getConnection()->prepare($sql);
        $result->execute();
        $rowsProducts=$result->fetchAll();
        
        
        //$htmlContent = $this->render ( 'de/management.html.twig');
        
        $return = array();
        if (!$array["isHTML"]) {
            $htmlContent=file_get_contents ( './templates/de/managementCompanyMasterProducts.html');
            $return[] = array(
                'label' => 'html',
                'content' =>json_encode($htmlContent)
            );
        }
        $return[] = array(
                'label' => 'rowsProducts',
                'content' =>json_encode($rowsProducts)
            );
        
        return new JsonResponse($return);
        
    }
    public function managementCompanyMasterProductsSave(Request $request)
    {
        require ('./web/classes/_standard.php');
        $array=object_to_array(json_decode($_REQUEST["data"]));
        
        $sessionStorage = new NativeSessionStorage(array(), new NativeFileSessionHandler());
        $session = new Session($sessionStorage);
        $session->start();
        $auth = json_decode($session->get('auth'));
        $firmID = $auth->{'firmID'};
        
        $entityManager = $this->getDoctrine()->getManager();
                      
        if ($array["id"]==-1) {
            echo $array["id"];      
            $record = new P17FirmsProducts();
        } else {            
            $record = $entityManager->getRepository(P17FirmsProducts::class)->find($array["id"]);
        }
                
        $record->setName($array["name"]);
        $record->setFirmid($firmID);
        
        $entityManager->persist($record);
        // actually executes the queries (i.e. the INSERT query)
        $entityManager->flush();
        
        $em = $this->getDoctrine()->getManager();
        $sql="select p.* from p17_firms_products p where p.firmID=$firmID";
        $result = $em->getConnection()->prepare($sql);
        $result->execute();
        $rowsProducts=$result->fetchAll();
        
        
        $return = array();
        $return[] = array(
            'label' => 'rowsProducts',
            'content' =>json_encode($rowsProducts)
        );
        
        return new JsonResponse($return);
        
        
    }
    
    public function managementCompanyMasterProductsDelete(Request $request)
    {
        require ('./web/classes/_standard.php');
        $array=object_to_array(json_decode($_REQUEST["data"]));
        
        $sessionStorage = new NativeSessionStorage(array(), new NativeFileSessionHandler());
        $session = new Session($sessionStorage);
        $session->start();
        $auth = json_decode($session->get('auth'));
        $firmID = $auth->{'firmID'};
        
        $array=object_to_array(json_decode($_REQUEST["data"]));
        
        $id = $array["id"];
        
        $em = $this->getDoctrine()->getEntityManager();
        $record = $em->getRepository(P17FirmsProducts::class)->find($id);
        
        $em->remove($record);
        $em->flush();

        //$em = $this->getDoctrine()->getManager();
        $sql="select p.* from p17_firms_products p where p.firmID=$firmID";
        $result = $em->getConnection()->prepare($sql);
        $result->execute();
        $rowsProducts=$result->fetchAll();
        
        $return = array();
        $return[] = array(
            'label' => 'rowsProducts',
            'content' =>json_encode($rowsProducts)
        );
        
        return new JsonResponse($return);
        
    }
    
    
    public function managementCompanyMasterSellingInit()
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
            $htmlContent=file_get_contents ( './templates/de/managementCompanyMasterSelling.html');
            $return[] = array(
                'label' => 'html',
                'content' =>json_encode($htmlContent)
            );
        }
        
        return new JsonResponse($return);
        
    }

    public function managementCompanyMasterSellingSave(Request $request)
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

        $arrayWhere=array("firmID" => $firmID);
        _db_update($em,"p17_firms", $array, $arrayWhere, $auth);
        
        $sql="select f.*,
                if (i.id is null,0,1) as catalogue
                from p17_firms f
                left join p17_firms_files i on 
                i.firmID=$firmID AND i.kind='catalogue'
                where f.firmID=$firmID";
        $rowFirm=_db_row($em,$sql);
        
        $return = array();
        $return[] = array(
            'label' => 'success',
            'content' =>json_encode('saved')
        );
        $return[] = array(
            'label' => 'rowOwnFirm',
            'content' =>json_encode($rowFirm)
        );
        
        
        return new JsonResponse($return);
        
        
    }
    
    public function managementCompanyMasterPurchaseInit()
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
            $htmlContent=file_get_contents ( './templates/de/managementCompanyMasterPurchase.html');
            $return[] = array(
                'label' => 'html',
                'content' =>json_encode($htmlContent)
            );
        }
        
        return new JsonResponse($return);
        
    }
    
    public function managementCompanyMasterAccountancyInit()
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
            $htmlContent=file_get_contents ( './templates/de/managementCompanyMasterAccountancy.html');
            $return[] = array(
                'label' => 'html',
                'content' =>json_encode($htmlContent)
            );
        }
        
        return new JsonResponse($return);
        
    }
    
    public function managementCompanyMasterAccountancySave(Request $request)
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
        
        $arrayWhere=array("firmID" => $firmID);
        _db_update($em,"p17_firms", $array, $arrayWhere, $auth);
        
        $sql="select f.*,
                if (i.id is null,0,1) as catalogue
                from p17_firms f
                left join p17_firms_files i on 
                i.firmID=$firmID AND i.kind='catalogue'
                where f.firmID=$firmID";
        $rowFirm=_db_row($em,$sql);
        
        $return = array();
        $return[] = array(
            'label' => 'success',
            'content' =>json_encode('saved')
        );
        $return[] = array(
            'label' => 'rowOwnFirm',
            'content' =>json_encode($rowFirm)
        );
        
        
        return new JsonResponse($return);
        
        
    }
    
}
