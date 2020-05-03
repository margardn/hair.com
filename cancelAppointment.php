<?php

session_start();
include 'connectDb.php';
$event = $_GET['appID'];

$query = "DELETE FROM `tblappointments` WHERE apptID = $event";
$query = mysqli_query($db, $query);



if ($_SESSION['user']['type']==1) {
    header ("Location: history.php");
}else {
    header("Location: viewAppointments.php");
}
