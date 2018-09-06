<?php
session_start();
require (dirname(__FILE__) . '/_db_class.php');
$firmID = json_decode($_SESSION["auth"])->{'firmID'};
$userID = json_decode($_SESSION["auth"])->{'userID'};


// --------------------------------------------------------------------------------------------------
// This script reads event data from a JSON file and outputs those events which are within the range
// supplied by the "start" and "end" GET parameters.
//
// An optional "timezone" GET parameter will force all ISO8601 date stings to a given timezone.
//
// Requires PHP 5.2.0 or higher.
// --------------------------------------------------------------------------------------------------

// Require our Event class and datetime utilities
require dirname(__FILE__) . '/calendar_utils.php';

// Short-circuit if the client did not give us a date range.
if (! isset($_GET['start']) || ! isset($_GET['end'])) {
    die("Please provide a date range.");
}

// Parse the start/end parameters.
// These are assumed to be ISO8601 strings with no time nor timezone, like "2013-12-29".
// Since no timezone will be present, they will parsed as UTC.
$range_start = parseDateTime($_GET['start']);
$range_end = parseDateTime($_GET['end']);

// Parse the timezone parameter if it is present.
$timezone = null;
if (isset($_GET['timezone'])) {
    $timezone = new DateTimeZone($_GET['timezone']);
}

// Read and parse our events JSON file into an array of event data arrays.
// $json = file_get_contents(dirname(__FILE__) . '/events.json');
// $input_arrays = json_decode($json, true);
$query = "select c.*,l.*,c.id as cID from p17_calendar l, p17_calendar_categories c 
		where l.firmID=$firmID AND
		c.id=l.categoryID OR 
		l.firmID=0 AND
		c.id=l.categoryID";
$rows = _db_rows($query);
// echo mysql_error();
// echo count($rows);
$json = '';
for ($i = 0; $i < count($rows); $i ++) {
    
    if ($json != '')
        $json .= ',';
    $json .= '{';
    $json .= '"id":"' . $rows[$i]["id"] . '",';
    $json .= '"cID":"' . $rows[$i]["cID"] . '",';
    
    $content = nl2br($rows[$i]["content"]);
    $content = str_replace(array(
        "\n",
        "\r"
    ), '', $content);
    $json .= '"content":"' . $content . '",';
    $json .= '"room":"' . $rows[$i]["location"] . '",';
    $json .= '"title":"' . $rows[$i]["title"] . '",';
    $json .= '"start":"' . str_replace(' ', 'T', $rows[$i]["start"]) . '",';
    if (substr($rows[$i]["end"], 0, 4) != '0000') {
        $json .= '"end":"' . str_replace(' ', 'T', $rows[$i]["end"]) . '",';
    }
    $json .= '"fulltime":"' . $rows[$i]["fulltime"] . '",';
    $json .= '"color":"' . $rows[$i]["color"] . '",';
    $json .= '"textColor":"' . $rows[$i]["textColor"] . '"';
    
    $json .= '}';
    
    /*
     * if (substr($rows[$i]["end"],0,4)!='0000') {
     * $json.=',{';
     * $rows[$i]["background"]="background";
     * $rows[$i]["color"]="yellow";
     * $json.='"title":"'.$rows[$i]["title"].'",';
     * $json.='"start":"'.str_replace(' ','T',$rows[$i]["start"]).'",';
     * $json.='"end":"'.str_replace(' ','T',$rows[$i]["end"]).'",';
     * $json.='"rendering":"'.$rows[$i]["background"].'"';
     * $json.='}';
     * }
     */
}

$json = '[' . $json . ']';
// echo $json;

$input_arrays = json_decode($json, true);

// Accumulate an output array of event data arrays.
$output_arrays = array();
foreach ($input_arrays as $array) {
    
    // Convert the input array into a useful Event object
    $event = new Event($array, $timezone);
    
    // If the event is in-bounds, add it to the output
    if ($event->isWithinDayRange($range_start, $range_end)) {
        // echo $array["start"]."<BR>";
        $output_arrays[] = $event->toArray();
    }
}

// Send JSON to the client.
echo json_encode($output_arrays);