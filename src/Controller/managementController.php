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

class managementController extends Controller
{

	/**
	* @Route("/management")
	*/        

    public function managementInit()
        {
       $title="dashboard";
       $date=date('d.m.Y');
       
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
    
    public function managementCompanyMasterInit()
    {
        $title="dashboard";
        $date=date('d.m.Y');
        
        $sessionStorage = new NativeSessionStorage(array(), new NativeFileSessionHandler());
        $session = new Session($sessionStorage);
        $session->start();
        $auth = $session->get('auth');
        //echo $auth;
        
        $htmlContent=file_get_contents ( './templates/de/managementCompanyMaster.html');
        //$htmlContent = $this->render ( 'de/management.html.twig');
        
        $return = array();
        $return[] = array(
            'label' => 'html',
            'content' =>json_encode($htmlContent)
        );
        
        return new JsonResponse($return);
        
    }

    public function managementPostinInit()
    {
        $title="dashboard";
        $date=date('d.m.Y');
        
        $sessionStorage = new NativeSessionStorage(array(), new NativeFileSessionHandler());
        $session = new Session($sessionStorage);
        $session->start();
        $auth = $session->get('auth');
        //echo $auth;
        
        $htmlContent=file_get_contents ( './templates/de/managementPostin.html');
        //$htmlContent = $this->render ( 'de/management.html.twig');
        
        $return = array();
        $return[] = array(
            'label' => 'html',
            'content' =>json_encode($htmlContent)
        );
        
        return new JsonResponse($return);
        
    }

    public function managementPostoutInit()
    {
        $title="dashboard";
        $date=date('d.m.Y');
        
        $sessionStorage = new NativeSessionStorage(array(), new NativeFileSessionHandler());
        $session = new Session($sessionStorage);
        $session->start();
        $auth = $session->get('auth');
        //echo $auth;
        
        $htmlContent=file_get_contents ( './templates/de/managementPostout.html');
        //$htmlContent = $this->render ( 'de/management.html.twig');
        
        $return = array();
        $return[] = array(
            'label' => 'html',
            'content' =>json_encode($htmlContent)
        );
        
        return new JsonResponse($return);
        
    }
    
    public function managementFirmsInit()
    {
        $title="dashboard";
        $date=date('d.m.Y');
        
        $sessionStorage = new NativeSessionStorage(array(), new NativeFileSessionHandler());
        $session = new Session($sessionStorage);
        $session->start();
        $auth = $session->get('auth');
        //echo $auth;
        
        $htmlContent=file_get_contents ( './templates/de/managementFirms.html');
        //$htmlContent = $this->render ( 'de/management.html.twig');
        
        $return = array();
        $return[] = array(
            'label' => 'html',
            'content' =>json_encode($htmlContent)
        );
        
        return new JsonResponse($return);
        
    }
    
    
    public function managementUserInit()
    {
        $title="dashboard";
        $date=date('d.m.Y');
        
        $sessionStorage = new NativeSessionStorage(array(), new NativeFileSessionHandler());
        $session = new Session($sessionStorage);
        $session->start();
        $auth = $session->get('auth');
        //echo $auth;
        
        $htmlContent=file_get_contents ( './templates/de/managementUser.html');
        //$htmlContent = $this->render ( 'de/management.html.twig');
        
        $return = array();
        $return[] = array(
            'label' => 'html',
            'content' =>json_encode($htmlContent)
        );
        
        return new JsonResponse($return);
        
    }
    
    public function managementTicketsInit()
    {
        $title="dashboard";
        $date=date('d.m.Y');
        
        $sessionStorage = new NativeSessionStorage(array(), new NativeFileSessionHandler());
        $session = new Session($sessionStorage);
        $session->start();
        $auth = $session->get('auth');
        //echo $auth;
        
        $htmlContent=file_get_contents ( './templates/de/managementTickets.html');
        //$htmlContent = $this->render ( 'de/management.html.twig');
        
        $return = array();
        $return[] = array(
            'label' => 'html',
            'content' =>json_encode($htmlContent)
        );
        
        return new JsonResponse($return);
        
    }
    
    public function managementExamInit()
    {
        $title="dashboard";
        $date=date('d.m.Y');
        
        $sessionStorage = new NativeSessionStorage(array(), new NativeFileSessionHandler());
        $session = new Session($sessionStorage);
        $session->start();
        $auth = $session->get('auth');
        //echo $auth;
        
        $htmlContent=file_get_contents ( './templates/de/managementExam.html');
        //$htmlContent = $this->render ( 'de/management.html.twig');
        
        $return = array();
        $return[] = array(
            'label' => 'html',
            'content' =>json_encode($htmlContent)
        );
        
        return new JsonResponse($return);
        
    }
    
    
    public function managementVoucherInit()
    {
        $title="dashboard";
        $date=date('d.m.Y');
        
        $sessionStorage = new NativeSessionStorage(array(), new NativeFileSessionHandler());
        $session = new Session($sessionStorage);
        $session->start();
        $auth = $session->get('auth');
        //echo $auth;
        
        $htmlContent=file_get_contents ( './templates/de/managementVoucher.html');
        //$htmlContent = $this->render ( 'de/management.html.twig');
        
        $return = array();
        $return[] = array(
            'label' => 'html',
            'content' =>json_encode($htmlContent)
        );
        
        return new JsonResponse($return);
        
    }
    
    
}

