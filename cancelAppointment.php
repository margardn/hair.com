<?php

include 'connectDb.php';
$event = $_GET['appID'];

$query = "DELETE FROM `tblappointments` WHERE apptID = $event";
$query = mysqli_query($db, $query);
header ("Location: viewAppointments.php");

