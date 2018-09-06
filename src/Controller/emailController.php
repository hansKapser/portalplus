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




class emailController extends Controller
{
	/**
	* @Route("/CMIMEMail")
	*/        
    var $to;
    var $boundary =  "----=_NextPart_000_0009_01BF95E9.CDFD2060";
    var $smtp_headers;
    var $filename_real;
    var $body_plain;
    var $body_html;
    var $atcmnt=array();
    var $atcmnt_type=array();
    
    function CMIMEMail($to,$from,$subject,$priority=3) {
        $this->to=$to; $this->from=$from; $this->subject=$subject; $this->priority=$priority;
    }
    
    function  mailbody( $plain, $html= "" ) {
        $this->body_plain=$plain;
        $this->body_html=$html;
    }
    
    
    function  attachfile( $fname, $content_type ) {
        $name=ereg_replace( "(.+/)", "",$fname);
        $f=fopen($name, "r");
        //   attach($name,$content_type,$fread(filesize($f)));
        $this->atcmnt[$name]=fread($f,filesize($f));
        $this->atcmnt_type[$name]=$content_type;
        fclose($f);
    }
    
    function  attach ( $name, $content_type, $data ) {
        $this->atcmnt[$name]=$data;
        $this->atcmnt_type[$name]=$content_type;
    }
    
    function  clear() {
        unset( $atcmnt );
        unset( $atcmnt_type );
    }
    
    function  makeheader() {
        $out="From: ".$this->from."\n";
        $out.= "Reply-To: ".$this->from. "\n";
        $out.= "MIME-Version: 1.0\nContent-Type: multipart/mixed;\n boundary=\"".$this->boundary. "\"\nX-Priority: ".$this->priority. "\n";
        return $out;
    }
    
    
    function  makebody() {
        $boundary2=  "----=_NextPart_001_0009_01BF95E9.CDFD2060";
        $out= "";
        $out= "\n\n".$this->body_plain. "\n\n";
        if( $this->body_html!= "" ) {
            $out.= "--".$this->boundary. "\nContent-Type: multipart/alternative;\n boundary=$boundary2\n\n";
            $out.= "$body_plan\n--$boundary2\nContent-Type: text/plain\nContent-Transfer-Encoding: quoted-printable\n\n".$this->body_plain. "\n\n--$boundary2\nContent-Type: text/html\n".
                "Conent-Transfer-Encoding: quoted-printable\n\n$this->body_html\n\n--$boundary2--\n";
        } else {
            $out.= "--".$this->boundary. "\nContent-Type: text/plain\nContent-Transfer-Encoding: quoted-printable\n\n".$this->body_plain. "\n\n--".$this->boundary. "\n";
        }
        reset( $this->atcmnt_type);
        while( list($name, $content_type) = each($this->atcmnt_type) ) {
            $out.= "\n--".$this->boundary. "\nContent-Type: $content_type\nContent-Transfer-Encoding: base64\nContent-Disposition: attachment; filename=\"$name\"\n\n".
                chunk_split(base64_encode($this->atcmnt[$name])). "\n";
                
        }
        $out.= "--".$this->boundary. "--\n";
        return $out;
    }
    
    function  send(){
        mail( $this->to, $this->subject, $this->makebody(),$this->makeheader() );
    }
    function  sendto($email){
        mail( $email, $this->subject, $this->makebody(),$this->makeheader() );
    }
    
    function  SMTPsend($host){
        $errno=0;$errstr= "";
        //   $f=fsockopen("127.0.0.1",25,&$erno, &$errstr);
        if(!$f) {
            $this->send();
        } else {
            //SNMP commands Not finished yet
            echo fgets($f,512);
            fputs($f, "HELO host.com\n");
            echo fgets($f,512);
            fputs($f, "MAIL FROM: ".$this->from. "\n");
            echo fgets($f,512);
            fputs($f, "RCPT TO: ".$this->to). "\n";
            echo fgets($f,512);
            fputs($f, "data\n");
            echo fgets($f,512);
            fputs($f, "From: ".$this->from. "\nTo: ".$this->to. "\n".$this->makeheader().$this->makebody(). "\n\n.\n");
            fputs($f, "quit\nexit");
            
            fclose($f);
        }
    }
    
    function my_chunk_split($str)
    {
        $stmp = base64_encode($str);
        $len = strlen($stmp);
        $out =  "";
        $done=0;
        while( $done<$len ) {
            $out.=( $len-$done>76)?substr($strp,$done, 76). "\r\n":substr($strp,$done, $len-$done). "\r\n";
            $done+=76;
            
        }
        return $out;
    }
    
}
 