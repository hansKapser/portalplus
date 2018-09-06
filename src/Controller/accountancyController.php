<?php
// src/Controller/purchaseController.php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Session\Storage\NativeSessionStorage;
use Symfony\Component\HttpFoundation\Session\Storage\Handler\NativeFileSessionHandler;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use App\Entity\P17Firms;
use App\Entity\P17FirmsNumbers;
use App\Entity\P17FibuJournalid;
use App\Entity\P17FibuJournal;
use App\Entity\P17FibuHauptbuch;
use App\Entity\P17FibuOpliste;
use App\Entity\P17FibuAssets;

class accountancyController extends Controller
{

    /**
     *
     * @Route("/accountancyInit")
     */
    public function accountancyInit()
    {
        $sessionStorage = new NativeSessionStorage(array(), new NativeFileSessionHandler());
        $session = new Session($sessionStorage);
        $session->start();
        $auth = $session->get('auth');
        
        
        $htmlContent = file_get_contents('./templates/de/accountancy.html');
        
        
        $return = array();
        $return[] = array(
            'label' => 'html',
            'content' => json_encode($htmlContent)
        );
        
        return new JsonResponse($return);
    }

    public function dialogBookingSave(Request $request)
    {
        require ('./web/classes/_standard.php');
        $array = object_to_array(json_decode($_REQUEST["data"]));
        
        $sessionStorage = new NativeSessionStorage(array(), new NativeFileSessionHandler());
        $session = new Session($sessionStorage);
        $session->start();
        $auth = json_decode($session->get('auth'));
        
        $firmID = $auth->{'firmID'};
        $mandantID = $firmID;
        $user = $auth->{'user'};
        $array["user"] = $user;
        $array["mandantID"] = $firmID;
        $orderID = $array["orderID"];
        $arrayOP = array();
        
        if ($array["BA"] == "KF" or $array["BA"] == "KZ") {
            $book = "P";
        } else {
            $book = "O";
        }
        
        $em = $this->getDoctrine()->getEntityManager();
        $ticketID = orderID2ticketID($em, $orderID, $book);
        
        if ($array["ID"] == "")
            $array["ID"] = - 1;
        $arrayID = explode(",", $array["ID"]);
        unset($array["ID"]);
        $pi = - 1;
        $pID = $arrayID[++ $pi];
        /*
         * if ($array["ID"]>=0) {
         * $arrayWhere=array("ID" => $array["ID"]);
         * _db_update($em,"p17_fibu_journal", $array, $arrayWhere, $auth);
         * $ID=$array["ID"];
         * } else {
         */
        if ($pID == - 1) {
            $arrayJ = array();
            $arrayJ["mandantID"] = $mandantID;
            $arrayJ["ticketID"] = $ticketID;
            $journalID = _db_insert($em, "p17_fibu_journalID", $arrayJ, $auth);
            $array["journalID"] = $journalID;
        } else {
            $sql = "select journalID
                    from p17_fibu_journal
                    where
                    ID=$pID";
            $row = _db_row($em, $sql);
            $journalID = $row["journalID"];
            $array["journalID"] = $journalID;
        }
        
        $array["ba"] = $array["BA"];
        
        switch ($array["BA"]) {
            case "KF":
                // 1st opliste
                $arrayOP["mandantID"] = $mandantID;
                $arrayOP["ticketID"] = $ticketID;
                $arrayOP["journalID"] = $journalID;
                $arrayOP["ba"] = $array["ba"];
                $arrayOP["betrag"] = $array["betrag"];
                $arrayOP["op_nummer"] = $array["beleg"];
                $arrayOP["datum"] = $array["datum"];
                $arrayOP["kontonummer"] = $array["haben"];
                $sql = "select t.* 
                                from p17_purchasebook p, p17_terms_of_payment t
                                where
                                p.orderID=$orderID AND
                                t.id=p.termPayment";
                $rowTerms = _db_row($em, $sql);
                
                $arrayOP["faellig"] = dateAdd($array["datum"], $rowTerms["net_days"]);
                $arrayOP["skontotage"] = $rowTerms["discount_days"];
                $arrayOP["skontoprozent"] = $rowTerms["discount"] / 100;
                $arrayOP["nettotage"] = $rowTerms["net_days"];
                if ($pID == - 1) {
                    // new
                    _db_insert($em, "p17_fibu_opliste", $arrayOP,  $auth);
                } else {
                    // update
                    $arrayWhere = array(
                        "journalID" => $journalID
                    );
                    _db_update($em, "p17_fibu_opliste", $array, $arrayWhere, $auth);
                }
                
                $countLines = 0;
                for ($i = 0; $i < 3; $i ++) {
                    if ($array["soll" . $i] != "") {
                        $countLines ++;
                        $array["soll"] = $array["soll" . $i];
                        $array["steuerzeile"] = $array["vat_id" . $i];
                        $array["BN"] = $array["BN" . $i];
                        if ($array["text" . $i] != "")
                            $array["text"] = $array["text" . $i];
                        $array["betrag"] = $array["betrag" . $i];
                        if ($pID == - 1) {
                            _db_insert($em, "p17_fibu_journal", $array,  $auth);
                        } else {
                            $arrayWhere = array(
                                "ID" => $pID
                            );
                            _db_update($em, "p17_fibu_journal", $array, $arrayWhere, $auth);
                            $pi ++;
                            if (isset($arrayID[$pi])) {
                                $pID = $arrayID[$pi];
                            } else {
                                $pID = - 1;
                            }
                        }
                    }
                }
                
                // in case of less lines in edit
                if ($countLines < count($arrayID)) {
                    for ($ii = $countlines; $ii < count($arrayID); $ii ++) {
                        $record = $em->getRepository(P17FibuJournal::class)->find($arrayID[$ii]);
                        $em->remove($record);
                        $em->flush();
                    }
                }
                
                break;
            
            case "KZ":
                $arrayOP["mandantID"] = $mandantID;
                $arrayOP["ticketID"] = $ticketID;
                $arrayOP["journalID"] = $journalID;
                $arrayOP["ba"] = $array["ba"];
                $arrayOP["ausgleichbetrag"] = str_replace(".", ",", comma2dot($array["betrag"]) + comma2dot($array["skontobetrag"]));
                $arrayOP["op_nummer"] = $array["beleg"];
                $arrayOP["datum"] = $array["datum"];
                $arrayOP["kontonummer"] = $array["soll"];
                
                if ($pID == - 1) {
                    _db_insert($em, "p17_fibu_opliste", $arrayOP,  $auth);
                    _db_insert($em, "p17_fibu_journal", $array,  $auth);
                } else {
                    
                    $arrayWhere = array(
                        "ID" => $array["OPID"]
                    );
                    _db_update($em, "p17_fibu_opliste", $array, $arrayWhere, $auth);
                    
                    $arrayWhere = array(
                        "ID" => $pID
                    );
                    _db_update($em, "p17_fibu_journal", $array, $arrayWhere, $auth);
                }
                break;
            case "DF":
                // 1st opliste
                $arrayOP["mandantID"] = $mandantID;
                $arrayOP["ticketID"] = $ticketID;
                $arrayOP["journalID"] = $journalID;
                $arrayOP["ba"] = $array["ba"];
                $arrayOP["betrag"] = $array["betrag"];
                $arrayOP["op_nummer"] = $array["beleg"];
                $arrayOP["datum"] = $array["datum"];
                $arrayOP["kontonummer"] = $array["soll"];
                $sql = "select t.*
                                from p17_orderbook p, p17_terms_of_payment t
                                where
                                p.orderID=$orderID AND
                                t.id=p.termPayment";
                $rowTerms = _db_row($em, $sql);
                
                $arrayOP["faellig"] = dateAdd($array["datum"], $rowTerms["net_days"]);
                $arrayOP["skontotage"] = $rowTerms["discount_days"];
                $arrayOP["skontoprozent"] = $rowTerms["discount"] / 100;
                $arrayOP["nettotage"] = $rowTerms["net_days"];
                if ($pID == - 1) {
                    // new
                    _db_insert($em, "p17_fibu_opliste", $arrayOP,  $auth);
                } else {
                    // update
                    $arrayWhere = array(
                        "journalID" => $journalID
                    );
                    _db_update($em, "p17_fibu_opliste", $array, $arrayWhere, $auth);
                }
                
                $countLines = 0;
                for ($i = 0; $i < 3; $i ++) {
                    if ($array["haben" . $i] != "") {
                        $countLines ++;
                        $array["haben"] = $array["haben" . $i];
                        $array["steuerzeile"] = $array["vat_id" . $i];
                        $array["BN"] = $array["BN" . $i];
                        if ($array["text" . $i] != "")
                            $array["text"] = $array["text" . $i];
                        $array["betrag"] = $array["betrag" . $i];
                        if ($pID == - 1) {
                            _db_insert($em, "p17_fibu_journal", $array,  $auth);
                        } else {
                            $arrayWhere = array(
                                "ID" => $pID
                            );
                            _db_update($em, "p17_fibu_journal", $array, $arrayWhere, $auth);
                            $pi ++;
                            if (isset($arrayID[$pi])) {
                                $pID = $arrayID[$pi];
                            } else {
                                $pID = - 1;
                            }
                        }
                    }
                }
                
                // in case of less lines in edit
                if ($countLines < count($arrayID)) {
                    for ($ii = $countlines; $ii < count($arrayID); $ii ++) {
                        $record = $em->getRepository(P17FibuJournal::class)->find($arrayID[$ii]);
                        $em->remove($record);
                        $em->flush();
                    }
                }
                
                break;
            case "DZ":
                $arrayOP["mandantID"] = $mandantID;
                $arrayOP["ticketID"] = $ticketID;
                $arrayOP["journalID"] = $journalID;
                $arrayOP["ba"] = $array["ba"];
                $arrayOP["ausgleichbetrag"] = str_replace(".", ",", comma2dot($array["betrag"]) + comma2dot($array["skontobetrag"]));
                $arrayOP["op_nummer"] = $array["beleg"];
                $arrayOP["datum"] = $array["datum"];
                $arrayOP["kontonummer"] = $array["haben"];
                
                if ($pID == - 1) {
                    _db_insert($em, "p17_fibu_opliste", $arrayOP,  $auth);
                    _db_insert($em, "p17_fibu_journal", $array,  $auth);
                } else {
                    
                    $arrayWhere = array(
                        "ID" => $array["OPID"]
                    );
                    _db_update($em, "p17_fibu_opliste", $array, $arrayWhere, $auth);
                    
                    $arrayWhere = array(
                        "ID" => $pID
                    );
                    _db_update($em, "p17_fibu_journal", $array, $arrayWhere, $auth);
                }
                break;
            
            default:
                if ($pID == - 1) {
                    _db_insert($em, "p17_fibu_journal", $array,  $auth);
                } else {
                    
                    $arrayWhere = array(
                        "ID" => $pID
                    );
                    _db_update($em, "p17_fibu_journal", $array, $arrayWhere, $auth);
                }
                
                break;
        }
        
        // }
        
        $sql = "select f.* 
                    from p17_fibu_journal f,p17_fibu_journalID j
                    where
                    j.ticketID=$ticketID AND
                    f.journalID=j.journalID
                    order by j.journalID asc";
        $rowsJournal = _db_rows($em, $sql);
        
        $return = array();
        $return[] = array(
            'label' => 'success',
            'content' => json_encode('saved')
        );
        $return[] = array(
            'label' => 'rows',
            'content' => json_encode($rowsJournal)
        );
        
        return new JsonResponse($return);
    }

    public function dialogBookingDelete(Request $request)
    {
        require ('./web/classes/_standard.php');
        $array = object_to_array(json_decode($_REQUEST["data"]));
        
        $sessionStorage = new NativeSessionStorage(array(), new NativeFileSessionHandler());
        $session = new Session($sessionStorage);
        $session->start();
        $auth = json_decode($session->get('auth'));
        $firmID = $auth->{'firmID'};
        $array["firmID"] = $firmID;
        $journalID = $array["id"];
        
        $em = $this->getDoctrine()->getEntityManager();
        
        $sql = "select ticketID from p17_fibu_journalID 
                where
                journalID=$journalID";
        $row = _db_row($em, $sql);
        $ticketID = $row["ticketID"];
        
        $record = $em->getRepository(P17FibuJournalid::class)->find($journalID);
        $em->remove($record);
        $em->flush();
        
        $sql = "select f.*
                from p17_fibu_journal f,p17_fibu_journalID j
                where
                j.ticketID=$ticketID AND
                f.journalID=j.journalID";
        $rowsJournal = _db_rows($em, $sql);
        
        $sql = "select f.*,
                sum(betrag) as betrag,
                sum(skontobetrag) as skontobetrag,
                sum(ausgleichbetrag) as ausgleichbetrag,
                DATE_ADD(datum, INTERVAL skontotage DAY) as skontodatum,
                if(DATE_ADD(datum, INTERVAL skontotage DAY)>=now(),skontobetrag,0) as skontobetrag,
                sum(betrag)-sum(skontobetrag) as zahlungsbetrag,
                sum(betrag)-sum(ausgleichbetrag) as rest
                from p17_fibu_opliste f
                where
                f.ticketID=$ticketID
                GROUP BY f.ticketID";
        $rowsOP = _db_rows($em, $sql);
        
        $return = array();
        $return[] = array(
            'label' => 'success',
            'content' => json_encode('deleted')
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

    public function getBookingJournal(Request $request)
    {
        require ('./web/classes/_standard.php');
        $array = object_to_array(json_decode($_REQUEST["data"]));
        
        $sessionStorage = new NativeSessionStorage(array(), new NativeFileSessionHandler());
        $session = new Session($sessionStorage);
        $session->start();
        $auth = json_decode($session->get('auth'));
        $firmID = $auth->{'firmID'};
        $mandantID = $firmID;
        $user = $auth->{'user'};
        $journalID = $array["journalID"];
        
        $em = $this->getDoctrine()->getEntityManager();
        $sql = "select f.*,j.ticketID 
                from p17_fibu_journal f,p17_fibu_journalID j
                where
                f.journalID=$journalID AND 
                j.journalID=f.journalID";
        $rowsJournal = _db_rows($em, $sql);
        $journalID = $rowsJournal[0]["journalID"];
        $ticketID = $rowsJournal[0]["ticketID"];
        
        $sql = "select f.*,
                sum(betrag) as betrag,
                sum(skontobetrag) as skontobetrag,
                sum(ausgleichbetrag) as ausgleichbetrag,
                DATE_ADD(datum, INTERVAL skontotage DAY) as skontodatum,
                if(DATE_ADD(datum, INTERVAL skontotage DAY)>=now(),skontobetrag,0) as skontobetrag,
                sum(betrag)-sum(skontobetrag) as zahlungsbetrag,
                sum(betrag)-sum(ausgleichbetrag) as rest
                from p17_fibu_opliste f
                where
                f.ticketID=$ticketID
                GROUP BY f.ticketID";
        $rowsJournalOP = _db_rows($em, $sql);
        
        $return = array();
        $return[] = array(
            'label' => 'rowsJournalE',
            'content' => json_encode($rowsJournal)
        );
        $return[] = array(
            'label' => 'rowsJournalEOP',
            'content' => json_encode($rowsJournalOP)
        );
        
        return new JsonResponse($return);
    }

    public function accountancyAccountsInit()
    {
        $sessionStorage = new NativeSessionStorage(array(), new NativeFileSessionHandler());
        $session = new Session($sessionStorage);
        $session->start();
        $auth = $session->get('auth');
        
        $htmlContent = file_get_contents('./templates/de/accountancyAccounts.html');
        
        $return = array();
        $return[] = array(
            'label' => 'html',
            'content' => json_encode($htmlContent)
        );
        
        return new JsonResponse($return);
    }

    public function accountancyImpersonalAccountsListInit()
    {
        include ('./web/classes/_standard.php');
        
        $sessionStorage = new NativeSessionStorage(array(), new NativeFileSessionHandler());
        $session = new Session($sessionStorage);
        $session->start();
        // $auth = $session->get('auth');
        $auth = json_decode($session->get('auth'));
        
        $firmID = $auth->{'firmID'};
        if (! isset($array["year"]))
            $array["year"] = date('Y');
        
        $year = $array["year"];
        
        $em = $this->getDoctrine()->getManager();
        
        $sql = "select *, v.percentage*100 as steuer_prozent,
	case (left(kontonummer,1))
	WHEN '0' THEN '0 Anlagevermögen'
	WHEN '1' THEN '1 Finanzanlagen'
	WHEN '2' THEN '2 Umlaufvermögen'
	WHEN '3' THEN '3 Eigenkapital'
	WHEN '4' THEN '4 Verbindlichkeiten'
	WHEN '5' THEN '5 Erträge'
	WHEN '6' THEN '6 Betriebliche Aufwendung'
	WHEN '7' THEN '7 weitere Aufwendungen'
	WHEN '8' THEN '8 Abschlusskonten'
	ELSE 'sonstiges'
	END AS klasse
	from p17_fibu_sachkonten s
	left join p17_vat v on v.vat_id=s.steuerzeile
	where
	s.firmID=0
	order by kontonummer asc";
        
        $rowsSachkonten = _db_rows($em, $sql);
        
        $sql = "select * from p17_system_grid
		where
		modul='accountancyImpersonalAccountsList'";
        $rowGrid = _db_row($em, $sql);
        
        $htmlContent = file_get_contents('./templates/de/accountancyImpersonalAccountsList.html');
        
        $return = array();
        $return[] = array(
            'label' => 'html',
            'content' => json_encode($htmlContent)
        );
        
        $return[] = array(
            'label' => 'rowsSachkonten',
            'content' => json_encode($rowsSachkonten)
        );
        
        $return[] = array(
            'label' => 'rowGrid',
            'content' => json_encode($rowGrid)
        );
        
        return new JsonResponse($return);
    }

    public function accountancyPersonalAccountsListInit()
    {
        include ('./web/classes/_standard.php');
        
        $sessionStorage = new NativeSessionStorage(array(), new NativeFileSessionHandler());
        $session = new Session($sessionStorage);
        $session->start();
        // $auth = $session->get('auth');
        $auth = json_decode($session->get('auth'));
        
        $firmID = $auth->{'firmID'};
        
        $em = $this->getDoctrine()->getManager();
        
        $sql = "select f.*,f.company as name,n.debitor,n.creditor,'' as percentage
                from p17_firms_numbers n
                left join p17_firms f on f.firmID=n.firmIDpartner
                where
                n.firmID=$firmID
                order by name asc";
        $rowsPersonenkonten = _db_rows($em, $sql);
        
        $sql = "select * from p17_system_grid
		where
		modul='accountancyPersonalAccountsList'";
        $rowGrid = _db_row($em, $sql);
        
        $htmlContent = file_get_contents('./templates/de/accountancyPersonalAccountsList.html');
        
        $return = array();
        $return[] = array(
            'label' => 'html',
            'content' => json_encode($htmlContent)
        );
        
        $return[] = array(
            'label' => 'rowsPersonenkonten',
            'content' => json_encode($rowsPersonenkonten)
        );
        
        $return[] = array(
            'label' => 'rowGrid',
            'content' => json_encode($rowGrid)
        );
        
        return new JsonResponse($return);
    }

    public function accountancyOverviewInit()
    {
        $sessionStorage = new NativeSessionStorage(array(), new NativeFileSessionHandler());
        $session = new Session($sessionStorage);
        $session->start();
        $auth = $session->get('auth');
        
        $htmlContent = file_get_contents('./templates/de/accountancyOverview.html');
        
        $return = array();
        $return[] = array(
            'label' => 'html',
            'content' => json_encode($htmlContent)
        );
        
        return new JsonResponse($return);
    }

    public function accountancyOverviewJournalListInit()
    {
        include ('./web/classes/_standard.php');
        
        $sessionStorage = new NativeSessionStorage(array(), new NativeFileSessionHandler());
        $session = new Session($sessionStorage);
        $session->start();
        // $auth = $session->get('auth');
        $auth = json_decode($session->get('auth'));
        
        if (!isset($auth)) {
            $return = array();
            $return[] = array(
                'label' => 'success',
                'content' => json_encode('seesion timeout')
            );
            return new JsonResponse($return);
        }
            
        $firmID = $auth->{'firmID'};
        
        if (! isset($array["year"]))
            $array["year"] = date('Y');
        
        $year = $array["year"];
        
        $em = $this->getDoctrine()->getManager();
        
        $schoolYears = schoolYears($em, $firmID, "p17_fibu_journal", "datum");
        $schoolYearFrom = $schoolYears[0]["from"];
        $schoolYearTo = $schoolYears[0]["to"];
        
        $sql = "select * 
            from p17_fibu_journal 
            where mandantID=$firmID AND
            datum>='$schoolYearFrom' AND
            datum<='$schoolYearTo'
            order by datum desc";
        
        $rowsJournal = _db_rows($em, $sql);
        
        $sql = "select * from p17_system_grid
		where
		modul='accountancyOverviewJournalList'";
        $rowGrid = _db_row($em, $sql);
        
        $htmlContent = file_get_contents('./templates/de/accountancyOverviewJournalList.html');
        
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
            'label' => 'rowsSchoolYears',
            'content' => json_encode($schoolYears)
        );
        
        $return[] = array(
            'label' => 'rowGrid',
            'content' => json_encode($rowGrid)
        );
        
        return new JsonResponse($return);
    }

    public function accountancyOverviewBalanceListInit()
    {
        include ('./web/classes/_standard.php');
        if (isset($_REQUEST["data"])) {
            $array = object_to_array(json_decode($_REQUEST["data"]));
        } else {
            $array=array();
        }
        
        $sessionStorage = new NativeSessionStorage(array(), new NativeFileSessionHandler());
        $session = new Session($sessionStorage);
        $session->start();
        // $auth = $session->get('auth');
        $auth = json_decode($session->get('auth'));
        
        $firmID = $auth->{'firmID'};
        if (! isset($array["year"]))
            $array["year"] = date('Y');
        
        $year = $array["year"];
        if (strstr($year, "-")) {
            $arr_temp = explode("-", $year);
            $yearMonth = $year;
            $year = $arr_temp[0];
        } else {
            $yearMonth = $year . "-" . date('m');
        }
        
        
        $em = $this->getDoctrine()->getManager();
        
        $schoolYears = schoolYears($em, $firmID, "p17_fibu_journal", "datum");
        $schoolYearFrom = $schoolYears[0]["from"];
        $schoolYearTo = $schoolYears[0]["to"];
        
        /*
         * structure of rowsBalance
         * konto
         * name
         * aktiva
         * passiva
         * periode
         * soll
         * haben
         * kum
         * soll
         * haben
         * saldo
         */
        $yearMonthE=substr($yearMonth,0,7)."-31";
        
        $sqlTemplate = "select l.konto,
	sum(l.soll) as soll,
    sum(l.haben) as haben,
    sum(l.soll-l.haben) as saldo,
    case (left(konto,1))
	WHEN '0' THEN '0 Anlagevermögen'
	WHEN '1' THEN '1 Finanzanlagen'
	WHEN '2' THEN '2 Umlaufvermögen'
	WHEN '3' THEN '3 Eigenkapital'
	WHEN '4' THEN '4 Verbindlichkeiten'
	WHEN '5' THEN '5 Erträge'
	WHEN '6' THEN '6 Betriebliche Aufwendung'
	WHEN '7' THEN '7 weitere Aufwendungen'
	WHEN '8' THEN '8 Abschlusskonten'
	ELSE 'sonstiges'
	END AS klasse
	from p17_fibu_hauptbuch l,p17_fibu_journal j
    where 
	[where]
    group by [groupBy]
	order by l.konto asc";
        $where = "l.mandantID=$firmID AND
	               l.datum>='$schoolYearFrom' AND
                   l.datum<='$yearMonthE' AND
                    j.journalID=l.journalID";
        $groupBy = "klasse,l.konto";
        
        $sql=str_replace("[where]",$where,$sqlTemplate);
        $sql=str_replace("[groupBy]",$groupBy,$sql);
        

        //echo $sql;
        
    $rowsBalance = _db_rows($em, $sql);
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        
        /*
         * opening
         *
         */
        $where = "l.mandantID=$firmID AND
	              l.datum>='$schoolYearFrom' AND
                  l.datum<='$schoolYearFrom' AND
                  j.journalID=l.journalID AND 
                  j.soll=8000 OR
                    l.mandantID=$firmID AND
	                l.datum>='$schoolYearFrom' AND
                    l.datum<='$schoolYearFrom' AND
                    j.journalID=l.journalID AND
                    j.haben=8000 ";
         $groupBy = "l.konto";
         $sql=str_replace("[where]",$where,$sqlTemplate);
         $sql=str_replace("[groupBy]",$groupBy,$sql);
         
         $rowsOpening=_db_rows($em,$sql);

         $yearMonthB=substr($yearMonth,0,7)."-01";
         $yearMonthE=substr($yearMonth,0,7)."-31";
         $where = "l.mandantID=$firmID AND
	               l.datum>='$yearMonthB' AND
                   l.datum<='$yearMonthE' AND
                   j.journalID=l.journalID AND
                   j.soll!=8000 AND
                   j.haben!=8000";
         $groupBy = "l.konto";
         
         $sql=str_replace("[where]",$where,$sqlTemplate);
         $sql=str_replace("[groupBy]",$groupBy,$sql);
        
        //echo $sql;
        $rowsPeriod=_db_rows($em,$sql);
         
        for ($i = 0; $i < count($rowsBalance); $i ++) {
            $konto = $rowsBalance[$i]["konto"];
            $rowsBalance[$i]["aktiva"]=0;
            $rowsBalance[$i]["passiva"]=0;
            $rowsBalance[$i]["sollP"]=0;
            $rowsBalance[$i]["habenP"]=0;
            if ($rowsBalance[$i]["saldo"]>=0) {
                $rowsBalance[$i]["saldoS"]=$rowsBalance[$i]["saldo"];
                $rowsBalance[$i]["saldoH"]=0;
            } else {
                $rowsBalance[$i]["saldoH"]=$rowsBalance[$i]["saldo"]*(-1);
                $rowsBalance[$i]["saldoS"]=0;
            }
            if (substr($konto, 0, 1) <= "4") {
                
                for ($ii=0;$ii<count($rowsOpening);$ii++) {
                    if ($rowsOpening[$ii]["konto"]==$konto) {
                        if (substr($konto,0,1)<="2") {
                            $rowsBalance[$i]["aktiva"]=$rowsOpening[$ii]["soll"];
                        } else {
                            $rowsBalance[$i]["passiva"]=$rowsOpening[$ii]["haben"];
                        }
                    }
                }
            } // endif opening
            
            /* periode
             * 
             */
            for ($ii=0;$ii<count($rowsPeriod);$ii++) {
                
                if ($rowsPeriod[$ii]["konto"]==$konto) {
                    if ($konto==5100)
                        //echo $rowsPeriod[$ii]["soll"]." ".$rowsPeriod[$ii]["haben"];
                    $rowsBalance[$i]["sollP"]+=$rowsPeriod[$ii]["soll"];
                    $rowsBalance[$i]["habenP"]+=$rowsPeriod[$ii]["haben"];
                }
            }
            
        
            
        } // next rowsBalance
        
        /*
         * redefine schoolYear
         * $array[$z]["year"] = substr($from, 0, 4);
         * $array[$z]["value"] = $array[$z]["year"];
         * $array[$z]["label"] = 'Schuljahr ' . substr($from, 0, 4) . '/' . substr($to, 0, 4);
         * $array[$z]["from"] = $from;
         * $array[$z]["to"] = $to;
         */
        
        $schoolMonth = array();
        $z = - 1;
        for ($i = 0; $i < count($schoolYears); $i ++) {
            $year = substr($schoolYears[$i]["to"], 0, 4);
            
            $month = 12;
            if ($year == date('Y'))
                $month = min($month, date('m'));
            
            for ($ii = $month; $ii > 0; $ii --) {
                $mon = $ii;
                $schoolMonth[++ $z]["value"] = $year . "-" . strzero($mon, 2);
                $schoolMonth[$z]["label"] = date("F", mktime(0, 0, 0, $ii, 10)) . " " . $year;
                if ($ii == 1) {
                    $year --;
                    $ii = 12;
                }
                if (substr($schoolYears[$i]["from"], 0, 7) > $year . "-" . strzero($ii, 2))
                    break;
            }
        }
        $sql = "select * from p17_system_grid
		where
		modul='accountancyOverviewBalanceList'";
        $rowGrid = _db_row($em, $sql);
        
        $htmlContent = file_get_contents('./templates/de/accountancyOverviewBalanceList.html');
        
        $return = array();
        $return[] = array(
            'label' => 'html',
            'content' => json_encode($htmlContent)
        );
        
        $return[] = array(
            'label' => 'rowsBalance',
            'content' => json_encode($rowsBalance)
        );
        $return[] = array(
            'label' => 'rowsSchoolYears',
            'content' => json_encode($schoolMonth)
        );
        
        $return[] = array(
            'label' => 'rowGrid',
            'content' => json_encode($rowGrid)
        );
        
        return new JsonResponse($return);
    }

    public function accountancyOverviewOutstandingListInit()
    {
        include ('./web/classes/_standard.php');
        
        $sessionStorage = new NativeSessionStorage(array(), new NativeFileSessionHandler());
        $session = new Session($sessionStorage);
        $session->start();
        // $auth = $session->get('auth');
        $auth = json_decode($session->get('auth'));
        
        $firmID = $auth->{'firmID'};
        if (! isset($array["year"]))
            $array["year"] = date('Y');
        
        $year = $array["year"];
        
        $em = $this->getDoctrine()->getManager();
        
        $schoolYears = schoolYears($em, $firmID, "p17_fibu_journal", "datum");
        $schoolYearFrom = $schoolYears[0]["from"];
        $schoolYearTo = $schoolYears[0]["to"];
        
        $sql = "select o.*,f.company
		from p17_fibu_opliste o, p17_firms_numbers n, p17_firms f
		where
		o.mandantID=$firmID AND
		n.debitor=o.kontonummer AND
		n.firmID=$firmID AND
		f.firmID=n.firmIDpartner OR
		o.mandantID=$firmID AND
		n.creditor=o.kontonummer AND
		n.firmID=$firmID AND
		f.firmID=n.firmIDpartner AND
        o.datum>='$schoolYearFrom' AND
        o.datum<='$schoolYearTo'
		order by o.faellig asc";
        
        $rowsOutstanding = _db_rows($em, $sql);
        
        $sql = "select * from p17_system_grid
		where
		modul='accountancyOverviewOutstandingList'";
        $rowGrid = _db_row($em, $sql);
        
        $htmlContent = file_get_contents('./templates/de/accountancyOverviewOutstandingList.html');
        
        $return = array();
        $return[] = array(
            'label' => 'html',
            'content' => json_encode($htmlContent)
        );
        
        $return[] = array(
            'label' => 'rowsOutstanding',
            'content' => json_encode($rowsOutstanding)
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

    public function accountancyOverviewLedgerListInit()
    {
        include ('./web/classes/_standard.php');
        
        $sessionStorage = new NativeSessionStorage(array(), new NativeFileSessionHandler());
        $session = new Session($sessionStorage);
        $session->start();
        // $auth = $session->get('auth');
        $auth = json_decode($session->get('auth'));
        
        $firmID = $auth->{'firmID'};
        if (! isset($array["year"]))
            $array["year"] = date('Y');
        
        $year = $array["year"];
        
        $em = $this->getDoctrine()->getManager();
        
        $schoolYears = schoolYears($em, $firmID, "p17_fibu_journal", "datum");
        $schoolYearFrom = $schoolYears[0]["from"];
        $schoolYearTo = $schoolYears[0]["to"];
        
        $sql = "select l.konto,
	sum(l.soll) as soll,
    sum(l.haben) as haben,
    sum(l.soll-l.haben) as saldo,
    case (left(konto,1))
	WHEN '0' THEN '0 Anlagevermögen'
	WHEN '1' THEN '1 Finanzanlagen'
	WHEN '2' THEN '2 Umlaufvermögen'
	WHEN '3' THEN '3 Eigenkapital'
	WHEN '4' THEN '4 Verbindlichkeiten'
	WHEN '5' THEN '5 Erträge'
	WHEN '6' THEN '6 Betriebliche Aufwendung'
	WHEN '7' THEN '7 weitere Aufwendungen'
	WHEN '8' THEN '8 Abschlusskonten'
	ELSE 'sonstiges'
	END AS klasse
	from p17_fibu_hauptbuch l
    where
	l.mandantID=$firmID AND
	l.datum>='$schoolYearFrom' AND
    l.datum<='$schoolYearTo'
    group by klasse,l.konto
	order by l.konto asc";
        
        $rowsLedger = _db_rows($em, $sql);
        
        $sql = "select * from p17_system_grid
		where
		modul='accountancyOverviewLedgerList'";
        $rowGrid = _db_row($em, $sql);
        
        $htmlContent = file_get_contents('./templates/de/accountancyOverviewLedgerList.html');
        
        $return = array();
        $return[] = array(
            'label' => 'html',
            'content' => json_encode($htmlContent)
        );
        
        $return[] = array(
            'label' => 'rowsLedger',
            'content' => json_encode($rowsLedger)
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

    public function accountancyChangeData(Request $request)
    {
        require ('./web/classes/_standard.php');
        $array = object_to_array(json_decode($_REQUEST["data"]));
        
        $sessionStorage = new NativeSessionStorage(array(), new NativeFileSessionHandler());
        $session = new Session($sessionStorage);
        $session->start();
        $auth = json_decode($session->get('auth'));
        $firmID = $auth->{'firmID'};
        $user = $auth->{'user'};
        
        $year = $array["year"];
        $field = $array["field"];
        $table = $array["table"];
        $rowsName = $array["rowsName"];
        
        $em = $this->getDoctrine()->getManager();
        $schoolYears = schoolYears($em, $firmID, $table, $field, $year);
        $schoolYearFrom = $schoolYears[0]["from"];
        $schoolYearTo = $schoolYears[0]["to"];
        
        switch ($table) {
            case "p17_fibu_opliste":
                $sql = "select o.*,f.company
		from p17_fibu_opliste o, p17_firms_numbers n, p17_firms f
		where
		o.mandantID=$firmID AND
		n.debitor=o.kontonummer AND
		n.firmID=$firmID AND
		f.firmID=n.firmIDpartner OR
		o.mandantID=$firmID AND
		n.creditor=o.kontonummer AND
		n.firmID=$firmID AND
		f.firmID=n.firmIDpartner AND
        o.datum>='$schoolYearFrom' AND
        o.datum<='$schoolYearTo'
		order by f.company asc,o.faellig asc";
                break;
            default:
                $sql = "select *
            from $table
            where firmID=$firmID AND
            $field>='$schoolYearFrom' AND
            $field<='$schoolYearTo'
            order by $field desc";
        }
        
        $rows = _db_rows($em, $sql);
        
        $return = array();
        $return[] = array(
            'label' => $rowsName,
            'content' => json_encode($rows)
        );
        
        return new JsonResponse($return);
    }
    

    public function accountancyBankInit()
    {
        $sessionStorage = new NativeSessionStorage(array(), new NativeFileSessionHandler());
        $session = new Session($sessionStorage);
        $session->start();
        $auth = $session->get('auth');
        
        $htmlContent = file_get_contents('./templates/de/accountancyBank.html');
        
        $return = array();
        $return[] = array(
            'label' => 'html',
            'content' => json_encode($htmlContent)
        );
        
        return new JsonResponse($return);
    }
    public function accountancyBankJournalListInit(Request $request)
    {
        require ('./web/classes/_standard.php');
        $array = object_to_array(json_decode($_REQUEST["data"]));
        
        $sessionStorage = new NativeSessionStorage(array(), new NativeFileSessionHandler());
        $session = new Session($sessionStorage);
        $session->start();
        $auth = json_decode($session->get('auth'));
        $firmID = $auth->{'firmID'};
        $user = $auth->{'user'};
        
        if (! isset($array["year"]))
            $array["year"] = date('Y');
            
        $year = $array["year"];
                    
        $em = $this->getDoctrine()->getManager();
        
        $sql = "select * from p17_system_grid
		where
		modul='accountancyEurobankList'";
        $rowGrid = _db_row($em, $sql);
        
        $sql = "select IBAN from p17_firms where firmID=$firmID";
        $row = _db_row($em,$sql);
        $accountNumber = str_replace(" ", "", $row["IBAN"]);
        $accountNumber = substr($accountNumber, strlen($accountNumber) - 8);
        
        $eme = $this->getDoctrine()->getManager("customer");
        $schoolYears = schoolYearsEurobank($eme, $accountNumber, "Transaction", "date");
        $schoolYearFrom = $schoolYears[0]["from"];
        $schoolYearTo = $schoolYears[0]["to"];
        
        $sql="select T.*,
            if (senderNumber=$accountNumber,U.username,'') as username,
			(select statementNo from Statement S where S.bankAccount_id=B.id AND 				
                S.dateFrom<= T.date AND S.dateTo>=T.date) as statementNo,
			if (remitteeNumber=$accountNumber,senderName,remitteeName) as SenderRemittee,
			if (senderNumber=$accountNumber,amount,0) as soll,
            if (remitteeNumber=$accountNumber,amount,0) as haben
			from BankAccount B, Transaction T
            left join User U on U.id=T.creator_id
			where
			B.number=$accountNumber AND
			T.senderNumber=$accountNumber AND
			T.date>='$schoolYearFrom' AND T.date<='$schoolYearTo'
			OR
			B.number=$accountNumber AND
			T.remitteeNumber=$accountNumber AND
			T.date>='$schoolYearFrom' AND T.date<='$schoolYearTo'
			order by date desc";
        
        $rowsTransactions=_db_rows($eme,$sql);
        
        
        
        $htmlContent = file_get_contents('./templates/de/accountancyEurobankList.html');
        
        $return = array();
        $return[] = array(
            'label' => 'html',
            'content' => json_encode($htmlContent)
        );
        $return[] = array(
            'label' => 'rowsSchoolYears',
            'content' => json_encode($schoolYears)
        );
        
        $return[] = array(
            'label' => 'rowGrid',
            'content' => json_encode($rowGrid)
        );
        $return[] = array(
            'label' => 'rowsTransactions',
            'content' => json_encode($rowsTransactions)
        );
        return new JsonResponse($return);
    }

    public function accountancyBankTransactionsFirm(Request $request)
    {
        require ('./web/classes/_standard.php');
        $array = object_to_array(json_decode($_REQUEST["data"]));
        
        $sessionStorage = new NativeSessionStorage(array(), new NativeFileSessionHandler());
        $session = new Session($sessionStorage);
        $session->start();
        $auth = json_decode($session->get('auth'));
        $firmID = $auth->{'firmID'};
        $senderFirmID=$array["senderFirmID"];
        $remitteeFirmID=$array["remitteeFirmID"];
        $dateFrom=$array["dateFrom"];
        if (!isset($array["dateTo"])) {
            $dateTo=date('Y-m-d');
        } else {
            $dateTo=$array["dateTo"];
        }
        $em = $this->getDoctrine()->getManager();
        
            $sql = "select firmID,IBAN,email 
                from p17_firms 
                where 
                firmID=$senderFirmID OR
                firmID=$remitteeFirmID";
            $rows = _db_rows($em,$sql);
            
            for ($i=0;$i<count($rows);$i++) {
                if ($rows[$i]["firmID"]==$firmID) {
                    $ownAccountNumber=$rows[$i]["IBAN"];    
                }
                
                if ($rows[$i]["firmID"]==$senderFirmID) {
                    $accountNumberSender=$rows[$i]["IBAN"];
                    $emailSender=$rows[$i]["email"];
                }
                if ($rows[$i]["firmID"]==$remitteeFirmID) {
                    $accountNumberRemittee=$rows[$i]["IBAN"];
                    $emailRemittee=$rows[$i]["email"];
                }
                
            }
            
            
            $accountNumberSender = str_replace(" ", "", $accountNumberSender);
            $accountNumberSender = substr($accountNumberSender, strlen($accountNumberSender) - 8);
            
            $accountNumberRemittee = str_replace(" ", "", $accountNumberRemittee);
            $accountNumberRemittee = substr($accountNumberRemittee, strlen($accountNumberRemittee) - 8);
            
            $ownAccountNumber = str_replace(" ", "", $ownAccountNumber);
            $ownAccountNumber = substr($ownAccountNumber, strlen($ownAccountNumber) - 8);
            
            $eme = $this->getDoctrine()->getManager("customer");
            
            $sql="select T.*,
			(select statementNo from Statement S where S.bankAccount_id=B.id AND
                S.dateFrom<= T.date AND S.dateTo>=T.date) as statementNo,
			if (remitteeNumber=$ownAccountNumber,senderName,remitteeName) as SenderRemittee,
			if (senderNumber=$ownAccountNumber,amount,0) as soll,
            if (remitteeNumber=$ownAccountNumber,amount,0) as haben
			from BankAccount B, Transaction T
			where
			B.number=$ownAccountNumber AND
			T.senderNumber=$accountNumberSender AND
            T.remitteeNumber=$accountNumberRemittee AND
			T.date>='$dateFrom' AND T.date<='$dateTo'
			order by date desc";
            
            $rowsTransactions=_db_rows($eme,$sql);
            
            $return = array();
            $return[] = array(
                'label' => 'rowsTransactions',
                'content' => json_encode($rowsTransactions)
            );
            return new JsonResponse($return);
    }
    
    
    public function accountancyPayFriendJournalListInit(Request $request)
    {
        require ('./web/classes/_standard.php');
        $array = object_to_array(json_decode($_REQUEST["data"]));
        
        $sessionStorage = new NativeSessionStorage(array(), new NativeFileSessionHandler());
        $session = new Session($sessionStorage);
        $session->start();
        $auth = json_decode($session->get('auth'));
        $firmID = $auth->{'firmID'};
        $email = $auth->{'email'};
        
        if (! isset($array["year"]))
            $array["year"] = date('Y');
            
            $year = $array["year"];
            
            $em = $this->getDoctrine()->getManager();
            
            $sql = "select * from p17_system_grid
		where
		modul='accountancyPayFriendList'";
            $rowGrid = _db_row($em, $sql);
            
            $sql = "select IBAN from p17_firms where firmID=$firmID";
            $row = _db_row($em,$sql);
            $accountNumber = str_replace(" ", "", $row["IBAN"]);
            $accountNumber = substr($accountNumber, strlen($accountNumber) - 8);
            
            $schoolYears = schoolYearsPF($em, $email, "p17_payfriend_journal", "date");
            $schoolYearFrom = $schoolYears[0]["from"];
            $schoolYearTo = $schoolYears[0]["to"];
            
            $sql="select *,
            if (sender='$email',amount,0) as soll,
            if (receiver='$email',amount,0) as haben,
            if (sender='$email',receiver,sender) as SenderRemittee
			from p17_payfriend_journal
			where
			sender='$email' OR
            receiver='$email'
			order by date desc";
            
            $rowsTransactions=_db_rows($em,$sql);
            
            $htmlContent = file_get_contents('./templates/de/accountancyPayFriendList.html');
            
            $return = array();
            $return[] = array(
                'label' => 'html',
                'content' => json_encode($htmlContent)
            );
            $return[] = array(
                'label' => 'rowsSchoolYears',
                'content' => json_encode($schoolYears)
            );
            
            $return[] = array(
                'label' => 'rowGrid',
                'content' => json_encode($rowGrid)
            );
            $return[] = array(
                'label' => 'rowsTransactions',
                'content' => json_encode($rowsTransactions)
            );
            return new JsonResponse($return);
    }
    
}

