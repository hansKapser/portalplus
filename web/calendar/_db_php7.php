<?php
define('DB_HOSTNAME','localhost'); // database host name
define('DB_USERNAME', 'hansk');     // database user name
define('DB_PASSWORD', 'd=ePfUe_15'); // database password
define('DB_NAME', 'portal17'); // database name 

function mysql_error() {
return ("");
}
	function _db_init() {
	$server=$_SERVER['HTTP_HOST'];
	$mysqli= new mysqli(DB_HOSTNAME, DB_USERNAME,DB_PASSWORD,DB_NAME); 
	$result = $mysqli->query("SET NAMES 'utf8'");
	return ($mysqli);
	}


	function _db_query($sql) {
		// $sql=sessionParameter($sql);	
		$mysqli=_db_init();
		$result = $mysqli->query($sql);
		$result->close();
		$mysqli->close();

	return ($result);
	}

	function _db_row($sql) {
	if ($sql=="") return ("");
//		$sql=sessionParameter($sql);	
		$mysqli=_db_init();
		$result = $mysqli->query($sql);
		$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
		$return=$row;
		$result->close();
		$mysqli->close();
		return ($return);
	}

	function _db_rows($sql) {
//		$sql=sessionParameter($sql);	
		$return=array();
		$mysqli=_db_init();
		$result = $mysqli->query($sql);
		
		while ($row = mysqli_fetch_array($result,MYSQLI_ASSOC) ) {

		$return[]=$row;
		}
		
		if ($mysqli->error!="") echo $sql;
		
		$result->close();
		$mysqli->close();
		return ($return);
	}

	
	function _db_rows_multi($sqlArray) {
		/*
		$sqlArray[$i]["query"];
		*/
	$i=0;
	$sqlArray[$i]["query"]  = "SELECT * from p17_firms where firmID=326;";
	$sqlArray[$i]["table"]="firms";
	$sqlArray[++$i]["query"] = "SELECT u.*,f.company from p17_user u, p17_firms f where f.firmID=u.firmID limit 2";
	$sqlArray[$i]["table"]="user";
	$query="";
		foreach ($sqlArray as $array) {
			$query.=$array["query"];
			}
	
	$mysqli=_db_init();
	if ($mysqli->multi_query($query)) {
		$mysqli->error;

$i=-1;
		
	do {
		$i++;
        /* store first result set */
        if ($result = $mysqli->store_result()) {
			
			while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
				$sqlArray[$i]["rows"][]=$row;
            }
    
	$result->free();
        }
        /* print divider */
        if ($mysqli->more_results()) {
            //printf("-----------------\n");
        }
    } while ($mysqli->next_result());
}

	/* close connection */
	$mysqli->close();
		$return=array();
		foreach ($sqlArray as $rows) {
		$table=$rows["table"];
		$return[$table]["rows"]=$rows["rows"];
		}
		return ($return);
	}
	
	
	function _db_num_rows($sql) {
//		$sql=sessionParameter($sql);	
		$mysqli=_db_init();
		$result = $mysqli->query($sql);
		$return=$mysqli->affected_rows;
		//$result->close();
		$mysqli->close();
		return ($return);
	}

	function _db_insert($sql) {
	if (gettype($sql)=="array") {
		for ($i=0;$i<count($sql);$i++) {
		_db_write($sql[0]);
		}
	} else {
	_db_write($sql);
	}
	}
	
	function _db_write($sql) {
//		$sql=sessionParameter($sql);	
		$mysqli=_db_init();
		$result = $mysqli->query($sql);
		$return=$mysqli->insert_id;
		
		//$result->close();
		$mysqli->close();
		return ($return);
	}

	function _db_fields($sql) {
//		$sql=sessionParameter($sql);	
		$row=_db_row($sql);
		$return=array();
		$mysqli=_db_init();
		$result = $mysqli->query($sql);
		$finfo = $result->fetch_fields();
		$i=-1;
        foreach ($finfo as $val) {	
		    $return[++$i]=$val->name;
			/*
            $val->table;
            $val->max_length;
            $val->length;
            $val->charsetnr;
            $val->flags;
            $val->type;
			*/
        }
		
		$result->close();
		$mysqli->close();
		return ($return);
	}

	function _db_field_info($sql) {
//		$sql=sessionParameter($sql);	
		$row=_db_row($sql);
		$return=array();
		$mysqli=_db_init();
		$result = $mysqli->query($sql);
		$finfo = $result->fetch_fields();
		$i=-1;
        foreach ($finfo as $val) {	
		    $return[++$i]["name"]=$val->name;
		    $return[$i]["table"]=$val->table;
		    $return[$i]["max_length"]=$val->max_length;
		    $return[$i]["length"]=$val->length;
		    $return[$i]["charsetnr"]=$val->charsetnr;
		    $return[$i]["flags"]=$val->flags;
		    $return[$i]["type"]=$val->type;
        }
		
		$result->close();
		$mysqli->close();
		return ($return);
	}


function _db_multiple($array) {

$results_rows=array();

if (count($array)==0) return ;
$query="";

foreach ($array as $row) {
	if ($query!="") $query.=";";
	$query.=$row[1];
}

$mysqli = new mysqli(DB_HOSTNAME, DB_USERNAME, DB_PASSWORD, DB_NAME);

/* check connection */
if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}

/* execute multi query */
$i=-1;
if ($mysqli->multi_query($query)) {
    do {
     
		$rows=array();
		
        if ($result = $mysqli->store_result()) {
			while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
                $rows[]=$row;
            }
            
			$result->free();
        }
  
	$label=$array[++$i][0];
	$result_rows[$label]=$rows;
	if (mysql_error()!="") echo mysql_error();
    } while ($mysqli->next_result());
}

/* close connection */
$mysqli->close();	
return ($result_rows);
}	
	
?>