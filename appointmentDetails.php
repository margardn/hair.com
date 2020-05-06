<?php


session_start();
include 'connectDb.php';
include 'myFunctions.php';
user(); //This function check to see if the user is currently logged in

//Get appointment details from database
$event = $_GET['event'];
$queryEvent = "SELECT * FROM tblappointments where apptID = $event";
$resultEvent = mysqli_query($db, $queryEvent);

//set one row as the result
$rowEvent = $resultEvent->fetch_assoc(); // fetch_assoc() - Fetch a result row as an associative array... Can now be called "$row["name"]"

$sytlistID = $rowEvent["stylistID"];
$customerID = $rowEvent["customerID"];
$serviceID = $rowEvent["serviceID"];
$slotID = $rowEvent["slotID"];
$complete = $rowEvent["complete"];
$paid = "£" . $rowEvent['money_in'];
$tip = "£" . $rowEvent['tip'];


$queryStylist = "SELECT * FROM tblusers where UserID = $sytlistID";
$resultStylist = mysqli_query($db, $queryStylist);
$rowStylist = $resultStylist->fetch_assoc(); // fetch_assoc() - Fetch a result row as an associative array... Can now be called "$row["name"]"
$stylistName = $rowStylist['Firstname'] . " " . $rowStylist['Surname'];
$stylistID = $rowStylist['UserID'];


$queryCustomer = "SELECT * FROM tblusers where UserID = $customerID";
$resultCustomer = mysqli_query($db, $queryCustomer);
$rowCustomer = $resultCustomer->fetch_assoc(); // fetch_assoc() - Fetch a result row as an associative array... Can now be called "$row["name"]"
$customerName = $rowCustomer['Firstname'] . " " . $rowCustomer['Surname'];

$queryCost = "SELECT * FROM tblservices where serviceID = $serviceID";
$resultCost = mysqli_query($db, $queryCost);
$rowCost = $resultCost->fetch_assoc(); // fetch_assoc() - Fetch a result row as an associative array... Can now be called "$row["name"]"
$cost = "£" . $rowCost['cost'];
$serviceName = $rowCost['serviceName'];

$querySlotTime = "SELECT * FROM tblslots where slotID = $slotID";
$resultSlotTime = mysqli_query($db, $querySlotTime);
$rowSlotTime = $resultSlotTime->fetch_assoc(); // fetch_assoc() - Fetch a result row as an associative array... Can now be called "$row["name"]"
//$slotTime = $rowSlotTime['start_event'] . " - " . $rowSlotTime['end_event'];

$appSlot = date('l jS \of F Y', strtotime($rowSlotTime['start_event'])) . "   " .
    date('G:i', strtotime($rowSlotTime['start_event'])) . " - " .
    date('G:i', strtotime($rowSlotTime['end_event']));

?>


<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link href="bootstrap-4.0.0-dist\css\bootstrap.min.css" rel="stylesheet"/><!-- Link to CSS Bootstrap -->

    <title>Appt Details</title>
</head>
<body>

<?php if ($_SESSION['user']['type'] == 1) { ?>
    <div class="float-right sticky-top" style="padding:1% 18%"><?php Button('Home', 'hair.com_home.php') ?></div>

<?php } elseif ($_SESSION['user']['type'] == 2 || $_SESSION['user']['type'] == 3) { ?>


    <div class="float-right sticky-top"
         style="padding:1% 18%"><?php Button('Admin Home', 'hair.com_stylistAdmin_home.php') ?></div>
<?php } ?>
<!--
*********************INSERT BANNER**********************************
-->
<?php banner('Hair.com', 'Your ultimate hair booking system...'); ?>


<div class="container text-muted">

    <?php navBar(); ?>


    <div class="wrapper fadeInDown">
        <div id="formContent">
            <BR>
            <h4>Appointment Details</h4>
            <BR>
            <?php
            if ($complete) {
                ?>

                <p class="text-danger">This appointment is closed</p>

                <?php


            }
            ?>


            <!------------------------------------------------------------------------------------------------->

            <div class="modal-body">


                <form action="editProfile.php" method="post">

                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">App't ID:</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="apptid"
                                   value="<?php echo $event ?>"
                                   readonly="readonly" required>
                        </div>
                    </div>


                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Customer:</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="customer"
                                   value="<?php echo $customerName ?>"
                                   readonly="readonly" required>
                        </div>
                    </div>


                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Stylist:</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="stylist" value="<?php echo $stylistName ?>"
                                   readonly="readonly"
                                   required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Appointment type:</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="stylist" value="<?php echo $serviceName ?>"
                                   readonly="readonly"
                                   required>
                        </div>
                    </div>


                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Slot:</label>
                        <div class="col-sm-9">
                            <input type="tel" class="form-control" name="phonenumber" pattern="[0-9]{11}"
                                   value="<?php echo $appSlot ?>" readonly="readonly" required>
                        </div>
                    </div>


                    <?php
                    if (!$complete) {

                        ?>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Cost for appointment:</label>
                            <div class="col-sm-9">
                                <input type="tel" class="form-control" "
                                value="<?php echo $cost ?>" readonly="readonly" required>
                            </div>
                        </div>
                        <?php
                    } else {
                        ?>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Customer paid:</label>
                            <div class="col-sm-9">
                                <input type="tel" class="form-control" "
                                value="<?php echo $paid ?>" readonly="readonly" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Tip:</label>
                            <div class="col-sm-9">
                                <input type="tel" class="form-control" "
                                value="<?php echo $tip ?>" readonly="readonly" required>
                            </div>
                        </div>


                        <?php


                    }
                    ?>

                    <div><input type="button" class="btn btn-default float-right" id="submit-button" value="Submit"
                                hidden>

                        <?php
                        if (!$complete) {

                        ?>

                        <input type="button" class="btn btn-default" id="cancel" value="Cancel Appointment"
                               onclick="deleteme(<?php echo $event ?>)">

                        <input type="button" class="btn btn-default" id="edit-app" value="Edit Appointment"
                               onclick="window.location='appBookForm.php?custID=<?php echo $customerID . "&serv=" . $serviceID
                                   . "&styl=" . $stylistID . "&edit=$slotID" ?>';">

                        <?php
                        if ($_SESSION['user']['type'] == 2 || $_SESSION['user']['type'] == 3){
                        ?>

                        <input type="button" class="btn btn-primary float-right" id="checkout" value="Checkout"
                               onclick="toggle_hide(event)"></div>
                <?php

                }//end if("$complete)

                }//end  if ($_SESSION['user']['type'] == 2 || $_SESSION['user']['type'] == 3)

                if (isset($_SESSION['hairAnalysis'])) {

                    if (in_array($customerID, $_SESSION['hairAnalysis'])) {
                        echo "<p class='text-danger'>***WARNING: This customers last skin test has expired***</p>";

                        ?>
                        <button type="button" class="btn btn-info"
                                onclick="location.href='hairAnalysis.php?val=<?php echo $customerID ?>';">Hair Analysis
                        </button>
                        <?php

                    }
                }

                ?>

                </form>

                <form id="checkoutForm" method="post" hidden>

                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Charged to customer:</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="confirm"
                                   value="<?php echo $cost ?>" required>

                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Tip?:</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="tip">

                        </div>
                    </div>


                    <div>
                        <button type="button" class="btn btn-default" onclick="updateMoneyIn(<?php echo $event ?>);">
                            Confirm
                        </button>

                </form>
            </div>
        </div>
    </div>
</div>

<script>


    function updateMoneyIn(moneyInEvent) {

        var value = document.getElementById("confirm").value;
        value = parseFloat(value.replace(/[^\d.]/g, ''));
        var tip = document.getElementById("tip").value;
        tip = parseFloat(tip.replace(/[^\d.]/g, ''));
        ;

        var total = value + tip;


        if (confirm("Charge to customer account = £" + total)) {
            window.location.href = 'updateCharge.php?appID=' + moneyInEvent + '&value=' + value + '&tip=' + tip + '';
            return true;
        }

    }

    function deleteme(delEvent) {
        if (confirm("Cancel Appointment?")) {
            window.location.href = 'cancelAppointment.php?appID=' + delEvent + '';
            return true;
        }

    }

    function inputToggle(e) {
        // var edit = true;
        e.preventDefault();
        // $(':input').prop('readonly', edit = !edit);
    }


    function hide() {
        var x = document.getElementById("checkout");
        if (x.style.display === "none") {
            x.style.display = "block";
        } else {
            x.style.display = "none";
        }


        var y = document.getElementById("cancel");
        if (y.style.display === "none") {
            y.style.display = "block";
        } else {
            y.style.display = "none";
        }

        var z = document.getElementById("edit-app");
        if (z.style.display === "none") {
            z.style.display = "block";
        } else {
            z.style.display = "none";
        }

    }

    function enableSubmit() {
        document.getElementById("checkoutForm").hidden = false;

    }

    // function enableChangePassword() {
    //     document.getElementById("change-password").disabled = false;
    // }

    function toggle_hide(e) {
        inputToggle(e);
        hide();
        enableSubmit();
        // enableChangePassword();
    }

</script>


</body>
</html>
