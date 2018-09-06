<?php
// src/Controller/sellingController.php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Session\Storage\NativeSessionStorage;
use Symfony\Component\HttpFoundation\Session\Storage\Handler\NativeFileSessionHandler;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use App\Entity\P17Firms;
use App\Entity\P17OrderPositions;
use App\Entity\P17Orderbook;
use App\Entity\P17OrderMessages;
use App\Entity\P17StockTransaction;
use App\Entity\P17Article;
use App\Entity\P17ArticleGroup;
use App\Entity\P17ArticleSet;
use App\Entity\P17ArticleVariation;
use App\Entity\P17ArticleVariationGroup;
use App\Entity\P17ArticleVariationSpec;
use App\Entity\P17StockOthers;
use App\Entity\P17OrderPackagePositions;
use App\Entity\P17OrderDhlPositions;
use App\Entity\P17OrderCreditPositions;
use App\Entity\P17OrderPositionsKk;

class sellingController extends Controller
{

    /**
     *
     * @Route("/sellingInit")
     */
    public function sellingInit()
    {
        $title = "selling";
        $date = date('d.m.Y');
        
        $sessionStorage = new NativeSessionStorage(array(), new NativeFileSessionHandler());
        $session = new Session($sessionStorage);
        $session->start();
        $auth = $session->get('auth');
        // echo $auth;
        
        $htmlContent = file_get_contents('./templates/de/selling.html');
        // $htmlContent = $this->render ( 'de/management.html.twig');
        
        $return = array();
        $return[] = array(
            'label' => 'html',
            'content' => json_encode($htmlContent)
        );
        
        return new JsonResponse($return);
    }

    public function sellingBookInit()
    {
        $title = "dashboard";
        $date = date('d.m.Y');
        
        $sessionStorage = new NativeSessionStorage(array(), new NativeFileSessionHandler());
        $session = new Session($sessionStorage);
        $session->start();
        $auth = $session->get('auth');
        // echo $auth;
        
        $htmlContent = file_get_contents('./templates/de/sellingBook.html');
        // $htmlContent = $this->render ( 'de/management.html.twig');
        
        $return = array();
        $return[] = array(
            'label' => 'html',
            'content' => json_encode($htmlContent)
        );
        
        return new JsonResponse($return);
    }

    public function sellingBookListInit()
    {
        include ('./web/classes/_standard.php');
        
        $sessionStorage = new NativeSessionStorage(array(), new NativeFileSessionHandler());
        $session = new Session($sessionStorage);
        $session->start();
        // $auth = $session->get('auth');
        $auth = json_decode($session->get('auth'));
        
        $firmID = $auth->{'firmID'};
        
        
        $em = $this->getDoctrine()->getManager();
        
        $schoolYears=schoolYears($em,$firmID,"p17_orderbook","orderDate");
        $schoolYearFrom=$schoolYears[0]["from"];
        $schoolYearTo=$schoolYears[0]["to"];
        
        $sql = "select b.*
		from p17_orderbook b
		where b.firmID=$firmID AND
        b.orderDate>='$schoolYearFrom' AND
        b.orderDate<='$schoolYearTo'
		order by b.orderID desc";
        $rowsSellingBook = _db_rows($em, $sql);
        
        $sql = "select * from p17_system_grid
		where
		modul='sellingBookList'";
        $rowGrid = _db_row($em, $sql);
        
        $htmlContent = file_get_contents('./templates/de/sellingBookList.html');
        
        $return = array();
        $return[] = array(
            'label' => 'html',
            'content' => json_encode($htmlContent)
        );
        
        $return[] = array(
            'label' => 'rowsSellingBook',
            'content' => json_encode($rowsSellingBook)
        );
        $return[] = array(
            'label' => 'rowsSchoolYears',
            'content' => json_encode($schoolYears)
        );
        
        $return[] = array(
            'label' => 'rowGrid',
            'content' => json_encode($rowGrid)
        );
        
        return new JsonResponse($return);
    }

    public function sellingOrderInit(Request $request)
    {
        include ('./web/classes/_standard.php');
        $array = object_to_array(json_decode($_REQUEST["data"]));
        
        $sessionStorage = new NativeSessionStorage(array(), new NativeFileSessionHandler());
        $session = new Session($sessionStorage);
        $session->start();
        // $auth = $session->get('auth');
        $auth = json_decode($session->get('auth'));
        
        $firmID = $auth->{'firmID'};
        $orderID = $array["orderID"];
        
        $em = $this->getDoctrine()->getManager();
        $sql = "select b.*,t.workflowStatus,
                f.street,f.country,f.postcode,f.city,f.email,f.UStID
		          from p17_orderbook b,p17_firms f,p17_tickets t
		          where b.orderID=$orderID AND
                    f.firmID=b.customer_firmID AND
                    t.ticketID=b.ticketID
		          order by b.orderID desc";
        $rowSellingOrder = _db_row($em, $sql);
        if (!isset($rowSellingOrder["customer_firmID"])) {
            $customerFirmID=-1;
        } else {
            $customerFirmID = $rowSellingOrder["customer_firmID"];
        }
        
        $sql = "select f.firmID,f.company,f.company2,f.street,
                f.country,f.postcode,f.city,f.email,UStID,
                n.D_rating,n.rebate,n.termPayment,n.prepayment
		          from p17_firms f
                  left join p17_firms_numbers n on n.firmID=$firmID AND n.firmIDpartner=$customerFirmID 
		          where f.firmID=$customerFirmID";
        $rowCustomer = _db_row($em, $sql);
        
        $sql = "select p.*,v.percentage,p.quantity*a.weight as weight,
		if (p.variation1_id=0,'',(select name from p17_article_variation where id=p.variation1_id)) as variation1,
		if (p.variation2_id=0,'',(select name from p17_article_variation where id=p.variation2_id)) as variation2
		from p17_order_positions p
		left join p17_vat v on v.vat_id=p.vat_id
        left join p17_article_variation_spec a
            on a.article_id=p.article_id AND a.variation1_id=p.variation1_id AND a.variation2_id=p.variation2_id
		where orderID=$orderID";
        $rowsOrderPositions = _db_rows($em, $sql);
        
                
        $htmlContent = file_get_contents('./templates/de/sellingOrder.html');
        
        $newVoucherNo=newVoucherNo($em,"p17_purchase_request","voucherNo",$firmID);
        
        $return = array();
        $return[] = array(
            'label' => 'html',
            'content' => json_encode($htmlContent)
        );
        
        $return[] = array(
            'label' => 'rowSellingOrder',
            'content' => json_encode($rowSellingOrder)
        );
        $return[] = array(
            'label' => 'rowsOrderPositions',
            'content' => json_encode($rowsOrderPositions)
        );
        
        $return[] = array(
            'label' => 'rowCustomer',
            'content' => json_encode($rowCustomer)
        );
        
        $return[] = array(
            'label' => 'newVoucherNo',
            'content' => json_encode($newVoucherNo)
        );
        
        return new JsonResponse($return);
    }
    
    public function sellingBookListDelete(Request $request)
    {
        require ('./web/classes/_standard.php');
        $array = object_to_array(json_decode($_REQUEST["data"]));
        
        $sessionStorage = new NativeSessionStorage(array(), new NativeFileSessionHandler());
        $session = new Session($sessionStorage);
        $session->start();
        $auth = json_decode($session->get('auth'));
        $firmID = $auth->{'firmID'};
        $array["firmID"] = $firmID;
        // sent by dialogDelete
        $orderID = $array["id"];
        
        $em = $this->getDoctrine()->getEntityManager();
        $record = $em->getRepository(P17Orderbook::class)->find($orderID);
        $em->remove($record);
        $em->flush();
        
        $return = array();
        $return[] = array(
            'label' => 'success',
            'content' => json_encode('deleted')
        );
        
        return new JsonResponse($return);
    }
    
    public function sellingBookListChangeData(Request $request)
    {
        require ('./web/classes/_standard.php');
        $array=object_to_array(json_decode($_REQUEST["data"]));
        
        $sessionStorage = new NativeSessionStorage(array(), new NativeFileSessionHandler());
        $session = new Session($sessionStorage);
        $session->start();
        $auth = json_decode($session->get('auth'));
        $firmID = $auth->{'firmID'};
        $user = $auth->{'user'};
        
        $year=$array["year"];
        
        $em = $this->getDoctrine()->getManager();
        $schoolYears=schoolYears($em,$firmID,"p17_orderbook","orderDate",$year);
        $schoolYearFrom=$schoolYears[0]["from"];
        $schoolYearTo=$schoolYears[0]["to"];
        
        $sql = "select p.*,t.userID,u.userID,u.user as ticket_user,team.id as teamID,team.name as ticket_team
		from p17_orderbook p
		left join p17_tickets t on p.ticketID=t.ticketID
		left join p17_user u on t.userID=u.userID
		left join p17_user_team team on team.id=t.teamID
		where p.firmID=$firmID AND
        p.orderDate>='$schoolYearFrom' AND
        p.orderDate<='$schoolYearTo'
        order by p.orderDate desc";
        $rowsSellingBook=_db_rows($em,$sql);
        
        $return = array();
        $return[] = array(
            'label' => 'rowsSellingBook',
            'content' =>json_encode($rowsSellingBook)
        );
        
        return new JsonResponse($return);
        
        
    }
    
    public function sellingOrderPositionSave(Request $request)
    {
        require ('./web/classes/_standard.php');
        $array = object_to_array(json_decode($_REQUEST["data"]));
        
        $sessionStorage = new NativeSessionStorage(array(), new NativeFileSessionHandler());
        $session = new Session($sessionStorage);
        $session->start();
        $auth = json_decode($session->get('auth'));
        $firmID = $auth->{'firmID'};
        $user = $auth->{'user'};
        $array["user"] = $user;
        $array["firmID"] = $firmID;
        $orderID = $array["orderID"];
        
        if ($array["id"] == "")
            $array["id"] = - 1;
        $em = $this->getDoctrine()->getEntityManager();
        if ($array["id"] >= 0) {
            $arrayWhere = array(
                "id" => $array["id"]
            );
            _db_update($em, "p17_order_positions", $array, $arrayWhere, $auth);
            $id = $array["id"];
        } else {
            unset($array["id"]);
            $id = _db_insert($em, "p17_order_positions", $array,  $auth);
        }
        
        $sql = "select p.*,v.percentage,
		if (p.variation1_id=0,'',(select name from p17_article_variation where id=p.variation1_id)) as variation1,
		if (p.variation2_id=0,'',(select name from p17_article_variation where id=p.variation2_id)) as variation2
		from p17_order_positions p
		left join p17_vat v on v.vat_id=p.vat_id
		where orderID=$orderID";
        $rowsOrderPositions = _db_rows($em, $sql);
        
        $return = array();
        $return[] = array(
            'label' => 'success',
            'content' => json_encode('saved')
        );
        $return[] = array(
            'label' => 'rowsOrderPositions',
            'content' => json_encode('$rowsOrderPositions')
        );
        
        return new JsonResponse($return);
    }

    public function sellingOrderPositionDelete(Request $request)
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
        $sql="select orderID from p17_order_positions where id=$id";
        $row=_db_row($em,$sql);
        $orderID=$row["orderID"];
        
        $record = $em->getRepository(P17OrderPositions::class)->find($id);
        $em->remove($record);
        $em->flush();
        
        $sql = "select p.*,v.percentage,
		if (p.variation1_id=0,'',(select name from p17_article_variation where id=p.variation1_id)) as variation1,
		if (p.variation2_id=0,'',(select name from p17_article_variation where id=p.variation2_id)) as variation2
		from p17_order_positions p
		left join p17_vat v on v.vat_id=p.vat_id
		where orderID=$orderID";
        $rowsOrderPositions = _db_rows($em, $sql);
        
        $return = array();
        $return[] = array(
            'label' => 'success',
            'content' => json_encode('saved')
        );
        $return[] = array(
            'label' => 'rowsOrderPositions',
            'content' => json_encode('$rowsOrderPositions')
        );
        
        return new JsonResponse($return);
    }

    public function sellingOrderStoreInit(Request $request)
    {
        require ('./web/classes/_standard.php');
        $array = object_to_array(json_decode($_REQUEST["data"]));
        
        $sessionStorage = new NativeSessionStorage(array(), new NativeFileSessionHandler());
        $session = new Session($sessionStorage);
        $session->start();
        
        $auth = json_decode($session->get('auth'));
        
        $firmID = $auth->{'firmID'};
        $orderID = $array["orderID"];
        
        $em = $this->getDoctrine()->getEntityManager();
        
        $sql = "select positionID,transaction,sum(quantity) as quantity
                 from p17_stock_transaction 
                 where orderID=$orderID AND division='V'
                 group by positionID,transaction";
        $rowsStockTransactionS = _db_rows($em, $sql);
        
        $sql = "select s.*,p.article_code,p.name,
		if (s.variation1_id=0,'',(select name from p17_article_variation where id=p.variation1_id)) as variation1,
		if (s.variation2_id=0,'',(select name from p17_article_variation where id=p.variation2_id)) as variation2
		from p17_stock_transaction s
        left join p17_order_positions p on p.id=s.positionID
		where s.orderID=$orderID  AND division='V'";
        
        $rowsStockTransaction = _db_rows($em, $sql);
        
        $htmlContent = file_get_contents('./templates/de/sellingOrderStore.html');
        // $htmlContent = $this->render ( 'de/management.html.twig');
        
        $return = array();
        $return[] = array(
            'label' => 'html',
            'content' => json_encode($htmlContent)
        );
        $return[] = array(
            'label' => 'rowsStockTransactionS',
            'content' => json_encode($rowsStockTransactionS)
        );
        
        $return[] = array(
            'label' => 'rowsStockTransaction',
            'content' => json_encode($rowsStockTransaction)
        );
        
        return new JsonResponse($return);
    }

    public function sellingOrderStoreGetStock(Request $request)
    {
        $rowsStock = array();
        
        include ('./web/classes/_standard.php');
        $array = object_to_array(json_decode($_REQUEST["data"]));
        
        $sessionStorage = new NativeSessionStorage(array(), new NativeFileSessionHandler());
        $session = new Session($sessionStorage);
        $session->start();
        // $auth = $session->get('auth');
        $auth = json_decode($session->get('auth'));
        
        $firmID = $auth->{'firmID'};
        $orderID = $array["orderID"];
        $article_id = $array["article_id"];
        $variation1_id = $array["variation1_id"];
        $variation2_id = $array["variation2_id"];
        
        $em = $this->getDoctrine()->getEntityManager();
        $sql = "select customer_firmID from p17_orderbook
                where
                orderID=$orderID";
        $row = _db_row($em, $sql);
        $customer_firmID = $row["customer_firmID"];
        
        $sql = "select id,kind from p17_article where id=$article_id AND firmID=$firmID";
        $rows = _db_rows($em, $sql);
        
        if (count($rows) > 0) {
            $kind = $rows[0]["kind"];
            if ($kind == "P") {
                $store = "storePackage";
            } else {
                $store = "storeHW";
            }
            
            $sql = "select sum(s.quantity) as sum,s.transaction
	           from p17_stock_transaction s
	           where
	           s.article_id='$article_id' AND
	           s.variation1_id=$variation1_id AND
	           s.variation2_id=$variation2_id
	           group by s.transaction";
            $rowsStock = _db_rows($em, $sql);
            if (count($rowsStock) == 0) {
                $rowsStock["sum"] = 0;
                $rowsStock["transaction"] = '';
            }
        } else {
            $ticketID = orderID2ticketID($em, $orderID, 'P');
            $sql = "select * from p17_fibu_assets where ticketID=$ticketID";
            $rowsStock = _db_rows($em, $sql);
            if (count($rowsStock) > 0) {
                $store = "storeAssets";
            } else {
                $store = "storeOthers";
            }
        }
        
        $return = array();
        $return[] = array(
            'label' => 'store',
            'content' => json_encode($store)
        );
        $return[] = array(
            'label' => 'rowsStock',
            'content' => json_encode($rowsStock)
        );
        
        return new JsonResponse($return);
    }

    public function sellingOrderStoreSave(Request $request)
    {
        require ('./web/classes/_standard.php');
        $array = object_to_array(json_decode($_REQUEST["data"]));
        
        $sessionStorage = new NativeSessionStorage(array(), new NativeFileSessionHandler());
        $session = new Session($sessionStorage);
        $session->start();
        $auth = json_decode($session->get('auth'));
        $firmID = $auth->{'firmID'};
        $user = $auth->{'user'};
        $array["user"] = $user;
        $array["firmID"] = $firmID;
        $orderID = $array["orderID"];
        $id = $array["id"];
        
        $em = $this->getDoctrine()->getEntityManager();
        $array["ticketID"] = orderID2ticketID($em, $orderID, 'O');
        $array["division"] = "V";
        $array["date"] = date('d.m.Y');
        
        if ($id > 0) {
            $arrayWhere = array(
                "id" => $array["id"]
            );
            _db_update($em, "p17_stock_transaction", $array, $arrayWhere, $auth);
        } else {
            unset($array["id"]);
            $id = _db_insert($em, "p17_stock_transaction", $array,  $auth);
        }
        
        $sql = "select positionID,transaction,sum(quantity) as quantity
                 from p17_stock_transaction
                 where orderID=$orderID
                 group by positionID,transaction";
        $rowsStockTransactionS = _db_rows($em, $sql);
        
        $sql = "select s.*,p.article_code,p.name,
		if (s.variation1_id=0,'',(select name from p17_article_variation where id=p.variation1_id)) as variation1,
		if (s.variation2_id=0,'',(select name from p17_article_variation where id=p.variation2_id)) as variation2
		from p17_stock_transaction s
        left join p17_order_positions p on p.id=s.positionID
		where s.orderID=$orderID";
        
        $rowsStockTransaction = _db_rows($em, $sql);
        
        $return = array();
        $return[] = array(
            'label' => 'success',
            'content' => json_encode('saved')
        );
        $return[] = array(
            'label' => 'rowsStockTransactionS',
            'content' => json_encode($rowsStockTransactionS)
        );
        
        $return[] = array(
            'label' => 'rowsStockTransaction',
            'content' => json_encode($rowsStockTransaction)
        );
        
        return new JsonResponse($return);
    }

    public function sellingOrderStoreDelete(Request $request)
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
        $sql = "select orderID from p17_stock_transaction where id=$id";
        $row = _db_row($em, $sql);
        $orderID = $row["orderID"];
        
        $record = $em->getRepository(P17StockTransaction::class)->find($id);
        $em->remove($record);
        $em->flush();
        
        $sql = "select positionID,transaction,sum(quantity) as quantity
                 from p17_stock_transaction
                 where orderID=$orderID AND
                    division='V'
                 group by positionID,transaction";
        $rowsStockTransactionS = _db_rows($em, $sql);
        
        $sql = "select s.*,p.article_code,p.name,
		if (s.variation1_id=0,'',(select name from p17_article_variation where id=p.variation1_id)) as variation1,
		if (s.variation2_id=0,'',(select name from p17_article_variation where id=p.variation2_id)) as variation2
		from p17_stock_transaction s
        left join p17_order_positions p on p.id=s.positionID
		where s.orderID=$orderID AND
                 division='V'";
        
        $rowsStockTransaction = _db_rows($em, $sql);
        
        $return = array();
        $return[] = array(
            'label' => 'success',
            'content' => json_encode('deleted')
        );
        $return[] = array(
            'label' => 'rowsStockTransactionS',
            'content' => json_encode($rowsStockTransactionS)
        );
        
        $return[] = array(
            'label' => 'rowsStockTransaction',
            'content' => json_encode($rowsStockTransaction)
        );
        
        return new JsonResponse($return);
    }

    public function sellingOrderDispatchInit(Request $request)
    {
        require ('./web/classes/_standard.php');
        $array = object_to_array(json_decode($_REQUEST["data"]));
        
        $sessionStorage = new NativeSessionStorage(array(), new NativeFileSessionHandler());
        $session = new Session($sessionStorage);
        $session->start();
        
        $auth = json_decode($session->get('auth'));
        
        $firmID = $auth->{'firmID'};
        $orderID = $array["orderID"];
        
        $em = $this->getDoctrine()->getEntityManager();
        
        $sql = "select p.*,v.percentage,
		if (p.variation1_id=0,'',(select name from p17_article_variation where id=p.variation1_id)) as variation1,
		if (p.variation2_id=0,'',(select name from p17_article_variation where id=p.variation2_id)) as variation2
		from p17_order_package_positions p
		left join p17_vat v on v.vat_id=p.vat_id
		where orderID=$orderID";
        $rowsOrderPackagePositions = _db_rows($em, $sql);
        
        $sql="select * from p17_post_fees
                where
                left(code,2)='PG'
                order by weight_from asc";
        $rowsPostFees=_db_rows($em,$sql);
        
        $sql="select * from p17_order_DHL_positions
                where
                orderID=$orderID";
        $rowsOrderDHLPositions=_db_rows($em,$sql);
        
        $htmlContent = file_get_contents('./templates/de/sellingOrderDispatch.html');
        // $htmlContent = $this->render ( 'de/management.html.twig');
        
        $return = array();
        $return[] = array(
            'label' => 'html',
            'content' => json_encode($htmlContent)
        );
        
        $return[] = array(
            'label' => 'rowsPostFees',
            'content' => json_encode($rowsPostFees)
        );
        
        $return[] = array(
            'label' => 'rowsOrderPackagePositions',
            'content' => json_encode($rowsOrderPackagePositions)
        );
        $return[] = array(
            'label' => 'rowsOrderDHLPositions',
            'content' => json_encode($rowsOrderDHLPositions)
        );
        
        return new JsonResponse($return);
    }
    
    public function sellingOrderDispatchSave(Request $request)
    {
        require ('./web/classes/_standard.php');
        $array = object_to_array(json_decode($_REQUEST["data"]));
        
        $sessionStorage = new NativeSessionStorage(array(), new NativeFileSessionHandler());
        $session = new Session($sessionStorage);
        $session->start();
        $auth = json_decode($session->get('auth'));
        $firmID = $auth->{'firmID'};
        $user = $auth->{'user'};
        $array["user"] = $user;
        $array["firmID"] = $firmID;
        $orderID = $array["orderID"];
        
        $em = $this->getDoctrine()->getEntityManager();
        
        for ($i=1;$i<=3;$i++) {
        if ($array["DHL_quantity$i"]!='') {
            $id=$array["DHL_packets$i"];
            $sql="select id,quantity from p17_order_DHL_positions where orderID=$orderID AND DHL_id=$id limit 1";
            $rows=_db_rows($em,$sql);
            if (count($rows)==0) {
                $arrayDHL=array();
                $arrayDHL["orderID"]=$array["orderID"];
                $arrayDHL["quantity"]=$array["DHL_quantity$i"];
                $arrayDHL["DHL_id"]=$array["DHL_packets$i"];
                $id = _db_insert($em, "p17_order_DHL_positions", $arrayDHL, $auth);
            } else {
                if ($rows[0]["quantity"]!=$array["DHL_quantity$i"]) {
                    $arrayDHL=array();
                    $arrayDHL["quantity"]=$array["DHL_quantity$i"];
                    $arrayWhere = array("id" => $rows[0]["id"]);
                    _db_update($em, "p17_order_DHL_positions", $arrayDHL, $arrayWhere);
                }
            }
        }
        
        }
        
        $sql="select * from p17_order_DHL_positions where orderID=$orderID";
        $rows=_db_rows($em,$sql);
        for ($i=0;$i<count($rows);$i++) {
            $OK=false;
            if ($rows[$i]["DHL_id"]==$array["DHL_packets1"] 
                AND $rows[$i]["quantity"]==$array["DHL_quantity1"] 
                OR
                $rows[$i]["DHL_id"]==$array["DHL_packets2"]
                AND $rows[$i]["quantity"]==$array["DHL_quantity2"]
                OR
                $rows[$i]["DHL_id"]==$array["DHL_packets3"]
                AND $rows[$i]["quantity"]==$array["DHL_quantity3"]) {
                    $OK=true;
                }
                if (!$OK) {
                    $id=$rows[$i]["id"];
                    $record = $em->getRepository(P17OrderDhlPositions::class)->find($id);
                    $em->remove($record);
                    $em->flush();
                }
        }
        
        $array["ticketID"] = orderID2ticketID($em, $orderID, 'O');
        $array["division"] = "V";
        $array["date"] = date('d.m.Y');
        
            $arrayWhere = array("orderID" => $array["orderID"]);
            _db_update($em, "p17_orderbook", $array, $arrayWhere, $auth);
        
            $sql = "select b.*
		from p17_orderbook b
		where b.orderID=$orderID
		order by b.orderID desc";
            $rowSellingOrder = _db_row($em, $sql);
            
        $return = array();
        $return[] = array(
            'label' => 'success',
            'content' => json_encode('saved')
        );
        $return[] = array(
            'label' => 'rowSellingOrder',
            'content' => json_encode($rowSellingOrder)
        );
        
        return new JsonResponse($return);
    }
    
    public function sellingOrderPackagePositionSave(Request $request)
    {
        require ('./web/classes/_standard.php');
        $array = object_to_array(json_decode($_REQUEST["data"]));
        
        $sessionStorage = new NativeSessionStorage(array(), new NativeFileSessionHandler());
        $session = new Session($sessionStorage);
        $session->start();
        $auth = json_decode($session->get('auth'));
        $firmID = $auth->{'firmID'};
        $user = $auth->{'user'};
        $array["user"] = $user;
        $array["firmID"] = $firmID;
        $orderID = $array["orderID"];
        
        if ($array["id"] == "")
            $array["id"] = - 1;
            $em = $this->getDoctrine()->getEntityManager();
            if ($array["id"] >= 0) {
                $arrayWhere = array(
                    "id" => $array["id"]
                );
                _db_update($em, "p17_order_package_positions", $array, $arrayWhere, $auth);
                $id = $array["id"];
            } else {
                unset($array["id"]);
                $id = _db_insert($em, "p17_order_package_positions", $array,  $auth);
            }
            
            $sql = "select p.*,v.percentage,
		if (p.variation1_id=0,'',(select name from p17_article_variation where id=p.variation1_id)) as variation1,
		if (p.variation2_id=0,'',(select name from p17_article_variation where id=p.variation2_id)) as variation2
		from p17_order_package_positions p
		left join p17_vat v on v.vat_id=p.vat_id
		where orderID=$orderID";
            $rowsOrderPackagePositions = _db_rows($em, $sql);
                        
            $return = array();
            $return[] = array(
                'label' => 'success',
                'content' => json_encode('saved')
            );
            $return[] = array(
                'label' => 'rowsOrderPackagePositions',
                'content' => json_encode($rowsOrderPackagePositions)
            );
                        
            return new JsonResponse($return);
    }
    
    public function sellingOrderPackagePositionDelete(Request $request)
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
        $record = $em->getRepository(P17OrderPackagePositions::class)->find($id);
        $em->remove($record);
        $em->flush();
        
        $sql = "select p.*,v.percentage,
		if (p.variation1_id=0,'',(select name from p17_article_variation where id=p.variation1_id)) as variation1,
		if (p.variation2_id=0,'',(select name from p17_article_variation where id=p.variation2_id)) as variation2
		from p17_order_package_positions p
		left join p17_vat v on v.vat_id=p.vat_id
		where orderID=$orderID";
        $rowsOrderPackagePositions = _db_rows($em, $sql);
        
        $return = array();
        $return[] = array(
            'label' => 'success',
            'content' => json_encode('deleted')
        );
        $return[] = array(
            'label' => 'rowsOrderPackagePositions',
            'content' => json_encode($rowsOrderPackagePositions)
        );
        
        return new JsonResponse($return);
    }
    
    public function sellingOrderDispatchCost(Request $request)
    {
        require ('./web/classes/_standard.php');
        $array = object_to_array(json_decode($_REQUEST["data"]));
        
        $sessionStorage = new NativeSessionStorage(array(), new NativeFileSessionHandler());
        $session = new Session($sessionStorage);
        $session->start();
        $auth = json_decode($session->get('auth'));
        $firmID = $auth->{'firmID'};
        $orderID = $array["orderID"];
        
        $em = $this->getDoctrine()->getEntityManager();
        
        $sql="select sum(sumPosition) as sumPosition
                from p17_order_positions
                where
                orderID=$orderID 
                group by orderID";
        $row=_db_row($em,$sql);
        
        
        $rowDispatchCostLKW=dispatchCost($em,$firmID,'LKW',$array["km"],$array["sum_weight"],$row["sumPosition"]);
        $rowDispatchCostBaySped=dispatchCost($em,$firmID,'BaySped',$array["km"],$array["sum_weight"],$row["sumPosition"]);
        
            $return = array();
            $return[] = array(
                'label' => 'rowDispatchCostLKW',
                'content' => json_encode($rowDispatchCostLKW)
            );
            $return[] = array(
                'label' => 'rowDispatchCostBaySped',
                'content' => json_encode($rowDispatchCostBaySped)
            );
            
            return new JsonResponse($return);
    }

    public function sellingOrderReceiptInit(Request $request)
    {
        require ('./web/classes/_standard.php');
        $array = object_to_array(json_decode($_REQUEST["data"]));
        
        $sessionStorage = new NativeSessionStorage(array(), new NativeFileSessionHandler());
        $session = new Session($sessionStorage);
        $session->start();
        
        $auth = json_decode($session->get('auth'));
        
        $firmID = $auth->{'firmID'};
        $orderID = $array["orderID"];
        
        $em = $this->getDoctrine()->getEntityManager();
        
        $sql = "select p.*,v.percentage,
		if (p.variation1_id=0,'',(select name from p17_article_variation where id=p.variation1_id)) as variation1,
		if (p.variation2_id=0,'',(select name from p17_article_variation where id=p.variation2_id)) as variation2
		from p17_order_credit_positions p
		left join p17_vat v on v.vat_id=p.vat_id
		where orderID=$orderID";
        $rowsOrderCreditPositions = _db_rows($em, $sql);
                
        $htmlContent = file_get_contents('./templates/de/sellingOrderReceipt.html');
        // $htmlContent = $this->render ( 'de/management.html.twig');
        
        $return = array();
        $return[] = array(
            'label' => 'html',
            'content' => json_encode($htmlContent)
        );
        
        $return[] = array(
            'label' => 'rowsOrderCreditPositions',
            'content' => json_encode($rowsOrderCreditPositions)
        );
        
        return new JsonResponse($return);
    }
    
    public function sellingOrderReceiptSave(Request $request)
    {
        require ('./web/classes/_standard.php');
        $array = object_to_array(json_decode($_REQUEST["data"]));
        
        $sessionStorage = new NativeSessionStorage(array(), new NativeFileSessionHandler());
        $session = new Session($sessionStorage);
        $session->start();
        $auth = json_decode($session->get('auth'));
        $firmID = $auth->{'firmID'};
        $user = $auth->{'user'};
        $array["user"] = $user;
        $array["firmID"] = $firmID;
        $orderID = $array["orderID"];
        
        $em = $this->getDoctrine()->getEntityManager();
        
        
        $array["ticketID"] = orderID2ticketID($em, $orderID, 'O');
        $array["division"] = "V";
        $array["date"] = date('d.m.Y');
        
        $arrayWhere = array("orderID" => $array["orderID"]);
        _db_update($em, "p17_orderbook", $array, $arrayWhere, $auth);
        
        
        $sql = "select b.*
		from p17_orderbook b
		where b.orderID=$orderID
		order by b.orderID desc";
        $rowSellingOrder = _db_row($em, $sql);
        
        $return = array();
        $return[] = array(
            'label' => 'success',
            'content' => json_encode('saved')
        );
        $return[] = array(
            'label' => 'rowSellingOrder',
            'content' => json_encode($rowSellingOrder)
        );
        
        
        return new JsonResponse($return);
    }
    
    
    public function sellingOrderCreditPositionSave(Request $request)
    {
        require ('./web/classes/_standard.php');
        $array = object_to_array(json_decode($_REQUEST["data"]));
        
        $sessionStorage = new NativeSessionStorage(array(), new NativeFileSessionHandler());
        $session = new Session($sessionStorage);
        $session->start();
        $auth = json_decode($session->get('auth'));
        $firmID = $auth->{'firmID'};
        $user = $auth->{'user'};
        $array["user"] = $user;
        $array["firmID"] = $firmID;
        $orderID = $array["orderID"];
        
        if ($array["id"] == "")
            $array["id"] = - 1;
            $em = $this->getDoctrine()->getEntityManager();
            if ($array["id"] >= 0) {
                $arrayWhere = array(
                    "id" => $array["id"]
                );
                _db_update($em, "p17_order_credit_positions", $array, $arrayWhere, $auth);
                $id = $array["id"];
            } else {
                unset($array["id"]);
                $id = _db_insert($em, "p17_order_credit_positions", $array,  $auth);
            }
            
            $sql = "select p.*,v.percentage,
		if (p.variation1_id=0,'',(select name from p17_article_variation where id=p.variation1_id)) as variation1,
		if (p.variation2_id=0,'',(select name from p17_article_variation where id=p.variation2_id)) as variation2
		from p17_order_credit_positions p
		left join p17_vat v on v.vat_id=p.vat_id
		where orderID=$orderID";
            $rowsOrderCreditPositions = _db_rows($em, $sql);
            
            $return = array();
            $return[] = array(
                'label' => 'success',
                'content' => json_encode('saved')
            );
            $return[] = array(
                'label' => 'rowsOrderCreditPositions',
                'content' => json_encode($rowsOrderCreditPositions)
            );
            
            return new JsonResponse($return);
    }
    
    public function sellingOrderCreditPositionDelete(Request $request)
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
        $sql="select orderID from p17_order_credit_positions where id=$id";
        $row=_db_row($em,$sql);
        $orderID=$row["orderID"];
                
        $record = $em->getRepository(P17OrderCreditPositions::class)->find($id);
        $em->remove($record);
        $em->flush();
        
        $sql = "select p.*,v.percentage,
		if (p.variation1_id=0,'',(select name from p17_article_variation where id=p.variation1_id)) as variation1,
		if (p.variation2_id=0,'',(select name from p17_article_variation where id=p.variation2_id)) as variation2
		from p17_order_credit_positions p
		left join p17_vat v on v.vat_id=p.vat_id
		where orderID=$orderID";
        $rowsOrderCreditPositions = _db_rows($em, $sql);
        
        $return = array();
        $return[] = array(
            'label' => 'success',
            'content' => json_encode('deleted')
        );
        $return[] = array(
            'label' => 'rowsOrderCreditPositions',
            'content' => json_encode($rowsOrderCreditPositions)
        );
        
        return new JsonResponse($return);
    }
    
    public function sellingOrderInvoiceInit()
    {
        require ('./web/classes/_standard.php');
        $array = object_to_array(json_decode($_REQUEST["data"]));
        
        $sessionStorage = new NativeSessionStorage(array(), new NativeFileSessionHandler());
        $session = new Session($sessionStorage);
        $session->start();
        
        $auth = json_decode($session->get('auth'));
        
        $firmID = $auth->{'firmID'};
        $orderID = $array["orderID"];
        
        $em = $this->getDoctrine()->getEntityManager();
                
        $htmlContent = file_get_contents('./templates/de/sellingOrderInvoice.html');
        // $htmlContent = $this->render ( 'de/management.html.twig');
        
        $return = array();
        $return[] = array(
            'label' => 'html',
            'content' => json_encode($htmlContent)
        );
                
        return new JsonResponse($return);
    }

    public function sellingOrderInvoiceSave(Request $request)
    {
        require ('./web/classes/_standard.php');
        $array = object_to_array(json_decode($_REQUEST["data"]));
        
        $sessionStorage = new NativeSessionStorage(array(), new NativeFileSessionHandler());
        $session = new Session($sessionStorage);
        $session->start();
        $auth = json_decode($session->get('auth'));
        $firmID = $auth->{'firmID'};
        $user = $auth->{'user'};
        $array["user"] = $user;
        $array["firmID"] = $firmID;
        $orderID = $array["orderID"];
        
        $em = $this->getDoctrine()->getEntityManager();
        
        
        $arrayWhere = array(
            "orderID" => $array["orderID"]
        );
        _db_update($em, "p17_orderbook", $array, $arrayWhere, $auth);
        
        $sql = "select b.*
		from p17_orderbook b
		where b.orderID=$orderID
		order by b.orderID desc";
        $rowSellingOrder = _db_row($em, $sql);
        
        $return = array();
        $return[] = array(
            'label' => 'success',
            'content' => json_encode('saved')
        );
        $return[] = array(
            'label' => 'rowSellingOrder',
            'content' => json_encode($rowSellingOrder)
        );
        
        
        return new JsonResponse($return);
    }

    public function sellingOrderBookingInit(Request $request)
    {
        require ('./web/classes/_standard.php');
        $array = object_to_array(json_decode($_REQUEST["data"]));
        
        $sessionStorage = new NativeSessionStorage(array(), new NativeFileSessionHandler());
        $session = new Session($sessionStorage);
        $session->start();
        $auth = json_decode($session->get('auth'));
        $firmID = $auth->{'firmID'};
        
        $htmlContent = file_get_contents('./templates/de/sellingOrderBooking.html');
        $htmlContent .= file_get_contents('./templates/de/bookingDialog.html');
        
        $em = $this->getDoctrine()->getEntityManager();
        $ticketID = orderID2ticketID($em, $array["orderID"], "O");
        
        $sql = "select f.*
                from p17_fibu_journal f,p17_fibu_journalID j
                where
                j.ticketID=$ticketID AND
                f.journalID=j.journalID";
        $rowsJournal = _db_rows($em, $sql);
        
        $sql = "select f.ticketID,
                sum(betrag) as betrag,
                sum(skontobetrag) as skontobetrag,
                sum(ausgleichbetrag) as ausgleichbetrag,
                sum(betrag)-sum(skontobetrag) as zahlungsbetrag,
                sum(betrag)-sum(ausgleichbetrag) as rest
                from p17_fibu_opliste f
                where
                f.ticketID=$ticketID";
        $rowsOP = _db_rows($em, $sql);
        //if(DATE_ADD(datum, INTERVAL skontotage DAY)>=now(),skontobetrag,0) as skontobetrag,
        //DATE_ADD(datum, INTERVAL skontotage DAY) as skontodatum,
        
        
        $return = array();
        $return[] = array(
            'label' => 'html',
            'content' => json_encode($htmlContent)
        );
        $return[] = array(
            'label' => 'rowsJournal',
            'content' => json_encode($rowsJournal)
        );
        
        $return[] = array(
            'label' => 'rowsOP',
            'content' => json_encode($rowsOP)
        );
        
        return new JsonResponse($return);
    }

    public function sellingOrderMessagesInit(Request $request)
    {
        require ('./web/classes/_standard.php');
        $array = object_to_array(json_decode($_REQUEST["data"]));
        
        $sessionStorage = new NativeSessionStorage(array(), new NativeFileSessionHandler());
        $session = new Session($sessionStorage);
        $session->start();
        $auth = json_decode($session->get('auth'));
        $firmID = $auth->{'firmID'};
        $orderID = $array["orderID"];
        
        $em = $this->getDoctrine()->getEntityManager();
        
        $sql = "select * from p17_firms_textmodules
                 where firmID=$firmID order by rank asc";
        $rowsTextmodules = _db_rows($em, $sql);
        
        $sql = "select * from p17_order_messages where orderID=$orderID order by date desc";
        $rowsMessages = _db_rows($em, $sql);
        
        $htmlContent = file_get_contents('./templates/de/sellingOrderMessages.html');
        // $htmlContent = $this->render ( 'de/management.html.twig');
        
        $return = array();
        $return[] = array(
            'label' => 'html',
            'content' => json_encode($htmlContent)
        );
        $return[] = array(
            'label' => 'rowsMessages',
            'content' => json_encode($rowsMessages)
        );
        $return[] = array(
            'label' => 'rowsTextmodules',
            'content' => json_encode($rowsTextmodules)
        );
        
        return new JsonResponse($return);
    }

    public function sellingOrderMessagesSave(Request $request)
    {
        require ('./web/classes/_standard.php');
        $array = object_to_array(json_decode($_REQUEST["data"]));
        
        $sessionStorage = new NativeSessionStorage(array(), new NativeFileSessionHandler());
        $session = new Session($sessionStorage);
        $session->start();
        $auth = json_decode($session->get('auth'));
        $firmID = $auth->{'firmID'};
        $user = $auth->{'user'};
        $array["user"] = $user;
        $array["firmID"] = $firmID;
        $orderID = $array["orderID"];
        $id = $array["id"];
        $em = $this->getDoctrine()->getEntityManager();
        
        if ($id >= 0) {
            $arrayWhere = array(
                "id" => $array["id"]
            );
            _db_update($em, "p17_order_messages", $array, $arrayWhere, $auth);
        } else {
            unset($array["id"]);
            _db_insert($em, "p17_order_messages", $array,  $auth);
        }
        
        $sql = "select * from p17_order_messages where orderID=$orderID order by date desc";
        $rowsMessages = _db_rows($em, $sql);
        
        $return = array();
        $return[] = array(
            'label' => 'success',
            'content' => json_encode('saved')
        );
        $return[] = array(
            'label' => 'rowsMessages',
            'content' => json_encode($rowsMessages)
        );
        
        return new JsonResponse($return);
    }

    public function sellingOrderMessagesDelete(Request $request)
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
        
        $sql = "select orderID from p17_order_messages where id=$id";
        $row = _db_row($em, $sql);
        $orderID = $row["orderID"];
        
        $record = $em->getRepository(P17OrderMessages::class)->find($id);
        $em->remove($record);
        $em->flush();
        
        $sql = "select * from p17_order_messages where orderID=$orderID order by date desc";
        $rowsMessages = _db_rows($em, $sql);
        
        $return = array();
        $return[] = array(
            'label' => 'success',
            'content' => json_encode('gelöscht')
        );
        $return[] = array(
            'label' => 'rowsMessages',
            'content' => json_encode($rowsMessages)
        );
        
        return new JsonResponse($return);
    }
    public function sellingKKInit()
    {
        $title = "dashboard";
        $date = date('d.m.Y');
        
        $sessionStorage = new NativeSessionStorage(array(), new NativeFileSessionHandler());
        $session = new Session($sessionStorage);
        $session->start();
        $auth = $session->get('auth');
        // echo $auth;
        
        $htmlContent = file_get_contents('./templates/de/sellingKK.html');
        // $htmlContent = $this->render ( 'de/management.html.twig');
        
        $return = array();
        $return[] = array(
            'label' => 'html',
            'content' => json_encode($htmlContent)
        );
        
        return new JsonResponse($return);
    }
    
    public function sellingKKListInit()
    {
        include ('./web/classes/_standard.php');
        
        $sessionStorage = new NativeSessionStorage(array(), new NativeFileSessionHandler());
        $session = new Session($sessionStorage);
        $session->start();
        // $auth = $session->get('auth');
        $auth = json_decode($session->get('auth'));
        
        $firmID = $auth->{'firmID'};
        
        $em = $this->getDoctrine()->getManager();
        $sql = "select b.*
		from p17_orderbook_KK b
		where b.firmID=$firmID
		order by b.orderID desc";
        $rowsSellingKK = _db_rows($em, $sql);
        
        $sql = "select * from p17_system_grid
		where
		modul='sellingKKList'";
        $rowGrid = _db_row($em, $sql);
        
        $htmlContent = file_get_contents('./templates/de/sellingKKList.html');
        
        $return = array();
        $return[] = array(
            'label' => 'html',
            'content' => json_encode($htmlContent)
        );
        
        $return[] = array(
            'label' => 'rowsSellingKK',
            'content' => json_encode($rowsSellingKK)
        );
        
        $return[] = array(
            'label' => 'rowGrid',
            'content' => json_encode($rowGrid)
        );
        
        return new JsonResponse($return);
    }
    
    public function sellingKKOrderInit(Request $request)
    {
        include ('./web/classes/_standard.php');
        $array = object_to_array(json_decode($_REQUEST["data"]));
        
        $sessionStorage = new NativeSessionStorage(array(), new NativeFileSessionHandler());
        $session = new Session($sessionStorage);
        $session->start();
        // $auth = $session->get('auth');
        $auth = json_decode($session->get('auth'));
        
        $firmID = $auth->{'firmID'};
        $orderID = $array["orderID"];
        
        $em = $this->getDoctrine()->getManager();
        $sql = "select b.*
		from p17_orderbook_KK b
		where b.orderID=$orderID
		order by b.orderID desc";
        $rowSellingKKOrder = _db_row($em, $sql);
        $customerFirmID = $rowSellingKKOrder["customer_firmID"];
        
        $sql = "select f.firmID,f.company,f.company2,f.street,
                f.country,f.postcode,f.city,f.email,UStID,
                n.D_rating,n.rebate,n.termPayment,n.prepayment
		          from p17_firms f
                  left join p17_firms_numbers n on n.firmID=$firmID AND n.firmIDpartner=$customerFirmID
		          where f.firmID=$customerFirmID";
        $rowCustomer = _db_row($em, $sql);
        
        $sql = "select p.*,v.percentage,p.quantity*a.weight as weight,
		if (p.variation1_id=0,'',(select name from p17_article_variation where id=p.variation1_id)) as variation1,
		if (p.variation2_id=0,'',(select name from p17_article_variation where id=p.variation2_id)) as variation2
		from p17_order_positions_KK p
		left join p17_vat v on v.vat_id=p.vat_id
        left join p17_article_variation_spec a
            on a.article_id=p.article_id AND a.variation1_id=p.variation1_id AND a.variation2_id=p.variation2_id
		where orderID=$orderID";
        $rowsKKOrderPositions = _db_rows($em, $sql);
        
        
        $sql = "select v.*
                from p17_vat v
                order by vat_id asc";
        $rowsVAT = _db_rows($em, $sql);
        
        $htmlContent = file_get_contents('./templates/de/sellingKKOrder.html');
        
        $return = array();
        $return[] = array(
            'label' => 'html',
            'content' => json_encode($htmlContent)
        );
        
        $return[] = array(
            'label' => 'rowSellingKKOrder',
            'content' => json_encode($rowSellingKKOrder)
        );
        $return[] = array(
            'label' => 'rowsKKOrderPositions',
            'content' => json_encode($rowsKKOrderPositions)
        );
        
        $return[] = array(
            'label' => 'rowCustomer',
            'content' => json_encode($rowCustomer)
        );
                
        return new JsonResponse($return);
    }
    
    public function sellingKKOrderPositionSave(Request $request)
    {
        require ('./web/classes/_standard.php');
        $array = object_to_array(json_decode($_REQUEST["data"]));
        
        $sessionStorage = new NativeSessionStorage(array(), new NativeFileSessionHandler());
        $session = new Session($sessionStorage);
        $session->start();
        $auth = json_decode($session->get('auth'));
        $firmID = $auth->{'firmID'};
        $user = $auth->{'user'};
        $array["user"] = $user;
        $array["firmID"] = $firmID;
        $orderID = $array["orderID"];
        
        if ($array["id"] == "")
            $array["id"] = - 1;
            $em = $this->getDoctrine()->getEntityManager();
            if ($array["id"] >= 0) {
                $arrayWhere = array(
                    "id" => $array["id"]
                );
                _db_update($em, "p17_order_positions_KK", $array, $arrayWhere, $auth);
                $id = $array["id"];
            } else {
                unset($array["id"]);
                $id = _db_insert($em, "p17_order_positions_KK", $array,  $auth);
            }
            
            $sql = "select p.*,v.percentage,
		if (p.variation1_id=0,'',(select name from p17_article_variation where id=p.variation1_id)) as variation1,
		if (p.variation2_id=0,'',(select name from p17_article_variation where id=p.variation2_id)) as variation2
		from p17_order_positions_KK p
		left join p17_vat v on v.vat_id=p.vat_id
		where orderID=$orderID";
            $rowsKKOrderPositions = _db_rows($em, $sql);
            
            $return = array();
            $return[] = array(
                'label' => 'success',
                'content' => json_encode('saved')
            );
            $return[] = array(
                'label' => 'rowsKKOrderPositions',
                'content' => json_encode('$rowsKKOrderPositions')
            );
            
            return new JsonResponse($return);
    }
    
    public function sellingKKOrderPositionDelete(Request $request)
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
        $sql="select orderID from p17_order_positions_KK where id=$id";
        $row=_db_row($em,$sql);
        $orderID=$row["orderID"];
        
        $record = $em->getRepository(P17OrderPositionsKk::class)->find($id);
        $em->remove($record);
        $em->flush();
        
        $sql = "select p.*,v.percentage,
		if (p.variation1_id=0,'',(select name from p17_article_variation where id=p.variation1_id)) as variation1,
		if (p.variation2_id=0,'',(select name from p17_article_variation where id=p.variation2_id)) as variation2
		from p17_order_positions_KK p
		left join p17_vat v on v.vat_id=p.vat_id
		where orderID=$orderID";
        $rowsKKOrderPositions = _db_rows($em, $sql);
        
        $return = array();
        $return[] = array(
            'label' => 'success',
            'content' => json_encode('saved')
        );
        $return[] = array(
            'label' => 'rowsKKOrderPositions',
            'content' => json_encode('$rowsKKOrderPositions')
        );
        
        return new JsonResponse($return);
    }
    
}

