<?php
// src/Controller/indexController.php
// use Symfony\Component\HttpFoundation\Session\Storage\PhpBridgeSessionStorage;
namespace App\Controller;

use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Session\Storage\NativeSessionStorage;
use Symfony\Component\HttpFoundation\Session\Storage\Handler\NativeFileSessionHandler;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;
use Symfony\Component\HttpFoundation\JsonResponse;

use Symfony\Component\HttpFoundation\Request; 
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use App\Entity\P17User; 
use App\Entity\P17Files;




class fileController extends Controller
{

	/**
	* @Route("/index")
	*/        

    public function index()
    {
      return $this->render('de/index.html.twig');
    }

    /**
     * @Route("/getFirmFile")
     */
    
    public function getFirmFile(Request $request)
        {
        
        require ('./web/classes/_standard.php');
            
        $array=object_to_array(json_decode($request->query->get('data')));
        $kind=$array['kind'];
        $firmID=$array['firmID'];
        
        
        $em = $this->getDoctrine()->getManager();
        $sql="select f.* from p17_firms_files f where f.firmID=$firmID AND kind='$kind'";
        $rows=_db_rows($em,$sql);
        
        if (count($rows)==0) {
            $content="kein Katalog hinterlegt ....";
        } else {
            $row=$rows[0];
            $content=$row["content"];
            $type=$row["type"];
            header('Content-Type: '.$type);
        }
        echo $content;
        return '';
        //return $this->render('de/index.html.twig');
            
        }
        
        
        public function uploadFirmFile(Request $request)
        {
            require ('./web/classes/_standard.php');
            //$array=object_to_array(json_decode($_REQUEST["data"]));
            
            $sessionStorage = new NativeSessionStorage(array(), new NativeFileSessionHandler());
            $session = new Session($sessionStorage);
            $session->start();
            $auth = json_decode($session->get('auth'));
            $firmID = $auth->{'firmID'};
            //$array["firmID"]=$firmID;
            
            
            $fileName = $_FILES['file']['name'];
            $tmpName = $_FILES['file']['tmp_name'];
            $fileSize = $_FILES['file']['size'];
            $fileType = $_FILES['file']['type'];
            $kind = $_REQUEST['kind'];
            $datei = fopen($tmpName, 'r');
            $content = addslashes(fread($datei, $fileSize));
            fclose($datei);
            
            $em = $this->getDoctrine()->getEntityManager();
            $sql="select f.* from p17_firms_files f where f.firmID=$firmID AND kind='$kind'";
            $rows=_db_rows($em,$sql);
            if (count($rows)==0) {
                $sql = "INSERT INTO p17_firms_files
	               (firmID,kind,name, size, type, content )
	               VALUES
	               ($firmID,'$kind','$fileName', '$fileSize', '$fileType', '$content')";
                
                $rueck=_db_write($em,$sql);
                
            } else {
              $id=$rows[0]["id"];
              $sql = "REPLACE INTO p17_firms_files
	               (id,firmID,kind,name, size, type, content )
	               VALUES
	               ($id,$firmID,'$kind','$fileName', '$fileSize', '$fileType', '$content')";
              
              $rueck=_db_write($em,$sql);
              
              
            }
            
        
        $return = array();
        $return[] = array(
            'label' => 'success',
            'content' =>json_encode('uploaded')
        );
        
        return new JsonResponse($return);
        }
        
        public function getTicketFile(Request $request)
        {
            
            require ('./web/classes/_standard.php');
            
            $array=object_to_array(json_decode($request->query->get('data')));
            $id=$array['id'];
            
            $em = $this->getDoctrine()->getManager();
            $sql="select f.content,f.type,f.name from p17_files f where f.id=$id";
            $row=_db_row($em,$sql);
            
           
            $content=$row["content"];
            $type=$row["type"];
            $name=$row["name"];
            
            if (!strstr($type,"application"))
                $type="application/$type";
            header('Content-Type: '.$type);
            header('Content-disposition: filename="'.$name.'"');
            echo $content;
            return '';
            //return $this->render('de/index.html.twig');
            
        }
        
        public function uploadTicketFile(Request $request)
        {
            require ('./web/classes/_standard.php');
            //$array=object_to_array(json_decode($_REQUEST["data"]));
            
            $sessionStorage = new NativeSessionStorage(array(), new NativeFileSessionHandler());
            $session = new Session($sessionStorage);
            $session->start();
            $auth = json_decode($session->get('auth'));
            $firmID = $auth->{'firmID'};
            //$array["firmID"]=$firmID;
            
            
            $fileName = $_FILES['file']['name'];
            $tmpName = $_FILES['file']['tmp_name'];
            $fileSize = $_FILES['file']['size'];
            $fileType = $_FILES['file']['type'];
            $ticketID = $_REQUEST['ticketID'];
            $datei = fopen($tmpName, 'r');
            $content = addslashes(fread($datei, $fileSize));
            fclose($datei);
            $today=date('Y-m-d');
            $em = $this->getDoctrine()->getEntityManager();
            $array["firmID"]=$firmID;
            $array["ticketID"]=$ticketID;
            $array["name"]=$fileName;
            $array["size"]=$fileSize;
            $array["type"]=$fileType;
            $array["content"]=$content;
            $array["message"]='';
            $array["date"]=$today;
            
            $rueck=_db_insert($em,'p17_files', $array,  $auth);
            
            $return = array();
            $return[] = array(
                'label' => 'success',
                'content' =>json_encode('uploaded')
            );
            
            return new JsonResponse($return);
        }
        
        public function deleteTicketFile(Request $request)
        {
            require ('./web/classes/_standard.php');
            $array=object_to_array(json_decode($_REQUEST["data"]));
            $id = $array["id"];
            
            $em = $this->getDoctrine()->getEntityManager();
            $record = $em->getRepository(P17Files::class)->find($id);
            
            $em->remove($record);
            $em->flush();
            
            $return = array();
            $return[] = array(
                'label' => 'success',
                'content' =>json_encode('deleted')
            );
            
            return new JsonResponse($return);
        }

        public function moveTicketFile(Request $request)
        {
            require ('./web/classes/_standard.php');
            $array=object_to_array(json_decode($_REQUEST["data"]));
            $id = $array["id"];
            $ticketID = $array["ticketID"];
            
            $em = $this->getDoctrine()->getEntityManager();            
            $sql="replace into p17_files
                    (id,ticketID)
                    values
                    ($id,$ticketID)";
            
            $rows=_db_write($em,$sql);
        
            $return = array();
            $return[] = array(
                'label' => 'success',
                'content' =>json_encode('moved')
            );
            
            return new JsonResponse($return);
        }
        
        public function getArticleFile(Request $request)
        {
            
            require ('./web/classes/_standard.php');
            
            $array=object_to_array(json_decode($request->query->get('data')));
            $article_id=$array['id'];
            $firmID=$array['firmID'];
            
            
            $em = $this->getDoctrine()->getManager();
            $sql="select f.* from p17_article_images f where f.article_id=$article_id";
            $row=_db_row($em,$sql);
            
            $content=$row["content"];
            $type=$row["type"];
            header('Content-Type: '.$type);
            echo $content;
            return '';
            //return $this->render('de/index.html.twig');
            
        }
        
        public function uploadArticleImageFile(Request $request)
        {
            require ('./web/classes/_standard.php');
            //$array=object_to_array(json_decode($_REQUEST["data"]));
            
            $sessionStorage = new NativeSessionStorage(array(), new NativeFileSessionHandler());
            $session = new Session($sessionStorage);
            $session->start();
            $auth = json_decode($session->get('auth'));
            $firmID = $auth->{'firmID'};
            
            $array=array();
            $array["firmID"]=$firmID;
            
            
            
            
            $fileName = $_FILES['file']['name'];
            $tmpName = $_FILES['file']['tmp_name'];
            $fileSize = $_FILES['file']['size'];
            $fileType = $_FILES['file']['type'];
            $array["article_id"] = $_REQUEST['id'];
            $article_id = $_REQUEST['id'];
            $array["variation1_id"] = 0; //$_REQUEST['variation1_id'];
            $array["variation2_id"] = 0; //$_REQUEST['variation2_id'];
            $array["name"]=$_FILES['file']['name'];
            $array["size"]=$_FILES['file']['size'];
            $array["type"]=$_FILES['file']['type'];
            $array["date"]=date('Y-m-d');
            $variation1_id=0;
            $variation2_id=0;
            $datei = fopen($tmpName, 'r');

            //$content = addslashes(fread($datei, $fileSize));
            // _db_insert and _db_update without addslashes
            $content = fread($datei, $fileSize);
            $array["content"]=$content;
            fclose($datei);
            
            $em = $this->getDoctrine()->getEntityManager();
            $sql="select f.* from p17_article_images f where f.article_id=$article_id";
            $rows=_db_rows($em,$sql);
            if (count($rows)==0) {
                $rueck=_db_insert($em,"p17_article_images", $array,  $auth);
                
            } else {
                $id=$rows[0]["id"];
                $arrayWhere=array("id" => $id);
                $rueck=_db_update($em,"p17_article_images", $array, $arrayWhere, $auth);
                
            }
            
            
            $return = array();
            $return[] = array(
                'label' => 'success',
                'content' =>json_encode('uploaded')
            );
            
            return new JsonResponse($return);
        }
        
        public function uploadArticleDataSheetFile(Request $request)
        {
            require ('./web/classes/_standard.php');
            //$array=object_to_array(json_decode($_REQUEST["data"]));
            
            $sessionStorage = new NativeSessionStorage(array(), new NativeFileSessionHandler());
            $session = new Session($sessionStorage);
            $session->start();
            $auth = json_decode($session->get('auth'));
            $firmID = $auth->{'firmID'};
            
            $array=array();
            $array["firmID"]=$firmID;
            
            
            
            
            $fileName = $_FILES['file']['name'];
            $tmpName = $_FILES['file']['tmp_name'];
            $fileSize = $_FILES['file']['size'];
            $fileType = $_FILES['file']['type'];
            $array["article_id"] = $_REQUEST['id'];
            $article_id = $_REQUEST['id'];
            $array["variation1_id"] = 0; //$_REQUEST['variation1_id'];
            $array["variation2_id"] = 0; //$_REQUEST['variation2_id'];
            $array["name"]=$_FILES['file']['name'];
            $array["size"]=$_FILES['file']['size'];
            $array["type"]=$_FILES['file']['type'];
            $array["date"]=date('Y-m-d');
            $variation1_id=0;
            $variation2_id=0;
            $datei = fopen($tmpName, 'r');
            
            //$content = addslashes(fread($datei, $fileSize));
            // _db_insert and _db_update without addslashes
            $content = fread($datei, $fileSize);
            $array["content"]=$content;
            fclose($datei);
            
            $em = $this->getDoctrine()->getEntityManager();
            $sql="select f.* from p17_article_datasheets f where f.article_id=$article_id";
            $rows=_db_rows($em,$sql);
            if (count($rows)==0) {
                $rueck=_db_insert($em,"p17_article_datasheets", $array,  $auth);
                
            } else {
                $id=$rows[0]["id"];
                $arrayWhere=array("id" => $id);
                $rueck=_db_update($em,"p17_article_datasheets", $array, $arrayWhere, $auth);
                
            }
            
            
            $return = array();
            $return[] = array(
                'label' => 'success',
                'content' =>json_encode('uploaded')
            );
            
            return new JsonResponse($return);
        }
        
        public function getDataSheetFile(Request $request)
        {
            
            require ('./web/classes/_standard.php');
            
            $array=object_to_array(json_decode($request->query->get('data')));
            $id=$array['id'];
            
            $em = $this->getDoctrine()->getManager();
            $sql="select f.content,f.type,f.name from p17_article_datasheets f where f.article_id=$id";
            $row=_db_row($em,$sql);
            
            
            $content=$row["content"];
            $type=$row["type"];
            $name=$row["name"];
            
            if (!strstr($type,"application"))
                $type="application/$type";
                header('Content-Type: '.$type);
                header('Content-disposition: filename="'.$name.'"');
                echo $content;
                return '';
                //return $this->render('de/index.html.twig');
                
        }
        
        public function uploadPinboardFile(Request $request)
        {
            require ('./web/classes/_standard.php');
            //$array=object_to_array(json_decode($_REQUEST["data"]));
            
            $sessionStorage = new NativeSessionStorage(array(), new NativeFileSessionHandler());
            $session = new Session($sessionStorage);
            $session->start();
            $auth = json_decode($session->get('auth'));
            $firmID = $auth->{'firmID'};
            //$array["firmID"]=$firmID;
            
            $fileName = $_FILES['file']['name'];
            $tmpName = $_FILES['file']['tmp_name'];
            $fileSize = $_FILES['file']['size'];
            $fileType = $_FILES['file']['type'];
            $id = $_REQUEST['id'];
            $datei = fopen($tmpName, 'r');
            $content = fread($datei, $fileSize);
            fclose($datei);
            $today=date('Y-m-d');
            $em = $this->getDoctrine()->getEntityManager();
            $array["id"]=$id;
            $array["name"]=$fileName;
            $array["size"]=$fileSize;
            $array["type"]=$fileType;
            $array["content"]=$content;
            $array["date"]=$today;
            
            $arrayWhere=array("id" => $id);
            $rueck=_db_update($em,"p17_pinboard", $array, $arrayWhere, $auth);
            
            
            $return = array();
            $return[] = array(
                'label' => 'success',
                'content' =>json_encode('uploaded')
            );
            
            return new JsonResponse($return);
        }
        
        public function getPinboardFile(Request $request)
        {
            
            require ('./web/classes/_standard.php');
            
            $array=object_to_array(json_decode($request->query->get('data')));
            $id=$array['id'];
            
            $em = $this->getDoctrine()->getManager();
            $sql="select f.content,f.type,f.name from p17_pinboard f where f.id=$id";
            $row=_db_row($em,$sql);
            
            
            $content=$row["content"];
            $type=$row["type"];
            $filename=$row["name"];
            
            //echo "name:".$name;
            //echo "content:".$content;
            if (!strstr($type,"application"))
                $type="application/$type";
                $response = new Response($content);
                
                $disposition = $response->headers->makeDisposition(
                    ResponseHeaderBag::DISPOSITION_INLINE,
                    'foo.pdf'
                    );
                $response->headers->set('Content-Type', $type);
                $response->headers->set('Content-Disposition', $disposition);
                //$response->send();
                return $response;
                /*
                
                header("Content-Type: " . $type);
                header("Content-Disposition: inline; filename=". $filename. ";");
                echo $content;

                
             $return = array();
             $return[] = array(
                 'label' => 'dummy',
                 'content' => json_encode('')
             );
             return new JsonResponse($return);
             */
                
        }
        
}