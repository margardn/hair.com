<?php
session_start();
include 'connectDb.php';
include 'myFunctions.php';

//Initialise variables
$customerID = $_POST['customerID'];
$serviceID = $_POST['serviceID'];
$stylistID = $_POST['stylistID'];
$slotID = $_POST['slotID'];
$servicename = $_POST['serviceName'];

if (isset($_POST['oldSlotID'])) {
    $oldSlotID = $_POST['oldSlotID'];
}



//insert user input to database------------------------------>

$query = "INSERT INTO tblappointments (serviceID, customerID, stylistID, slotID)
VALUES ($serviceID, $customerID, $stylistID, $slotID)";

if (isset($oldSlotID)) {

    $query2 = "DELETE FROM `tblappointments` WHERE slotID=$oldSlotID";
    if ($db->query($query2) == true) {
    }
    if ($db->query($query) == true) {
        if ($_SESSION['user']['type']==1) {
            echo '<script>alert("Appointment successfully amended...")</script>';
            echo '<script>window.location="history.php"</script>';
        }else {
            echo '<script>alert("Appointment successfully amended...")</script>';
            echo '<script>window.location="viewAppointments.php"</script>';
        }
    }
} else {

    if ($db->query($query) == true) {
        echo '<script>alert("Appointment successfully saved...")</script>';

        if ($_SESSION['user']['type']==1) {

            echo '<script>window.location="history.php"</script>';
        }else{
            echo '<script>window.location="viewAppointments.php"</script>';
        }



    }else {
        echo '<script>alert("error...")</script>';
        echo '<script>window.location="viewAppointments.php"</script>';
    }
}
?>






