<?php
session_start();
include 'connectDb.php';
include 'myFunctions.php';


?>

<!doctype html>
<html lang="en">
<head>


    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>


    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="bootstrap-4.0.0-dist\css\bootstrap.min.css" rel="stylesheet"/><!-- Link to CSS Bootstrap -->
    <title>Login Hair.com</title>
</head>
<body>
<div class="float-right sticky-top" style="padding:1% 18%"><?php Button('Register', 'registration.php') ?></div>

<!--
*********************INSERT BANNER**********************************
-->
<?php banner('Hair.com', 'Your ultimate hair booking system...'); ?>


<div class="container text-muted">
    <div class="wrapper fadeInDown">
        <div id="formContent">
            <BR>
            <h4>User Login</h4>
            <BR>
            <form method="POST" action="login_confirm.php">
                <div class="form-group">
                    <input type="email" class="fadeIn second" name="login" placeholder="Username" required>
                </div>
                <div class="form-group">
                    <input type="password" class="fadeIn third" name="password" placeholder="Password" required>
                </div>

                <!------------------------------------------------------>
                <div class="field-group">
                    <div>
                        <!--<input type="button" name="rememberme" id="rememberme"/> <label>Remember me</label>-->
                        <a href="reset_password.php">Forgot password</a>

                    </div>
                </div>
                <!------------------------------------------------------>

                <hr/>
                <div class="form-group">
                    <div><input type="submit" class="btn btn-default" id="submit-button" name="submit-button"
                                value="Submit"></div>
                </div>
            </form>


        </div>
    </div>
</div>


</body>
</html>




