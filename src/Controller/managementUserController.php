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
use App\Entity\P17User;
use App\Entity\P17UserClasses;
use App\Entity\P17UserTeam;
use App\Entity\P17UserProfiles;

class managementUserController extends Controller
{

	/**
	* @Route("/managementUser")
	*/        

    
    
    public function managementUserInit()
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
            $htmlContent=file_get_contents ( './templates/de/managementUser.html');
            $return[] = array(
                'label' => 'html',
                'content' => json_encode($htmlContent)
            );
        }
        
        return new JsonResponse($return);
        
    }
    
    public function managementUserListInit()
    {
        include ('./web/classes/_standard.php');
        $array=object_to_array(json_decode($_REQUEST["data"]));
        
        
        $sessionStorage = new NativeSessionStorage(array(), new NativeFileSessionHandler());
        $session = new Session($sessionStorage);
        $session->start();
        //$auth = $session->get('auth');
        $auth = json_decode($session->get('auth'));
        
        $firmID = $auth->{'firmID'};
        $schoolNo = $auth->{'schoolNo'};
        
        $em = $this->getDoctrine()->getManager();
        
        $return = array();
        if (!$array["isHTML"]) {
            $htmlContent=file_get_contents ( './templates/de/managementUserList.html');
            $return[] = array(
                'label' => 'html',
                'content' => json_encode($htmlContent)
            );
            $sql = "select * from p17_system_grid
		where
		modul='managementUserList'";
            $rowGrid = _db_row($em,$sql);
            
            $return[] = array(
                'label' => 'rowGrid',
                'content' =>json_encode($rowGrid)
            );
            
        }
                
        return new JsonResponse($return);
        
    }
    public function managementUserClassesInit()
    {
        include ('./web/classes/_standard.php');
        $array=object_to_array(json_decode($_REQUEST["data"]));
        
        
        $sessionStorage = new NativeSessionStorage(array(), new NativeFileSessionHandler());
        $session = new Session($sessionStorage);
        $session->start();
        //$auth = $session->get('auth');
        $auth = json_decode($session->get('auth'));
        $firmID = $auth->{'firmID'};
        $schoolNo = $auth->{'schoolNo'};
        
        $em = $this->getDoctrine()->getManager();
        
        
        
        $return = array();
        if (!$array["isHTML"]) {
            $htmlContent=file_get_contents ( './templates/de/managementUserClasses.html');
            $return[] = array(
                'label' => 'html',
                'content' => json_encode($htmlContent)
            );
            $sql = "select * from p17_system_grid
		where
		modul='managementUserClasses'";
            $rowGrid = _db_row($em,$sql);
            
            $return[] = array(
                'label' => 'rowGrid',
                'content' =>json_encode($rowGrid)
            );
            
        }
        
        return new JsonResponse($return);
        
    }
 
    public function managementUserTeamsInit()
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
            $htmlContent=file_get_contents ( './templates/de/managementUserTeams.html');
            $return[] = array(
                'label' => 'html',
                'content' => json_encode($htmlContent)
            );
            $sql = "select * from p17_system_grid
		where
		modul='managementUserTeams'";
            $rowGrid = _db_row($em,$sql);
            
            $return[] = array(
                'label' => 'rowGrid',
                'content' =>json_encode($rowGrid)
            );
            
        }
        
        
        return new JsonResponse($return);
        
    }
    
    public function managementUserSave(Request $request)
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
        
         
        $array["password"]=$array["passwd"];
        unset($array['passwd']);
        unset($array['passwd2']);
        
        
    
        
        if ($array["userID"]=="")
            $array["userID"]=-1;
        
            $em = $this->getDoctrine()->getEntityManager();
            if ($array["userID"]>=0) {
                
                $arrayWhere=array("userID" => $array["userID"]);
                _db_update($em,"p17_user", $array, $arrayWhere, $auth);
                $userID=$array["userID"];
            } else {
                unset($array['userID']);
                $userID=_db_insert($em,"p17_user", $array,  $auth);
                
            }
            
            $sql = "select u.*,
                    c.name as class_name,
                    p.name as profile_name,t.name as team_name
                    from p17_user u,
                    p17_user_classes c,
                    p17_user_profiles p,
                    p17_user_team t
                    where
                    u.userID=$userID AND
                    c.id=u.classID AND
                    p.id=u.profileID AND
                    t.id=u.teamID
                    order by u.user asc";
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
    
    public function managementUserDelete(Request $request)
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
        $record = $em->getRepository(P17User::class)->find($array["id"]);
        $em->remove($record);
        $em->flush();
        
        $return = array();
        $return[] = array(
            'label' => 'success',
            'content' =>json_encode('saved')
        );
        
        return new JsonResponse($return);
        
        
    }
    
    public function managementUserGetFirm(Request $request)
    {
        require ('./web/classes/_standard.php');
        $array=object_to_array(json_decode($_REQUEST["data"]));
        
        $sessionStorage = new NativeSessionStorage(array(), new NativeFileSessionHandler());
        $session = new Session($sessionStorage);
        $session->start();
        $auth = json_decode($session->get('auth'));
        //$firmID = $auth->{'firmID'};
        
        $firmID=$array["firmID"];
        
        $em = $this->getDoctrine()->getEntityManager();
        $sql = "select u.*,p.name as profile_name
		          from p17_user_team u, p17_user_profiles p
		          where
                    u.firmID=$firmID AND
                    p.id=u.profileID
                  order by u.name asc";
        $rowsFirmTeams=_db_rows($em,$sql);
        
        $sql = "select u.*,p.name as profile_name
		          from p17_user_classes u, p17_user_profiles p
		          where
                    u.firmID=$firmID AND
                    p.id=u.profileID
                  order by u.name asc";
        $rowsFirmClasses=_db_rows($em,$sql);
        
                $return = array();
                $return[] = array(
                    'label' => 'rowsFirmClasses',
                    'content' =>json_encode($rowsFirmClasses)
                );
                $return[] = array(
                    'label' => 'rowsFirmTeams',
                    'content' =>json_encode($rowsFirmTeams)
                );
                
                return new JsonResponse($return);
                
                
    }
    public function managementUserClassSave(Request $request)
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
        $updateUser=$array["updateUser"];
        unset($array['updateUser']);
        
        if ($array["id"]=="")
            $array["id"]=-1;
            
            $em = $this->getDoctrine()->getEntityManager();
            if ($array["id"]>=0) {
                $arrayWhere=array("id" => $array["id"]);
                _db_update($em,"p17_user_classes", $array, $arrayWhere, $auth);
                $id=$array["id"];
            } else {
                unset($array['id']);
                $id=_db_insert($em,"p17_user_classes", $array,  $auth);
                
            }
            
            $sql = "select u.*
                    from p17_user_classes u
                    where
                    u.id=$id";
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
    
    public function managementUserClassDelete(Request $request)
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
        $record = $em->getRepository(P17UserClasses::class)->find($array["id"]);
        $em->remove($record);
        $em->flush();
        
        $return = array();
        $return[] = array(
            'label' => 'success',
            'content' =>json_encode('deleted')
        );
        
        return new JsonResponse($return);
        
        
    }
    
}
