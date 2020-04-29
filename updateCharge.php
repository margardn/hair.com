<?php

include 'connectDb.php';
$event = $_GET['appID'];

$value = $_GET['value'];
$value=trim($value,'£');
$value=(float)$value;




var_dump($value);



echo $event;

$query = "UPDATE `tblappointments` SET `money_in`=$value WHERE apptID = $event";
$query = mysqli_query($db, $query);
header ("Location: viewAppointments.php");

