<?php

session_start();
include 'connectDb.php';
include 'myFunctions.php';

user(); //This function check to see if the user is currently logged in

$id = $_GET["customerID"];





$currentdate = date("Y-m-d") . " 00:00:00";

echo $currentdate . "<br>";



$serviceID = $_POST["serviceID"];
$stylistID = $_POST["stylistID"];

echo $id . " <br>" .  $serviceID. "<br>" . $stylistID;



//GET NEXT 2 WEEKS SLOTS

$query = "SELECT * FROM tblslots WHERE start_event >= $currentdate";
$result = mysqli_query($db, $query);
$data = array();

if (mysqli_num_rows($result)>0) {
    while($row = mysqli_fetch_assoc($result)){
        $data[]= $row;

        echo $row . "<br>";
    }
}

//SELECT * FROM tblslots WHERE start_event >= '2020-04-01 00:00:00' <----WORKED



//while ($row = mysqli_fetch_array($query)){
//
////
////    $result = $row['SlotID'];
////    echo $result . "<br>";
//}


?>

<style type="text/css">
    body {margin:2rem;}
</style>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link href="bootstrap-4.0.0-dist\css\bootstrap.min.css" rel="stylesheet"/><!-- Link to CSS Bootstrap -->
    <!--    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">-->


    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdn.rawgit.com/JacobLett/bootstrap4-latest/504729ba/bootstrap-4-latest.min.js"></script>

    <script src="js/myJS.js"></script>

    <link rel = "stylesheet"
          type = "text/css"
          href = "https://cdn.rawgit.com/JacobLett/bootstrap4-latest/504729ba/bootstrap-4-latest.min.css" />


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


            <button class="btn btn-primary btn-block" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                Button Name - Day/date
            </button>

            <div class="collapse" id="collapseExample">
                <div class="card card-body">
                    Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident.
                </div>
            </div>


            <button class="btn btn-primary btn-block" type="button" data-toggle="collapse" data-target="#collapseExample2" aria-expanded="false" aria-controls="collapseExample">
                Button Name - Day/date
            </button>


            <div class="collapse" id="collapseExample2">
                <div class="card card-body">
                    Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident.
                </div>
            </div>







        </div>
    </div>
</div>


</body>
</html>