<?php
session_start();
include 'connectDb.php';
include 'myFunctions.php';

user(); //This function check to see if the user is currently logged in
//if ($_SESSION['user']['type'] != 3 && $_SESSION['user']['type'] != 2) {
//    echo '<script>window.location="hair.com_home.php"</script>';
//    exit();
//}

if (isset($_GET['edit'])) {
    $edit = $_GET['edit'];
}


$customerID = $_POST['customerID'];
$serviceID = $_POST['serviceID'];
$stylistID = $_POST['stylistID'];
$slot = $_POST['slot'];


$queryCust = "SELECT * FROM tblusers where UserID = $customerID";
$resultCust = mysqli_query($db, $queryCust);
$rowCust = $resultCust->fetch_assoc(); // fetch_assoc() - Fetch a result row as an associative array. Can now be called "$row["name"]"
$customerName = $rowCust['Firstname'] . " " . $rowCust['Surname'];

$queryStyl = "SELECT * FROM tblusers where UserID = $stylistID";
$resultStyl = mysqli_query($db, $queryStyl);
$rowStyl = $resultStyl->fetch_assoc();
$stylistName = $rowStyl['Firstname'] . " " . $rowStyl['Surname'];

$queryService = "SELECT * FROM tblservices where serviceID = $serviceID";
$resultService = mysqli_query($db, $queryService);
$rowService = $resultService->fetch_assoc();
$service = $rowService['serviceName'];
$cost = $rowService['cost'];

$queryAppSlot = "SELECT * FROM tblslots where slotID = $slot";
$resultAppSlot = mysqli_query($db, $queryAppSlot);
$rowAppSlot = $resultAppSlot->fetch_assoc();
$appSlot = date('l jS \of F Y', strtotime($rowAppSlot['start_event'])) . " <br> " .
    date('G:i', strtotime($rowAppSlot['start_event'])) . " - " .
    date('G:i', strtotime($rowAppSlot['end_event']));


?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link href="bootstrap-4.0.0-dist\css\bootstrap.min.css" rel="stylesheet"/><!-- Link to CSS Bootstrap -->
    <!--    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">-->
    <title>Admin/Home Hair.com</title>
</head>
<body>
<div class="float-right sticky-top"
     style="padding:1% 18%"><?php Button('Admin Home', 'hair.com_stylistAdmin_home.php') ?></div>

<!--
*********************INSERT BANNER**********************************
-->
<?php banner('Hair.com', 'Your ultimate hair booking system...'); ?>


<div class="container text-muted">

    <?php navBar(); ?>
    <div class="wrapper fadeInDown">

        <p></p>

        <?php
        if (isset($edit)) {
            ?>
            <h4>New Appointment Details</h4>
            <?php
        } else {
            ?>

            <h4>Appointment Details</h4>
        <?php }

        if (in_array($customerID, hairAnalysis())) {
            echo "<p class='text-danger'>***WARNING: This customers last skin test has expired***</p>";
        }
        ?>
        <p></p>



        <table width="70%" visible="false">
            <tr>
                <td visible="false">
                    <Label ID="Label8" Font-Size=Smaller runat=server> Customer Name: </Label>
                </td>
                <td visible="false">
                    <Label Font-Size=Smaller runat=server><font
                                color="black"><?php echo $customerName ?></font></Label>
                </td>
            </tr>
            <tr>
                <td visible="false">
                    <Label Font-Size=Smaller runat=server> Stylist name: </Label>
                </td>
                <td visible="false">
                    <Label Font-Size=Smaller runat=server><font
                                color="black"><?php echo $stylistName ?></font></Label>
                </td>
            </tr>

            <tr>
                <td visible="false">
                    <Label Font-Size=Smaller runat=server> Appointment service: </Label>
                </td>
                <td visible="false">
                    <Label Font-Size=Smaller runat=server><font
                                color="black"><?php echo $service ?></font></Label>
                </td>
            </tr>

            <tr>
                <td visible="false">
                    <Label ID="Label8" Font-Size=Smaller runat=server> Appointment slot: </Label>
                </td>
                <td visible="false">
                    <Label Font-Size=Smaller runat=server><font
                                color="black"><?php echo $appSlot ?></font></Label>
                </td>
            </tr>

            <tr>
                <td visible="false">
                    <Label ID="Label8" Font-Size=Smaller runat=server> Price: </Label>
                </td>
                <td visible="false">
                    <Label Font-Size=Smaller runat=server><font
                                color="black">£<?php echo $cost ?></font></Label>
                </td>
            </tr>


        </table>


        <form action="slotConfirmed.php" method="post">

            <input type="hidden" name="customerID"
                   value="<?php echo $customerID ?>">

            <input type="hidden" name="serviceID"
                   value="<?php echo $serviceID ?>">

            <input type="hidden" name="stylistID"
                   value="<?php echo $stylistID ?>">

            <input type="hidden" name="serviceName"
                   value="<?php echo $service ?>">

            <input type="hidden" name="slotID"
                   value="<?php echo $slot ?>">

            <input type="hidden" name="cost"
                   value="<?php echo $cost ?>">

            <?php
            if (isset($edit)) {

            ?>
            <input type="hidden" name="oldSlotID"
                   value="<?php echo $edit ?>">
            <?php
            }
            ?>

            <div><input type="submit" class="btn btn-default" value="Confirm"></div>
        </form>


    </div>
</div>


</body>
</html>