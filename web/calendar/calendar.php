<?php 
session_start();
$row["userID"]=$_REQUEST["userID"];
$row["status"]=$_REQUEST["status"];
$row["firmID"]=$_REQUEST["firmID"];

$_SESSION["auth"] = json_encode($row);
header('Location: ./calendar.html');

?>