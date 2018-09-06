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
    $start = $_POST["date"];
    $title = $_POST["title"];
    $userID = $_POST["userID"];
    $ticketID = $_POST["ticketID"];
    $query = "select id from p17_calendar_categories where 
		statusRead=1 AND statusEdit=1 AND statusDelete=1";
    $rows = _db_rows($query);
    $categoryID = $rows[0]["id"];
    
    $query = "select * from p17_tickets where ticketID=$ticketID";
    $rowT = _db_row($query);
    $content = $rowT["from_company"] . "\n" . $rowT["voucherNoExternal"] . "\n" . $rowT["date"] . "\n";
    
    $query = "insert into p17_calendar
		(firmID,ticketID,userID,start,title,categoryID,fulltime,content)
		values
		($firmID,$ticketID,$userID,'$start','$title','$categoryID',1,'$content')";
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
