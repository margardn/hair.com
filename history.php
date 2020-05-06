<?php
session_start();
include 'connectDb.php';
include 'myFunctions.php';

user(); //This function check to see if the user is currently logged in

$id = $_SESSION['user']['id'];

if ($_SESSION['user']['type'] == 2 || $_SESSION['user']['type'] == 3) {
    echo '<script>window.location="hair.com_stylistAdmin_home.php"</script>';
    exit();
}


$query = "SELECT tblappointments.apptID, tblappointments.money_in, tblusers.Firstname, tblusers.Surname, tblservices.serviceName,
       tblservices.cost, tblslots.start_event, tblslots.end_event 

FROM tblappointments 
    JOIN tblusers ON tblappointments.stylistID = tblusers.UserID 
    JOIN tblslots ON tblappointments.slotID = tblslots.slotID 
    JOIN tblservices ON tblappointments.serviceID = tblservices.serviceID 

WHERE tblappointments.customerID=$id";


?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="bootstrap-4.0.0-dist\css\bootstrap.min.css" rel="stylesheet"/><!-- Link to CSS Bootstrap -->
    <title>History</title>
</head>
<body>
<div class="float-right sticky-top" style="padding:1% 18%"><?php Button('Home', 'hair.com_home.php') ?></div>

<!--
*********************INSERT BANNER**********************************
-->
<?php banner('Hair.com', 'Your ultimate hair booking system...'); ?>


<div class="container text-muted">

    <?php navBar(); ?>
    <div class="wrapper fadeInDown">
        <div id="formContent">


            <p>To make changes to upcoming appointments just click the appointment </p>

            <p></p>
            <h5>Upcoming Appointments</h5>

            <table class="table table-striped">
                <thead>
                <tr>
                    <th scope="col">Ref</th>
                    <th scope="col">Stylist name</th>
                    <th scope="col">Service</th>
                    <th scope="col">Date</th>
                    <th scope="col">Time</th>
                    <th scope="col">Price</th>
                    <th scope="col">Action</th>
                </tr>
                </thead>
                <tbody>

                <?php
                $result = $db->query($query);

                while ($row = $result->fetch_assoc()) {


                    $checkDate = new DateTime($row['start_event']);
                    $now = new DateTime();

                    $date = date('l jS \of F Y', strtotime($row['start_event']));

                    $apptTime = date('G:i', strtotime($row['start_event'])) . " - " .
                        date('G:i', strtotime($row['end_event']));

                    //determine if app't is past or present

                    if ($checkDate > $now) {

                        ?>


                        <tr>
                            <th scope="row"><?php echo $row['apptID'] ?></th>
                            <td><?php echo $row['Firstname'] . " " . $row['Surname'] ?></td>
                            <td><?php echo $row['serviceName'] ?></td>
                            <td><?php echo $date ?></td>
                            <td><?php echo $apptTime ?></td>
                            <td><?php echo "£" . $row['cost'] ?></td>
                            <td>
                                <button type="button" class="btn btn-info" onclick="location.href='appointmentDetails.php?event=<?php echo $row['apptID']  ?>';">Open Appt</button>
                            </td>
                        </tr>

                        <?php
                    }//end if ($checkDate>$now)

                }//end while ($row = $result->fetch_assoc())

                ?>


                </tbody>
            </table>


            <h5>Previous Appointments</h5>
            <table class="table table-striped">
                <thead>
                <tr>
                    <th scope="col">Ref</th>
                    <th scope="col">Stylist name</th>
                    <th scope="col">Service</th>
                    <th scope="col">Date</th>
                    <th scope="col">Time</th>
                    <th scope="col">Amount Paid</th>
                </tr>
                </thead>
                <tbody>

                <?php
                $result = $db->query($query);

                while ($row = $result->fetch_assoc()) {


                    $checkDate = new DateTime($row['start_event']);
                    $now = new DateTime();

                    $date = date('l jS \of F Y', strtotime($row['start_event']));

                    $apptTime = date('G:i', strtotime($row['start_event'])) . " - " .
                        date('G:i', strtotime($row['end_event']));

                    //determine if app't is past or present

                    if ($checkDate < $now) {

                        ?>


                        <tr>
                            <th scope="row"><?php echo $row['apptID'] ?></th>
                            <td><?php echo $row['Firstname'] . " " . $row['Surname'] ?></td>
                            <td><?php echo $row['serviceName'] ?></td>
                            <td><?php echo $date ?></td>
                            <td><?php echo $apptTime ?></td>
                            <td><?php echo "£" . $row['money_in'] ?></td>
                        </tr>

                        <?php
                    }//end if ($checkDate>$now)

                }//end while ($row = $result->fetch_assoc())

                ?>


                </tbody>
            </table>


        </div>
    </div>


</div>
</body>
</html>