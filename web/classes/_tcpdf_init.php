<?php

// create new PDF document
function tcpdfRemoveParameter($string, $array_rows)
{
    $string = str_replace('$y=$pdf->getY()', '[y]=$pdf->getY()', $string);
    $string = str_replace('$x=$pdf->getX()', '[x]=$pdf->getX()', $string);
    
    $string = str_replace("\$xb=", "", $string);
    $string = str_replace("\$yb=", "", $string);
    $string = str_replace("\$xb=", "", $string);
    $string = str_replace("\$ye=", "", $string);
    
    $string = str_replace("\$w=", "", $string);
    $string = str_replace("\$x=", "", $string);
    $string = str_replace("\$y=", "", $string);
    $string = str_replace("\$h=", "", $string);
    $string = str_replace("\$border=", "", $string);
    $string = str_replace("\$ln=", "", $string);
    $string = str_replace("\$fill=", "", $string);
    $string = str_replace("\$reseth=", "", $string);
    $string = str_replace("\$autopadding=", "", $string);
    $string = str_replace("\$align=", "", $string);
    // $string=str_replace(" ","",$string);
    $string = tcpdfReplaceRows($string, $array_rows);
    $string = tcpdfEvalFunctions($string);
    $string = str_replace('"."', "", $string);
    return ($string);
}

function tcpdfReplaceRows($string, $array_rows)
{
    foreach ($array_rows as $key => $value) {
        if (gettype($value) == "array") {
            $rowName = $value;
            $fullRowName = '$' . $key;
            
            foreach ($rowName as $key => $value) {
                $fullFieldName = $fullRowName . '["' . $key . '"]';
                if (gettype($value) == "array") {
                    foreach ($rowName[$key] as $Ikey => $value) {
                        $fullItemName = $fullRowName . '[' . $key . ']' . '["' . $Ikey . '"]';
                        $string = str_replace($fullItemName, '"' . $value . '"', $string);
                    }
                } else {
                    $string = str_replace($fullFieldName, '"' . $value . '"', $string);
                }
            }
        } // valtype array
    }
    
    return ($string);
}

function tcpdfEvalFunctions($string)
{
    $z = 0;
    while (strstr($string, "sql2dddd(")) {
        $pos = strpos($string, "sql2dddd");
        $pos2 = strpos($string, ")", $pos);
        $temp = substr($string, $pos, $pos2 - $pos + 1);
        $pos = strpos($string, "(", $pos);
        $parameter = substr($string, $pos + 2, $pos2 - $pos - 3);
        $value = sql2dddd($parameter);
        
        $string = str_replace($temp, '"' . $value . '"', $string);
        $z ++;
        if ($z == 100)
            break;
    }
    
    $z = 0;
    
    while (strstr($string, "cent2euro(")) {
        $pos = strpos($string, "cent2euro");
        $pos2 = strpos($string, "),", $pos);
        $temp = substr($string, $pos, $pos2 - $pos + 1);
        $pos = strpos($string, "(", $pos);
        $parameter = substr($string, $pos + 2, $pos2 - $pos - 2);
        $parameter = str_replace('"', '', $parameter);
        $value = cent2euro($parameter);
        
        $string = str_replace($temp, '"' . $value . '"', $string);
        $z ++;
        if ($z == 100)
            break;
    }
    
    return ($string);
}

function tcpdfEval($string)
{
    // $string=str_replace("\$x=","",$string);
    // $string=str_replace("\$y=","",$string);
    // $string=str_replace("\$xb=","",$string);
    // $string=str_replace("\$yb=","",$string);
    // $string=str_replace("\$xb=","",$string);
    // $string=str_replace("\$ye=","",$string);
    // $string=str_replace("\$w=","",$string);
    $string = str_replace("\$h=", "", $string);
    $string = str_replace("\$border=", "", $string);
    $string = str_replace("\$ln=", "", $string);
    $string = str_replace("\$fill=", "", $string);
    $string = str_replace("\$reseth=", "", $string);
    $string = str_replace("\$autopadding=", "", $string);
    $string = str_replace("\$align=", "", $string);
    // $string=str_replace(" ","",$string);
    return ($string);
}

function tcpdf_init()
{
    $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
    
    $pdf->SetCreator(PDF_CREATOR);
    $pdf->SetAuthor('hk');
    $pdf->SetTitle('Druckauftrag');
    
    // set default header data
    $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE . ' 001', PDF_HEADER_STRING);
    
    // set header and footer fonts
    $pdf->setHeaderFont(Array(
        PDF_FONT_NAME_MAIN,
        '',
        PDF_FONT_SIZE_MAIN
    ));
    $pdf->setFooterFont(Array(
        PDF_FONT_NAME_DATA,
        '',
        PDF_FONT_SIZE_DATA
    ));
    
    // without header
    $pdf->setPrintHeader(false);
    $pdf->setPrintFooter(false);
    
    // set default monospaced font
    $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
    
    // set margins
    $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
    $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
    $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
    
    // set auto page breaks
    $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
    
    // set image scale factor
    $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
    
    // set default font subsetting mode
    $pdf->setFontSubsetting(true);
    
    // Set font
    // dejavusans is a UTF-8 Unicode font, if you only need to
    // print standard ASCII chars, you can use core fonts like
    // helvetica or times to reduce file size.
    $pdf->SetFont('dejavusans', '', 11, '', true);
    
    // Add a page
    // This method has several options, check the source code documentation for more information.
    // $pdf->AddPage();
    
    return ($pdf);
}

function tcpdfParser($string)
{
    $parameter = array();
    if (substr($string, 0, 6) == '$pdf->') {
        $posB = strpos($string, '(', 0);
        $tcpdfFunction = substr($string, 0, $posB);
        $tcpdfFunction = str_replace('$pdf->', '', $tcpdfFunction);
        // echo "function $tcpdfFunction <BR>";
        
        $posE = strrpos($string, ')');
        $parameterString = substr($string, $posB + 1, $posE - $posB - 1);
        $parameter = $tcpdfFunction($parameterString);
    } else {
        $tcpdfFunction = "eval";
        $parameter = $string;
    }
    
    return (array(
        $tcpdfFunction,
        $parameter
    ));
}

function writeHTMLCell($string)
{
    $arr_temp = explode(',', $string);
    if (count($arr_temp) == 11) {
        $parameter = $arr_temp;
    } else {
        // dann kommt wohl ein Komma im String vor
        
        $parameter[0] = $arr_temp[0];
        $parameter[1] = $arr_temp[1];
        $parameter[2] = $arr_temp[2];
        $parameter[3] = $arr_temp[3];
        $rpos = 0;
        for ($i = 0; $i < 4; $i ++) {
            $pos = strpos($string, ',', $pos + 1);
        }
        $string = substr($string, $pos) . "<BR>";
        
        for ($i = 0; $i < 6; $i ++) {
            $pos = strrpos($string, ',', - $rpos);
            $rpos = strlen($string) - $pos + 1;
        }
        
        $string = trim($string);
        $parameter[4] = substr($string, 1, $pos - 1);
        $arr_temp = explode(',', substr($string, $pos + 1));
        $parameter[5] = $arr_temp[0];
        $parameter[6] = $arr_temp[1];
        $parameter[7] = $arr_temp[2];
        $parameter[8] = $arr_temp[3];
        $parameter[9] = $arr_temp[4];
        $parameter[10] = $arr_temp[5];
    }
    
    return ($parameter);
}

function setFont($string)
{
    $arr_temp = explode(',', $string);
    if (count($arr_temp) == 5) {
        $parameter = $arr_temp;
    }
    return ($parameter);
}

function Image($string)
{
    $posB = strpos($string, '(');
    $posE = strpos($string, ')');
    $parameterString = substr($string, $posB + 1, $posE - $posB - 1);
    $arr_temp = explode(',', $parameterString);
    $value = '@' . getImageData($arr_temp[0], $arr_temp[1], $arr_temp[2]);
    $temp = '"@".getImageData(' . $parameterString . ')';
    $string = str_replace($temp, '[]', $string);
    
    $arr_temp = explode(',', $string);
    if (count($arr_temp) == 17) {
        $parameter = $arr_temp;
        $parameter[0] = $value;
    }
    
    return ($parameter);
}

function Line($string)
{
    $arr_temp = explode(',', $string);
    
    if (count($arr_temp) == 5) {
        $parameter = $arr_temp;
    } else {
        $parameter[0] = $arr_temp[0];
        $parameter[1] = $arr_temp[1];
        $parameter[2] = $arr_temp[2];
        $parameter[3] = $arr_temp[3];
        
        $pos = strpos($string, "array(");
        $pArray = substr($string, $pos, strlen($string) - $pos);
        $posB = strpos($pArray, "=>");
        $posE = strpos($pArray, ',', $posB);
        $substr = substr($pArray, $posB + 2, $posE - $posB - 2);
        
        $parameter[4]["width"] = $substr;
        $posB = strpos($pArray, "=>", $posE);
        $posE = strpos($pArray, ')', $posB);
        $substr = substr($pArray, $posB + 2, $posE - $posB - 2);
        $posB = strpos($substr, "(");
        $substr = substr($substr, $posB + 1);
        $arr_temp = explode(',', $substr);
        $parameter[4]["color"] = $arr_temp;
    }
    
    return ($parameter);
}

function printTcpdf($pdf, $arrayTcpdf)
{
    $y = 0;
    for ($i = 0; $i < count($arrayTcpdf); $i ++) {
        $function = $arrayTcpdf[$i][0];
        $p = $arrayTcpdf[$i][1];
        /*
         * for ($i=0;$i<count($p);$i++) {
         * $p[$i]=str_replace('$y',$y,$p[$i]);
         * }
         */
        switch ($function) {
            case "writeHTMLCell":
                $pdf->writeHTMLCell($p[0], $p[1], $p[2], $p[3], $p[4], $p[5], $p[6], $p[7], $p[8], $p[9], $p[10]);
                break;
            case "SetFont":
                
                break;
            case "Line":
                
                break;
            
            case "Image":
                
                break;
            
            case "eval":
                $arrayTcpdf[$i][1] = str_replace('[y]', '$y', $arrayTcpdf[$i][1]);
                // echo $arrayTcpdf[$i][1]."<BR>";
                eval($arrayTcpdf[$i][1]);
                break;
        }
    }
    return ($pdf);
}

?>