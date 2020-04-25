<?php
session_start();
include 'connectDb.php';
include 'myFunctions.php';

//Initialise variables
$customerID = $_POST['customerID'];
//$serviceID = $_POST['serviceID'];
$stylistID = $_POST['stylistID'];
$slotID = $_POST['slotID'];
$servicename = $_POST['serviceName'];



//insert user input to database------------------------------>

$query = "INSERT INTO tblappointments (title, customerID, stylistID, slotID) 
VALUES ('$servicename', $customerID, $stylistID, $slotID)";

if ($db->query($query)==true) {
//$db->query($query);
    echo '<script>alert("Appointment successfully saved...")</script>';
    echo '<script>window.location="viewAppointments.php"</script>';
}else{
    echo '<script>alert("error...")</script>';
    echo '<script>window.location="services.php"</script>';
}

?>






