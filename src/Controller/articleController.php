<?php
// src/Controller/articleController.php
namespace App\Controller;



use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Session\Storage\NativeSessionStorage;
use Symfony\Component\HttpFoundation\Session\Storage\Handler\NativeFileSessionHandler;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request; 
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use App\Entity\P17Article; 
use App\Entity\P17ArticleGroup;
use App\Entity\P17ArticleVariationGroup;
use App\Entity\P17ArticleVariationSpec;

class articleController extends Controller
{

	/**
	* @Route("/articleInit")
	*/        

    public function articleInit()
        {
            include ('./web/classes/_standard.php');
            $array = object_to_array(json_decode($_REQUEST["data"]));
            
       $title="article";
       $date=date('d.m.Y');
       
       $sessionStorage = new NativeSessionStorage(array(), new NativeFileSessionHandler());
       $session = new Session($sessionStorage);
       $session->start();
       $auth = $session->get('auth');
       //echo $auth;
       
       //$htmlContent = $this->render ( 'de/management.html.twig');
        
       $return = array();
       if (!$array["isHTML"]) {
           $htmlContent=file_get_contents ( './templates/de/article.html');
           $return[] = array(
       'label' => 'html',
       'content' =>json_encode($htmlContent)
       );
       }
                              
        return new JsonResponse($return);
                              
    }
    
    public function articleMasterInit()
    {
        include ('./web/classes/_standard.php');
        $array = object_to_array(json_decode($_REQUEST["data"]));
        
        $title="dashboard";
        $date=date('d.m.Y');
        
        $sessionStorage = new NativeSessionStorage(array(), new NativeFileSessionHandler());
        $session = new Session($sessionStorage);
        $session->start();
        $auth = $session->get('auth');
        //echo $auth;
        
        //$htmlContent = $this->render ( 'de/management.html.twig');
        
        $return = array();
        if (!$array["isHTML"]) {
            $htmlContent=file_get_contents ( './templates/de/articleMaster.html');
            $return[] = array(
            'label' => 'html',
            'content' =>json_encode($htmlContent)
        );
        }
        return new JsonResponse($return);
        
    }

    public function articleMasterListInit()
    {
        include ('./web/classes/_standard.php');
        $array = object_to_array(json_decode($_REQUEST["data"]));
        
        
        $sessionStorage = new NativeSessionStorage(array(), new NativeFileSessionHandler());
        $session = new Session($sessionStorage);
        $session->start();
        //$auth = $session->get('auth');
        $auth = json_decode($session->get('auth'));
        
        $firmID = $auth->{'firmID'};
        
        $em = $this->getDoctrine()->getManager();

        
        
        
        $return = array();
        if (!$array["isHTML"]) {
            $htmlContent=file_get_contents ( './templates/de/articleMasterList.html');
            $return[] = array(
            'label' => 'html',
            'content' =>json_encode($htmlContent)
        );
        $sql = "select * from p17_system_grid
		where
		modul='articleMasterList'";
            $rowGrid = _db_row($em,$sql);
            $return[] = array(
                'label' => 'rowGrid',
                'content' =>json_encode($rowGrid)
            );
            
        }
        
        return new JsonResponse($return);
        
    }

    public function articleGet4Positions()
    {
        include ('./web/classes/_standard.php');
        $array=object_to_array(json_decode($_REQUEST["data"]));
        $sessionStorage = new NativeSessionStorage(array(), new NativeFileSessionHandler());
        $session = new Session($sessionStorage);
        $session->start();
        //$auth = $session->get('auth');
        $auth = json_decode($session->get('auth'));
        
        //$firmID = $auth->{'firmID'};
        $firmID=$array["firmID"];
        
        $em = $this->getDoctrine()->getManager();
        $sql = "select a.*,g.id as group_id, g.name as group_name
		from p17_article a,
        p17_article_group g
		where a.firmID=$firmID AND
		g.id=a.group_id
		order by group_name asc";
        $rowsOwnArticle = _db_rows($em,$sql);
        
        $return = array();
        $return[] = array(
            'label' => 'rowsOwnArticle',
            'content' =>json_encode($rowsOwnArticle)
        );
        
        return new JsonResponse($return);
        
    }
    
    public function articleMasterSave(Request $request)
    {
        require ('./web/classes/_standard.php');
        $array=object_to_array(json_decode($_REQUEST["data"]));
        
        $sessionStorage = new NativeSessionStorage(array(), new NativeFileSessionHandler());
        $session = new Session($sessionStorage);
        $session->start();
        $auth = json_decode($session->get('auth'));
        $firmID = $auth->{'firmID'};
        $array["firmID"]=$firmID;
        
        $article_id=$array["id"];
        $spec_id=$array["spec_id"];
        if (isset($array["variation1_id"])) {
            $variation1_id=$array["variation1_id"];
        } else {
            $variation1_id=0;
            $array["variation1_id"]=0;
        }
        if (isset($array["variation2_id"])) {
            $variation2_id=$array["variation2_id"];
        } else {
            $variation2_id=0;
            $array["variation2_id"]=0;
        }
        
        if ($spec_id=='') $spec_id=-1;
        if ($variation1_id=='') $variation1_id=0;
        if ($variation2_id=='') $variation2_id=0;
        $array_spec=$array;
        
        $em = $this->getDoctrine()->getEntityManager();
        
        
        
        if ($array["id"]=="")
            $array["id"]=-1;
            $em = $this->getDoctrine()->getEntityManager();
            
            if ($array["id"]>=0) {
                if ($spec_id>0) {
                    // unset because written in p17_article_variation_spec
                    unset($array['quantity_unit']);
                    unset($array['weight']);
                    unset($array['price']);
                    unset($array['retourCredit']);
                    unset($array['inventory']);
                    unset($array['min_stock']);
                    unset($array['max_stock']);
                    unset($array['reorder_stock']);
                    unset($array['purchase_quantity']);
                }
                $array["updated"]=date('d.m.Y');
                $arrayWhere=array("id" => $array["id"]);
                _db_update($em,"p17_article", $array, $arrayWhere, $auth);
                $id=$array["id"];
            } else {
                unset($array['id']);
                unset($array['spec_id']);
                unset($array['variation1_group_id']);
                unset($array['variation1_id']);
                unset($array['variation2_group_id']);
                unset($array['variation2_id']);
                $array["created"]=date('d.m.Y');
                $id=_db_insert($em,"p17_article", $array,  $auth);
            }
            $array_spec["article_id"]=$id;
            /*
             * check p17_article_variation_spec
             */
            if ($spec_id<0) {
                // no specification yet
                
                if ($variation1_id!=0 OR $variation2_id!=0) {
                    unset($array_spec['id']);
                    $spec_id=_db_insert($em,"p17_article_variation_spec",$array_spec, $auth);
                }
            } else {
            
                // specification already exists
                if ($variation1_id==0 AND $variation2_id==0) {
                    // delete spec
                    $record = $em->getRepository(P17ArticleVariationSpec::class)->find($id);
                    $em->remove($record);
                    $em->flush();
                    $spec_id=-1;
                } else {
                    // update spec
                    $arrayWhere=array("id" => $array_spec["spec_id"]);
                    _db_update($em,"p17_article_variation_spec",$array_spec,$arrayWhere);
                }
            }
            $sql = "select a.*,g.id as group_id, g.name as group_name
		from p17_article a,
        p17_article_group g
		where a.firmID=$firmID AND
		g.id=a.group_id
		order by group_name asc";
            $rowsArticle = _db_rows($em, $sql);
            
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
                'label' => 'success',
                'content' =>json_encode('gespeichert')
            );
            $return[] = array(
                'label' => 'rowsOwnArticle',
                'content' => json_encode($rowsArticle)
            );
            
            $return[] = array(
                'label' => 'rowsOwnVariationSpec',
                'content' => json_encode($rowsVariationSpec)
            );
            
            
            return new JsonResponse($return);
            
    }
    
    public function articleMasterDelete(Request $request)
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
        $spec_id=$array["spec_id"];
        $em = $this->getDoctrine()->getEntityManager();
        if ($spec_id>0) {
            $record = $em->getRepository(P17ArticleVariationSpec::class)->find($spec_id);
        } else {
            $record = $em->getRepository(P17Article::class)->find($id);
        }
        $em->remove($record);
        $em->flush();
        $sql = "select a.*,g.id as group_id, g.name as group_name
		from p17_article a,
        p17_article_group g
		where a.firmID=$firmID AND
		g.id=a.group_id
		order by group_name asc";
        $rowsArticle = _db_rows($em, $sql);
        
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
            'label' => 'success',
            'content' =>json_encode('gelöscht')
        );
        $return[] = array(
            'label' => 'rowsOwnArticle',
            'content' => json_encode($rowsArticle)
        );
        
        $return[] = array(
            'label' => 'rowsOwnVariationSpec',
            'content' => json_encode($rowsVariationSpec)
        );
        
        
        return new JsonResponse($return);
        
        
    }
    
    public function articleGroupsListInit()
    {
        include ('./web/classes/_standard.php');
        $array = object_to_array(json_decode($_REQUEST["data"]));
        
        
        $sessionStorage = new NativeSessionStorage(array(), new NativeFileSessionHandler());
        $session = new Session($sessionStorage);
        $session->start();
        //$auth = $session->get('auth');
        $auth = json_decode($session->get('auth'));
        
        $firmID = $auth->{'firmID'};
        
        $em = $this->getDoctrine()->getManager();
        
    
        
        
        
        $return = array();
        if (!$array["isHTML"]) {
            $htmlContent=file_get_contents ( './templates/de/articleGroupsList.html');
            $return[] = array(
                'label' => 'html',
                'content' =>json_encode($htmlContent)
            );
            $sql = "select * from p17_system_grid
		where
		modul='articleGroupsList'";
            $rowGrid = _db_row($em,$sql);
            $return[] = array(
                'label' => 'rowGrid',
                'content' =>json_encode($rowGrid)
            );
        }
        
        
        
        return new JsonResponse($return);
        
    }
    
    
    public function articleGroupsSave(Request $request)
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
                _db_update($em,"p17_article_group", $array, $arrayWhere, $auth);
                $id=$array["id"];
            } else {
                unset($array['id']);
                $id=_db_insert($em,"p17_article_group", $array,  $auth);
            }
            
            $sql = "select g.*
		      from p17_article_group g
		      where g.id=$id";
            $row=_db_rows($em,$sql);
            
            $sql = "select g.*
		from p17_article_group g
		where g.firmID=$firmID
		order by name asc";
            $rowsArticleGroups=_db_rows($em,$sql);
            
            $return = array();
            $return[] = array(
                'label' => 'success',
                'content' =>json_encode('gespeichert')
            );
            $return[] = array(
                'label' => 'row',
                'content' =>json_encode($row)
            );
            $return[] = array(
                'label' => 'rowsOwnArticleGroups',
                'content' => json_encode($rowsArticleGroups)
            );
            
            return new JsonResponse($return);
            
            
    }
    
    public function articleGroupsDelete(Request $request)
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
        $record = $em->getRepository(P17ArticleGroup::class)->find($id);
        $em->remove($record);
        $em->flush();
        
        $sql = "select g.*
		from p17_article_group g
		where g.firmID=$firmID
		order by name asc";
        $rowsArticleGroups=_db_rows($em,$sql);
        
        
        $return = array();
        $return[] = array(
            'label' => 'success',
            'content' =>json_encode('gelöscht')
        );
        
        $return[] = array(
            'label' => 'rowsOwnArticleGroups',
            'content' => json_encode($rowsArticleGroups)
        );
        
        return new JsonResponse($return);
        
        
    }
    
    public function articleCategoriesListInit()
    {
        include ('./web/classes/_standard.php');
        $array = object_to_array(json_decode($_REQUEST["data"]));
        
        
        $sessionStorage = new NativeSessionStorage(array(), new NativeFileSessionHandler());
        $session = new Session($sessionStorage);
        $session->start();
        //$auth = $session->get('auth');
        $auth = json_decode($session->get('auth'));
        
        $firmID = $auth->{'firmID'};
        
        $em = $this->getDoctrine()->getManager();
        
        
        
        
        
        $return = array();
        
        if (!$array["isHTML"]) {
            $htmlContent=file_get_contents ( './templates/de/articleCategoriesList.html');
            $return[] = array(
                'label' => 'html',
                'content' =>json_encode($htmlContent)
            );
        $sql = "select * from p17_system_grid
		where
		modul='articleCategoriesList'";
            $rowGrid = _db_row($em,$sql);
            $return[] = array(
                'label' => 'rowGrid',
                'content' =>json_encode($rowGrid)
            );
        }
        
        
        
        
        return new JsonResponse($return);
        
    }
    
    
    public function articleCategoriesSave(Request $request)
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
                _db_update($em,"p17_article_variation_group", $array, $arrayWhere, $auth);
                $id=$array["id"];
            } else {
                unset($array['id']);
                $id=_db_insert($em,"p17_article_variation_group", $array,  $auth);
            }
            
            $sql = "select g.*
		      from p17_article_variation_group g
		      where g.id=$id";
            $row=_db_rows($em,$sql);
            
            $sql = "select g.id as variation_group_id,g.name
		from p17_article_variation_group g
		where g.firmID=$firmID
		order by name asc";
            $rowsArticleCategories=_db_rows($em,$sql);
            
            
            $return = array();
            $return[] = array(
                'label' => 'success',
                'content' =>json_encode('gespeichert')
            );
            $return[] = array(
                'label' => 'row',
                'content' =>json_encode($row)
            );
            $return[] = array(
                'label' => 'rowsOwnArticleCategories',
                'content' => json_encode($rowsVariation)
            );
            
            return new JsonResponse($return);
            
            
    }
    
    public function articleCategoriesDelete(Request $request)
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
        $record = $em->getRepository(P17ArticleVariationGroup::class)->find($id);
        $em->remove($record);
        $em->flush();
        $sql = "select g.id as variation_group_id,g.name
		from p17_article_variation_group g
		where g.firmID=$firmID
		order by name asc";
        $rowsArticleCategories=_db_rows($em,$sql);
        
        $return = array();
        $return[] = array(
            'label' => 'success',
            'content' =>json_encode('gelöscht')
        );
        $return[] = array(
            'label' => 'rowsOwnArticleCategories',
            'content' => json_encode($rowsVariation)
        );
        
        return new JsonResponse($return);
        
        
    }
    
    public function articleVariationsListInit()
    {
        include ('./web/classes/_standard.php');
        $array = object_to_array(json_decode($_REQUEST["data"]));
        
        
        $sessionStorage = new NativeSessionStorage(array(), new NativeFileSessionHandler());
        $session = new Session($sessionStorage);
        $session->start();
        //$auth = $session->get('auth');
        $auth = json_decode($session->get('auth'));
        
        $firmID = $auth->{'firmID'};
        
        $em = $this->getDoctrine()->getManager();
        /*
        $sql = "select v.*,g.firmID,g.name as group_name
		from p17_article_variation_group g, p17_article_variation v
		where 
        g.firmID=$firmID AND
        v.variation_group_id=g.id
		order by group_name asc,v.name asc";
        $rowsOwnArticleVariations=_db_rows($em,$sql);
        
        $sql = "select g.id as variation_group_id,g.name
		from p17_article_variation_group g
		where g.firmID=$firmID
		order by name asc";
        $rowsOwnArticleCategories=_db_rows($em,$sql);
        */
        
        
        
        
        
        $return = array();
        if (!$array["isHTML"]) {
            $htmlContent=file_get_contents ( './templates/de/articleVariationsList.html');
            $return[] = array(
                'label' => 'html',
                'content' =>json_encode($htmlContent)
            );
            $sql = "select * from p17_system_grid
		where
		modul='articleVariationsList'";
            $rowGrid = _db_row($em,$sql);
            $return[] = array(
                'label' => 'rowGrid',
                'content' =>json_encode($rowGrid)
            );
        }
        /*
        $return[] = array(
            'label' => 'rowsOwnArticleVariations',
            'content' =>json_encode($rowsOwnArticleVariations)
        );
        $return[] = array(
            'label' => 'rowsOwnArticleCategories',
            'content' =>json_encode($rowsOwnArticleCategories)
        );
        */
        
        return new JsonResponse($return);
        
    }
    
    
    public function articleVariationsSave(Request $request)
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
                _db_update($em,"p17_article_variation", $array, $arrayWhere, $auth);
                $id=$array["id"];
            } else {
                unset($array['id']);
                $id=_db_insert($em,"p17_article_variation", $array,  $auth);
            }
            
            $sql = "select g.*
		      from p17_article_variation g
		      where g.id=$id";
            $row=_db_rows($em,$sql);
            
            $sql = "select v.*,g.firmID,g.name as group_name
		from p17_article_variation_group g, p17_article_variation v
		where
        g.firmID=$firmID AND
        v.variation_group_id=g.id
		order by group_name asc,v.name asc";
            $rowsArticleVariations=_db_rows($em,$sql);
            
            $return = array();
            $return[] = array(
                'label' => 'success',
                'content' =>json_encode('gespeichert')
            );
            $return[] = array(
                'label' => 'row',
                'content' =>json_encode($row)
            );
            $return[] = array(
                'label' => 'rowsOwnArticleVariations',
                'content' =>json_encode($rowsArticleVariations)
            );
            
            return new JsonResponse($return);
            
            
    }
    
    public function articleVariationsDelete(Request $request)
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
        $record = $em->getRepository(P17ArticleVariationGroup::class)->find($id);
        $em->remove($record);
        $em->flush();
        
        $sql = "select v.*,g.firmID,g.name as group_name
		from p17_article_variation_group g, p17_article_variation v
		where
        g.firmID=$firmID AND
        v.variation_group_id=g.id
		order by group_name asc,v.name asc";
        $rowsArticleVariations=_db_rows($em,$sql);
        
        $return = array();
        $return[] = array(
            'label' => 'success',
            'content' =>json_encode('gelöscht')
        );
        $return[] = array(
            'label' => 'rowsOwnArticleVariations',
            'content' =>json_encode($rowsArticleVariations)
        );
        
        return new JsonResponse($return);
        
        
    }
    
}

