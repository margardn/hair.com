<?php
session_start();
include 'connectDb.php';
include 'myFunctions.php';

session_destroy();

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="bootstrap-4.0.0-dist\css\bootstrap.min.css" rel="stylesheet"/><!-- Link to CSS Bootstrap -->
    <title>Logged out Hair.com</title>
</head>
<body>
<div class="float-right sticky-top" style="padding:1% 18%"><?php Button('Login', 'index.php')  ?></div>

<!--
*********************INSERT BANNER**********************************
-->
<?php banner('Thankyou for using Hair.com', 'Your ultimate hair booking system...'); ?>


<div class="container text-muted">
    <div class="wrapper fadeInDown">
        <div id="formContent">
            <h1>You have been successfully logged out...</h1>

        </div>
    </div>
</div>


</body>
</html>

