<?php
// src/Controller/managementController.php
namespace App\Controller;

use App\Entity\P17StockTransaction;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Session\Storage\NativeSessionStorage;
use Symfony\Component\HttpFoundation\Session\Storage\Handler\NativeFileSessionHandler;
use Symfony\Component\Routing\Annotation\Route;

class storeController extends Controller
{

	/**
	* @Route("/storeInit")
	*/        

    public function storeInit()
        {
            require ('./web/classes/_standard.php');
            $array=object_to_array(json_decode($_REQUEST["data"]));
            
       $sessionStorage = new NativeSessionStorage(array(), new NativeFileSessionHandler());
       $session = new Session($sessionStorage);
       $session->start();
       $auth = $session->get('auth');
       //echo $auth;
       
       
       //$htmlContent = $this->render ( 'de/management.html.twig');
       $em = $this->getDoctrine()->getManager();
       
       $return = array();
       if (!$array["isHTML"]) {
           $htmlContent=file_get_contents ( './templates/de/store.html');
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
    
    public function storeListInit()
    {
        require ('./web/classes/_standard.php');
        $array=object_to_array(json_decode($_REQUEST["data"]));
        
        $sessionStorage = new NativeSessionStorage(array(), new NativeFileSessionHandler());
        $session = new Session($sessionStorage);
        $session->start();
        //$auth = $session->get('auth');
        $auth = json_decode($session->get('auth'));
        
        $firmID = $auth->{'firmID'};
        $schoolNo = $auth->{'schoolNo'};
        
        $em = $this->getDoctrine()->getManager();
        
        /*
         * from hetzner begin
         */
        $sql = "select l.article_id,l.variation1_id,l.variation2_id,
		sum(if(transaction='I',quantity,0)) as sum_in,
		sum(if(transaction='O',quantity,0)) as sum_out,
		sum(if(transaction='R',quantity,0)) as sum_res,
        sum(if(transaction='P',quantity,0)) as sum_purch
		from p17_stock_transaction l,p17_article a
		where
		a.firmID=$firmID AND
		a.id=l.article_id
		group by article_id,variation1_id,variation2_id
		order by article_id asc, variation1_id asc, variation2_id asc";
        $rowsStock = _db_rows($em,$sql);
        
        $sql = "select a.id,a.id as article_id,a.article_code,a.name,a.reorder_stock,a.quantity_unit,
			g.id as group_id, g.name as group_name,'' as spec_id,0 as variation1_id,0 as variation2_id
		from p17_article a, p17_article_group g
		where a.firmID=$firmID AND
		g.id=a.group_id";
        $rows = _db_rows($em,$sql);
        
        $rowsArticleStore = array();
        
        for ($i = 0; $i < count($rows); $i ++) {
            $rowsArticleStore[] = $rows[$i];
            $article_id = $rows[$i]["id"];
            
            $query = "select s.*,(select v.name
					from p17_article_variation v,p17_article_variation_group g
					where v.id=s.variation1_id AND
					g.id=v.variation_group_id) as variation1,
					(select v.name
					from p17_article_variation v,p17_article_variation_group g
					where v.id=s.variation2_id AND
					g.id=v.variation_group_id) as variation2
					from p17_article_variation_spec s
					where article_id=$article_id";
            
            $rows_spec = _db_rows($em,$query);
            for ($ii = 0; $ii < count($rows_spec); $ii ++) {
                $arr_temp = $rows[$i];
                $arr_temp["article_id"] = $rows_spec[$ii]["article_id"];
                $arr_temp["spec_name"] = $rows_spec[$ii]["variation1"] . " " . $rows_spec[$ii]["variation2"];
                $arr_temp["spec_id"] = $rows_spec[$ii]["id"];
                $arr_temp["quantity_unit"] = $rows_spec[$ii]["quantity_unit"];
                $arr_temp["weight"] = $rows_spec[$ii]["weight"];
                $arr_temp["price"] = $rows_spec[$ii]["price"];
                $arr_temp["retourCredit"] = $rows_spec[$ii]["retourCredit"];
                $arr_temp["min_stock"] = $rows_spec[$ii]["min_stock"];
                $arr_temp["max_stock"] = $rows_spec[$ii]["max_stock"];
                $arr_temp["reorder_stock"] = $rows_spec[$ii]["reorder_stock"];
                $arr_temp["purchase_quantity"] = $rows_spec[$ii]["purchase_quantity"];
                $arr_temp["variation1_id"] = $rows_spec[$ii]["variation1_id"];
                $arr_temp["variation2_id"] = $rows_spec[$ii]["variation2_id"];
                $rowsArticleStore[] = $arr_temp;
            }
            
        }
        
        for ($i = 0; $i < count($rowsArticleStore); $i ++) {
            $arr_temp = stock($rowsArticleStore[$i], $rowsStock);
            $rowsArticleStore[$i]["available"] = $arr_temp["available"];
            $rowsArticleStore[$i]["real"] = $arr_temp["real"];
        }
        
        $sql = "select s.*
		from p17_stock_transaction s,p17_article a
			where
			1=2 limit 1";
        $rowsStoreTransaction = _db_rows($em,$sql);
        
        /*
         * from hetzner end
         */
                
        $return = array();
        if (!$array["isHTML"]) {
            $htmlContent=file_get_contents ( './templates/de/storeList.html');
            $return[] = array(
                'label' => 'html',
                'content' =>json_encode($htmlContent)
            );
            $sql = "select * from p17_system_grid
		where
		modul='storeListMaster'";
            $rowGrid = _db_row($em,$sql);
            $return[] = array(
                'label' => 'rowGrid',
                'content' =>json_encode($rowGrid)
            );
        }
        
        $return[] = array(
            'label' => 'rowsArticleStore',
            'content' =>json_encode($rowsArticleStore)
        );
        
        
        $return[] = array(
            'label' => 'rowsStore',
            'content' => json_encode($rowsStoreTransaction)
        );
        
        return new JsonResponse($return);
        
    }
    
    public function storeGetTransaction(Request $request)
    {
        
    include ('./web/classes/_standard.php');
    $array=object_to_array(json_decode($_REQUEST["data"]));
    
    $sessionStorage = new NativeSessionStorage(array(), new NativeFileSessionHandler());
    $session = new Session($sessionStorage);
    $session->start();
    //$auth = $session->get('auth');
    $auth = json_decode($session->get('auth'));
    
    $firmID = $auth->{'firmID'};
    $id=$array["id"];
        
    $em = $this->getDoctrine()->getManager();
    $sql = "select s.*
		from p17_stock_transaction s
		where s.id=$id";
    $rowStoreTransaction=_db_row($em,$sql);
    $return = array();
    $return[] = array(
        'label' => 'rowStoreTransaction',
        'content' =>json_encode($rowStoreTransaction)
    );
    
    return new JsonResponse($return);
    
    }
    
    public function storeGetArticleTransactions(Request $request)
    {
        
        include ('./web/classes/_standard.php');
        $array=object_to_array(json_decode($_REQUEST["data"]));
        
        $sessionStorage = new NativeSessionStorage(array(), new NativeFileSessionHandler());
        $session = new Session($sessionStorage);
        $session->start();
        //$auth = $session->get('auth');
        $auth = json_decode($session->get('auth'));
        
        $firmID = $auth->{'firmID'};
        $article_id=$array["article_id"];
        $variation1_id=$array["variation1_id"];
        $variation2_id=$array["variation2_id"];
        
        $em = $this->getDoctrine()->getManager();
        $sql = "select s.*
		from p17_stock_transaction s
		where 
        s.article_id=$article_id AND
        s.variation1_id=$variation1_id AND
        s.variation2_id=$variation2_id
        order by date desc";
        $rowsStore=_db_rows($em,$sql);
        for ($i=0;$i<count($rowsStore);$i++) {
            $orderID=$rowsStore[$i]["orderID"];
            if ($rowsStore[$i]["division"]=="E") {
                $sql="select purchaseNo as orderNo from p17_purchasebook
                    where
                    orderID=$orderID";
                $row=_db_row($em,$sql);
                if (count($row)==0) {
                    $rowsStore[$i]["orderNo"]="";
                } else {
                    $rowsStore[$i]["orderNo"]=$row["orderNo"];
                }
                
            } else {
                $sql="select orderNo as orderNo from p17_orderbook
                    where
                    orderID=$orderID";
                $row=_db_row($em,$sql);
                if (count($row)==0) {
                    $rowsStore[$i]["orderNo"]="";
                } else {
                    $rowsStore[$i]["orderNo"]=$row["orderNo"];
                }
                
            }
        }
        
        $rowStatistic=getArticleStatistic($em,$article_id,$variation1_id,$variation2_id);
        
        // for all article_id without variation, last parameter false
        $rowStatisticA=getArticleStatistic($em,$article_id,$variation1_id,$variation2_id,false);
        
        $rowStatistic["totalConsumptionA"]=$rowStatisticA["totalConsumption"];
        $rowStatistic["monthlyConsumptionA"]=$rowStatisticA["monthlyConsumption"];
        $rowStatistic["turnoverRatioA"]=$rowStatisticA["turnoverRatio"];
        
        $return = array();
        $return[] = array(
            'label' => 'rowsStore',
            'content' =>json_encode($rowsStore)
        );
        $return[] = array(
            'label' => 'rowStatistic',
            'content' =>json_encode($rowStatistic)
        );
        
        return new JsonResponse($return);
        
    }
    public function storeGetOrderTransactions(Request $request)
    {
        
        include ('./web/classes/_standard.php');
        $array=object_to_array(json_decode($_REQUEST["data"]));
        
        $sessionStorage = new NativeSessionStorage(array(), new NativeFileSessionHandler());
        $session = new Session($sessionStorage);
        $session->start();
        //$auth = $session->get('auth');
        $auth = json_decode($session->get('auth'));
        
        $firmID = $auth->{'firmID'};
        $orderID=$array["orderID"];
        $division=$array["division"];
        
        
        $em = $this->getDoctrine()->getManager();
        $sql = "select s.*,a.article_code,a.name
		from p17_stock_transaction s,p17_article a
		where
        s.orderID=$orderID AND
        s.division='$division' AND
        a.id=s.article_id
        order by a.article_code asc";
        $rowsStore=_db_rows($em,$sql);
        
         if ($division=="E") {
             $sql="select o.*,
                    purchaseNo as orderNo,
                    purchaseDate as orderDate,
                    supplier_company as partnerCompany 
                    from p17_purchasebook o
                    where
                    o.orderID=$orderID";
              $rowOrder=_db_row($em,$sql);
              $sql = "select p.*,v.percentage*100 as percentage,
		      if (p.variation1_id=0,'',(select name from p17_article_variation where id=p.variation1_id)) as variation1,
		      if (p.variation2_id=0,'',(select name from p17_article_variation where id=p.variation2_id)) as variation2
		      from p17_purchase_positions p
              left join p17_vat v on v.vat_id=p.vat_id
		      where p.orderID=$orderID
		      order by p.article_code asc";
              
              $rowsOrderPositions = _db_rows($em, $sql);
                      
            } else {
                $sql="select o.*,
                    customer_company as partnerCompany
                    from p17_orderbook o
                    where
                    o.orderID=$orderID";
                $rowOrder=_db_row($em,$sql);
                $sql = "select p.*,v.percentage*100 as percentage,
		          if (p.variation1_id=0,'',(select name from p17_article_variation where id=p.variation1_id)) as variation1,
		          if (p.variation2_id=0,'',(select name from p17_article_variation where id=p.variation2_id)) as variation2
		          from p17_order_positions p
                  left join p17_vat v on v.vat_id=p.vat_id
		          where p.orderID=$orderID
		          order by p.article_code asc";
                
                $rowsOrderPositions = _db_rows($em, $sql);
                
            }
        
        $return = array();
        $return[] = array(
            'label' => 'rowsStore',
            'content' => json_encode($rowsStore)
        );
        $return[] = array(
            'label' => 'rowOrder',
            'content' => json_encode($rowOrder)
        );
        $return[] = array(
            'label' => 'rowsOrderPositions',
            'content' => json_encode($rowsOrderPositions)
        );

        return new JsonResponse($return);
        
    }
    public function storeTransactionDelete(Request $request)
    {
        require ('./web/classes/_standard.php');
        $array = object_to_array(json_decode($_REQUEST["data"]));
        
        $sessionStorage = new NativeSessionStorage(array(), new NativeFileSessionHandler());
        $session = new Session($sessionStorage);
        $session->start();
        $auth = json_decode($session->get('auth'));
        $firmID = $auth->{'firmID'};
        $array["firmID"] = $firmID;
        $id = $array["id"];
        
        $em = $this->getDoctrine()->getEntityManager();
        $record = $em->getRepository(P17StockTransaction::class)->find($id);
        $em->remove($record);
        $em->flush();
        
        $return = array();
        $return[] = array(
            'label' => 'success',
            'content' => json_encode('deleted')
        );
        
        return new JsonResponse($return);
    }

    public function storeReorderListInit()
    {
        require ('./web/classes/_standard.php');
        $array=object_to_array(json_decode($_REQUEST["data"]));
        
        $sessionStorage = new NativeSessionStorage(array(), new NativeFileSessionHandler());
        $session = new Session($sessionStorage);
        $session->start();
        // $auth = $session->get('auth');
        $auth = json_decode($session->get('auth'));
        
        $firmID = $auth->{'firmID'};
        
        $em = $this->getDoctrine()->getManager();
        $sql = "select l.article_id,l.variation1_id,l.variation2_id,
		sum(if(transaction='I',quantity,0)) as sum_in,
		sum(if(transaction='O',quantity,0)) as sum_out,
		sum(if(transaction='R',quantity,0)) as sum_res
		from p17_stock_transaction l,p17_article a
		where
		a.firmID=$firmID AND
		a.id=l.article_id
		group by article_id,variation1_id,variation2_id
		order by article_id asc, variation1_id asc, variation2_id asc";
        $rowsStock = _db_rows($em,$sql);
        
        $sql = "select a.id,a.id as article_id,a.article_code,a.name,a.reorder_stock,a.quantity_unit,
			g.id as group_id, g.name as group_name,'' as spec_id,0 as variation1_id,0 as variation2_id,0 as available,0 as realy,0 as average
		from p17_article a, p17_article_group g
		where a.firmID=$firmID AND
		g.id=a.group_id
		order by group_name asc, article_code asc";
        $rows = _db_rows($em,$sql);
        
        for ($i = 0; $i < count($rows); $i ++) {
            $arr_tempS = stock($rows[$i], $rowsStock);
            $rows[$i]["available"] = $arr_tempS["available"];
            $rows[$i]["realy"] = $arr_tempS["real"];
        }
        
        $rowsArticle = array();
        
        for ($i = 0; $i < count($rows); $i ++) {
            $rowsArticle[] = $rows[$i];
            $article_id = $rows[$i]["id"];
            
            $sql = "select s.*,(select v.name
					from p17_article_variation v,p17_article_variation_group g
					where v.id=s.variation1_id AND
					g.id=v.variation_group_id) as variation1,
					(select v.name
					from p17_article_variation v,p17_article_variation_group g
					where v.id=s.variation2_id AND
					g.id=v.variation_group_id) as variation2
					from p17_article_variation_spec s
					where article_id=$article_id";
            
            $rows_spec = _db_rows($em,$sql);
            for ($ii = 0; $ii < count($rows_spec); $ii ++) {
                $arr_temp = $rows[$i];
                $arr_temp["article_id"] = $rows_spec[$ii]["article_id"];
                $arr_temp["spec_name"] = $rows_spec[$ii]["variation1"] . " " . $rows_spec[$ii]["variation2"];
                $arr_temp["spec_id"] = $rows_spec[$ii]["id"];
                $arr_temp["quantity_unit"] = $rows_spec[$ii]["quantity_unit"];
                $arr_temp["weight"] = $rows_spec[$ii]["weight"];
                $arr_temp["price"] = $rows_spec[$ii]["price"];
                $arr_temp["retourCredit"] = $rows_spec[$ii]["retourCredit"];
                $arr_temp["min_stock"] = $rows_spec[$ii]["min_stock"];
                $arr_temp["max_stock"] = $rows_spec[$ii]["max_stock"];
                $arr_temp["reorder_stock"] = $rows_spec[$ii]["reorder_stock"];
                $arr_temp["purchase_quantity"] = $rows_spec[$ii]["purchase_quantity"];
                $arr_temp["variation1_id"] = $rows_spec[$ii]["variation1_id"];
                $arr_temp["variation2_id"] = $rows_spec[$ii]["variation2_id"];
                
                $arr_tempS = stock($arr_temp, $rowsStock);
                $arr_temp["available"] = $arr_tempS["available"];
                $arr_temp["realy"] = $arr_tempS["real"];
                if ($arr_temp["available"] < $arr_temp["reorder_stock"] and $arr_temp["reorder_stock"] > 0)
                    $rowsArticle[] = $arr_temp;
            }
            ;
        }
        ;
        
        $rows = $rowsArticle;
        unset($rowsArticle);
        $rowsReorder = array();
        
        
        for ($i = 0; $i < count($rows); $i ++) {
            if (! emptyRowStock($rows, $i)) {
                $rowsReorder[] = $rows[$i];
                $arr_temp = stock_ratios($em,$rows[$i]["article_id"], $rows[$i]["variation1_id"], $rows[$i]["variation2_id"], '');
                $ii = count($rowsReorder) - 1;
                $rowsReorder[$ii]["average"] = $arr_temp["average"];
            }
        }
                
        $return = array();
        if (!$array["isHTML"]) {
            $htmlContent = file_get_contents('./templates/de/storeReorderList.html');
            $return[] = array(
                'label' => 'html',
                'content' =>json_encode($htmlContent)
            );
            $sql = "select * from p17_system_grid
		where
		modul='storeReorderList'";
            $rowGrid = _db_row($em, $sql);
            
            $return[] = array(
                'label' => 'rowGrid',
                'content' =>json_encode($rowGrid)
            );
        }
        
        $return[] = array(
            'label' => 'rowsReorder',
            'content' => json_encode($rowsReorder)
        );
                
        return new JsonResponse($return);
    }
    
    public function storeReorderRequisition()
    {
        include ('./web/classes/_standard.php');
        $sessionStorage = new NativeSessionStorage(array(), new NativeFileSessionHandler());
        $session = new Session($sessionStorage);
        $session->start();
        $auth = $session->get('auth');
        //echo $auth;
        
        $htmlContent=file_get_contents ( './templates/de/purchaseRequisitionOrder.html');
        
        $em = $this->getDoctrine()->getManager();
        
        $sql="select * from p17_purchase_request where orderID=-1";
        $rowPurchaseOrder=_db_row($em,$sql);
        
        $return = array();
        $return[] = array(
            'label' => 'html',
            'content' =>json_encode($htmlContent)
        );
        $return[] = array(
            'label' => 'rowPurchaseOrder',
            'content' =>json_encode($rowPurchaseOrder)
        );
        
        return new JsonResponse($return);
        
    }
    
}

