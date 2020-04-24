<?php

session_start();
//include 'connectDb.php';
include 'myFunctions.php';




$connect = new PDO('mysql:host=localhost;dbname=hair.com', 'root', '');
$currentUser = $_SESSION['user']['id'];
$data = array();



//WORKING
$query = "SELECT * FROM tblappointments, tblslots, tblusers where tblappointments.slotID = tblslots.slotID
                                                    and tblappointments.stylistID = '$currentUser' 
                                                    and tblappointments.customerID = tblusers.UserID     ORDER BY apptID";

echo $query;


$statement = $connect->prepare($query);

$statement->execute();

$result = $statement->fetchAll();



foreach($result as $row)
{

    var_dump($row);
//    $data[] = array(
//        'id'   => $row["apptID"],
//        'title'   => $row["title"] . " - " . $row['Firstname'] . " " . $row['Surname'],
//        'start'   => $row["start_event"],
//        'end'   => $row["end_event"]
//    );
}

