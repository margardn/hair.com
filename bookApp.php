<?php
session_start();
include 'connectDb.php';
include 'myFunctions.php';

?>


<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="css/jquery.dataTables.min.css"/>

    <link rel="stylesheet" type="text/css" href="css/buttons.dataTables.min.css"/>

    <link href="bootstrap-4.0.0-dist\css\bootstrap.min.css" rel="stylesheet"/><!-- Link to CSS Bootstrap -->
    <link href="css/my.css" rel="stylesheet"/>

    <!--    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">-->
    <title>Book Appt Hair.com</title>
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

    <p></p>
    <?php

    $query = "SELECT * FROM tblusers";

    $result = $db->query($query);
    if ($result->num_rows > 0) {
    ?>

    <h3>Select client</h3>
    <table id="custTbl" class="display nowrap" >
        <thead>
        <tr>
            <th scope="col">User ID</th>
            <th scope="col">Name</th>
            <th scope="col">Email Address</th>
            <th scope="col">Contact No</th>
        </tr>
        </thead>
        <?php

        while ($row = mysqli_fetch_array($result)) {

            $id = $row['UserID'];
            $Firstname = $row['Firstname'];
            $surname = $row['Surname'];
            $username = $row['Username'];
            $phonenumber = $row['phonenumber'];

            ?>
            <tr style="cursor: pointer;" onclick="location.href='appBookForm.php?val=<?php echo $id  ?>';" >
            <td> <?php echo $row['UserID'] ?> </td>
                <td>
                    <div> <?php echo $Firstname . " " . $surname ?> </div>
                </td>
                <td>
                    <div class='edit' id='<?php echo $id; ?>'> <?php echo $username; ?> </div>
                </td>
                <td>
                    <div class='edit' id='<?php echo $id; ?>'> <?php echo $phonenumber; ?></div>
                </td>
            </tr>

            <?php


        }//end "while ($row = mysqli_fetch_array($result))"

        }//end "if ($result->num_rows > 0)"
        ?>
    </table>

</div>

<script type="text/javascript" src="js/jquery-3.3.1.js"></script>
<script type="text/javascript" src="js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="js/buttons.flash.min.js"></script>
<script type="text/javascript" src="js/jszip.min.js"></script>
<script type="text/javascript" src="js/pdfmake.min.js"></script>
<script type="text/javascript" src="js/vfs_fonts.js"></script>
<script type="text/javascript" src="js/buttons.html5.min.js"></script>
<script type="text/javascript" src="js/buttons.print.min.js"></script>

<script type="text/javascript">


    $('#custTbl').DataTable({

    });

    $('.dataTables_length').addClass('bs-select');

</script>




</body>
</html>
