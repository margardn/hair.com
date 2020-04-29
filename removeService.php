<?php
session_start();
include 'connectDb.php';
include 'myFunctions.php';

$id = $_GET["val"];





$query = "UPDATE `tblservices` SET `active` = '0' WHERE `tblservices`.`serviceID` = $id";
$result = mysqli_query($db, $query);


echo '<script>alert("Service was successfully deleted...")</script>';
echo '<script>window.location="services.php"</script>';