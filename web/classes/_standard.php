<?php

function object_to_array($data)
{
    if (is_array($data) || is_object($data)) {
        $result = array();
        foreach ($data as $key => $value) {
            $result[$key] = object_to_array($value);
        }
        return $result;
    }
    return $data;
}

function _db_rows($em, $sql)
{
    $result = $em->getConnection()->prepare($sql);
    $result->execute();
    $rows = $result->fetchAll();
    return ($rows);
}

function _db_row($em, $sql)
{
    $rows = _db_rows($em, $sql);
    if (count($rows) == 0) {
        return (array());
    } else {
        return ($rows[0]);
    }
}

function _db_write($em, $sql)
{
    $sql = "set global sql_mode='STRICT_TRANS_TABLES';" . $sql;
    
    $result = $em->getConnection()->prepare($sql);
    $result->execute();
    return (true);
}

function _db_update($em, $table, $array, $arrayWhere, $auth=false)
{
    $arrayData = array();
    
    
    if ($auth) {
        $userID=$auth->{'userID'};
    } else {
        $userID=-1;
    }
    
    //echo "userID: ".$userID;
    
    $array = transformDate2Sql($em, $table, $array,  $auth);
    
    $conn = $em->getConnection();    
    $conn->exec("SET @_userID = $userID");
    $conn->update($table, $array, $arrayWhere);
    return;
}

function _db_insert($em, $table, $array, $auth=false)
{
    
    if ($auth) {
        $userID=$auth->{'userID'};
    } else {
        $userID=-1;
    }
    
    $array = transformDate2Sql($em, $table, $array,  $auth);
    
    $conn = $em->getConnection();
    $conn->exec("set global sql_mode='STRICT_TRANS_TABLES'");
    $conn->exec("SET @_userID = $userID");
    $conn->insert($table, $array);
    $id = $conn->lastInsertId();
    return ($id);
}

function transformDate2Sql($em, $table, $array, $auth=false)
{
    $arrayData = array();
    $fields = "";
    $values = "";
    
    $sql = "SHOW COLUMNS from $table";
    $result = $em->getConnection()->prepare($sql);
    $result->execute();
    $arrayFields = $result->fetchAll();
    
    for ($i = 0; $i < count($arrayFields); $i ++) {
        $key = $arrayFields[$i]["Field"];
        $type = $arrayFields[$i]["Type"];
        if (isset($array[$key]))
            $arrayData[$key] = $array[$key];
        if (strstr(strtoupper($type), "DATE") and isset($arrayData[$key]))
            $arrayData[$key] = date2SQL($arrayData[$key]);
        if (strstr(strtoupper($type), "DECIMAL") and isset($arrayData[$key]))
            $arrayData[$key] = comma2dot($arrayData[$key]);
        if (strstr(strtoupper($type), "INT") and isset($arrayData[$key])) {
            if ($arrayData[$key] == "")
                $arrayData[$key] = 0;
        }
    }
    
    return ($arrayData);
}

function mysqlFieldList($em, $table)
{
    $sql = "SHOW COLUMNS from $table";
    $result = $em->getConnection()->prepare($sql);
    $result->execute();
    $arrayFields = $result->fetchAll();
    return ($arrayFields);
}

function date2SQL($date)
{
    $time = "";
    $date = trim($date);
    if (substr($date, 4, 1) == "-" and substr($date, 7, 1) == "-")
        return ($date);
    
    if (strstr($date, " ")) {
        $pos = strpos($date, " ");
        $time = substr($date, $pos);
        $date = substr($date, 0, $pos);
    }
    $arr_temp = explode(".", $date);
    if (count($arr_temp) == 3) {
        return ($arr_temp[2] . "-" . $arr_temp[1] . "-" . $arr_temp[0] . $time);
    } else {
        if ($date == '') {
            return (null);
        } else {
            return ($date);
        }
    }
}

function sql2dddd($date)
{
    $time = "";
    if (strstr($date, " ")) {
        $arr_temp = explode(" ", $date);
        $date = $arr_temp[0];
        $time = $arr_temp[1];
    }
    
    $arr_temp = explode("-", $date);
    if (count($arr_temp)>=3) {
    $dateGerman = $arr_temp[2] . "." . $arr_temp[1] . "." . $arr_temp[0];
    if ($time != "") {
        $dateGerman .= " " . substr($time, 0, 5);
    }
    } else {
        $dateGerman=$date;
    }
    return ($dateGerman);
}

function dateAdd($date, $days)
{
    $date = date2SQL($date);
    if ($days > 0) {
        $newDate = date('Y-m-d', strtotime($date . ' + ' . $days . ' days'));
    } else {
        $newDate = date('Y-m-d', strtotime($date . ' - ' . $days . ' days'));
    }
    return ($newDate);
}

function comma2dot($value)
{
    if ($value == "")
        return (0);
    
    if (strpos($value, ",") < 0 and strpos($value, ".") < 0)
        return ($value);
    
    if (strpos($value, ",") < 0 and strpos($value, ".") >= 0) {
        return ($value);
    }
    
    if (strpos($value, ",") >= 0 and strpos($value, ".") >= 0)
        $value = str_replace(".", "", $value);
    
    if (strpos($value, ",") >= 0 and strpos($value, ".") < 0)
        $value = str_replace(",", ".", $value);
    
    $value = str_replace(",", ".", $value);
    
    return ($value);
}

function cent2euro($value)
{
    if (strpos($value, ".") < strpos($value, ","))
        return ($value);
    if (! strpos($value, ".")) {
        $value = $value / 100;
        if (! strpos($value, "."))
            $value .= ".00";
    }
    $value = str_replace('.', ',', $value);
    return ($value);
}

function getArticle($em, $supplier_firmID, $kind)
{
    switch ($kind) {
        case "S":
            $query = "select * from p17_article where firmID=$supplier_firmID AND kind='S'";
            $queryG = "select distinct g.* from p17_article a, p17_article_group g
		where
		a.firmID=$supplier_firmID AND
		g.firmID=$supplier_firmID AND
		g.id=a.group_id AND
		a.kind='S'";
            break;
        case "P":
            $query = "select * from p17_article where firmID=$supplier_firmID AND kind='P'";
            $queryG = "select distinct g.* from p17_article a, p17_article_group g
		where
		a.firmID=$supplier_firmID AND
		g.firmID=$supplier_firmID AND
		g.id=a.group_id AND
		a.kind='P'";
            break;
        default:
            $query = "select * from p17_article where firmID=$supplier_firmID";
            $queryG = "select * from p17_article_group g where g.firmID=$supplier_firmID";
            break;
    }
    
    $rowsAGroups = _db_rows($em, $queryG);
    
    $rowsArticle = _db_rows($em, $query);
    
    $query = "select v.* from p17_article_variation v,p17_article_variation_group g where g.firmID=$supplier_firmID AND v.variation_group_id=g.id";
    $rowsVariations = _db_rows($em, $query);
    
    $query = "select * from p17_article_variation_group a where a.firmID=$supplier_firmID";
    $rowsVGroup = _db_rows($em, $query);
    
    $query = "select s.* from p17_article a, p17_article_variation_spec s
		where
		a.firmID=$supplier_firmID AND
		a.id=s.article_id";
    $rowsSpec = _db_rows($em, $query);
    
    $query = "select s.* from p17_article a, p17_article_set s
		where
		a.firmID=$supplier_firmID AND
		s.set_article_id=a.id";
    $rowsSet = _db_rows($em, $query);
    
    $array["rowsAGroups"] = $rowsAGroups;
    $array["rowsArticle"] = $rowsArticle;
    $array["rowsVariations"] = $rowsVariations;
    $array["rowsVGroup"] = $rowsVGroup;
    $array["rowsSpec"] = $rowsSpec;
    $array["rowsSet"] = $rowsSet;
    
    return ($array);
}

function orderID2ticketID($em, $orderID, $book)
{
    if ($book == "P") {
        $table = "p17_purchasebook";
    } else {
        $table = "p17_orderbook";
    }
    $sql = "select ticketID from $table
            where
            orderID=$orderID";
    $row = _db_row($em, $sql);
    return ($row["ticketID"]);
}

function distance($em, $firmID1, $firmID2)
{
    $sql = "select postcode from p17_firms
            where
            firmID=$firmID1 OR firmID=$firmID2";
    $rows = _db_rows($em, $sql);
    $postcode1 = strzero($rows[0]["postcode"], 5);
    $postcode2 = strzero($rows[1]["postcode"], 5);
    $sql = "select km from p17_distances
            where
            postcode1='$postcode1' AND
            postcode2='$postcode2' OR
            postcode2='$postcode1' AND
            postcode1='$postcode2'";
    $row = _db_row($em, $sql);
    return ($row["km"]);
}

function dispatchCost($em, $firmID, $means, $km, $sum_weight, $sum_value)
{
    $sum_weight = comma2dot($sum_weight);
    $sum_value = comma2dot($sum_value);
    
    $array = array();
    
    switch ($means) {
        case "LKW":
            $sql = "select truck_cost_fix,truck_cost_km,truck_cost_insurance
                    from p17_firms
                    where 
                    firmID=$firmID";
            $row = _db_row($em, $sql);
            $array["truck_cost_fix"] = $row["truck_cost_fix"];
            $array["truck_cost_netValue"] = $sum_value;
            $array["truck_cost_km"] = $row["truck_cost_km"];
            $array["truck_cost_km_total"] = $row["truck_cost_km"] * $km;
            $array["truck_cost_insurance"] = $row["truck_cost_insurance"];
            $array["truck_cost_insurance_total"] = $row["truck_cost_insurance"] * $sum_value / 10000;
            $array["truck_cost_total"] = $array["truck_cost_fix"] + $array["truck_cost_km_total"] + $array["truck_cost_insurance_total"];
            break;
        case "BaySped":
            $sum_weight = min($sum_weight, 3000);
            $km = min($km, 3001);
            
            $sql = "select price  
                    from p17_baysped_carriage_home
                    where
                    weight>=$sum_weight
                    order by weight asc limit 1";
            $row = _db_row($em, $sql);
            $array["baySped_cost_carriage_home"] = $row["price"];
            
            $sql = "select price
                    from p17_baysped_freightage
                    where
                    weight>=$sum_weight AND
                    km>=$km
                    order by km asc, weight asc limit 1";
            $row = _db_row($em, $sql);
            
            $array["baySped_cost_freightage"] = $row["price"];
            $array["baySped_cost_papers"] = 1;
            $array["baySped_cost_SVR_percentage"] = 0.08;
            $array["baySped_cost_netValue"] = $sum_value;
            $array["baySped_cost_SVR"] = 0.008 / 1000 * $sum_value;
            $array["baySped_cost_freightage"] = $row["price"];
            $array["baySped_cost_total"] = $array["baySped_cost_carriage_home"] + $array["baySped_cost_freightage"];
            
            break;
    }
    
    return ($array);
}

function schoolYears($em, $firmID, $table, $field = "date", $year = 1959)
{
    $array = array();
    if ($year == 1959) {
        $sql = "select $field from $table order by $field desc limit 1";
        $row = _db_row($em, $sql);
        $year = substr($row[$field], 0, 4);
        if (substr($row[$field], 5, 2) <= '08')
            $year --;
        
        $sql = "select left($field,4) as year
                from $table
                where
                firmID=$firmID AND
                left($field,4)<='$year'
                order by $field desc";
    } else {
        
        $from = strzero($year,4) . "-01-09";
        $year ++;
        $to = strzero($year,4) . "-31-08";
        
        $sql = "select left($field,4) as year
                from $table
                where
                firmID=$firmID AND
                $field>='$from' AND
                $field<='$to'
                order by $field desc limit 1";
    }
    
    $rows = _db_rows($em, $sql);
    
    $z = - 1;
    for ($i = 0; $i < count($rows); $i ++) {
        $year = $rows[$i]["year"];
        $from = strzero($year,4) . "-01-09";
        $year ++;
        $to = strzero($year,4) . "-31-08";
        $in = false;
        for ($ii = 0; $ii < count($array); $ii ++) {
            if ($array[$ii]["from"] == $from)
                $in = true;
        }
        
        if (! $in) {
            $array[++ $z]["year"] = substr($from, 0, 4);
            $array[$z]["value"] = $array[$z]["year"];
            $array[$z]["label"] = 'Schuljahr ' . substr($from, 0, 4) . '/' . substr($to, 0, 4);
            $array[$z]["from"] = $from;
            $array[$z]["to"] = $to;
        }
    }
    if (count($array)==0) {
        $from="0000-00-00";
        $to="0000-00-00";
        $array[++ $z]["year"] = substr($from, 0, 4);
        $array[$z]["value"] = $array[$z]["year"];
        $array[$z]["label"] = 'Schuljahr ' . substr($from, 0, 4) . '/' . substr($to, 0, 4);
        $array[$z]["from"] = $from;
        $array[$z]["to"] = $to;
    }
    return ($array);
}

function schoolYearsEurobank($em, $secondNumber, $table, $field = "date", $year = 1959)
{
    $array = array();
    if ($year == 1959) {
        $sql = "select $field from $table order by $field desc limit 1";
        $row = _db_row($em, $sql);
        $year = substr($row[$field], 0, 4);
        if (substr($row[$field], 5, 2) <= '08')
            $year --;
            
            $sql = "select left($field,4) as year
                from $table T
                where
                T.senderNumber=$secondNumber  AND
                left($field,4)<='$year' OR
			    T.remitteeNumber=$secondNumber AND
                left($field,4)<='$year'
                order by $field desc";
    } else {
        
        $from = strzero($year,4) . "-01-09";
        $year ++;
        $to = strzero($year,4) . "-31-08";
        
        $sql = "select left($field,4) as year
                from $table T
                where
                T.senderNumber=$secondNumber  AND
                $field>='$from' AND
                $field<='$to' OR
			    T.remitteeNumber=$secondNumber AND
                $field>='$from' AND
                $field<='$to'
                order by $field desc limit 1";
    }
    
    $rows = _db_rows($em, $sql);
    
    $z = - 1;
    for ($i = 0; $i < count($rows); $i ++) {
        $year = $rows[$i]["year"];
        $from = strzero($year,4) . "-01-09";
        $year ++;
        $to = strzero($year,4) . "-31-08";
        $in = false;
        for ($ii = 0; $ii < count($array); $ii ++) {
            if ($array[$ii]["from"] == $from)
                $in = true;
        }
        
        if (! $in) {
            $array[++ $z]["year"] = substr($from, 0, 4);
            $array[$z]["value"] = $array[$z]["year"];
            $array[$z]["label"] = 'Schuljahr ' . substr($from, 0, 4) . '/' . substr($to, 0, 4);
            $array[$z]["from"] = $from;
            $array[$z]["to"] = $to;
        }
    }
    if (count($array)==0) {
        $from="0000-00-00";
        $to="0000-00-00";
        $array[++ $z]["year"] = substr($from, 0, 4);
        $array[$z]["value"] = $array[$z]["year"];
        $array[$z]["label"] = 'Schuljahr ' . substr($from, 0, 4) . '/' . substr($to, 0, 4);
        $array[$z]["from"] = $from;
        $array[$z]["to"] = $to;
    }
    return ($array);
}

function schoolYearsPF($em, $email, $table, $field = "date", $year = 1959)
{
    $array = array();
    if ($year == 1959) {
        $sql = "select $field from $table order by $field desc limit 1";
        $row = _db_row($em, $sql);
        $year = substr($row[$field], 0, 4);
        if (substr($row[$field], 5, 2) <= '08')
            $year --;
            
            $sql = "select left($field,4) as year
                from $table
                where
                sender='$email' AND
                left($field,4)<='$year' OR
                receiver='$email' AND
                left($field,4)<='$year'
                order by $field desc";
    } else {
        
        $from = strzero($year,4) . "-01-09";
        $year ++;
        $to = strzero($year,4) . "-31-08";
        
        $sql = "select left($field,4) as year
                from $table
                where
                sender='$email' AND
                $field>='$from' AND
                $field<='$to' OR
                receiver='$email' AND
                $field>='$from' AND
                $field<='$to'
                order by $field desc limit 1";
    }
    
    $rows = _db_rows($em, $sql);
    
    $z = - 1;
    for ($i = 0; $i < count($rows); $i ++) {
        $year = $rows[$i]["year"];
        $from = strzero($year,4) . "-01-09";
        $year ++;
        $to = strzero($year,4) . "-31-08";
        $in = false;
        for ($ii = 0; $ii < count($array); $ii ++) {
            if ($array[$ii]["from"] == $from)
                $in = true;
        }
        
        if (! $in) {
            $array[++ $z]["year"] = substr($from, 0, 4);
            $array[$z]["value"] = $array[$z]["year"];
            $array[$z]["label"] = 'Schuljahr ' . substr($from, 0, 4) . '/' . substr($to, 0, 4);
            $array[$z]["from"] = $from;
            $array[$z]["to"] = $to;
        }
    }
    if (count($array)==0) {
        $from="0000-00-00";
        $to="0000-00-00";
        $array[++ $z]["year"] = substr($from, 0, 4);
        $array[$z]["value"] = $array[$z]["year"];
        $array[$z]["label"] = 'Schuljahr ' . substr($from, 0, 4) . '/' . substr($to, 0, 4);
        $array[$z]["from"] = $from;
        $array[$z]["to"] = $to;
    }
    return ($array);
}

function getImageData($em, $firmID, $kind, $article_id, $variation1_id = 0, $variation2_id = 0)
{
    // echo "firmID: $firmI<BR>kind: $kind<BR>article_id: $article_id";
    $numargs = func_num_args();
    if ($numargs == 4) {
        $variation2_id = 0;
    }
    
    if ($numargs == 3) {
        $variation1_id = 0;
        $variation2_id = 0;
    }
    
    switch ($kind) {
        case "image":
            $query = "select content
		from p17_article_images
		where firmID=$firmID AND
		article_id=$article_id AND
		variation1_id=$variation1_id AND
		variation2_id=$variation2_id";
            break;
        default:
            $query = "select content from p17_firms_files where firmID=$firmID AND kind='$kind'";
            break;
    }
    $rows = _db_rows($em, $query);
    if (count($rows) == 0) {
        $query = "select content
		from p17_article_images
		where firmID=$firmID AND
		article_id=$article_id";
        $rows = _db_rows($em, $query);
        
        if (count($rows) == 0) {
            // dummy for empty images
            $query = "select content from p17_article_images where firmID=326 AND article_id=0";
            $rows = _db_rows($em, $query);
        }
    }
    return ($rows[0]["content"]);
}

function workflowStatusUpdate($em, $ticketID, $needle)
{
    $sql = "select workflowStatus from p17_tickets where ticketID=$ticketID";
    $row = _db_row($em, $sql);
    $workflowStatus = $row["workflowStatus"];
    $haystack = explode(",", $workflowStatus);
    $string = "";
    if (in_array($needle, $haystack))
        return;
    
    for ($i = 0; $i < count($haystack); $i ++) {
        if ($string != "")
            $string .= ",";
        $string .= $haystack[$i];
    }
    
    if ($string != "")
        $string .= ",";
    
    $string .= $needle;
    $array = array();
    $array["workflowStatus"] = $string;
    $arrayWhere = array(
        "ticketID" => $ticketID
    );
    
    _db_update($em, "p17_tickets", $array, $arrayWhere, $auth);
    return;
}

function strzero($value, $len)
{
    if (strlen($value) >= $len)
        return ($value);
    $value = (int) $value;
    
    return (str_repeat('0', $len - strlen($value)) . $value);
}

/*
 * stock funcktion
 *
 */
function stock($row, $rowsStock)
{
    $array["available"] = 0;
    $array["real"] = 0;
    
    for ($i = 0; $i < count($rowsStock); $i ++) {
        if ($row["article_id"] == $rowsStock[$i]["article_id"] and $row["variation1_id"] == $rowsStock[$i]["variation1_id"] and $row["variation2_id"] == $rowsStock[$i]["variation2_id"]) {
            $array["available"] = $rowsStock[$i]["sum_in"] - $rowsStock[$i]["sum_res"];
            $array["real"] = $rowsStock[$i]["sum_in"] - $rowsStock[$i]["sum_out"];
            break;
        }
    }
    return ($array);
}

function emptyRowStock($rows, $i)
{
    $return = true;
    
    if ($rows[$i]["available"] + $rows[$i]["realy"] + $rows[$i]["reorder_stock"] != 0)
        return (false);
    $article_code = $rows[$i]["article_code"];
    
    for ($ii = 0; $ii < count($rows); $ii ++) {
        if ($i != $ii and $rows[$ii]["article_code"] == $article_code) {
            if ($rows[$ii]["available"] + $rows[$ii]["realy"] + $rows[$ii]["reorder_stock"] != 0) {
                $return = false;
                break;
            }
        }
    }
    
    return ($return);
}

function stock_ratios($em, $article_id, $variation1_id, $variation2_id)
{
    // get some json data
    $array = array();
    $array["opening"] = 0;
    $sql = "select l.quantity as opening
	from p17_stock_transaction l,p17_article a
	where
	a.id=$article_id AND
	l.article_id=a.id AND
	l.transaction='I'
	order by l.date asc limit 1";
    $row = _db_row($em, $sql);
    
    if (isset($row["opening"])) {
        $array["opening"] = $row["opening"];
    }
    
    $sql = "select
		sum(if(l.transaction='I',l.quantity,0)) as sum_in,
		sum(if(l.transaction='O',l.quantity,0)) as sum_out,
		sum(if(l.transaction='R',l.quantity,0)) as sum_res
		from p17_stock_transaction l,p17_article a
		where
		a.id=$article_id AND
		a.id=l.article_id AND
		l.variation1_id=$variation1_id AND
		l.variation2_id=$variation2_id";
    $row = _db_row($em, $sql);
    $array["closing"] = $row["sum_in"] - $row["sum_out"];
    $array["average"] = ($array["closing"] - $array["opening"]) / 2;
    return ($array);
}

function getArticleStatistic($em, $article_id, $variation1_id, $variation2_id, $spec = true)
{
    if ($spec) {
        $sql = "select sum(if(transaction='O',quantity,0)) as sum_out
		from p17_stock_transaction l
		where
        l.article_id=$article_id AND
        l.variation1_id=$variation1_id AND
        l.variation2_id=$variation2_id
		group by l.article_id,l.variation1_id,l.variation2_id";
    } else {
        $sql = "select sum(if(transaction='O',quantity,0)) as sum_out
		from p17_stock_transaction l
		where
        l.article_id=$article_id
		group by l.article_id";
    }
    
    $rowStatistic = _db_row($em, $sql);
    if (isset($rowStatistic["sum_out"])) {
        $rowStatistic["totalConsumption"] = $rowStatistic["sum_out"];
        
        if ($spec) {
            $sql = "select date from p17_stock_transaction l
		where
        l.article_id=$article_id AND
        l.variation1_id=$variation1_id AND
        l.variation2_id=$variation2_id AND
        l.transaction='I'
        order by date asc limit 1";
        } else {
            $sql = "select date from p17_stock_transaction l
		where
        l.article_id=$article_id AND
        l.transaction='I'
        order by date asc limit 1";
        }
        $row = _db_row($em, $sql);
        if (count($row) > 0) {
            $firstIn = $row["date"];
        } else {
            $firstIn = "2018-01-01";
        }
        
        if ($spec) {
            $sql = "select date from p17_stock_transaction l
		where
        l.article_id=$article_id AND
        l.variation1_id=$variation1_id AND
        l.variation2_id=$variation2_id AND
        l.transaction='O'
        order by date desc limit 1";
        } else {
            $sql = "select date from p17_stock_transaction l
		where
        l.article_id=$article_id AND
        l.transaction='O'
        order by date desc limit 1";
        }
        
        $row = _db_row($em, $sql);
        
        if (count($row) > 0) {
            $lastOut = $row["date"];
        } else {
            $lastOut = date('Y-m-d');
        }
        
        $yearB = substr($firstIn, 0, 4);
        $yearE = substr($lastOut, 0, 4);
        $monthB = substr($firstIn, 5, 2);
        $monthE = substr($lastOut, 5, 2);
        
        if ($monthB > $monthE) {
            $month = 12 - $monthB + 1 + $monthE + (($yearE - $yearB) * 12);
        } else {
            $month = $monthE - $monthB + 1 + (($yearE - $yearB) * 12);
        }
        if ($month != 0) {
            $rowStatistic["monthlyConsumption"] = max(0, $rowStatistic["sum_out"] / $month);
        } else {
            $rowStatistic["monthlyConsumption"] = 0;
        }
    } else {
        // endif isset($rowStatistic
        $rowStatistic["totalConsumption"] = 0;
        $rowStatistic["monthlyConsumption"] = 0;
    }
    
    if ($spec) {
        $sql = "select left(date,7) as month,
        sum(if(transaction='I',quantity,0)) as sum_in,
		sum(if(transaction='O',quantity,0)) as sum_out
		from p17_stock_transaction l
		where
        l.article_id=$article_id AND
        l.variation1_id=$variation1_id AND
        l.variation2_id=$variation2_id
		group by left(date,7) order by left(date,7) asc";
    } else {
        $sql = "select left(date,7) as month,
        sum(if(transaction='I',quantity,0)) as sum_in,
		sum(if(transaction='O',quantity,0)) as sum_out
		from p17_stock_transaction l
		where
        l.article_id=$article_id
		group by left(date,7) order by left(date,7) asc";
    }
    $rows = _db_rows($em, $sql);
    
    $total = 0;
    $aStock = 0;
    for ($i = 0; $i < count($rows); $i ++) {
        if ($i == 0) {
            $rows[$i]["SB"] = $rows[$i]["sum_in"] - $rows[$i]["sum_out"];
            $total += $rows[$i]["SB"];
        } else {
            $rows[$i]["SB"] = $rows[$i - 1]["SB"] + $rows[$i]["sum_in"] - $rows[$i]["sum_out"];
        }
        $aStock = $total / count($rows);
    }
    
    if ($aStock != 0) {
        $rowStatistic["turnoverRatio"] = $rowStatistic["totalConsumption"] / $aStock;
    } else {
        $rowStatistic["turnoverRatio"] = 0;
    }
    
    return ($rowStatistic);
}

function isHAWALI($em, $firmID)
{
    $sql = "select firmID from p17_firms where firmID=$firmID AND virtualFirm=1";
    $row = _db_row($em, $sql);
    if (count($row) == 0) {
        return - 1;
    } else {
        return $row["firmID"];
    }
}

function isKK($em, $firmID)
{
    $sql = "select firmID from p17_firms where firmID=$firmID AND virtualFirm=2";
    $row = _db_row($em, $sql);
    if (count($row) == 0) {
        return - 1;
    } else {
        return $row["firmID"];
    }
}

function calcInvoice($em, $rowOrder, $rowsPosition)
{
    $VATrate = 19;
    $VATrateReduced = 7;
    
    $merchandiseNetVn = 0;
    $merchandiseNetVr = 0;
    $packageNetVn = 0;
    $packageNetVr = 0;
    $dispatchNetVn = 0;
    $dispatchNetVr = 0;
    $NetVn = 0;
    $NetVr = 0;
    $VATn = 0;
    $VATr = 0;
    $grossValue = 0;
    $tradeDiscount = 0;
    $paymentAmount = 0;
    
    $termPayment = $rowOrder["termPayment"];
    $sql = "select * from p17_terms_of_payment
            where
            id=$termPayment";
    $rowTermPayment = _db_row($em, $sql);
    $row = _db_row($em, $sql);
    $percentageTermPayment = $row["discount"];
    
    $packingCost = $rowOrder["packingCost"];
    $shippingCosts = $rowOrder["shippingCosts"]["baySped_cost_total"];
    
    for ($i = 0; $i < count($rowsPosition); $i ++) {
        $price = $rowsPosition[$i]["price"];
        $quantity = $rowsPosition[$i]["quantity"];
        $discount = $rowsPosition[$i]["discount"];
        $percentage = $rowsPosition[$i]["percentage"];
        
        if ($percentage == $VATrate or $percentage == $VATrateReduced / 100) {
            $merchandiseNetVn += $quantity * $price * (1 - $discount / 100);
        } else {
            $merchandiseNetVr += $quantity * $price * (1 - $discount / 100);
        }
    }
    
    if ($packingCost != 0) {
        
        if ($merchandiseNetVn != 0 and $merchandiseNetVr == 0)
            $packageNetVn = $packingCost;
        if ($merchandiseNetVn == 0 and $merchandiseNetVr != 0)
            $packageNetVr = $packingCost;
        if ($merchandiseNetVn != 0 and $merchandiseNetVr != 0) {
            $partPercentVn = $merchandiseNetVn / ($merchandiseNetVn + $merchandiseNetVr);
            $packageNetVn = $packingCost * $partPercentVn;
            $packageNetVr = $packingCost - $packageNetVn;
        }
    }
    
    if ($shippingCosts != 0) {
        if ($merchandiseNetVn != 0 and $merchandiseNetVr == 0)
            $dispatchNetVn = $shippingCosts;
        
        if ($merchandiseNetVn == 0 and $merchandiseNetVr != 0)
            $dispatchNetVr = $shippingCosts;
        if ($merchandiseNetVn != 0 and $merchandiseNetVr != 0) {
            $partPercentVn = $merchandiseNetVn / ($merchandiseNetVn + $merchandiseNetVr);
            $dispatchNetVn = $shippingCosts * $partPercentVn;
            $dispatchNetVr = $shippingCosts - $dispatchNetVn;
        }
    }
    
    $NetVn = $merchandiseNetVn + $packageNetVn + $dispatchNetVn;
    $NetVr = $merchandiseNetVr + $packageNetVr + $dispatchNetVr;
    $VATn = $NetVn * $VATrate / 100;
    $VATr = $NetVr * $VATrateReduced / 100;
    
    $grossValue = $NetVn + $NetVr + $VATn + $VATr;
    
    $tradeDiscount = $percentageTermPayment / 100 * ($merchandiseNetVn * (1 + $VATrate / 100) + $merchandiseNetVr * (1 + ($VATrateReduced / 100)));
    $paymentAmount = $grossValue - $tradeDiscount;
    
    $array = array();
    $array["merchandiseNetVn"] = $merchandiseNetVn;
    $array["merchandiseNetVr"] = $merchandiseNetVr;
    $array["packageNetVn"] = $packageNetVn;
    $array["packageNetVr"] = $packageNetVr;
    $array["dispatchNetVn"] = $dispatchNetVn;
    $array["dispatchNetVr"] = $dispatchNetVr;
    $array["NetVn"] = $NetVn;
    $array["NetVr"] = $NetVr;
    $array["VATn"] = $VATn;
    $array["VATr"] = $VATr;
    $array["grossValue"] = $grossValue;
    $array["tradeDiscount"] = $tradeDiscount;
    $array["paymentAmount"] = $paymentAmount;
    
    return ($array);
}

function newVoucherNo($em, $table, $field, $firmID)
{
    $sql = "select right($field,5) as newVoucherNo
                from $table
                where firmID=$firmID
                order by right($field,5) desc limit 1";
    $row = _db_row($em, $sql);
    if (count($row) == 0) {
        $newVoucherNo = substr(date('Y'), 3, 1) . "0001";
    } else {
        $y = substr($row["newVoucherNo"], 3, 1);
        if ($y != substr(date('Y'), 3, 1)) {
            $v = 1;
        } else {
            $v = substr($row["newVoucherNo"], 1);
        }
        
        $newVoucherNo = substr(date('Y'), 3, 1) . strzero($v, 4);
    }
    return ($newVoucherNo);
}
      
?>