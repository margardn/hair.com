<?php
session_start();
include 'connectDb.php';
include 'myFunctions.php';
user();


?>

<!DOCTYPE html>
<html>
<head>
    <title>View Appointments</title>


    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" type="text/css" href="css/jquery.dataTables.min.css"/>

        <link rel="stylesheet" type="text/css" href="css/buttons.dataTables.min.css"/>

        <link href="bootstrap-4.0.0-dist\css\bootstrap.min.css" rel="stylesheet"/><!-- Link to CSS Bootstrap -->


        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.css"/>
        <!--    <link rel="stylesheet"-->
        <!--          href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha.6/css/bootstrap.css"/>-->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.js"></script>

        <script>

            $(document).ready(function () {
                var calendar = $('#calendar').fullCalendar({

                    // minTime: "08:00:00",
                    // maxTime: "18:00:00",
                    //default: 1,
                    editable: false,
                    allDaySlot: false,
                    height: "auto",
                    header: {
                        left: 'prev,next today',
                        center: 'title',
                        right: 'month,agendaWeek,agendaDay'
                    },

                    events: "load.php?>",
                    defaultView: 'agendaWeek',

                    businessHours: {
                        start: '09:00',
                        end: '17:00',
                        dow: [2, 3, 4, 5, 6]
                    },
                    minTime: "08:30:00",
                    maxTime: "17:30:00",

                    selectable: false,

                    // selectHelper: true,
                    // select: function (start, end, allDay) {
                    //     var title = prompt("Enter Event Title");
                    //     if (title) {
                    //         var start = $.fullCalendar.formatDate(start, "Y-MM-DD HH:mm:ss");
                    //         var end = $.fullCalendar.formatDate(end, "Y-MM-DD HH:mm:ss");
                    //         $.ajax({
                    //             url: "insert.php",
                    //             type: "POST",
                    //             data: {title: title, start: start, end: end},
                    //             success: function () {
                    //                 calendar.fullCalendar('refetchEvents');
                    //                 alert("Added Successfully");
                    //             }
                    //         })
                    //     }
                    // },
                    // editable: false,
                    // eventResize: function (event) {
                    //     var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");
                    //     var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");
                    //     var title = event.title;
                    //     var id = event.id;
                    //     $.ajax({
                    //         url: "update.php",
                    //         type: "POST",
                    //         data: {title: title, start: start, end: end, id: id},
                    //         success: function () {
                    //             calendar.fullCalendar('refetchEvents');
                    //             alert('Event Update');
                    //         }
                    //     })
                    // },
                    //
                    // eventDrop: function (event) {
                    //     var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");
                    //     var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");
                    //     var title = event.title;
                    //     var id = event.id;
                    //     $.ajax({
                    //         url: "update.php",
                    //         type: "POST",
                    //         data: {title: title, start: start, end: end, id: id},
                    //         success: function () {
                    //             calendar.fullCalendar('refetchEvents');
                    //             alert("Event Updated");
                    //         }
                    //     });
                    // },
                    //


                    eventClick: function (event) {
                        // if (confirm("You have selected to remove this appointment. Are you sure you want to remove it?")) {
                        //     var id = event.id;
                        //     $.ajax({
                        //         url: "delete.php",
                        //         type: "POST",
                        //         data: {id: id},
                        //         success: function () {
                        //             calendar.fullCalendar('refetchEvents');
                        //             alert("Event Removed");
                        //         }
                        //     })
                        // }
                        //
                        // header("Location: customers.php");


                        if (confirm("Open appointment details?")) {
                            window.location = "appointmentDetails.php?event=" + event.id;
                        }
                    },
                });
            });
        </script>

    </head>
<body>
<div class="float-right sticky-top"
     style="padding:1% 18%"><?php Button('Admin Home', 'hair.com_stylistAdmin_home.php') ?></div>

<!--
*********************INSERT BANNER**********************************
-->
<?php banner('Hair.com', 'Your schedule...'); ?>


<div class="container text-muted">

    <?php navBar(); ?>

    <div class="btn-group-toggle">

        <p></p>

        <?php
        //pull stylist names and display in buttons using loop
        //Get stylist name from Db
        $query = "SELECT UserID, Firstname, Surname FROM tblusers where UserType != 1";
        $result = mysqli_query($db, $query);
        $row = $result->fetch_assoc();


        ?>

        <button class="btn btn-light" onclick="location.href='redirect.php?custID=0';">All Stylists</button>

        <?php

        if ($result->num_rows > 0) {


        foreach ($result

        as $row) {
        $user = $row['UserID'];
        ?>


        <button class="btn btn-light"
                onclick="location.href='redirect.php?custID=<?php echo $user ?>';"><?php echo $row['Firstname']
                . " " . $row['Surname']; ?></button>

        <tr style="cursor: pointer;" onclick="location.href='appBookForm.php?custID=<?php echo $id ?>';">

            <!--                <form class="float-left " method="get" action="redirect.php?val=11">-->
            <!--                    <button class="btn btn-light">-->
            <?php //echo $row['Firstname'] . " " . $row['Surname']; ?><!--</button>-->
            <!--                </form>-->


            <?php

            }//end  foreach ($result as $row)
            }//end if ($result->num_rows > 0)
            ?>


            <form class="float-right " method="get" action="bookApp.php">
                <button class="btn btn-info">Book Appointment</button>
            </form>


            <p></p>
    </div>
    <div class="container float-left">
        <h5><?php if (isset($_SESSION['schedule']['stylist'])) {

                //echo $_SESSION['schedule']['stylist'];
                if ($_SESSION['schedule']['stylist'] == 0) {
                    echo "All Stylists ";
                } else {


                    $user = $_SESSION['schedule']['stylist'];

                    $query2 = "SELECT * FROM tblusers where UserID = $user";
                    $result2 = mysqli_query($db, $query2);
                    $row = $result2->fetch_assoc();

                    echo $row['Firstname'] . " " . $row['Surname'] . " - ";
                }

            } elseif (!isset($_SESSION['schedule']['stylist'])) {

                echo $_SESSION['user']['firstname'] . " " . $_SESSION['user']['surname'] . " - ";
                ?>
                <?php
            }
            ?>Schedule</h5>


        <p></p>
        <div id="calendar"></div>

    </div>
</div>


</body>
</html>