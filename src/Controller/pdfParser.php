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
use App\Entity\P17User; 
use Twig\Node\Expression\Binary\AndBinary;




class pdfParser extends Controller
{
	/**
	* @Route("/pdfParser")
	*/        
    var $orderID=-1;
    var $template='';
    var $division='';
    var $countPositions=0;
    var $lang="de";
    
    var $hawaliFirmID = -1;
    var $rowSender=array();
    var $rowReceiver=array();
    var $rowOrder=array();
    var $rowsPosition=array();
    
    function pdfParserInit($orderID) {
        $this->orderID=$orderID;
    }
    
    function printBody() {
        $template=$this->template;


        if ($this->lang=="de") {
            $sql="select contentText_de as content from p17_templatesPdf where name='$template'";
        } else {
            $sql="select contentText_en as content from p17_templatesPdf where name='$template'";
        }
        
        $row=_db_row($this->em,$sql);
        if (count($row)==0)
            return 'no template found for '.$this->lang." ".$this->template;
        
        $content=$row["content"];
        
        $array=explode("\n",$content);
        $content="";
        for ($i=0;$i<count($array);$i++) {
            if (substr(trim($array[$i]),0,2)=="<<") {
                $string=$array[$i];
                $pos=strpos($string,"<<");
                $pos2=strpos($string,">>");
                $stringR=substr($string,$pos,$pos2-$pos+2);
                $tb=substr($string,$pos+2,$pos2-$pos-2);
                $tb=str_replace(".txt","",$tb);
                
                
                if ($this->lang=="de") {
                    $sql="select contentText_de as content from p17_templatesPdf where name='$tb'";
                } else {
                    $sql="select contentText_en as content from p17_templatesPdf where name='$tb'";
                }
                $row=_db_row($this->em,$sql);
                $tbContent=$row["content"];
                $array[$i]=str_replace($stringR,$tbContent,$array[$i]);
                $content.=$array[$i]."\n";
            } else {
                $content.=$array[$i]."\n";
            }
        }
        
        $array=explode("\n",$content);
        $content="";
        for ($i=0;$i<count($array);$i++) {
            if (substr(trim($array[$i]),0,2)!="//" AND 
                trim($array[$i])!='') {
                $content.=$array[$i]."\n";
            }
        }
        
        $content = str_replace("\$xb=", "", $content);
        $content = str_replace("\$yb=", "", $content);
        $content = str_replace("\$xb=", "", $content);
        $content = str_replace("\$ye=", "", $content);
        $content = str_replace("\$w=", "", $content);
        //$content = str_replace(", \$x=", ", ", $content);
        //$content = str_replace(",\$x=", ",", $content);
        //$content = str_replace(", \$y=", ", ", $content);
        //$content = str_replace(",\$y=", ",", $content);
        $content = str_replace("\$h=", "", $content);
        $content = str_replace("\$border=", "", $content);
        $content = str_replace("\$ln=", "", $content);
        $content = str_replace("\$fill=", "", $content);
        $content = str_replace("\$reseth=", "", $content);
        $content = str_replace("\$autopadding=", "", $content);
        $content = str_replace("\$align=", "", $content);
        
        
        $e=-1;
            while (strstr($content,"-for-each") AND $e<10) {
                $e++;
                $pos=strpos($content,"<!--");
                $posB=$pos;
                $pos2=strpos($content,">",$pos);
                $begin=substr($content,$pos,$pos2+1);
                $pos=strpos($begin,"for-each");
                $pos2=strpos($begin,">",$pos);
                $blockName=substr($begin,$pos,$pos2-$pos);
                
                $blockName=str_replace("for-each","",$blockName);
                $blockName=str_replace(" ","",$blockName);
                if ($blockName=="")
                    $blockName="positions";
                
                
                $pos2=strpos($content,"/for-each",$pos);
                $posE=strpos($content,">",$pos2);
                $blockR=substr($content,$posB,$posE-$posB+1);
                $block=$blockR;
                
                $pos=strpos($block,">");
                $block=substr($block,$pos+1);
                
                $pos2=strpos($block,"</for-each");
                $block=substr($block,0,$pos2);
                $block=trim($block);
                
                $string="";
                if ($blockName=="positions")
                    $counter=$this->countPositions;
                if ($blockName=="package")
                    $counter=$this->countPackagePositions;
                        
                for ($i=0;$i<$counter;$i++) {
                    $string.=str_replace('[$i]',"[".$i."]",$block)."\n";
                }
                $content=str_replace($blockR,$string,$content);
            }
            
            
            return($content);
            
    }
    
    function printHAWALI1() {
        $content="";
        
        $this->template = "auftrag_AB";
        $content = $this->printBody();
        if ($content != "")
            //$content .= "\$pdf->AddPage('P', 'A4');\n";
        
            return ($content);
    }
    
    function pintHawaliRecalc($rowHawali,$rowOrder,$rowsPosition) {

        //var_dump($rowsPosition);

        if ($rowHawali["rebate_till"]>date('Y-m-d')) {
            $rebate=$rowHawali["rebateR"];
            $rowOrder["basisPrice"]="Sonderaktion";
        } else {
            $rebate=$rowHawali["rebate"];
        }
        $totalSum=0;
        $totalWeight=0;
        
        for ($i=0;$i<count($rowsPosition);$i++) {
            $rowsPosition[$i]["discount"]=$rebate*100;
            $rowsPosition[$i]["sumPosition"]=$rowsPosition[$i]["quantity"]*$rowsPosition[$i]["price"]*(1-$rebate/100);
            $totalSum+=$rowsPosition[$i]["sumPosition"];
            $article_id=$rowsPosition[$i]["article_id"];
            $variation1_id=$rowsPosition[$i]["variation1_id"];
            $variation2_id=$rowsPosition[$i]["variation2_id"];
            
            if ($variation1_id==0 AND $variation2_id==0) {
                $sql="select weight from p17_article where id=$article_id";
            } else {
                $sql="select weight from p17_article_variation_spec where article_id=$article_id";
            
            }
            
            $row=_db_row($this->em,$sql);
            $totalWeight+=$rowsPosition[$i]["quantity"]*$row["weight"];
            $rowsPosition[$i]["gross_weight"]=$rowsPosition[$i]["quantity"]*$row["weight"];
            $rowsPosition[$i]["variation1_name"]=$rowsPosition[$i]["variation1"];
            $rowsPosition[$i]["variation2_name"]=$rowsPosition[$i]["variation2"];
        }
        
        if ($totalSum<$rowHawali["carriageFree"]) {
            $rowOrder["deliveryCondition"]="unfrei";
            $rowOrder["shippingCosts"]=$rowHawali["shippingCosts"];
        } else {
            $rowOrder["deliveryCondition"]="frei";
            $rowOrder["shippingCosts"]=0;
        }
        if ($totalWeight<=31.5) {
            $rowOrder["dispatch"]="DHL";
            $sql="select price from p17_post_fees 
                where
                left(code,2)='PG' AND 
                weight_from/1000>=$totalWeight AND 
                weight_to/1000<=$totalWeight
                order by weight_from asc";
            $row=_db_row($tins->em,$sql);
            $rowOrder["shippingCosts"]=$row["price"];
            
        } else {
            if ($rowHawali["firmID"]==153) {
                // getIn for shippingCosts Memmingen
                $firmIDfrom=356; // UeBW-zentrale
            } else {
                $firmIDfrom=$rowHawali["firmID"];
            }
            
            $km=distance($this->em,$firmIDfrom,$rowOrder["firmID"]);            
            $rowOrder["shippingCosts"]=dispatchCost($this->em,$rowOrder["firmID"],'BaySped',$km,$totalWeight,$totalSum);
        }
        
        // calc invoice
        $rowInvoice=calcInvoice($this->em,$rowOrder,$rowsPosition);
        

        return (array($rowOrder,$rowsPosition,$rowInvoice));
    }
    
    function isImage($string) {
        $ret=false;
        $pos=strpos($string,"getImageData");
        $pos=strpos($string,"(",$pos);
        $pos2=strpos($string,")",$pos);
        $substr=substr($string,$pos,$pos2-$pos);
        $substr=str_replace('$row','$this->row',$substr);
        $substr=str_replace('$em','$this->em',$substr);
        
        $arrayP=explode(",",$substr);
        // var $p0=$arrayP[0]; // em
        
        $firmID=$arrayP[1]; // sender
        $firmID=str_replace('$this->rowSender["firmID"]',$this->rowSender["firmID"],$firmID);

        $kind=str_replace('"','',$arrayP[2]); // logo
        
        
        
        switch ($kind) {
            case "image":
                    $article_id=$arrayP[3];
        
                    if (isset($arrayP[4])) {
                        $variation1_id=$arrayP[4];
                        $variation2_id=$arrayP[5];
                    }
                    for ($i=0;$i<count($this->rowsPosition);$i++) {
                    $what='$this->rowsPosition['.$i.']["article_id"]';
                    $with=$this->rowsPosition[$i]["article_id"];
                    $article_id=str_replace($what,$with,$article_id);
                    
                    $what='$this->rowsPosition['.$i.']["variation1_id"]';
                    $with=$this->rowsPosition[$i]["variation1_id"];
                    $variation1_id=str_replace($what,$with,$variation1_id);
                    
                    $what='$this->rowsPosition['.$i.']["variation2_id"]';
                    $with=$this->rowsPosition[$i]["variation2_id"];
                    $variation2_id=str_replace($what,$with,$variation2_id);
                    
                    }
                $sql="select content
		from p17_article_images
		where firmID=$firmID AND
		article_id=$article_id AND
		variation1_id=$variation1_id AND
		variation2_id=$variation2_id";

                $row=_db_row($this->em,$sql);
              if (count($row)==0) {
                $sql="select content
		from p17_article_images
		where firmID=$firmID AND
		article_id=$article_id";
                    
              $row=_db_row($this->em,$sql);
              }
                
                break;
            default:
                $sql="select content from p17_firms_files where firmID=$firmID AND kind='$kind'";
                $row=_db_row($this->em,$sql);
                break;
        }
            
            if (count($row)==0) {
                $ret=false;
            } else {
                $ret=true;
            }
        
        return ($ret);
    }
}
 