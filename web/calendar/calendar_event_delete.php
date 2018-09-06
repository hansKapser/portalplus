<?php
session_start();

if (is_ajax()) {
    init();
}

// Function to check if the request is an AJAX request
function is_ajax()
{
    return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
}

function init()
{
    // get some json data
    require ('./_db_class.php');
    $firmID = json_decode($_SESSION["auth"])->{'firmID'};
    $today = date('Y-m-d');
    $array = json_decode($_POST["data"], true);
    
    // from session
    
    $id = $_POST["id"];
    
    $query = "delete from p17_calendar
		where
		id=$id";
    
    $insert_id = _db_write($query);
    
    $error = mysql_error();
    
    $return = array();
    $return[] = array(
        'label' => 'success',
        'content' => json_encode($error . ' ' . $query)
    );
    
    echo json_encode($return);
    return;
}
