<?php
session_start();
include 'connectDb.php';
include 'myFunctions.php';

user(); //This function check to see if the user is currently logged in
if ($_SESSION['user']['type']!=3 && $_SESSION['user']['type']!=2){
    echo '<script>window.location="hair.com_home.php"</script>';
    exit();
}

//printAllSessionVars();

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
<div class="float-right sticky-top" style="padding:1% 18%"><?php Button('Admin Home', 'hair.com_stylistAdmin_home.php')  ?></div>

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
            <form method="get" action="viewAppointments.php">
                <button class="btn btn-primary btn-block"><h1>View/Edit Appointments</h1></button>
            </form>
            <p/>
            <form method="get" action="customers.php">
                <button class="btn btn-primary btn-block"><h1>View/Edit Customers</h1></button>
            </form>
            <p/>

            <form method="get" action="createUser.php">
                <button class="btn btn-primary btn-block"><h1>Create client</h1></button>
            </form>

            <p/>

            <form method="get" action="bookApp.php">
                <button class="btn btn-primary btn-block"><h1>Book Appointment</h1></button>
            </form>

            <p/>

            <p/>

            <form method="get" action="services.php">
                <button class="btn btn-primary btn-block"><h1>View/Edit Services</h1></button>
            </form>

            <p/>

            <form method="get" action="reports.php">
                <button class="btn btn-primary btn-block"><h1>Generate Reports</h1></button>
            </form>


        </div>
    </div>
</div>


</body>
</html>