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
use App\Entity\P17PostbookOut;
use App\Entity\P17PostbookInVouchers;

class managementPostoutController extends Controller
{

	/**
	* @Route("/managementCompanyMaster")
	*/        

    
    
    public function managementPostoutBoxInit()
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

        $sql = "select p.*
		from p17_postbook_out p
		where p.firmID=$firmID
        order by p.date desc";
        $rowsPostout=_db_rows($em,$sql);
        
        /*
        $sql = "select * from p17_postbook_in_vouchers order by division asc, voucher asc";
        $rowsVoucher = _db_rows($em,$sql);
        */      
        
        $return = array();
        if (!$array["isHTML"]) {
            $htmlContent=file_get_contents ( './templates/de/managementPostoutBox.html');
            $return[] = array(
                'label' => 'html',
                'content' => json_encode($htmlContent)
            );
            $sql = "select * from p17_system_grid
		where
		modul='managementPostoutBox'";
            $rowGrid = _db_row($em,$sql);
            $return[] = array(
                'label' => 'rowGrid',
                'content' =>json_encode($rowGrid)
            );
            
        }
        $return[] = array(
            'label' => 'rowsPostout',
            'content' =>json_encode($rowsPostout)
        );

        /*
        $return[] = array(
            'label' => 'rowsVoucher',
            'content' =>json_encode($rowsVoucher)
        );
        */
        
        return new JsonResponse($return);
        
    }


    public function managementPostoutBoxSave(Request $request)
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
            _db_update($em,"p17_postbook_out", $array, $arrayWhere, $auth);
            $id=$array["id"];
        } else {
            $array["uid"]=0;
            $array["user"]=$user;
            unset($array['id']);
            $id=_db_insert($em,"p17_postbook_out", $array,  $auth);
            
        }
        
        $sql="select * from p17_postbook_out where id=$id";
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
    
    public function managementPostoutBoxDelete(Request $request)
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
        $record = $em->getRepository(P17PostbookOut::class)->find($id);
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
