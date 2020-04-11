<?php
session_start();
include 'connectDb.php';
include 'myFunctions.php';
user();

$id = $_GET["val"]??$_SESSION['user']['id'];;

$query = "SELECT UserID, Firstname, Surname FROM tblusers where UserID = $id";
$result = mysqli_query($db, $query);


//set one row as the result
$row = $result->fetch_assoc(); // fetch_assoc() - Fetch a result row as an associative array. Can now be called "$row["name"]"
//print_r($row);


$query2 = "SELECT * FROM tblservices";
$result2 = mysqli_query($db, $query2);

$query3 = "SELECT UserID, Firstname, Surname FROM tblusers where UserType != '1'";
$result3 = mysqli_query($db, $query3);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Book Appt Form</title>
    <link href="bootstrap-4.0.0-dist\css\bootstrap.min.css" rel="stylesheet"/><!-- Link to CSS Bootstrap -->
    <link href="bootstrap-4.0.0-dist\js\bootstrap.min.js" rel="stylesheet"/>
    <link href="js/jquery-3.4.1.js">

</head>


<body>
<div class="float-right sticky-top"
     style="padding:1% 18%"><?php Button('Admin Home', 'hair.com_stylistAdmin_home.php') ?></div>
<?php banner('Hair.com', 'Your ultimate hair booking system...'); ?>

<div class="container text-muted">
    <?php navBar(); ?>
    <div class="wrapper fadeInDown">
        <div id="formContent">

            <BR>
            <h4>Book Appointment</h4>
            <BR>
            <div class="modal-body">

                <form action="*********.php" method="post">

                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Customer Name</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="firstname"
                                   value="<?php echo $row['Firstname'] . ' ' . $row['Surname'] ?>" disabled>
                        </div>
                    </div>

                    <div class="form-group row">

                        <label class="col-sm-3 col-form-label">Select a service:</label>

                        <select class="col-sm-9" name="service" required>
                            <option value=""  hidden>Please select a service...</option>
                            <?php //with help from https://www.youtube.com/watch?v=TNPxG2yrPlM

                            while ($row2 = $result2->fetch_assoc()) {
                                $service = $row2['serviceName'];

                                $return = $row2['serviceID'];
                                ?>
                                <option value=<?php echo $return ?>><?php echo $service ?></option>
                            <?php

                            }
                            ?>
                        </select>
                    </div>

                    <div class="form-group row">

                        <label class="col-sm-3 col-form-label">Select a stylist:</label>

                        <select class="col-sm-9" name="stylist" required>

                            <option value="" hidden>Please select a stylist...</option>
                            <?php //with help from https://www.youtube.com/watch?v=TNPxG2yrPlM

                            while ($row3 = $result3->fetch_assoc()) {
                                $stylist = $row3['Firstname'] . " " . $row3['Surname'];

                                $return = $row3['UserID'];
                                ?>
                                <option value=<?php echo $return ?>><?php echo $stylist ?></option>
                                <?php

                            }
                            ?>
                        </select>
                    </div>




                    <div><input type="submit" class="btn btn-default" id="submit-button" value="Submit"></div>
                </form>


            </div>
        </div>
    </div>
</div> <!-- close container -->

<script src="js/myJS.js"></script>
</body>
</html>