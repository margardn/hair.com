<?php

session_start();
include 'connectDb.php';
include 'myFunctions.php';
user();

$customerID = $_POST['customerID'];
$date = date('Y-m-d');
$texture = $_POST['texture'];
$condition = $_POST['condition'];
$form = $_POST['form'];
$obs = $_POST['obs'];
$hairAnalysis = $_POST['test'];


$query = "INSERT INTO `tblhairanalysis` (`analysisNo`, `customerID`, `texture`, `hairCondition`, `naturalForm`, `skinTestDate`, `result`) VALUES 
                                                                                                           
                    (NULL, '$customerID', '$texture', '$condition', '$form', '$date', '$obs');";

$query2 = "SELECT hairAnalysis FROM tblusers where UserID = $customerID";

$result2 = $db->query($query2);
if ($result2->num_rows > 0) {
    $row2 = mysqli_fetch_array($result2);
    $currentAnalysis = $row2['hairAnalysis'];
}

if ($currentAnalysis != $hairAnalysis) {
    $query3 = "UPDATE `tblusers` SET `hairAnalysis` = $hairAnalysis WHERE `tblusers`.`UserID` = $customerID;";
   $db->query($query3);
}


$db->query($query);

if ($query) {
    echo "<script>alert('Hair analysis successfully added...');
    window.location='customers.php';</script>";
    exit();
} else {
    //failure
    echo "<script>alert('Error.. Update failed. Please retry...');
    window.location='customers.php';</script>";
    exit();
}