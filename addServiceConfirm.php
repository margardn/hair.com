<?php
session_start();
include 'connectDb.php';
include 'myFunctions.php';

//Initialise variables
$servicename = $_POST['servicename'];
$duration = (int)$_POST['duration'];
$devTime = $_POST['devtime'];
$price = $_POST['price'];
//var_dump($devTime);

//INSERT INTO `tblservices`(`serviceName`) VALUES ('perm')

//insert user input to database------------------------------>

$query = "INSERT INTO tblservices (serviceName, durationMins, devTime, cost) VALUES ('$servicename', $duration, $devTime, $price)";

if ($db->query($query)==true) {
//$db->query($query);
    echo '<script>alert("New Service successfully added...")</script>';
    echo '<script>window.location="services.php"</script>';
}else{
    echo '<script>alert("error...")</script>';
    echo '<script>window.location="services.php"</script>';
}
//echo $query;
//echo $query;



//---------------------------------------------------------------------


?>

<!--<!doctype html>-->
<!--<html lang="en">-->
<!--<head>-->
<!--    <meta charset="UTF-8">-->
<!--    <meta name="viewport"-->
<!--          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">-->
<!--    <meta http-equiv="X-UA-Compatible" content="ie=edge">-->
<!--    <link href="bootstrap-4.0.0-dist\css\bootstrap.min.css" rel="stylesheet"/><!-- Link to CSS Bootstrap -->-->
<!--    <title>Add Service Confirm</title>-->
<!--</head>-->
<!--<body>-->
<!--<div class="float-right sticky-top"-->
<!--     style="padding:1% 18%">--><?php //Button('Admin Home', 'hair.com_stylistAdmin_home.php') ?><!--</div>-->
<!---->
<!---->
<!--<!---->
<!--*********************INSERT BANNER**********************************-->
<!---->-->
<?php //banner('Hair.com', 'Your ultimate hair booking system...'); ?>
<!---->
<!---->
<!--<div class="container text-muted">-->
<!--    <div class="wrapper fadeInDown">-->
<!--        <div id="formContent">-->
<!--            <br>-->
<!--            <h4>New Service</h4>-->
<!---->
<!---->
<!--            <table width="400" visible="false">-->
<!--                <tr>-->
<!--                    <td visible="false">-->
<!--                        <Label ID="Label8" Font-Size=Smaller runat=server> Service Name: </Label>-->
<!--                    </td>-->
<!--                    <td visible="false">-->
<!--                        <Label Font-Size=Smaller runat=server><font-->
<!--                                    color="black">--><?php //echo $servicename ?><!--</font></Label>-->
<!--                    </td>-->
<!--                </tr>-->
<!--                <tr>-->
<!--                    <td visible="false">-->
<!--                        <Label Font-Size=Smaller runat=server> Duration required: </Label>-->
<!--                    </td>-->
<!--                    <td visible="false">-->
<!--                        <Label Font-Size=Smaller runat=server><font color="black">--><?php //echo $duration ?><!--</font></Label>-->
<!--                    </td>-->
<!--                </tr>-->
<!--                <tr>-->
<!--                    <td visible="false">-->
<!--                        <Label ID="Label8" Font-Size=Smaller runat=server> Development time needed: </Label>-->
<!--                    </td>-->
<!--                    <td visible="false">-->
<!--                        <Label Font-Size=Smaller runat=server><font color="black">--><?php
//
//                                if ($devTime == 0) {
//                                    echo "No";
//                                } elseif ($devTime == 1) {
//                                    echo "Yes";
//                                } ?><!--</font></Label>-->
<!--                    </td>-->
<!--                </tr>-->
<!---->
<!--                <tr>-->
<!--                    <td visible="false">-->
<!--                        <Label ID="Label8" Font-Size=Smaller runat=server> Price: </Label>-->
<!--                    </td>-->
<!--                    <td visible="false">-->
<!--                        <Label Font-Size=Smaller runat=server><font-->
<!--                                    color="black">--><?php //echo "£" . $price ?><!--</font></Label>-->
<!--                    </td>-->
<!--                </tr>-->
<!---->
<!---->
<!--            </table>-->
<!---->
<!--        </div>-->
<!--    </div>-->
<!--</div>-->
<!---->
<!---->
<!--</body>-->
<!--</html>-->
