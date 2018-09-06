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
    $categoryID = $_POST["categoryID"];
    $title = $_POST["title"];
    $location = $_POST["location"];
    $startDate = date2sql($_POST["startDate"]);
    $startTime = $_POST["startTime"];
    $endDate = date2sql($_POST["endDate"]);
    $endTime = $_POST["endTime"];
    $fullTime = $_POST["fulltime"];
    $content = $_POST["content"];
    
    $start = $startDate . " " . $startTime;
    $end = $endDate . " " . $endTime;
    
    $query = "update p17_calendar
		set
		categoryID='$categoryID',
		title='$title',
		location='$location',
		start='$start',
		end='$end',
		fullTime='$fullTime',
		content='$content'
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
