<?php
session_start();
include 'connectDb.php';
include 'myFunctions.php';


user(); //This function check to see if the user is currently logged in

//Get profile details from database
$userID = $_SESSION['user']['id'];
$query = "SELECT * FROM tblusers where UserID = $userID";
$result = mysqli_query($db, $query);

//set one row as the result
$row = $result->fetch_assoc(); // fetch_assoc() - Fetch a result row as an associative array... Can now be called "$row["name"]"
//print_r($row);

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

    <title>Home Hair.com</title>
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
            <h4>Your Profile</h4>
            <BR>


            <!------------------------------------------------------------------------------------------------->

            <div class="modal-body">


                <form action="editProfile.php" method="post">


                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Firstname</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="firstname"
                                   value="<?php echo $row['Firstname'] ?>"
                                   readonly="readonly" required>
                        </div>
                    </div>


                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Surname</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="surname" value="<?php echo $row['Surname'] ?>"
                                   readonly="readonly"
                                   required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Phone Number</label>
                        <div class="col-sm-9">
                            <input type="tel" class="form-control" name="phonenumber" pattern="[0-9]{11}"
                                   value="<?php echo $row['phonenumber'] ?>" readonly="readonly" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Address 1</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="address1"
                                   value="<?php echo $row['address1'] ?>"
                                   readonly="readonly" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Address 2</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="address2"
                                   value="<?php echo $row['address2'] ?>"
                                   readonly="readonly" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Postcode</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="postcode"
                                   pattern="[A-Za-z]{1,2}[0-9Rr][0-9A-Za-z]? [0-9][ABD-HJLNP-UW-Zabd-hjlnp-uw-z]{2}"
                                   value="<?php echo $row['postcode'] ?>" readonly="readonly" required>
                        </div>
                    </div>


                    <div><input type="submit" class="btn btn-default" id="submit-button" value="Submit" disabled>

                        <input type="button" class="btn btn-default" id="change-password" value="Change Password"
                               disabled onclick="window.location='reset_password.php';">
                        <input type="button" class="btn btn-default float-right" id="edit" value="Edit"
                               onclick="toggle_hide(event)"></div>

                </form>


                <!------------------------------------------------------------------------------------------------->

                <p/>
                <p>NOTE: Your email address/username can only be changed by your stylist</p>
            </div>


        </div>

    </div>

</div>

<script>

    function inputToggle(e) {
        var edit = true;
        e.preventDefault();
        $(':input').prop('readonly', edit = !edit);
    }


    function hide() {
        var x = document.getElementById("edit");
        if (x.style.display === "none") {
            x.style.display = "block";
        } else {
            x.style.display = "none";
        }

    }

    function enableSubmit() {
        document.getElementById("submit-button").disabled = false;

    }

    function enableChangePassword() {
        document.getElementById("change-password").disabled = false;
    }

    function toggle_hide(e) {
        inputToggle(e);
        hide();
        enableSubmit();
        enableChangePassword();
    }

</script>


</body>
</html>