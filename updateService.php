<?php
include "connectDb.php";

$field = $_POST['field'];
$value = trim($_POST['value']);
$value = ltrim($value, '£');
$editid = $_POST['id'];



//======================================================================
//Delete between lines when done
//session_start();
//$_SESSION['field'] = $field;
//$_SESSION['value'] = $value;
//$_SESSION['EditID'] = $editid;
//
////
//
//
//exit();
//======================================================================

$query = "UPDATE tblservices SET ".$field."='".$value."' WHERE serviceID=".$editid;
mysqli_query($db,$query);

echo 1;