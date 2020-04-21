<?php

session_start();
include 'myFunctions.php';

$connect = new PDO('mysql:host=localhost;dbname=hair.com', 'root', '');
$currentUser = $_SESSION['user']['id'];
$data = array();

//$query = "SELECT * FROM tblappointments ORDER BY apptID";



//WORKING
$query = "SELECT * FROM tblappointments, tblslots, tblusers where tblappointments.slotID = tblslots.slotID
                                                    and tblappointments.stylistID = '$currentUser' 
                                                    and tblappointments.customerID = tblusers.UserID     ORDER BY apptID";

//
//$query = "SELECT * FROM tblappointments, tblslots, tblusers where tblappointments.slotID = tblslots.slotID
//                                                    and tblappointments.stylistID = 11 ORDER BY apptID";


$statement = $connect->prepare($query);

$statement->execute();

$result = $statement->fetchAll();

//print_r($result);


?>