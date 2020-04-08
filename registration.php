<?php
session_start();
include 'connectDb.php';
include 'myFunctions.php';


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Registration Form</title>
    <link href="bootstrap-4.0.0-dist\css\bootstrap.min.css" rel="stylesheet"/><!-- Link to CSS Bootstrap -->
    <link href="bootstrap-4.0.0-dist\js\bootstrap.min.js" rel="stylesheet"/>
    <link href="js/jquery-3.4.1.js">

</head>


<body>
<div class="float-right sticky-top" style="padding:1% 18%"><?php Button('Login', 'index.php') ?></div>
<?php banner('Hair.com', 'Your ultimate hair booking system...'); ?>

<div class="container text-muted">
    <div class="wrapper fadeInDown">
        <div id="formContent">

            <BR>
            <h4>Registration Form</h4>
            <BR>
            <div class="modal-body">

                <form action="registration_confirm.php" method="post">

                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Firstname</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="firstname" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Surname</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="surname" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Phone Number</label>
                        <div class="col-sm-9">
                            <input type="tel" class="form-control" name="phonenumber" pattern="[0-9]{11}" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Address 1</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="address1" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Address 2</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="address2" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Postcode</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="postcode" pattern="[A-Za-z]{1,2}[0-9Rr][0-9A-Za-z]? [0-9][ABD-HJLNP-UW-Zabd-hjlnp-uw-z]{2}" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Email</label>
                        <div class="col-sm-9">
                            <input type="email" class="form-control" name="email" placeholder="email@example.com"
                                   required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Password</label>
                        <div class="col-sm-9">
                            <input type="password" class="form-control" name="inputPassword" id="password"
                                   placeholder="Password"
                                   required onkeyup='check();'>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Confirm Password</label>
                        <div class="col-sm-9">
                            <input type="password" class="form-control" name="confirmPassword" id="confirm_password"
                                   placeholder="Confirm Password"
                                   required onkeyup='check();'>
                            <span id='message'></span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">User Type</label>
                        <select class="col-sm-9" name="userType" required>
                            <option value="" disabled selected hidden>Please select...</option>
                            <option value="1">Client</option>
                            <option value="2">Stylist</option>
                            <option value="3">Full Admin</option>
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