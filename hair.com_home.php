<?php
session_start();
include 'connectDb.php';
include 'myFunctions.php';

user(); //This function check to see if the user is currently logged in

$id=$_SESSION['user']['type'];

if ($_SESSION['user']['type'] == 2 || $_SESSION['user']['type'] == 3) {
    echo '<script>window.location="hair.com_stylistAdmin_home.php"</script>';
    exit();
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="bootstrap-4.0.0-dist\css\bootstrap.min.css" rel="stylesheet"/><!-- Link to CSS Bootstrap -->
    <title>Home Hair.com</title>
</head>
<body>
<div class="float-right sticky-top" style="padding:1% 18%"><?php Button('Home', 'hair.com_home.php')  ?></div>

<!--
*********************INSERT BANNER**********************************
-->
<?php banner('Hair.com', 'Your ultimate hair booking system...'); ?>


<div class="container text-muted">

    <?php navBar(); ?>
    <div class="wrapper fadeInDown">
        <div id="formContent">



            Please select an option: <p/>
            <p/>
            <p/>

            <p/>
            <form method="get" action="appBookForm.php">
                <button class="btn btn-primary btn-block" ><h1>Book an appointment</h1></button>
            </form>
            <p/>
            <form method="get" action=" ">
                <button class="btn btn-primary btn-block"><h1>History</h1></button>
            </form>
            <p/>

            <form method="get" action=" ">
                <button class="btn btn-primary btn-block"><h1>Cancellation Watch</h1></button>
            </form>

            <p/>

            <form method="get" action=" ">
                <button class="btn btn-primary btn-block"><h1>Settings</h1></button>
            </form>

        </div>
    </div>
</div>






</body>
</html>