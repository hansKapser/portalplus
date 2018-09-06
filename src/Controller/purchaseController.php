<?php
// src/Controller/purchaseController.php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Session\Storage\NativeSessionStorage;
use Symfony\Component\HttpFoundation\Session\Storage\Handler\NativeFileSessionHandler;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\P17Firms;
use App\Entity\P17PurchasePositions;
use App\Entity\P17Purchasebook;
use App\Entity\P17PurchaseMessages;
use App\Entity\P17StockTransaction;
use App\Entity\P17FibuAssets;
use App\Entity\P17StockOthers;
use App\Entity\P17PurchaseRequestPositions;
use App\Entity\P17PurchaseRequest;
use App\Entity\P17Tickets;
use App\Entity\P17PurchaseKk;
use App\Entity\P17PurchaseKkPositions;

class purchaseController extends Controller
{

    /**
     *
     * @Route("/purchaseInit")
     */
    public function purchaseInit()
    {
        include ('./web/classes/_standard.php');
        $array=object_to_array(json_decode($_REQUEST["data"]));
        
        $sessionStorage = new NativeSessionStorage(array(), new NativeFileSessionHandler());
        $session = new Session($sessionStorage);
        $session->start();
        $auth = $session->get('auth');
        // echo $auth;
        
        // $htmlContent = $this->render ( 'de/management.html.twig');
        
        $return = array();
        if (!$array["isHTML"]) {
            $htmlContent = file_get_contents('./templates/de/purchase.html');
            $return[] = array(
            'label' => 'html',
            'content' => json_encode($htmlContent)
        );
        }
        
        return new JsonResponse($return);
    }

    public function purchaseBookInit()
    {
        include ('./web/classes/_standard.php');
        $array=object_to_array(json_decode($_REQUEST["data"]));
        
        $sessionStorage = new NativeSessionStorage(array(), new NativeFileSessionHandler());
        $session = new Session($sessionStorage);
        $session->start();
        $auth = $session->get('auth');
        // echo $auth;
        
        
        // $htmlContent = $this->render ( 'de/management.html.twig');
        
        $return = array();
        if (!$array["isHTML"]) {
            $htmlContent = file_get_contents('./templates/de/purchaseBook.html');
            $return[] = array(
                'label' => 'html',
                'content' => json_encode($htmlContent)
            );
            
        }
        
        return new JsonResponse($return);
    }

    public function purchaseBookListInit()
    {
        include ('./web/classes/_standard.php');
        $array=object_to_array(json_decode($_REQUEST["data"]));
        
        $sessionStorage = new NativeSessionStorage(array(), new NativeFileSessionHandler());
        $session = new Session($sessionStorage);
        $session->start();
        // $auth = $session->get('auth');
        $auth = json_decode($session->get('auth'));
        
        $firmID = $auth->{'firmID'};
        if (!isset($array["year"]))
            $array["year"]=date('Y');
        
        $year=$array["year"];
                
        $em = $this->getDoctrine()->getManager();
        $sql = "select b.*
		from p17_purchasebook b
		where b.firmID=$firmID AND
        left(b.purchaseDate,4)='$year'
		order by b.orderID desc";
        $rowsPurchaseBook = _db_rows($em, $sql);
        
        $sql="select distinct left(purchaseDate,4) as value,
                concat('Schuljahr ',left(purchaseDate,4),'/',left(purchaseDate,4)+1) as label
                from p17_purchasebook where firmID=$firmID
                order by value desc";
        $rowsSchoolYears=_db_rows($em,$sql);
        
        
        $sql = "select * from p17_system_grid
		where
		modul='purchaseBookList'";
        $rowGrid = _db_row($em, $sql);
        
        
        
        $return = array();
        if (!$array["isHTML"]) {
            $htmlContent = file_get_contents('./templates/de/purchaseBookList.html');
            $return[] = array(
                'label' => 'html',
                'content' => json_encode($htmlContent)
            );
            
        }
        
        $return[] = array(
            'label' => 'rowsPurchaseBook',
            'content' => json_encode($rowsPurchaseBook)
        );
        
        $return[] = array(
            'label' => 'rowsSchoolYears',
            'content' => json_encode($rowsSchoolYears)
        );
        
        $return[] = array(
            'label' => 'rowGrid',
            'content' => json_encode($rowGrid)
        );
        
        return new JsonResponse($return);
    }
    

    public function purchaseBookChangeData(Request $request)
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
        
        $sql = "select b.*
		from p17_purchasebook b
		where b.firmID=$firmID AND
        left(b.purchaseDate,4)='$year'
		order by b.orderID desc";
        $rowsPurchaseBook = _db_rows($em, $sql);
        
        $return = array();
        $return[] = array(
            'label' => 'rowsPurchaseBook',
            'content' =>json_encode($rowsPurchaseBook)
        );
        
        return new JsonResponse($return);
        
        
    }
    public function purchaseBookListDelete(Request $request)
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
        $record = $em->getRepository(P17Purchasebook::class)->find($orderID);
        $em->remove($record);
        $em->flush();
        
        $return = array();
        $return[] = array(
            'label' => 'success',
            'content' => json_encode('deleted')
        );
        
        return new JsonResponse($return);
    }
    
    public function purchaseOrderInit(Request $request)
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
		          from p17_tickets t,p17_purchasebook b
                   left join p17_firms f on f.firmID=b.supplier_firmID
		          where b.orderID=$orderID AND
                    t.ticketID=b.ticketID
		          order by b.orderID desc";
        $rowPurchaseOrder = _db_row($em, $sql);
        
        $newVoucherNo=newVoucherNo($em,"p17_purchasebook","purchaseNo",$firmID);
       
        
        if (count($rowPurchaseOrder)==0) {
            $supplier_firmID = -1;
        } else {
            $supplier_firmID = $rowPurchaseOrder["supplier_firmID"];
        }
        
        
        $sql = "select p.*,v.percentage*100 as percentage,
		if (p.variation1_id=0,'',(select name from p17_article_variation where id=p.variation1_id)) as variation1,
		if (p.variation2_id=0,'',(select name from p17_article_variation where id=p.variation2_id)) as variation2
		from p17_purchase_positions p
        left join p17_vat v on v.vat_id=p.vat_id
		where p.orderID=$orderID
		order by p.article_code asc";
        $rowsPurchaseOrderPositions = _db_rows($em, $sql);
        
        $sql = "select a.*,g.id as group_id, g.name as group_name
		from p17_article a,
        p17_article_group g
		where a.firmID=$supplier_firmID AND
		g.id=a.group_id
		order by group_name asc";
        $rowsArticle = _db_rows($em, $sql);
        
        $sql = "select v.* 
                from p17_article_variation v, p17_article_variation_group g
                where
                g.firmID=$supplier_firmID AND
                v.variation_group_id=g.id";
        $rowsVariation = _db_rows($em, $sql);
        
        $sql = "select s.*,
                if (s.variation1_id=0,'',(select name from p17_article_variation where id=s.variation1_id)) as variation1,
		        if (s.variation2_id=0,'',(select name from p17_article_variation where id=s.variation2_id)) as variation2
                from p17_article_variation_spec s, p17_article a
                where
                a.firmID=$supplier_firmID AND
                s.article_id=a.id";
        $rowsVariationSpec = _db_rows($em, $sql);
        
        $sql = "select v.*
                from p17_vat v
                order by vat_id asc";
        $rowsVAT = _db_rows($em, $sql);
        
        
        
        $return = array();
        if (!$array["isHTML"]) {
            $htmlContent = file_get_contents('./templates/de/purchaseOrder.html');
        $return[] = array(
            'label' => 'html',
            'content' => json_encode($htmlContent)
        );
        }
        
        $return[] = array(
            'label' => 'rowPurchaseOrder',
            'content' => json_encode($rowPurchaseOrder)
        );
        
        $return[] = array(
            'label' => 'rowsPurchaseOrderPositions',
            'content' => json_encode($rowsPurchaseOrderPositions)
        );
        $return[] = array(
            'label' => 'rowsArticle',
            'content' => json_encode($rowsArticle)
        );
        $return[] = array(
            'label' => 'rowsVariation',
            'content' => json_encode($rowsVariation)
        );
        $return[] = array(
            'label' => 'rowsVariationSpec',
            'content' => json_encode($rowsVariationSpec)
        );
        $return[] = array(
            'label' => 'rowsVAT',
            'content' => json_encode($rowsVAT)
        );
        $return[] = array(
            'label' => 'newVoucherNo',
            'content' => json_encode($newVoucherNo)
        );
        
        return new JsonResponse($return);
    }

    public function purchaseOrderSave(Request $request)
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
        /*
         * @todo ???
         */
        $array["supplier_ticketID"] = 0;
        $orderID = $array["orderID"];
        
        $em = $this->getDoctrine()->getEntityManager();
        
        if ($orderID==-1) {
            $arrayT["firmID"]=$firmID;
            $arrayT["initiatorUser"]=$auth->{'user'};
            $arrayT["user"]=$auth->{'user'};
            $arrayT["userID"]=$auth->{'userID'};
            $arrayT["teamID"]=$auth->{'teamID'};
            $arrayT["classID"]=$auth->{'classID'};
            $arrayT["division"]='E';
            $arrayT["date"]=date('d.m.Y');
            
            $ticketID = _db_insert($em, "p17_tickets", $arrayT,  $auth);
            $arrayT["ticketID"]=$ticketID;
            $arrayT["purchaseDate"]=date('d.m.Y');
            
            $orderID = _db_insert($em, "p17_purchasebook", $arrayT,  $auth);
            $array["orderID"]=$orderID;
        }
        
        
        
        $sql="select ticketID,supplier_firmID from p17_purchasebook where orderID=$orderID";
        $row=_db_row($em,$sql);
        $array["ticketID"]=$row["ticketID"];
        
        if ($row["supplier_firmID"]<=0) {
            $company=$array["supplier_company"];
            $sql="select firmID from p17_firms where company='$company'";
            $row=_db_row($em,$sql);
            $supplier_firmID=$row["firmID"];
            $array["supplier_firmID"]=$supplier_firmID;
        }
        
        $arrayWhere = array(
                    "orderID" => $array["orderID"]
                );
        _db_update($em, "p17_purchasebook", $array, $arrayWhere, $auth);
        
        $arrayWhere = array(
            "ticketID" => $array["ticketID"]
        );
        $arrayT=array();
        $arrayT["voucherNoInternal"]=$array["purchaseNo"];
        $arrayT["from_company"]=$array["supplier_company"];
        $arrayT["from_firmID"]=$array["supplier_firmID"];
        
        _db_update($em, "p17_tickets", $arrayT, $arrayWhere, $auth);
        
        workflowStatusUpdate($em,$array["ticketID"],"BE");
        
        
        $sql = "select b.*,t.workflowStatus,
                f.street,f.country,f.postcode,f.city,f.email,f.UStID
		          from p17_purchasebook b,p17_firms f,p17_tickets t
		          where b.orderID=$orderID AND
                    f.firmID=b.supplier_firmID AND
                    t.ticketID=b.ticketID
		          order by b.orderID desc";
        $rowPurchaseOrder = _db_row($em, $sql);
        
            
            $return = array();
            $return[] = array(
                'label' => 'success',
                'content' => json_encode('saved')
            );
            $return[] = array(
                'label' => 'rowPurchaseOrder',
                'content' => json_encode($rowPurchaseOrder)
            );
            
            return new JsonResponse($return);
    }
    
    public function purchaseOrderPositionSave(Request $request)
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
        
        if ($orderID==-1) {
            $arrayT["firmID"]=$firmID;
            $arrayT["initiatorUser"]=$auth->{'user'};
            $arrayT["user"]=$auth->{'user'};
            $arrayT["userID"]=$auth->{'userID'};
            $arrayT["teamID"]=$auth->{'teamID'};
            $arrayT["classID"]=$auth->{'classID'};
            $arrayT["division"]='E';
            $arrayT["date"]=date('d.m.Y');
            
            $ticketID = _db_insert($em, "p17_tickets", $arrayT,  $auth);
            $arrayT["ticketID"]=$ticketID;
            $arrayT["purchaseDate"]=date('d.m.Y');
            
            $orderID = _db_insert($em, "p17_purchasebook", $arrayT,  $auth);
            $array["orderID"]=$orderID;
        }
        
        if ($array["id"] == "")
            $array["id"] = - 1;
        
        if ($array["id"] >= 0) {
            $arrayWhere = array(
                "id" => $array["id"]
            );
            _db_update($em, "p17_purchase_positions", $array, $arrayWhere, $auth);
            $id = $array["id"];
        } else {
            unset($array["id"]);
            $id = _db_insert($em, "p17_purchase_positions", $array,  $auth);
        }
        
        $sql = "select p.*,v.percentage*100 as percentage,
		if (p.variation1_id=0,'',(select name from p17_article_variation where id=p.variation1_id)) as variation1,
		if (p.variation2_id=0,'',(select name from p17_article_variation where id=p.variation2_id)) as variation2
		from p17_purchase_positions p
        left join p17_vat v on v.vat_id=p.vat_id
		where p.orderID=$orderID
		order by p.article_code asc";
        $rowsPurchaseOrderPositions = _db_rows($em, $sql);
        
        $return = array();
        $return[] = array(
            'label' => 'success',
            'content' => json_encode('saved')
        );
        $return[] = array(
            'label' => 'rows',
            'content' => json_encode($rowsPurchaseOrderPositions)
        );
        
        return new JsonResponse($return);
    }

    public function purchaseOrderPositionDelete(Request $request)
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
        $record = $em->getRepository(P17PurchasePositions::class)->find($id);
        $em->remove($record);
        $em->flush();
        
        $return = array();
        $return[] = array(
            'label' => 'success',
            'content' => json_encode('deleted')
        );
        
        return new JsonResponse($return);
    }

    public function purchaseOrderStoreInit(Request $request)
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
        $sql = "select p.*,v.percentage*100 as percentage,
		if (p.variation1_id=0,'',(select name from p17_article_variation where id=p.variation1_id)) as variation1,
		if (p.variation2_id=0,'',(select name from p17_article_variation where id=p.variation2_id)) as variation2
		from p17_purchase_positions p
        left join p17_vat v on v.vat_id=p.vat_id
		where p.orderID=$orderID
		order by p.article_code asc";
        $rowsPurchaseOrderPositions = _db_rows($em, $sql);
        /* any store transactions
         * 
         */
        
        for ($i=0;$i<count($rowsPurchaseOrderPositions);$i++) {
            $positionID=$rowsPurchaseOrderPositions[$i]["id"];
            $sql="select transaction,
                    sum(quantity) as quantity
                    from p17_stock_transaction 
                    where positionID=$positionID
                    group by transaction";
            $rows=_db_rows($em,$sql);
            $rowsPurchaseOrderPositions[$i]["stockP"]=0;
            $rowsPurchaseOrderPositions[$i]["stockI"]=0;
            for ($ii=0;$ii<count($rows);$ii++) {
                if ($rows[$ii]["transaction"]=="P") {
                    $rowsPurchaseOrderPositions[$i]["stockP"]=$rows[$ii]["OK"];
                    if ($rowsPurchaseOrderPositions[$i]["quantity"]!=$rows[$ii]["quantity"])
                        // more entries than allowed
                        $rowsPurchaseOrderPositions[$i]["stockP"]=-1;
                }
                    
                if ($rows[$ii]["transaction"]=="I") {
                    $rowsPurchaseOrderPositions[$i]["stockI"]=$rows[$ii]["OK"];
                    if ($rowsPurchaseOrderPositions[$i]["quantity"]!=$rows[$ii]["quantity"])
                        // more entries than allowed
                        $rowsPurchaseOrderPositions[$i]["stockI"]=-1;
                    
                }
                    
            }
        }
        
        for ($i=0;$i<count($rowsPurchaseOrderPositions);$i++) {
            if (!isset($rowsPurchaseOrderPositions[$i]["stockP"])) {
                $positionID=$rowsPurchaseOrderPositions[$i]["id"];
                $sql="select transaction,OK from p17_stock_others where positionID=$positionID";
                $rows=_db_rows($em,$sql);
                $rowsPurchaseOrderPositions[$i]["stockP"]=0;
                $rowsPurchaseOrderPositions[$i]["stockI"]=0;
                for ($ii=0;$ii<count($rows);$ii++) {
                    if ($rowsPurchaseOrderPositions[$i]["quantity"]=$rows[$ii]["quantity"]) {
                        $rowsPurchaseOrderPositions[$i]["stockI"]=1;
                    } else {
                        $rowsPurchaseOrderPositions[$i]["stockI"]=-1;
                    }
                }
            } // endif
        }
        
        for ($i=0;$i<count($rowsPurchaseOrderPositions);$i++) {
            if (!isset($rowsPurchaseOrderPositions[$i]["stockP"])) {
                $positionID=$rowsPurchaseOrderPositions[$i]["id"];
                $sql="select quantity from p17_fibu_assets where positionID=$positionID";
                $rows=_db_rows($em,$sql);
                $rowsPurchaseOrderPositions[$i]["stockP"]=0;
                $rowsPurchaseOrderPositions[$i]["stockI"]=0;
                for ($ii=0;$ii<count($rows);$ii++) {
                    if ($rows[$ii]["quantity"]==$rowsPurchaseOrderPositions[$i]["quantity"]) {
                        $rowsPurchaseOrderPositions[$i]["stockI"]=1;
                    } else {
                        $rowsPurchaseOrderPositions[$i]["stockI"]=-1;
                    }
                }
            } // endif
        }
        
        $sql = "select positionID,transaction,sum(quantity) as quantity
                 from p17_stock_transaction
                 where orderID=$orderID AND division='E'
                 group by positionID,transaction";
        $rowsStockTransactionS = _db_rows($em, $sql);
        
        $sql = "select s.*,p.article_code,p.name,
		if (s.variation1_id=0,'',(select name from p17_article_variation where id=p.variation1_id)) as variation1,
		if (s.variation2_id=0,'',(select name from p17_article_variation where id=p.variation2_id)) as variation2
		from p17_stock_transaction s
        left join p17_purchase_positions p on p.id=s.positionID
		where s.orderID=$orderID AND division='E'";
        
        $rowsStockTransaction = _db_rows($em, $sql);
        
        
// $htmlContent = $this->render ( 'de/management.html.twig');

$return = array();
if (!$array["isHTML"]) {
    $htmlContent = file_get_contents('./templates/de/purchaseOrderStore.html');
    $return[] = array(
    'label' => 'html',
    'content' => json_encode($htmlContent)
);
}

$return[] = array(
    'label' => 'rowsPurchaseOrderPositions',
    'content' => json_encode($rowsPurchaseOrderPositions)
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
    
    public function purchaseOrderStoreDelete(Request $request)
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
                 division='E'
                 group by positionID,transaction";
        $rowsStockTransactionS = _db_rows($em, $sql);
        
        $sql = "select s.*,p.article_code,p.name,
		if (s.variation1_id=0,'',(select name from p17_article_variation where id=p.variation1_id)) as variation1,
		if (s.variation2_id=0,'',(select name from p17_article_variation where id=p.variation2_id)) as variation2
		from p17_stock_transaction s
        left join p17_purchase_positions p on p.id=s.positionID
		where s.orderID=$orderID AND
                 division='E'";
        
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
    

    public function purchaseOrderStoreGetStock(Request $request)
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
        $sql = "select supplier_firmID from p17_purchasebook
                where
                orderID=$orderID";
        $row = _db_row($em, $sql);
        $supplier_firmID = $row["supplier_firmID"];
        
        // lets have a look in p17_article_references
        $sql = "select r.article_id 
            from p17_article_references r
            where
            r.firmID=$firmID AND
            r.supplier_firmID=$supplier_firmID AND
            r.supplier_article_id=$article_id AND
            r.supplier_variation1_id=$variation1_id AND
            r.supplier_variation2_id=$variation2_id";
        $rows = _db_rows($em, $sql);
        
        if (count($rows) > 0) {
            $article_id = $rows[0]["article_id"];
        }
        
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
	           s.variation2_id=$variation2_id AND
               s.division='E' AND
               s.orderID=$orderID
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
    
    public function purchaseOrderStoreSave(Request $request)
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
        $positionID = $array["positionID"];
        $orderID = $array["orderID"];
        $store=$array["storeSelect"];
        unset($array["id"]);
        switch ($store) {
            case "storeAssets":
                $table="p17_fibu_assets";
                break;
            case "storeOthers":
                $table="p17_stock_others";
                break;
            default:
                $table="p17_stock_transaction";
                $array["division"]="E";
                $disponible=comma2dot($array["disponible"]);
                $real=comma2dot($array["real"]);
                $quantity=comma2dot($array["quantity"]);
                $available_quantity=comma2dot($array["available_quantity"]);
                $actual_quantity=comma2dot($array["actual_quantity"]);
                $transaction=$array["transaction"];
                $array["OK"]=0;
                if ($transaction=="I") {
                    if ($disponible+$quantity==$available_quantity AND 
                    $real+$quantity==$actual_quantity) {
                        $array["OK"]=1;
                    } else {
                        $array["OK"]=1;
                    }
                }
                
                if ($transaction=="P") {
                    
                        if ($disponible+$quantity==$available_quantity AND
                        $real==$actual_quantity) {
                            $array["OK"]=1;
                        } else {
                            $array["OK"]=-1;
                        }
                }
                
                break;
        }
        
        $em = $this->getDoctrine()->getEntityManager();
        $ticketID = orderID2ticketID($em, $array["orderID"], "P");
        
        $array["ticketID"]=$row["ticketID"];
        $array["date"]=date('d.m.Y');
        if (isset($array["use_month"]) AND $array["use_month"]=="")
            $array["use_month"]=0;
        
        $id = _db_insert($em, $table, $array,  $auth);
            
        $sql = "select p.*,v.percentage*100 as percentage,
		if (p.variation1_id=0,'',(select name from p17_article_variation where id=p.variation1_id)) as variation1,
		if (p.variation2_id=0,'',(select name from p17_article_variation where id=p.variation2_id)) as variation2
		from p17_purchase_positions p
        left join p17_vat v on v.vat_id=p.vat_id
		where p.orderID=$orderID
		order by p.article_code asc";
        $rowsPurchaseOrderPositions = _db_rows($em, $sql);
        
        for ($i=0;$i<count($rowsPurchaseOrderPositions);$i++) {
            $positionID=$rowsPurchaseOrderPositions[$i]["id"];
            $sql="select transaction,OK from p17_stock_transaction where positionID=$positionID";
            $rows=_db_rows($em,$sql);
            $rowsPurchaseOrderPositions[$i]["stockP"]=0;
            $rowsPurchaseOrderPositions[$i]["stockI"]=0;
            for ($ii=0;$ii<count($rows);$ii++) {
                if ($rows[$ii]["transaction"]=="P")
                    $rowsPurchaseOrderPositions[$i]["stockP"]=$rows[$ii]["OK"];
                    if ($rows[$ii]["transaction"]=="I")
                        $rowsPurchaseOrderPositions[$i]["stockI"]=$rows[$ii]["OK"];
            }
        }
        
        for ($i=0;$i<count($rowsPurchaseOrderPositions);$i++) {
            if (!isset($rowsPurchaseOrderPositions[$i]["stockP"])) {
                $positionID=$rowsPurchaseOrderPositions[$i]["id"];
                $sql="select transaction,OK from p17_stock_others where positionID=$positionID";
                $rows=_db_rows($em,$sql);
                $rowsPurchaseOrderPositions[$i]["stockP"]=0;
                $rowsPurchaseOrderPositions[$i]["stockI"]=0;
                for ($ii=0;$ii<count($rows);$ii++) {
                    if ($rowsPurchaseOrderPositions[$i]["quantity"]=$rows[$ii]["quantity"]) {
                        $rowsPurchaseOrderPositions[$i]["stockI"]=1;
                    } else {
                        $rowsPurchaseOrderPositions[$i]["stockI"]=-1;
                    }
                }
            } // endif
        }
        
        for ($i=0;$i<count($rowsPurchaseOrderPositions);$i++) {
            if (!isset($rowsPurchaseOrderPositions[$i]["stockP"])) {
                $positionID=$rowsPurchaseOrderPositions[$i]["id"];
                $sql="select quantity from p17_fibu_assets where positionID=$positionID";
                $rows=_db_rows($em,$sql);
                $rowsPurchaseOrderPositions[$i]["stockP"]=0;
                $rowsPurchaseOrderPositions[$i]["stockI"]=0;
                for ($ii=0;$ii<count($rows);$ii++) {
                    if ($rows[$ii]["quantity"]==$rowsPurchaseOrderPositions[$i]["quantity"]) {
                        $rowsPurchaseOrderPositions[$i]["stockI"]=1;
                    } else {
                        $rowsPurchaseOrderPositions[$i]["stockI"]=-1;
                    }
                }
            } // endif
        }
        
            
            $return = array();
            $return[] = array(
                'label' => 'success',
                'content' => json_encode('saved')
            );
            $return[] = array(
                'label' => 'rowsPurchaseOrderPositions',
                'content' => json_encode($rowsPurchaseOrderPositions)
            );
            
            return new JsonResponse($return);
    }
    
    public function purchaseOrderIncomingInit(Request $request)
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
        $sql = "select b.*,
                f.street,f.country,f.postcode,f.city,f.email,f.UStID
		          from p17_purchasebook b,p17_firms f
		          where b.orderID=$orderID AND
                    f.firmID=b.supplier_firmID
		          order by b.orderID desc";
        $rowPurchaseOrder = _db_row($em, $sql);
        
        $supplier_firmID = $rowPurchaseOrder["supplier_firmID"];
        /*
        $sql = "select p.*,v.percentage*100 as percentage,
		if (p.variation1_id=0,'',(select name from p17_article_variation where id=p.variation1_id)) as variation1,
		if (p.variation2_id=0,'',(select name from p17_article_variation where id=p.variation2_id)) as variation2
		from p17_purchase_positions p
        left join p17_vat v on v.vat_id=p.vat_id
		where p.orderID=$orderID
		order by p.article_code asc";
        $rowsPurchaseOrderPositions = _db_rows($em, $sql);
        */
        $sql = "select p.*,v.percentage*100 as percentage,
		if (p.variation1_id=0,'',(select name from p17_article_variation where id=p.variation1_id)) as variation1,
		if (p.variation2_id=0,'',(select name from p17_article_variation where id=p.variation2_id)) as variation2
		from p17_purchase_credit c, p17_purchase_credit_positions p
        left join p17_vat v on v.vat_id=p.vat_id
		where 
        c.orderID=$orderID AND
        p.creditID=c.id
		order by p.article_code asc";
        $rowsPurchaseOrderPositionsR = _db_rows($em, $sql);
        
        
        // $htmlContent = $this->render ( 'de/management.html.twig');
        
        $return = array();
        if (!$array["isHTML"]) {
            $htmlContent = file_get_contents('./templates/de/purchaseOrderIncoming.html');
            $return[] = array(
            'label' => 'html',
            'content' => json_encode($htmlContent)
        );
        }
        /*
        $return[] = array(
            'label' => 'rowPurchaseOrder',
            'content' => json_encode($rowPurchaseOrder)
        );
        
        $return[] = array(
            'label' => 'rowsPurchaseOrderPositions',
            'content' => json_encode($rowsPurchaseOrderPositions)
        );
        */
        $return[] = array(
            'label' => 'rowsPurchaseOrderPositionsR',
            'content' => json_encode($rowsPurchaseOrderPositionsR)
        );
        
        return new JsonResponse($return);
    }
    
    public function purchaseOrderIncomingPositionSave(Request $request)
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
                _db_update($em, "p17_purchase_positions", $array, $arrayWhere, $auth);
                $id = $array["id"];
            } else {
                unset($array["id"]);
                $id = _db_insert($em, "p17_purchase_positions", $array,  $auth);
            }
            
            $sql = "select p.*,v.percentage*100 as percentage,
		if (p.variation1_id=0,'',(select name from p17_article_variation where id=p.variation1_id)) as variation1,
		if (p.variation2_id=0,'',(select name from p17_article_variation where id=p.variation2_id)) as variation2
		from p17_purchase_positions p
        left join p17_vat v on v.vat_id=p.vat_id
		where p.orderID=$orderID
		order by p.article_code asc";
            $rowsPurchaseOrderPositions = _db_rows($em, $sql);
            
            $return = array();
            $return[] = array(
                'label' => 'success',
                'content' => json_encode('saved')
            );
            $return[] = array(
                'label' => 'rowsPurchaseOrderPositions',
                'content' => json_encode($rowsPurchaseOrderPositions)
            );
            
            return new JsonResponse($return);
    }
    
    public function purchaseOrderIncomingPositionSaveR(Request $request)
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
        $ticketID = orderID2ticketID($em, $array["orderID"], "P");
        
        
        $sql="select id as creditID from p17_purchase_credit where orderID=$orderID";
        $row=_db_row($em,$sql);
        if (count($row)==0) {
            $arrayC=array();
            $arrayC["orderID"]=$orderID;
            $arrayC["kind"]='P';
            $arrayC["ticketID"]=$ticketID;
            $arrayC["creditDate"]=date('d.m.Y');
            $array["creditID"] = _db_insert($em, "p17_purchase_credit", $arrayC, $auth);
        } else {
            $array["creditID"]=$row["creditID"];
        }
        
        if ($array["id"] == "")
            $array["id"] = - 1;
            
            if ($array["id"] >= 0) {
                $arrayWhere = array(
                    "id" => $array["id"]
                );
                _db_update($em, "p17_purchase_credit_positions", $array, $arrayWhere, $auth);
                $id = $array["id"];
            } else {
                unset($array["id"]);
                $id = _db_insert($em, "p17_purchase_credit_positions", $array,  $auth);
            }
            
            $sql = "select p.*,v.percentage*100 as percentage,
		if (p.variation1_id=0,'',(select name from p17_article_variation where id=p.variation1_id)) as variation1,
		if (p.variation2_id=0,'',(select name from p17_article_variation where id=p.variation2_id)) as variation2
		from p17_purchase_credit c, p17_purchase_credit_positions p
        left join p17_vat v on v.vat_id=p.vat_id
		where
        c.orderID=$orderID AND
        p.creditID=c.id
		order by p.article_code asc";
            $rowsPurchaseOrderPositionsR = _db_rows($em, $sql);
            
            $return = array();
            $return[] = array(
                'label' => 'success',
                'content' => json_encode('saved')
            );
            $return[] = array(
                'label' => 'rowsPurchaseOrderPositionsR',
                'content' => json_encode($rowsPurchaseOrderPositionsR)
            );
            
            return new JsonResponse($return);
    }
    
    public function purchaseOrderInvoiceInit()
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
        
        $sql = "select p.*,v.percentage*100 as percentage,
		if (p.variation1_id=0,'',(select name from p17_article_variation where id=p.variation1_id)) as variation1,
		if (p.variation2_id=0,'',(select name from p17_article_variation where id=p.variation2_id)) as variation2
		from p17_purchase_positions p
        left join p17_vat v on v.vat_id=p.vat_id
		where p.orderID=$orderID
		order by p.article_code asc";
        
        $rowsPurchaseOrderPositions = _db_rows($em, $sql);
        
        for ($i = 0; $i < count($rowsPurchaseOrderPositions); $i ++) {
            if ($rowsPurchaseOrderPositions[$i]["faultIDInvoice"] == 1) {
                $rowsPurchaseOrderPositions[$i]["cb_" . $rowsPurchaseOrderPositions[$i]["id"]] = 1;
            } else {
                $rowsPurchaseOrderPositions[$i]["cb_" . $rowsPurchaseOrderPositions[$i]["id"]] = 0;
            }
        }
        /*
        $sql = "select b.*,
                f.street,f.country,f.postcode,f.city,f.email,f.UStID
		          from p17_purchasebook b,p17_firms f
		          where b.orderID=$orderID AND
                    f.firmID=b.supplier_firmID
		          order by b.orderID desc";
        $rowPurchaseOrder = _db_row($em, $sql);
        */
        // $htmlContent = $this->render ( 'de/management.html.twig');
        
        $return = array();
        if (!$array["isHTML"]) {
            $htmlContent = file_get_contents('./templates/de/purchaseOrderInvoice.html');
            $return[] = array(
            'label' => 'html',
            'content' => json_encode($htmlContent)
        );
        }
        /*
        $return[] = array(
            'label' => 'rowPurchaseOrder',
            'content' => json_encode($rowPurchaseOrder)
        );
        */
        $return[] = array(
            'label' => 'rowsPurchaseOrderPositions',
            'content' => json_encode($rowsPurchaseOrderPositions)
        );
        
        
        return new JsonResponse($return);
    }

    public function purchaseOrderInvoiceSave(Request $request)
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
        
        $sql = "select id from p17_purchase_positions where orderID=$orderID";
        $rows = _db_rows($em, $sql);
        for ($i = 0; $i < count($rows); $i ++) {
            $id = $rows[$i]["id"];
            $arr_temp = array();
            $arr_temp["faultIDInvoice"] = $array["cb_" . $id];
            $arrayWhere = array(
                "id" => $id
            );
            _db_update($em, "p17_purchase_positions", $arr_temp, $arrayWhere, $auth);
            unset($array["cb_" . $id]);
        }
        
        $arrayWhere = array(
            "orderID" => $array["orderID"]
        );
        _db_update($em, "p17_purchasebook", $array, $arrayWhere, $auth);
        
        $return = array();
        $return[] = array(
            'label' => 'success',
            'content' => json_encode('saved')
        );
        
        return new JsonResponse($return);
    }

    public function purchaseOrderBookingInit(Request $request)
    {
        require ('./web/classes/_standard.php');
        $array = object_to_array(json_decode($_REQUEST["data"]));
        
        $sessionStorage = new NativeSessionStorage(array(), new NativeFileSessionHandler());
        $session = new Session($sessionStorage);
        $session->start();
        $auth = json_decode($session->get('auth'));
        $firmID = $auth->{'firmID'};
        
        
        $em = $this->getDoctrine()->getEntityManager();
        $orderID=$array["orderID"];
        $ticketID = orderID2ticketID($em, $array["orderID"], "P");
        
        $sql = "select f.* 
                from p17_fibu_journal f,p17_fibu_journalID j
                where 
                j.ticketID=$ticketID AND
                f.journalID=j.journalID";
        $rowsJournal = _db_rows($em, $sql);
        
        $sql = "select f.*
                from p17_fibu_opliste f
                where
                f.ticketID=$ticketID";
        $rowsOP = _db_rows($em, $sql);
                
        $return = array();
        if (!$array["isHTML"]) {
            $htmlContent = file_get_contents('./templates/de/purchaseOrderBooking.html');
            $htmlContent .= file_get_contents('./templates/de/bookingDialog.html');
            $return[] = array(
            'label' => 'html',
            'content' => json_encode($htmlContent)
        );
        }

        $sql = "select invoiceNo,invoiceNoInternal from p17_purchasebook where orderID=$orderID";
        $row=_db_row($em,$sql);
        $invoiceNo=$row["invoiceNo"];
        $invoiceNoInternal=$row["invoiceNoInternal"];

        $paymentInfo="";
        
        if ($invoiceNo!="") {
            $invoiceNo=substr($invoiceNo,strlen($invoiceNo)-5);
            
        if ($invoiceNoInternal!="") 
                $invoiceNoInternal=substr($invoiceNoInternal,strlen($invoiceNoInternal)-5);
       
        $sql = "select IBAN from p17_firms where firmID=$firmID";
        $row = _db_row($em,$sql);
        $accountNumber = str_replace(" ", "", $row["IBAN"]);
        $accountNumber = substr($accountNumber, strlen($accountNumber) - 8);
        
        $eme = $this->getDoctrine()->getManager("customer");
        
        $sql="select T.*,
                if (senderNumber=$accountNumber,U.username,'') as username,
                (select statementNo from Statement S where S.bankAccount_id=B.id AND 				
                S.dateFrom<= T.date AND S.dateTo>=T.date) as statementNo
			from BankAccount B, Transaction T
            left join User U on U.id=T.creator_id
			where
			T.senderNumber=$accountNumber AND
            T.reason like '%$invoiceNo%' OR 
            T.senderNumber=$accountNumber AND
            T.reason like '%$invoiceNoInternal%'";
        
        $row=_db_row($eme,$sql);
        if (count($row)>0) {
                //var_dump($row);
            $paymentInfo=substr(sql2dddd($row["date"]),0,10)." ".str_replace('.',",",$row["amount"]);
            $paymentInfo.=" KA: ".$row["statementNo"];
        }
        } 
        
        
        $return[] = array(
            'label' => 'rowsJournal',
            'content' => json_encode($rowsJournal)
        );
        
        $return[] = array(
            'label' => 'rowsOP',
            'content' => json_encode($rowsOP)
        );
        $return[] = array(
            'label' => 'rowPaymentInfo',
            'content' => json_encode($paymentInfo)
        );
        
        return new JsonResponse($return);
    }

    public function purchaseOrderMessagesInit(Request $request)
    {
        require ('./web/classes/_standard.php');
        $array = object_to_array(json_decode($_REQUEST["data"]));
        
        $sessionStorage = new NativeSessionStorage(array(), new NativeFileSessionHandler());
        $session = new Session($sessionStorage);
        $session->start();
        $auth = json_decode($session->get('auth'));
        $firmID = $auth->{'firmID'};
        $orderID=$array["orderID"];
        
        $em = $this->getDoctrine()->getEntityManager();
        
        $sql="select * from p17_firms_textmodules
                 where firmID=$firmID order by rank asc";
        $rowsTextmodules=_db_rows($em,$sql);
        
        $sql="select * from p17_purchase_messages where orderID=$orderID order by date desc";
        $rowsMessages=_db_rows($em,$sql);
        
        // $htmlContent = $this->render ( 'de/management.html.twig');
        
        $return = array();
        if (!$array["isHTML"]) {
            $htmlContent = file_get_contents('./templates/de/purchaseOrderMessages.html');
            $return[] = array(
            'label' => 'html',
            'content' => json_encode($htmlContent)
        );
        }
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
    
    public function purchaseOrderMessagesSave(Request $request)
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
        $id=$array["id"];
        $em = $this->getDoctrine()->getEntityManager();
        
        if ($id>=0) {
            $arrayWhere = array("id" => $array["id"]);
            _db_update($em, "p17_purchase_messages", $array, $arrayWhere, $auth);
        } else {
            unset($array["id"]);
            _db_insert($em, "p17_purchase_messages", $array,  $auth);
        }
        
        $sql="select * from p17_purchase_messages where orderID=$orderID order by date desc";
        $rowsMessages=_db_rows($em,$sql);
        
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

    public function purchaseOrderMessagesDelete(Request $request)
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
        
        $sql="select orderID from p17_purchase_messages where id=$id";
        $row=_db_row($em,$sql);
        $orderID = $row["orderID"];
        
        $record = $em->getRepository(P17PurchaseMessages::class)->find($id);
        $em->remove($record);
        $em->flush();
        
        $sql="select * from p17_purchase_messages where orderID=$orderID order by date desc";
        $rowsMessages=_db_rows($em,$sql);
        
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
    
    public function purchaseRequisitionInit()
    {
        $sessionStorage = new NativeSessionStorage(array(), new NativeFileSessionHandler());
        $session = new Session($sessionStorage);
        $session->start();
        $auth = $session->get('auth');
        // echo $auth;
        
        // $htmlContent = $this->render ( 'de/management.html.twig');
        
        $return = array();
        if (!$array["isHTML"]) {
            $htmlContent = file_get_contents('./templates/de/purchaseRequisition.html');
            $return[] = array(
            'label' => 'html',
            'content' => json_encode($htmlContent)
        );
        }
        
        return new JsonResponse($return);
    }
    
    public function purchaseRequisitionListInit()
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
		from p17_purchase_request b
		where b.firmID=$firmID
		order by b.orderID desc";
        $rowsPurchaseRequisition = _db_rows($em, $sql);
        
        $sql="select distinct left(date,4) as value,
                concat('Schuljahr ',left(date,4),'/',left(date,4)+1) as label
                from p17_purchase_request where firmID=$firmID
                order by value desc";
        $rowsSchoolYears=_db_rows($em,$sql);
        
        $sql = "select * from p17_system_grid
		where
		modul='purchaseRequisitionList'";
        $rowGrid = _db_row($em, $sql);
        
        
        $return = array();
        if (!$array["isHTML"]) {
            $htmlContent = file_get_contents('./templates/de/purchaseRequisitionList.html');
            $return[] = array(
            'label' => 'html',
            'content' => json_encode($htmlContent)
        );
        }
        $return[] = array(
            'label' => 'rowsPurchaseRequisition',
            'content' => json_encode($rowsPurchaseRequisition)
        );
        
        $return[] = array(
            'label' => 'rowGrid',
            'content' => json_encode($rowGrid)
        );
        $return[] = array(
            'label' => 'rowsSchoolYears',
            'content' => json_encode($rowsSchoolYears)
        );
        
        return new JsonResponse($return);
    }
    
    public function purchaseRequisitionOrderInit(Request $request)
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
		          from p17_purchase_request b,p17_firms f,p17_tickets t
		          where b.orderID=$orderID AND
                    f.firmID=b.supplier_firmID AND
                    t.ticketID=b.ticketID
		          order by b.orderID desc";
        $rowPurchaseOrder = _db_row($em, $sql);
        if (count($rowPurchaseOrder)==0) {
            $supplier_firmID = -1;
        } else {
            $supplier_firmID = $rowPurchaseOrder["supplier_firmID"];
        }
        
        
        $sql = "select p.*,v.percentage*100 as percentage,
		if (p.variation1_id=0,'',(select name from p17_article_variation where id=p.variation1_id)) as variation1,
		if (p.variation2_id=0,'',(select name from p17_article_variation where id=p.variation2_id)) as variation2
		from p17_purchase_request_positions p
        left join p17_vat v on v.vat_id=p.vat_id
		where p.orderID=$orderID
		order by p.article_code asc";
        $rowsOrderPositions = _db_rows($em, $sql);
        
        $sql = "select a.*,g.id as group_id, g.name as group_name
		from p17_article a,
        p17_article_group g
		where a.firmID=$supplier_firmID AND
		g.id=a.group_id
		order by group_name asc";
        $rowsArticle = _db_rows($em, $sql);
        
        $sql = "select v.*
                from p17_article_variation v, p17_article_variation_group g
                where
                g.firmID=$supplier_firmID AND
                v.variation_group_id=g.id";
        $rowsVariation = _db_rows($em, $sql);
        
        $sql = "select s.*,
                if (s.variation1_id=0,'',(select name from p17_article_variation where id=s.variation1_id)) as variation1,
		        if (s.variation2_id=0,'',(select name from p17_article_variation where id=s.variation2_id)) as variation2
                from p17_article_variation_spec s, p17_article a
                where
                a.firmID=$supplier_firmID AND
                s.article_id=a.id";
        $rowsVariationSpec = _db_rows($em, $sql);
                
        
        $newVoucherNo=newVoucherNo($em,"p17_purchase_request","voucherNo");
        
        $return = array();
        if (!$array["isHTML"]) {
            $htmlContent = file_get_contents('./templates/de/purchaseRequisitionOrder.html');
            $return[] = array(
            'label' => 'html',
            'content' => json_encode($htmlContent)
        );
        }
        $return[] = array(
            'label' => 'rowPurchaseOrder',
            'content' => json_encode($rowPurchaseOrder)
        );
        
        $return[] = array(
            'label' => 'rowsOrderPositions',
            'content' => json_encode($rowsOrderPositions)
        );
        $return[] = array(
            'label' => 'rowsArticle',
            'content' => json_encode($rowsArticle)
        );
        $return[] = array(
            'label' => 'rowsVariation',
            'content' => json_encode($rowsVariation)
        );
        $return[] = array(
            'label' => 'rowsVariationSpec',
            'content' => json_encode($rowsVariationSpec)
        );
        $return[] = array(
            'label' => 'newVoucherNo',
            'content' => json_encode($newVoucherNo)
        );
        
        return new JsonResponse($return);
    }

    public function purchaseRequisitionOrderSave(Request $request)
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
        /*
         * @todo ???
         */
        $array["supplier_ticketID"] = 0;
        $orderID = $array["orderID"];
        
        $em = $this->getDoctrine()->getEntityManager();
        
        if ($orderID==-1) {
            $arrayT["firmID"]=$firmID;
            $arrayT["initiatorUser"]=$auth->{'user'};
            $arrayT["user"]=$auth->{'user'};
            $arrayT["userID"]=$array["userID"]; // destination user
            $arrayT["division"]='E';
            $arrayT["date"]=date('d.m.Y');
            
            $ticketID = _db_insert($em, "p17_tickets", $arrayT,  $auth);
            $arrayT["ticketID"]=$ticketID;
            $arrayT["date"]=date('d.m.Y');
            
            $orderID = _db_insert($em, "p17_purchase_request", $arrayT,  $auth);
            $array["orderID"]=$orderID;
        }
        
        
        
        $sql="select ticketID,supplier_firmID from p17_purchase_request where orderID=$orderID";
        $row=_db_row($em,$sql);
        $array["ticketID"]=$row["ticketID"];
        
        if ($row["supplier_firmID"]==0) {
            $company=$array["supplier_company"];
            $sql="select firmID from p17_firms where company='$company'";
            $row=_db_row($em,$sql);
            if (!isset($row["firmID"])) {
            $supplier_firmID=0;   
            } else {
            $supplier_firmID=$row["firmID"];
            }
            $array["supplier_firmID"]=$supplier_firmID;
        }
        
        $arrayWhere = array(
            "orderID" => $array["orderID"]
        );
        _db_update($em, "p17_purchase_request", $array, $arrayWhere,$auth);
        
        $arrayWhere = array(
            "ticketID" => $array["ticketID"]
        );
        $arrayT=array();
        $arrayT["voucherNoInternal"]=$array["voucherNo"];
        $arrayT["from_company"]=$array["supplier_company"];
        $arrayT["from_firmID"]=$array["supplier_firmID"];
        $arrayT["userID"]=$array["userID"];
        
        _db_update($em, "p17_tickets", $arrayT, $arrayWhere, $auth);
        
        workflowStatusUpdate($em,$array["ticketID"],"BM");
        
        
        $sql = "select b.*,t.workflowStatus,
                f.street,f.country,f.postcode,f.city,f.email,f.UStID
		          from p17_purchase_request b,p17_firms f,p17_tickets t
		          where b.orderID=$orderID AND
                    f.firmID=b.supplier_firmID AND
                    t.ticketID=b.ticketID
		          order by b.orderID desc";
        $rowPurchaseOrder = _db_row($em, $sql);
        
        
        $return = array();
        $return[] = array(
            'label' => 'success',
            'content' => json_encode('saved')
        );
        $return[] = array(
            'label' => 'rowPurchaseOrder',
            'content' => json_encode($rowPurchaseOrder)
        );
        
        return new JsonResponse($return);
    }
    public function purchaseRequisitionDelete(Request $request)
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
        $sql="select ticketID from p17_purchase_request where orderID=$orderID";
        $row=_db_row($em,$sql);
        $ticketID=$row["ticketID"];
        
        
        $record = $em->getRepository(P17PurchaseRequest::class)->find($orderID);
        $em->remove($record);
        $em->flush();
        
        $sql="select orderID from p17_purchasebook where ticketID=$ticketID";
        $rows=_db_rows($em,$sql);
        
        if (count($rows)==0) {
            //  no purchase order
            // in this case we can also remove the ticket
            $record = $em->getRepository(P17Tickets::class)->find($ticketID);
            $em->remove($record);
            $em->flush();
        }
        
        $return = array();
        $return[] = array(
            'label' => 'success',
            'content' => json_encode('deleted')
        );
        
        return new JsonResponse($return);
    }
    
    public function purchaseRequisitionOrderPositionSave(Request $request)
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
        
        if ($orderID==-1) {
            $arrayT["firmID"]=$firmID;
            $arrayT["initiatorUser"]=$auth->{'user'};
            $arrayT["user"]=$auth->{'user'};
            $arrayT["userID"]=$auth->{'userID'};
            $arrayT["teamID"]=$auth->{'teamID'};
            $arrayT["classID"]=$auth->{'classID'};
            $arrayT["division"]='E';
            $arrayT["date"]=date('d.m.Y');
            
            $ticketID = _db_insert($em, "p17_tickets", $arrayT,  $auth);
            $arrayT["ticketID"]=$ticketID;
            $arrayT["date"]=date('d.m.Y');
            
            $orderID = _db_insert($em, "p17_purchase_request", $arrayT,  $auth);
            $array["orderID"]=$orderID;
        }
        
        if ($array["id"] == "")
            $array["id"] = - 1;
            
            if ($array["id"] >= 0) {
                $arrayWhere = array(
                    "id" => $array["id"]
                );
                _db_update($em, "p17_purchase_request_positions", $array, $arrayWhere, $auth);
                $id = $array["id"];
            } else {
                unset($array["id"]);
                $id = _db_insert($em, "p17_purchase_request_positions", $array,  $auth);
            }
            
            $sql = "select p.*,v.percentage*100 as percentage,
		if (p.variation1_id=0,'',(select name from p17_article_variation where id=p.variation1_id)) as variation1,
		if (p.variation2_id=0,'',(select name from p17_article_variation where id=p.variation2_id)) as variation2
		from p17_purchase_request_positions p
        left join p17_vat v on v.vat_id=p.vat_id
		where p.orderID=$orderID
		order by p.article_code asc";
            $rowsOrderPositions = _db_rows($em, $sql);
            
            $return = array();
            $return[] = array(
                'label' => 'success',
                'content' => json_encode('saved')
            );
            $return[] = array(
                'label' => 'rowsOrderPositions',
                'content' => json_encode($rowsOrderPositions)
            );
            
            return new JsonResponse($return);
    }
    
    public function PurchaseRequisitionOrderPositionDelete(Request $request)
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
        
        $sql="select orderID from p17_purchase_request_positions
                where id=$id";
        $row=_db_row($em,$sql);
        $orderID=$row["orderID"];
        
        $record = $em->getRepository(P17PurchaseRequestPositions::class)->find($id);
        $em->remove($record);
        $em->flush();
        
        $sql = "select p.*,v.percentage*100 as percentage,
		if (p.variation1_id=0,'',(select name from p17_article_variation where id=p.variation1_id)) as variation1,
		if (p.variation2_id=0,'',(select name from p17_article_variation where id=p.variation2_id)) as variation2
		from p17_purchase_request_positions p
        left join p17_vat v on v.vat_id=p.vat_id
		where p.orderID=$orderID
		order by p.article_code asc";
        $rowsOrderPositions = _db_rows($em, $sql);
        
        $return = array();
        $return[] = array(
            'label' => 'success',
            'content' => json_encode('deleted')
        );
        $return[] = array(
            'label' => 'rowsOrderPositions',
            'content' => json_encode($rowsOrderPositions)
        );
        
        return new JsonResponse($return);
    }
    
    public function purchaseSourceSupplyInit()
    {
        $sessionStorage = new NativeSessionStorage(array(), new NativeFileSessionHandler());
        $session = new Session($sessionStorage);
        $session->start();
        $auth = $session->get('auth');
        // echo $auth;
        
        // $htmlContent = $this->render ( 'de/management.html.twig');
        
        $return = array();
        if (!$array["isHTML"]) {
            $htmlContent = file_get_contents('./templates/de/purchaseSourceSupply.html');
            $return[] = array(
            'label' => 'html',
            'content' => json_encode($htmlContent)
        );
        }
        return new JsonResponse($return);
    }
    
    public function purchaseEnquiryInit()
    {
        $sessionStorage = new NativeSessionStorage(array(), new NativeFileSessionHandler());
        $session = new Session($sessionStorage);
        $session->start();
        $auth = $session->get('auth');
        // echo $auth;
        
        // $htmlContent = $this->render ( 'de/management.html.twig');
        
        $return = array();
        if (!$array["isHTML"]) {
            $htmlContent = file_get_contents('./templates/de/purchaseEnquiry.html');
            $return[] = array(
            'label' => 'html',
            'content' => json_encode($htmlContent)
        );
        }
        
        return new JsonResponse($return);
    }
    
    public function purchaseEnquiryListInit()
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
		from p17_purchase_enquiry b
		where b.firmID=$firmID
		order by b.orderID desc";
        $rowsPurchaseEnquiry = _db_rows($em, $sql);
        
        $sql = "select * from p17_system_grid
		where
		modul='purchaseEnquiryList'";
        $rowGrid = _db_row($em, $sql);
        
        
        $return = array();
        if (!$array["isHTML"]) {
            $htmlContent = file_get_contents('./templates/de/purchaseEnquiryList.html');
            $return[] = array(
            'label' => 'html',
            'content' => json_encode($htmlContent)
        );
        }
        $return[] = array(
            'label' => 'rowsPurchaseEnquiry',
            'content' => json_encode($rowsPurchaseEnquiry)
        );
        
        $return[] = array(
            'label' => 'rowGrid',
            'content' => json_encode($rowGrid)
        );
        
        return new JsonResponse($return);
    }
    
    public function purchaseGetArticles(Request $request)
    {
        include ('./web/classes/_standard.php');
        $array = object_to_array(json_decode($_REQUEST["data"]));
        
        $sessionStorage = new NativeSessionStorage(array(), new NativeFileSessionHandler());
        $session = new Session($sessionStorage);
        $session->start();
        // $auth = $session->get('auth');
        $auth = json_decode($session->get('auth'));
        $success="";
        
        $firmID = $auth->{'firmID'};
        
        $em = $this->getDoctrine()->getManager();
        
        
        if (!isset($array["supplier_firmID"])) {
        $supplier_company = $array["supplier_company"];
        
        
        $sql="select firmID as supplier_firmID 
                from p17_firms
                where
                company='$supplier_company'";
        $row=_db_row($em,$sql);
        
        
        if (count($row)==0) {
            $success="Lieferant nicht gefunden!";
            $supplier_firmID=-1;
        } else {
            $success="";
            $supplier_firmID=$row["supplier_firmID"];
        }
        } else {
            $supplier_firmID=$array["supplier_firmID"];
        }
        
        if (isHAWALI($em,$supplier_firmID)>=0)
           $supplier_firmID=$firmID;
        
        $sql = "select a.*,g.id as group_id, g.name as group_name
		from p17_article a,
        p17_article_group g
		where a.firmID=$supplier_firmID AND
		g.id=a.group_id
		order by group_name asc";
        $rowsArticle = _db_rows($em, $sql);

        $sql = "select f.firmID,f.company,
                g.id as group_id, g.name as group_name
        from p17_article_group g, p17_firms f
		where g.firmID=$supplier_firmID AND
        f.firmID=$supplier_firmID
		order by group_name asc";
        $rowsArticleGroups = _db_rows($em, $sql);
        
        $sql = "select v.*
                from p17_article_variation v, p17_article_variation_group g
                where
                g.firmID=$supplier_firmID AND
                v.variation_group_id=g.id";
        $rowsVariation = _db_rows($em, $sql);
        
        $sql = "select s.*,
                if (s.variation1_id=0,'',(select name from p17_article_variation where id=s.variation1_id)) as variation1,
		        if (s.variation2_id=0,'',(select name from p17_article_variation where id=s.variation2_id)) as variation2
                from p17_article_variation_spec s, p17_article a
                where
                a.firmID=$supplier_firmID AND
                s.article_id=a.id";
        $rowsVariationSpec = _db_rows($em, $sql);
        
        $return = array();
        $return[] = array(
            'label' => 'success',
            'content' => json_encode($success)
        );
        
        $return[] = array(
            'label' => 'rowsArticleGroups',
            'content' => json_encode($rowsArticleGroups)
        );
        
        $return[] = array(
            'label' => 'rowsArticle',
            'content' => json_encode($rowsArticle)
        );
        $return[] = array(
            'label' => 'rowsVariation',
            'content' => json_encode($rowsVariation)
        );
        $return[] = array(
            'label' => 'rowsVariationSpec',
            'content' => json_encode($rowsVariationSpec)
        );
        
        return new JsonResponse($return);
    }
    
    
    public function purchaseSourceSupplySearch(Request $request)
    {
        include ('./web/classes/_standard.php');
        $array = object_to_array(json_decode($_REQUEST["data"]));
        
        $sessionStorage = new NativeSessionStorage(array(), new NativeFileSessionHandler());
        $session = new Session($sessionStorage);
        $session->start();
        // $auth = $session->get('auth');
        $auth = json_decode($session->get('auth'));
        
        $firmID = $auth->{'firmID'};
        $searchString = $array["searchString"];
        $arrayFirms=array();
        $priority=1;
        
        $em = $this->getDoctrine()->getManager();
        $sql="select f.firmID,f.company,f.company2,f.street,f.country,f.postcode,f.city,
                if (c.id is null,0,1) as isCatalogue,
                $priority as priority
                from p17_firms f
                left join p17_firms_files c on c.firmID=f.firmID AND c.kind='catalogue'
                where
                f.company like '%$searchString%' OR
                f.company2 like '%$searchString%'";
        $rows=_db_rows($em,$sql);
        $found=false;
        
        $arrayFirms = array_unique (array_merge ($arrayFirms, $rows),SORT_REGULAR);
                
        $priority++;
        $sql="select f.firmID,f.company,f.company2,f.street,f.country,f.postcode,f.city,
                if (c.id is null,0,1) as isCatalogue,
                $priority as priority
                from p17_firms_products p, p17_firms f
                left join p17_firms_files c on c.firmID=f.firmID AND c.kind='catalogue'
                where
                p.name like '%$searchString%' AND
                f.firmID=p.firmID";
        
         $rows=_db_rows($em,$sql);
         $arrayFirms = array_unique (array_merge ($arrayFirms, $rows),SORT_REGULAR);
         
            $priority++;
            $sql="select f.firmID,f.company,f.company2,
                f.street,f.country,f.postcode,f.city,
                if (c.id is null,0,1) as isCatalogue,
                $priority as priority
                from p17_article a, p17_firms f
                left join p17_firms_files c on c.firmID=f.firmID AND c.kind='catalogue'
                where
                a.name like '%$searchString%' AND
                f.firmID=a.firmID";
         
         $rows=_db_rows($em,$sql);
         $arrayFirms = array_unique (array_merge ($arrayFirms, $rows),SORT_REGULAR);
        
         $arrayF=array();
         $z=-1;
         for ($i=0;$i<count($arrayFirms);$i++) {
             if (isset($arrayFirms[$i])) {
             ++$z;
                 $arrayF[$z]=$arrayFirms[$i];
             
             $supplier_firmID=$arrayF[$z]["firmID"];
             $sql="select name
                    from p17_firms_products
                    where
                    firmID=$supplier_firmID
                    order by name asc";
             $arrayF[$z]["offer"]=_db_rows($em,$sql);
             }
         }
         
        $return = array();
        
        $return[] = array(
            'label' => 'rowsSourceFirms',
            'content' => json_encode($arrayF)
        );
        
        return new JsonResponse($return);
    }
    
    public function purchaseKKInit()
    {
        $sessionStorage = new NativeSessionStorage(array(), new NativeFileSessionHandler());
        $session = new Session($sessionStorage);
        $session->start();
        $auth = $session->get('auth');
        // echo $auth;
        
        // $htmlContent = $this->render ( 'de/management.html.twig');
        
        $return = array();
        if (!$array["isHTML"]) {
            $htmlContent = file_get_contents('./templates/de/purchaseKK.html');
            $return[] = array(
            'label' => 'html',
            'content' => json_encode($htmlContent)
        );
        }
        return new JsonResponse($return);
    }
    
    public function purchaseKKListInit()
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
		from p17_purchase_KK b
		where b.firmID=$firmID
		order by b.orderID desc";
        $rowsPurchaseKK = _db_rows($em, $sql);
        
        $sql="select distinct left(date,4) as value,
                concat('Schuljahr ',left(date,4),'/',left(date,4)+1) as label
                from p17_purchase_KK where firmID=$firmID
                order by value desc";
        $rowsSchoolYears=_db_rows($em,$sql);
        
        $sql = "select * from p17_system_grid
		where
		modul='purchaseKKList'";
        $rowGrid = _db_row($em, $sql);
        
        
        $return = array();
        if (!$array["isHTML"]) {
            $htmlContent = file_get_contents('./templates/de/purchaseKKList.html');
            $return[] = array(
            'label' => 'html',
            'content' => json_encode($htmlContent)
        );
        }
        
        $return[] = array(
            'label' => 'rowsPurchaseKK',
            'content' => json_encode($rowsPurchaseKK)
        );
        
        $return[] = array(
            'label' => 'rowGrid',
            'content' => json_encode($rowGrid)
        );
        $return[] = array(
            'label' => 'rowsSchoolYears',
            'content' => json_encode($rowsSchoolYears)
        );
        
        return new JsonResponse($return);
    }
    
    public function purchaseKKOrderInit(Request $request)
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
		          from p17_purchase_KK b,p17_firms f,p17_tickets t
		          where b.orderID=$orderID AND
                    f.firmID=b.supplier_firmID AND
                    t.ticketID=b.ticketID
		          order by b.orderID desc";
        $rowPurchaseOrder = _db_row($em, $sql);
        if (count($rowPurchaseOrder)==0) {
            $supplier_firmID = $firmID;
        } else {
            $supplier_firmID = $rowPurchaseOrder["supplier_firmID"];
        }
        
        
        $sql = "select p.*,v.percentage*100 as percentage,
		if (p.variation1_id=0,'',(select name from p17_article_variation where id=p.variation1_id)) as variation1,
		if (p.variation2_id=0,'',(select name from p17_article_variation where id=p.variation2_id)) as variation2
		from p17_purchase_KK_positions p
        left join p17_vat v on v.vat_id=p.vat_id
		where p.orderID=$orderID
		order by p.article_code asc";
        $rowsOrderPositions = _db_rows($em, $sql);
        
        $sql = "select a.*,g.id as group_id, g.name as group_name
		from p17_article a,
        p17_article_group g
		where a.firmID=$supplier_firmID AND
		g.id=a.group_id
		order by group_name asc";
        $rowsArticle = _db_rows($em, $sql);
        
        $sql = "select v.*
                from p17_article_variation v, p17_article_variation_group g
                where
                g.firmID=$supplier_firmID AND
                v.variation_group_id=g.id";
        $rowsVariation = _db_rows($em, $sql);
        
        $sql = "select s.*,
                if (s.variation1_id=0,'',(select name from p17_article_variation where id=s.variation1_id)) as variation1,
		        if (s.variation2_id=0,'',(select name from p17_article_variation where id=s.variation2_id)) as variation2
                from p17_article_variation_spec s, p17_article a
                where
                a.firmID=$supplier_firmID AND
                s.article_id=a.id";
        $rowsVariationSpec = _db_rows($em, $sql);
        
        $newVoucherNo=newVoucherNo($em,"p17_purchase_KK","voucherNo");    
        
        
        
        $return = array();
        if (!$array["isHTML"]) {
            $htmlContent = file_get_contents('./templates/de/purchaseKKOrder.html');
            $return[] = array(
            'label' => 'html',
            'content' => json_encode($htmlContent)
        );
        }
        $return[] = array(
            'label' => 'rowPurchaseOrder',
            'content' => json_encode($rowPurchaseOrder)
        );
        
        $return[] = array(
            'label' => 'rowsOrderPositions',
            'content' => json_encode($rowsOrderPositions)
        );
        $return[] = array(
            'label' => 'rowsArticle',
            'content' => json_encode($rowsArticle)
        );
        $return[] = array(
            'label' => 'rowsVariation',
            'content' => json_encode($rowsVariation)
        );
        $return[] = array(
            'label' => 'rowsVariationSpec',
            'content' => json_encode($rowsVariationSpec)
        );
        $return[] = array(
            'label' => 'newVoucherNo',
            'content' => json_encode($newVoucherNo)
        );
        
        return new JsonResponse($return);
    }
    
    public function purchaseKKOrderSave(Request $request)
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
        /*
         * @todo ???
         */
        $array["supplier_ticketID"] = 0;
        $orderID = $array["orderID"];
        
        $em = $this->getDoctrine()->getEntityManager();
        
        if ($orderID==-1) {
            $arrayT["firmID"]=$firmID;
            $arrayT["initiatorUser"]=$auth->{'user'};
            $arrayT["user"]=$auth->{'user'};
            $arrayT["userID"]=$array["userID"]; // destination user
            $arrayT["division"]='E';
            $arrayT["date"]=date('d.m.Y');
            
            $ticketID = _db_insert($em, "p17_tickets", $arrayT, $auth);
            $arrayT["ticketID"]=$ticketID;
            $arrayT["date"]=date('d.m.Y');
            
            $orderID = _db_insert($em, "p17_purchase_request", $arrayT, $auth);
            $array["orderID"]=$orderID;
        }
        
        
        
        $sql="select ticketID,supplier_firmID from p17_purchase_KK where orderID=$orderID";
        $row=_db_row($em,$sql);
        $array["ticketID"]=$row["ticketID"];
        
        if ($row["supplier_firmID"]==0) {
            $company=$array["supplier_company"];
            $sql="select firmID from p17_firms where company='$company'";
            $row=_db_row($em,$sql);
            if (!isset($row["firmID"])) {
                $supplier_firmID=0;
            } else {
                $supplier_firmID=$row["firmID"];
            }
            $array["supplier_firmID"]=$supplier_firmID;
        }
        
        $arrayWhere = array(
            "orderID" => $array["orderID"]
        );
        _db_update($em, "p17_purchase_request", $array, $arrayWhere, $auth);
        
        $arrayWhere = array(
            "ticketID" => $array["ticketID"]
        );
        $arrayT=array();
        $arrayT["voucherNoInternal"]=$array["voucherNo"];
        $arrayT["from_company"]=$array["supplier_company"];
        $arrayT["from_firmID"]=$array["supplier_firmID"];
        $arrayT["userID"]=$array["userID"];
        
        _db_update($em, "p17_tickets", $arrayT, $arrayWhere, $auth);
        
        workflowStatusUpdate($em,$array["ticketID"],"BM");
        
        
        $sql = "select b.*,t.workflowStatus,
                f.street,f.country,f.postcode,f.city,f.email,f.UStID
		          from p17_purchase_KK b,p17_firms f,p17_tickets t
		          where b.orderID=$orderID AND
                    f.firmID=b.supplier_firmID AND
                    t.ticketID=b.ticketID
		          order by b.orderID desc";
        $rowPurchaseOrder = _db_row($em, $sql);
        
        
        $return = array();
        $return[] = array(
            'label' => 'success',
            'content' => json_encode('saved')
        );
        $return[] = array(
            'label' => 'rowPurchaseOrder',
            'content' => json_encode($rowPurchaseOrder)
        );
        
        return new JsonResponse($return);
    }
    public function purchaseKKDelete(Request $request)
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
        $sql="select ticketID from p17_purchase_KK where orderID=$orderID";
        $row=_db_row($em,$sql);
        $ticketID=$row["ticketID"];
        
        
        $record = $em->getRepository(P17PurchaseKk::class)->find($orderID);
        $em->remove($record);
        $em->flush();
        
        $sql="select orderID from p17_orderbook where ticketID=$ticketID";
        $rows=_db_rows($em,$sql);
        
        if (count($rows)==0) {
            //  no purchase order
            // in this case we can also remove the ticket
            $record = $em->getRepository(P17Tickets::class)->find($ticketID);
            $em->remove($record);
            $em->flush();
        }
        
        $return = array();
        $return[] = array(
            'label' => 'success',
            'content' => json_encode('deleted')
        );
        
        return new JsonResponse($return);
    }
    
    public function purchaseKKOrderPositionSave(Request $request)
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
        
        if ($orderID==-1) {
            $arrayT["firmID"]=$firmID;
            $arrayT["initiatorUser"]=$auth->{'user'};
            $arrayT["user"]=$auth->{'user'};
            $arrayT["userID"]=$auth->{'userID'};
            $arrayT["teamID"]=$auth->{'teamID'};
            $arrayT["classID"]=$auth->{'classID'};
            $arrayT["division"]='E';
            $arrayT["date"]=date('d.m.Y');
            
            $ticketID = _db_insert($em, "p17_tickets", $arrayT,  $auth);
            $arrayT["ticketID"]=$ticketID;
            $arrayT["date"]=date('d.m.Y');
            
            $orderID = _db_insert($em, "p17_purchase_request", $arrayT,  $auth);
            $array["orderID"]=$orderID;
        }
        
        if ($array["id"] == "")
            $array["id"] = - 1;
            
            if ($array["id"] >= 0) {
                $arrayWhere = array(
                    "id" => $array["id"]
                );
                _db_update($em, "p17_purchase_KK_positions", $array, $arrayWhere, $auth);
                $id = $array["id"];
            } else {
                unset($array["id"]);
                $id = _db_insert($em, "p17_purchase_KK_positions", $array,  $auth);
            }
            
            $sql = "select p.*,v.percentage*100 as percentage,
		if (p.variation1_id=0,'',(select name from p17_article_variation where id=p.variation1_id)) as variation1,
		if (p.variation2_id=0,'',(select name from p17_article_variation where id=p.variation2_id)) as variation2
		from p17_purchase_KK_positions p
        left join p17_vat v on v.vat_id=p.vat_id
		where p.orderID=$orderID
		order by p.article_code asc";
            $rowsOrderPositions = _db_rows($em, $sql);
            
            $return = array();
            $return[] = array(
                'label' => 'success',
                'content' => json_encode('saved')
            );
            $return[] = array(
                'label' => 'rowsOrderPositions',
                'content' => json_encode($rowsOrderPositions)
            );
            
            return new JsonResponse($return);
    }
    
    public function PurchaseKKOrderPositionDelete(Request $request)
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
        
        $sql="select orderID from p17_purchase_KK_positions
                where id=$id";
        $row=_db_row($em,$sql);
        $orderID=$row["orderID"];
        
        $record = $em->getRepository(P17PurchaseKkPositions::class)->find($id);
        $em->remove($record);
        $em->flush();
        
        $sql = "select p.*,v.percentage*100 as percentage,
		if (p.variation1_id=0,'',(select name from p17_article_variation where id=p.variation1_id)) as variation1,
		if (p.variation2_id=0,'',(select name from p17_article_variation where id=p.variation2_id)) as variation2
		from p17_purchase_KK_positions p
        left join p17_vat v on v.vat_id=p.vat_id
		where p.orderID=$orderID
		order by p.article_code asc";
        $rowsOrderPositions = _db_rows($em, $sql);
        
        $return = array();
        $return[] = array(
            'label' => 'success',
            'content' => json_encode('deleted')
        );
        $return[] = array(
            'label' => 'rowsOrderPositions',
            'content' => json_encode($rowsOrderPositions)
        );
        
        return new JsonResponse($return);
    }
    
}

