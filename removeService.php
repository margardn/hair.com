<?php
session_start();
include 'connectDb.php';
include 'myFunctions.php';

$id = $_GET["val"];



"DELETE FROM `tblservices` WHERE `tblservices`.`serviceID` = 25;";

$query = "DELETE FROM `tblservices` WHERE `tblservices`.`serviceID` = $id";
$result = mysqli_query($db, $query);


echo '<script>alert("Service was successfully deleted...")</script>';
echo '<script>window.location="services.php"</script>';