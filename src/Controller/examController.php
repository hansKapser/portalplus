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

class examController extends Controller
{

    /**
     *
     * @Route("/examInit")
     */
    public function examInit()
    {
        $sessionStorage = new NativeSessionStorage(array(), new NativeFileSessionHandler());
        $session = new Session($sessionStorage);
        $session->start();
        $auth = $session->get('auth');
        // echo $auth;
        
        $htmlContent = file_get_contents('./templates/de/management.html');
        // $htmlContent = $this->render ( 'de/management.html.twig');
        
        $return = array();
        $return[] = array(
            'label' => 'html',
            'content' => json_encode($htmlContent)
        );
        
        return new JsonResponse($return);
    }

    public function managementExamListInit()
    {
        include ('./web/classes/_standard.php');
        
        $sessionStorage = new NativeSessionStorage(array(), new NativeFileSessionHandler());
        $session = new Session($sessionStorage);
        $session->start();
        // $auth = $session->get('auth');
        $auth = json_decode($session->get('auth'));
        
        $firmID = $auth->{'firmID'};
        $schoolNo = $auth->{'schoolNo'};
        
        $em = $this->getDoctrine()->getManager();
        
        $sql = "select e.*,f.company,c.name as className
		 from p17_exam e,p17_firms f,p17_tickets t,p17_user_classes c
		where 
		f.firmID=$firmID AND 
		t.ticketID=e.ticketID AND
        t.firmID=$firmID AND
		c.id=e.classID
		order by e.date asc";
        
        $rowsExam = _db_rows($em, $sql);
                
        $sql = "select * from p17_system_grid
		where
		modul='managementExamList'";
        $rowGrid = _db_row($em, $sql);
        
        $htmlContent = file_get_contents('./templates/de/managementExamList.html');
        
        $return = array();
        $return[] = array(
            'label' => 'html',
            'content' => json_encode($htmlContent)
        );
        
        $return[] = array(
            'label' => 'rowsExam',
            'content' => json_encode($rowsExam)
        );
                
        $return[] = array(
            'label' => 'rowGrid',
            'content' => json_encode($rowGrid)
        );
        
        return new JsonResponse($return);
    }
}

