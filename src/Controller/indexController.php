<?php
// src/Controller/indexController.php
// use Symfony\Component\HttpFoundation\Session\Storage\PhpBridgeSessionStorage;
namespace App\Controller;

use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Session\Storage\NativeSessionStorage;
use Symfony\Component\HttpFoundation\Session\Storage\Handler\NativeFileSessionHandler;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request; 
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use App\Entity\P17User; 



/** / for direkt calls of mysql-queries 
use Doctrine\ORM\Query\ResultSetMapping;
*/
/**

 * session-variables
 * stored json_encoded in one variable
 * $_SESSION["auth"]=json_encode($row);
 * $row["lang"]='';
 * $row["firmID"]='';
 * $row["schoolNo"]='';
 * $row["company"]='';
 * $row["email"]='';
 * $row["emailPass"]='';
 * $row["userID"]='-1';
 * $row["user"]='';
 * $row["user_name"]='';
 * $row["classID"]='';
 * $row["class_name"]='';
 * $row["teamID"]='';
 * $row["team_name"]='';
 * $row["profileID"]='';
 * $row["profile_name"]='';
 * $row["status"]='';
 * $row["menu"]='';
 * get the variable by json_decode
 * $firmID = json_decode($_SESSION["auth"])->{'firmID'};
 

$_SESSION["auth"] = '';
*/


class indexController extends Controller
{

	/**
	* @Route("/index")
	*/        

    public function index()
    {
      return $this->render('de/index.html.twig');
    }

    /**
     * @Route("/login")
     */
    
      public function login(Request $request)
        {

       
            require ('./web/classes/_standard.php');
            // Get Symfony to interface with this existing session
            $sessionStorage = new NativeSessionStorage(array(), new NativeFileSessionHandler());
            $session = new Session($sessionStorage);
            // symfony will now interface with the existing PHP session
            
            $user = $_REQUEST["user"];
            $password = $_REQUEST["password"];

            $em = $this->getDoctrine()->getManager();
            $sql="select u.*,p.status 
                    from p17_user u,p17_user_profiles p
                    where u.user='$user' AND 
                    u.password=password('$password') AND
                    p.id=u.profileID";
            
            $em = $this->getDoctrine()->getManager();
            $rows=_db_rows($em,$sql);
            
            if (count($rows)==0) {
                // redirect
                return $this->redirect('index');
            } else {
                $row=$rows[0];
            }
                
            $userID=$row["userID"];
            
            // get information for $_SESSION
            $sql = "select u.firmID,f.company,f.schoolNo,f.email,f.emailPass,f.IBAN,f.IPlocal,
				u.userID,u.user,u.name as user_name,
				u.classID,c.name as class_name,
				u.teamID, t.name as team_name,
				u.profileID,p.name as profile_name,p.status,p.hiddenMenu,
				p.autoPurchase,p.emailPurchase,
				p.autoSale,p.emailSale,
				p.autoStock,p.autoAccounting
				from
				p17_user u, p17_firms f,
				p17_user_classes c,p17_user_team t,
				p17_user_profiles p
				where
				u.userID=$userID AND
				f.firmID=u.firmID AND
				c.id=u.classID AND
				t.id=u.teamID AND
				p.id=u.profileID";
            
            $row=_db_row($em,$sql);  
                        
            $auth=json_encode($row);

            $session->start();
            $session->set('auth', $auth);
            
            $auth = json_decode($session->get('auth'));
            var_dump($auth);
            
          
            return $this->redirect('dashboard');
            
            
        }
        public function logout(Request $request)
        {
            
            
            require ('./web/classes/_standard.php');
            // Get Symfony to interface with this existing session
            $sessionStorage = new NativeSessionStorage(array(), new NativeFileSessionHandler());
            $session = new Session($sessionStorage);
            // symfony will now interface with the existing PHP session
            
            return $this->redirect('index');
            
            
        }
        
}