<?php

session_start();

//$id = $_GET["custID"]??$_SESSION['user']['id'];;

//$user = $_GET["custID"];

$_SESSION['schedule'][ 'stylist']=$_GET["custID"];

header("Location: viewAppointments.php");



