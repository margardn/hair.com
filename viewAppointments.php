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
                editable: true,
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'month,agendaWeek,agendaDay'
                },
                events: 'load.php',
                // selectable: true,
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
                    if (confirm("You have selected to remove this appointment. Are you sure you want to remove it?")) {
                        var id = event.id;
                        $.ajax({
                            url: "delete.php",
                            type: "POST",
                            data: {id: id},
                            success: function () {
                                calendar.fullCalendar('refetchEvents');
                                alert("Event Removed");
                            }
                        })
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

    <p></p>
    <br/>
    <div class="container">
        <div id="calendar"></div>
    </div>
</div>
</body>
</html>