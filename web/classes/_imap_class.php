<?php


function getEmailAccount() {
// get via SESSION-vars from mysql 
	
$firmID=json_decode($_SESSION["auth"])->{'firmID'};	
$query="select email,emailPass from p17_firms where firmID=$firmID";
$rows=_db_rows($query)	;
$array["user"]=$rows[0]["email"];
$array["password"]=$rows[0]["emailPass"];
return ($array);
}

function getMessageList() {
$array=array();


$array_account=getEmailAccount();	
$mbox = imap_open("{mail.your-server.de:143}", $array_account["user"], $array_account["password"]);

/* structure of header
seen, date * as unixTimestamp, from, subject
*/
$array_headers = imap_fetch_overview($mbox,"1:{$MC->Nmsgs}",0);
$array_headers=object_to_array($array_headers);

return ($array_headers);
}

function getMessage($mbox,$uid) {
    $string=getBody($mbox,$uid);
    
    $structure = imap_fetchstructure($mbox,$uid,FT_UID);
    
    $attachments = array();
    
    if(isset($structure->parts) && count($structure->parts)) {
        for($i = 0; $i < count($structure->parts); $i++) {
            
            $attachments[$i] = array(
                'is_attachment' => false,
                'filename' => '',
                'name' => '',
                'attachment' => '');
            
            if($structure->parts[$i]->ifdparameters) {
                foreach($structure->parts[$i]->dparameters as $object) {
                    if(strtolower($object->attribute) == 'filename') {
                        $attachments[$i]['is_attachment'] = true;
                        $attachments[$i]['name'] = $object->value;
                        
                    }
                }
            }
            
            if($structure->parts[$i]->ifparameters) {
                foreach($structure->parts[$i]->parameters as $object) {
                    if(strtolower($object->attribute) == 'name') {
                        $attachments[$i]['is_attachment'] = true;
                        $attachments[$i]['name'] = $object->value;
                    }
                }
            }
            
            if($attachments[$i]['is_attachment']) {
                $attachments[$i]['attachment'] = imap_fetchbody($mbox, $uid, $i+1,FT_UID);
                if($structure->parts[$i]->encoding == 3) { // 3 = BASE64
                    $attachments[$i]['attachment'] = base64_decode($attachments[$i]['attachment']);
                }
                elseif($structure->parts[$i]->encoding == 4) { // 4 = QUOTED-PRINTABLE
                    $attachments[$i]['attachment'] = quoted_printable_decode($attachments[$i]['attachment']);
                }
            }
        } // for($i = 0; $i < count($structure->parts); $i++)
    } // if(isset($structure->parts) && count($structure->parts))
    $files=array();
    
    for ($i=0;$i<count($attachments);$i++) {
        if ($attachments[$i]["name"]!='') {
            $files[]["filename"]=$attachments[$i]["name"];
            $files[count($files)-1]["name"]=iconv_mime_decode($attachments[$i]["name"]);
        }
        
    }
    //$string=htmlFilter($string);
    //$string=imap_qprint($string);
    $array[0]=$string;
    $array[1]=$files;
    
    return ($array);
    
}

function getMessage1($mbox,$uid) {

$array=array();
$array_body=array();

	 
	$string=imap_fetchbody($mbox, $uid,1,FT_UID);
	$string=getBody($mbox,$uid);

	
	$structure = imap_fetchstructure($mbox,$uid,FT_UID);
	$string = _encodeMessage($string, $structure->encoding);
	
	$attachments = array();

		if(isset($structure->parts) && count($structure->parts)) {
         for($i = 0; $i < count($structure->parts); $i++) {
			 
           $attachments[$i] = array(
              'is_attachment' => false,
              'filename' => '',
              'name' => '',
              'attachment' => '');

           if($structure->parts[$i]->ifdparameters) {
             foreach($structure->parts[$i]->dparameters as $object) {
               if(strtolower($object->attribute) == 'filename') {
                 $attachments[$i]['is_attachment'] = true;
                 $attachments[$i]['name'] = $object->value;

               }
             }
           }

           if($structure->parts[$i]->ifparameters) {
             foreach($structure->parts[$i]->parameters as $object) {
               if(strtolower($object->attribute) == 'name') {
                 $attachments[$i]['is_attachment'] = true;
                 $attachments[$i]['name'] = $object->value;
               }
             }
           }

           if($attachments[$i]['is_attachment']) {
             $attachments[$i]['attachment'] = imap_fetchbody($mbox, $uid, $i+1,FT_UID);
             if($structure->parts[$i]->encoding == 3) { // 3 = BASE64
               $attachments[$i]['attachment'] = base64_decode($attachments[$i]['attachment']);
             }
             elseif($structure->parts[$i]->encoding == 4) { // 4 = QUOTED-PRINTABLE
               $attachments[$i]['attachment'] = quoted_printable_decode($attachments[$i]['attachment']);
             }
           }             
         } // for($i = 0; $i < count($structure->parts); $i++)
       } // if(isset($structure->parts) && count($structure->parts))
 


	if (strstr($string,"quoted-printable") OR strstr($string,"=E4")  OR strstr($string,"=DC")) {
	$dec = quoted_printable_decode($string);
	$string = mb_convert_encoding($dec, "UTF-8", "iso-8859-1");
	
	$pos=strpos($string,"quoted-printable");
	if ($pos>0) $string=substr($string,$pos+17);
	}
	
	$files=array();

	for ($i=0;$i<count($attachments);$i++) {
		if ($attachments[$i]["name"]!='') { 
		$files[]["filename"]=$attachments[$i]["name"];
		$files[count($files)-1]["name"]=iconv_mime_decode($attachments[$i]["name"]);
		}

	}
	//$string=htmlFilter($string);
	$string=imap_qprint($string);
	$array[0]=$string;
	$array[1]=$files;
	
return ($array);
}

function htmlFilter($string) {
$returnString="";
$nextPart="";
$ende=false;
	
	$arr_temp=explode("\n",$string);
	for ($i=0;$i<count($arr_temp);$i++) {
		if (trim($arr_temp[$i])!="") {
		if ($nextPart!="" AND substr(trim($arr_temp[$i]),0,16)."-"==$nextPart)
			break;
		
			switch (substr(trim($arr_temp[$i]),0,16)) {
				case "------=_NextPart":
					if ($returnString!="")
						$ende=true;;
					
					if (trim($arr_temp[$i+1])=="Content-Type: text/html") {
						$NextPart=trim($arr_temp[$i]);
						$i+=2;
					} else {
						$i+=1;
					}
				break;
				default:
				$returnString.=trim($arr_temp[$i])."<BR>";
				break;
			}
			if ($ende) break;
		}
	}

		return ($returnString);
}

function getAttachment($mbox,$uid) {

$output = '';



    /* get information specific to this email */
    //$overview = imap_fetch_overview($mbox,$uid,0);
    //$message = imap_fetchbody($mbox,$uid,2,FT_UID);
    $structure = imap_fetchstructure($mbox,$uid,FT_UID);
    

    //print $overview;


     $attachments = array();
       if(isset($structure->parts) && count($structure->parts)) {
         for($i = 0; $i < count($structure->parts); $i++) {
           $attachments[$i] = array(
              'is_attachment' => false,
              'filename' => '',
              'name' => '',
              'attachment' => '');

           if($structure->parts[$i]->ifdparameters) {
             foreach($structure->parts[$i]->dparameters as $object) {
               if(strtolower($object->attribute) == 'filename') {
                 $attachments[$i]['is_attachment'] = true;
                 $attachments[$i]['name'] = $object->value;
               }
             }
           }

           if($structure->parts[$i]->ifparameters) {
             foreach($structure->parts[$i]->parameters as $object) {
               if(strtolower($object->attribute) == 'name') {
                 $attachments[$i]['is_attachment'] = true;
                 $attachments[$i]['name'] = $object->value;
               }
             }
           }

           if($attachments[$i]['is_attachment']) {
             $attachments[$i]['attachment'] = imap_fetchbody($mbox, $uid, $i+1,FT_UID);
             if($structure->parts[$i]->encoding == 3) { // 3 = BASE64
               $attachments[$i]['attachment'] = base64_decode($attachments[$i]['attachment']);
             }
             elseif($structure->parts[$i]->encoding == 4) { // 4 = QUOTED-PRINTABLE
               $attachments[$i]['attachment'] = quoted_printable_decode($attachments[$i]['attachment']);
             }
           }             
         } // for($i = 0; $i < count($structure->parts); $i++)
       } // if(isset($structure->parts) && count($structure->parts))
		   
	   $files=array();
	   $i=-1;
        foreach($attachments as $at) {
            if($at['is_attachment']==1) {
				$content=addslashes($at['attachment']);
				$filename=$at['name'];
				if ($filename!="") {
				$pos=strrpos($filename,".");
				$type=substr($filename,$pos+1);
	
				if ($type!='pdf' AND $type!='doc' AND $type!='docx') {
					if (strstr($type,'pdf')) $type='pdf';
					if (strstr($type,'doc')) $type='msword';
				}
									
					$files[++$i]["fileName"]=str_replace(' ','%20',$filename);
					$files[$i]["fileSize"]=strlen($content);
					$files[$i]["fileType"]=$type;
					$files[$i]["content"]=$content;
					
				}
			}
        }
	   
        /* 
         * @todo: alternative fieldnames in table p17_files 
         */
        for ($i=0;$i<count($files);$i++) {
            $files[$i]["name"]=$files[$i]["fileName"];
            $files[$i]["size"]=$files[$i]["fileSize"];
            $files[$i]["type"]=$files[$i]["fileType"];
        }
        
return ($files);
}

function getFolder($mbox) {
$array=array();

	$list = imap_list($mbox, "{mail.your-server.de:143}", "*");

if (is_array($list)) {
    foreach ($list as $val) {
		
        $val=imapSpecialCharsDecode($val);
		$folder=imap_utf7_decode($val);
		$folder=str_replace("{mail.your-server.de:143}","",$folder);
		$array[]=$folder;
		//$array[]=htmlspecialchars($folder);
		
    }
} else {
    echo "imap_list failed: " . imap_last_error() . "<BR>";
}

return ($array);
}

function sortImapFolders($a,$b) {
    return $a['group'].$a['label']>$b['group'].$b['label'];
}


function imapSpecialCharsDecode($string) {
 //$string=rawurlencode($string);
 return imap_qprint($string);
 
$string=str_replace("\&AOQ-","&auml;",$string);
$string=str_replace("\&APY-","&ouml;",$string);
$string=str_replace("\&APw-","&uuml;",$string); 	
$string=str_replace("\&AMQ-","&Auml;",$string); 	
$string=str_replace("\&ARN-","&Ouml;",$string); 	
$string=str_replace("\&ANw-","&Uuml;",$string); 	
$string=str_replace("\&AN8-","&szlig;",$string); 
$string=str_replace("=C3=A4","&auml;",$string);
$string=str_replace("=C3=B6","&ouml;",$string);
$string=str_replace("=C3=BC","&uuml;",$string);
$string=str_replace("=C3=9F","&szlig;",$string);

$string=str_replace("=C3=84","&Auml;",$string);
$string=str_replace("=C3=96","&Ouml;",$string);
$string=str_replace("=C3=9C","&Uuml;",$string);


return ($string);
}

function _encodeMessage($sMessage, $coding){
    
    switch($coding)
    {
        case 0:
            //$sMessage=imap_base64($sMessage);
            break;
        case 1:
            $sMessage = imap_8bit($sMessage);
            break;
        case 2:
            $sMessage = imap_binary($sMessage);
            break;
        case 3:
            echo "coding 3";
        break;
        case 4:
            $sMessage = imap_qprint($sMessage);
            break;
        case 5:
            echo "coding 5";
            break;
        case 6:
            echo "coding 6";
            break;
        case 7:
            $sMessage=imap_base64($sMessage);
            break;
    }
    return ($sMessage);
}

/* function make it pretty
 * 
*/

function getPart($stream, $msg_number, $mime_type, $structure = false, $part_number = false)
{
    if (!$structure)
        $structure = imap_fetchstructure($stream, $msg_number,FT_UID);
        
        if ($structure)
        {
            if ($mime_type == getMimeType($structure))
            {
                if (!$part_number)
                {
                    $part_number = "1";
                    $prefix="";
                }
                $text = imap_fetchbody($stream, $msg_number, $part_number,FT_UID);
                if ($structure->encoding == 3)
                {
                    return imap_base64($text);
                }
                else if ($structure->encoding == 4)
                {
                    return imap_qprint($text);
                }
                else
                {
                    return $text;
                }
            }
            if ($structure->type == 1) /* multipart */
            {
                while(list($index, $sub_structure) = each($structure->parts))
                {
                    
                    if ($part_number)
                    {
                        $prefix = $part_number . '.';
                    }
                    if (!isset($prefix)) $prefix='';
                    $sData = getPart($stream, $msg_number, $mime_type, $sub_structure, $prefix . ($index + 1));
                    if ($sData)
                    {
                        return $sData;
                    }
                    
                }
            }
        }
        return false;
}

	function getBody($mbox,$nID)  
	{
		$sBody = getPart($mbox, $nID, "TEXT/HTML");
		if ($sBody == "")
			$sBody = getPart($mbox, $nID, "TEXT/PLAIN");
		if ($sBody == "") 
			return "";
		// replace <p> tags into <br> tags
		$sBody = str_replace("</p>","<br>", $sBody);
		// strip all tags except for <b><strong><u><em><i><ul><ol><li><a><br><img>
		// if you don't need certain tags you can remove them
		$sBody = strip_tags($sBody,"<b><strong><u><em><i><ul><ol><li><a><br><img>");
		return $sBody;
	}	
	
	/**
	 * Function that reads the email
	 * @param	int		ID of the mail in de box
	 */
	/**
	 * Function to get the mime type internal private use
	 * @param	string		message text
	 */
	function getMimeType(&$structure) 
	{
		$primary_mime_type = array("TEXT", "MULTIPART", "MESSAGE", "APPLICATION", "AUDIO", "IMAGE", "VIDEO", "OTHER");

		if ($structure->subtype) 
			return $primary_mime_type[(int) $structure->type] . '/' . $structure->subtype;
		
		return "TEXT/PLAIN";
	}
	
	/**
	 * Function to get a message part of internal private use
	 * @param	string		message text
	 */
	
        ?>