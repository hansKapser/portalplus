<?php
session_start();
// init();

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
    // $userID=json_decode($_SESSION["auth"])->{'userID'};
    $today = date('Y-m-d');
    $id = $_POST["id"];
    $start = $_POST["start"];
    $query = "update p17_calendar
		set
		start='$start'
		where id=$id";
    _db_write($query);
    $error = mysql_error();
    $return = array();
    $return[] = array(
        'label' => 'success',
        'content' => json_encode($error)
    );
    echo json_encode($return);
    return;
}
