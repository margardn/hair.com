<?php
include "connectDb.php";

$field = $_POST['field'];
$value = trim($_POST['value']);
$editid = $_POST['id'];



//======================================================================
//Delete between lines when done
//session_start();
//$_SESSION['field'] = $field;
//$_SESSION['value'] = $value;
//$_SESSION['EditID'] = $editid;

//
//
//
//exit();
//======================================================================

$query = "UPDATE tblusers SET ".$field."='".$value."' WHERE UserID=".$editid;
mysqli_query($db,$query);

echo 1;