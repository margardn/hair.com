<?php

include 'connectDb.php';
$event = $_GET['appID'];

$value = $_GET['value'];
$value=trim($value,'£');
$tip = $_GET['tip']??0;
$tip=trim($tip,'£');
$value=(float)$value;
$tip=(float)$tip;










$query = "UPDATE `tblappointments` SET `money_in`=$value, `tip`=$tip, complete=1 WHERE apptID = $event";
$query = mysqli_query($db, $query);
header ("Location: viewAppointments.php");

