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
    require_once (dirname(__FILE__) . '/_db_php7.php');
    $firmID = json_decode($_SESSION["auth"])->{'firmID'};
    $userID = json_decode($_SESSION["auth"])->{'userID'};
    $today = date('Y-m-d');
    
    $query = "select t.userID,t.ticketID,t.voucher from p17_tickets t left join p17_calendar c on c.ticketID=t.ticketID where c.id IS NULL AND t.firmID=$firmID AND t.userID=$userID";
    $rows = _db_rows($query);
    $query = "select * from p17_calendar_categories";
    $rows_category = _db_rows($query);
    
    $return = array();
    $return[] = array(
        'label' => 'rows',
        'content' => json_encode($rows)
    );
    $return[] = array(
        'label' => 'rows_category',
        'content' => json_encode($rows_category)
    );
    
    echo json_encode($return);
    return;
}

