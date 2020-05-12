<?php

session_start();
include 'connectDb.php';
include 'myFunctions.php';

if (isset($_GET['edit'])) {
    $edit=$_GET['edit'];
}

user(); //This function check to see if the user is currently logged in

$customerID = $_GET["customerID"];
$serviceID = $_POST["serviceID"];
$stylistID = $_POST["stylistID"];

//get service name from Db
$query = "SELECT serviceName, cost, durationMins FROM tblservices where serviceID = $serviceID";
$result = mysqli_query($db, $query);
$row = $result->fetch_assoc(); // fetch_assoc() - Fetch a result row as an associative array. Can now be called "$row["name"]"
$serviceName = $row['serviceName'];
$cost = $row['cost'];
$duration = $row['durationMins'];
$slotsRequired = slotsRequired($duration);//this functoin will retuern the number of slots an appointment needs
echo "Slots Required - " . $slotsRequired . "<br> Time in mins required - " . $duration;


//get customer name from Db
$queryCust = "SELECT * FROM tblusers where UserID = $customerID";
$resultCust = mysqli_query($db, $queryCust);
$rowCust = $resultCust->fetch_assoc(); // fetch_assoc() - Fetch a result row as an associative array. Can now be called "$row["name"]"
$customerName = $rowCust['Firstname'] . " " . $rowCust['Surname'];

//Get stylist name from Db
$queryStyl = "SELECT * FROM tblusers where UserID = $stylistID";
$resultStyl = mysqli_query($db, $queryStyl);
$rowStyl = $resultStyl->fetch_assoc();
$stylistName = $rowStyl['Firstname'] . " " . $rowStyl['Surname'];

//Get appointments already booked for selected stylist
$queryBooked = "SELECT * FROM tblappointments where stylistID = $stylistID";


$result2 = get1Week();//Returns $result containing result of query for all slots for next week
$result3 = get2ndWeek();//Returns $result2 containing result of query for all slots for the following week

//compare both results ($resultBooked and $result2+3) and see if slotID matches any of the slots already
// booked for the stylist
$bookedSlotID = array();

//Now build array containing all appointment slots already booked for current stylist
$resultBooked = $db->query($queryBooked);
if ($resultBooked->num_rows > 0) {

    while ($row = mysqli_fetch_array($resultBooked)) {
        //$bookedSlotID = $row;
        array_push($bookedSlotID, $row['slotID']);

    }//end "while ($row = mysqli_fetch_array($result))"
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
        <!--    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">-->


        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
        <script src="https://cdn.rawgit.com/JacobLett/bootstrap4-latest/504729ba/bootstrap-4-latest.min.js"></script>


        <link rel="stylesheet"
              type="text/css"
              href="https://cdn.rawgit.com/JacobLett/bootstrap4-latest/504729ba/bootstrap-4-latest.min.css"/>


        <title>Select Slot</title>
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
        <div class="wrapper fadeInDown">
            <br id="formContent">

            <p></p>
            <?php
            if (in_array($customerID, hairAnalysis())) {
                echo "<p class='text-danger'>***WARNING: This customers last skin test has expired***</p>";
            }
            ?>

            <h5>Please select available slot for the following appointment:</h5>
            <p></p>
            <table width="80%" visible="false">
                <tr>
                    <td visible="false">
                        <Label ID="Label8" Font-Size=Smaller runat=server> Customer Name: </Label>
                    </td>
                    <td visible="false">
                        <Label Font-Size=Smaller runat=server><font
                                    color="black"><?php echo $customerName ?></font></Label>
                    </td>
                </tr>
                <tr>
                    <td visible="false">
                        <Label Font-Size=Smaller runat=server> Stylist name: </Label>
                    </td>
                    <td visible="false">
                        <Label Font-Size=Smaller runat=server><font
                                    color="black"><?php echo $stylistName ?></font></Label>
                    </td>
                </tr>

                <tr>
                    <td visible="false">
                        <Label Font-Size=Smaller runat=server> Appointment service: </Label>
                    </td>
                    <td visible="false">
                        <Label Font-Size=Smaller runat=server><font
                                    color="black"><?php echo $serviceName ?></font></Label>
                    </td>
                </tr>

                <tr>
                    <td visible="false">
                        <Label Font-Size=Smaller runat=server> Appointment duration: </Label>
                    </td>
                    <td visible="false">
                        <Label Font-Size=Smaller runat=server><font
                                    color="black"><?php echo $duration . "mins" ?></font></Label>
                    </td>
                </tr>

                <tr>
                    <td visible="false">
                        <Label ID="Label8" Font-Size=Smaller runat=server> Price: </Label>
                    </td>
                    <td visible="false">
                        <Label Font-Size=Smaller runat=server><font
                                    color="black">£<?php echo $cost ?></font></Label>
                    </td>
                </tr>

            </table>

            <br>Please select an available timeslot:</br>


            <?php
            $day1 = [];
            $day2 = [];
            $day3 = [];
            $day4 = [];
            $day5 = [];
            $day6 = [];
            $day7 = [];
            $day8 = [];
            $day9 = [];
            $day10 = [];

            if ($result2->num_rows > 0) {

                while ($row = mysqli_fetch_array($result2)) {

                    //  If slot ID is in $slotInDay elements, do not add to the $day arrays
                    if (!in_array($row['slotID'], $bookedSlotID)) {

                        $day = $row['start_event'];//Pulls date of app't start from array on each loop
                        $day = strtotime($day);//Formats that to timestamp(int)
                        $day = date("l", $day);//Changes $date to Day string with full wording

                        if ($day == "Tuesday") {
                            array_push($day1, $row);
                        }
                        if ($day == "Wednesday") {
                            array_push($day2, $row);
                        }
                        if ($day == "Thursday") {
                            array_push($day3, $row);
                        }
                        if ($day == "Friday") {
                            array_push($day4, $row);
                        }
                        if ($day == "Saturday") {
                            array_push($day5, $row);
                        }
                    }//end if (!in_array($row['slotID'], $bookedSlotID))

                }//end "while ($row = mysqli_fetch_array($result))"

//                //Day1 - if start slot is 09:00 then end slot is 09:00 + duration
//                echo "Var dump day1<br>";
//                var_dump($day1);
            }//end "if ($result->num_rows > 0)"

            if ($result3->num_rows > 0) {

                while ($row2 = mysqli_fetch_array($result3)) {

                    if (!in_array($row2['slotID'], $bookedSlotID)) {

                        $day = $row2['start_event'];//Pulls date of app't start from array on each loop
                        $day = strtotime($day);//Formats that to timestamp(int)
                        $day = date("l", $day);//Changes $date to Day string with full wording

                        if ($day == "Tuesday") {
                            array_push($day6, $row2);
                        }
                        if ($day == "Wednesday") {
                            array_push($day7, $row2);
                        }
                        if ($day == "Thursday") {
                            array_push($day8, $row2);
                        }
                        if ($day == "Friday") {
                            array_push($day9, $row2);
                        }
                        if ($day == "Saturday") {
                            array_push($day10, $row2);

                        }
                    }
                }//end "while ($row = mysqli_fetch_array($result))"


            }//end "if ($result->num_rows > 0)"
            //                echo "Day 1 = " . count($day1) . "<br>" . "Day 2 = " . count($day2) . "<br>" . "Day 3 = " . count($day3)
            //                    . "<br>" . "Day 4 = " . count($day4) . "<br>" . "Day 5 = " . count($day5) . "<br>";

            //Load populated arrays into milti dimentional array
            $toBeSorted = array();


            if (count($day1) > 0) {
                array_push($toBeSorted, $day1);
                // array_push($day3, $row);
            }
            if (count($day2) > 0) {
                array_push($toBeSorted, $day2);
            }
            if (count($day3) > 0) {
                array_push($toBeSorted, $day3);
            }
            if (count($day4) > 0) {
                array_push($toBeSorted, $day4);
            }
            if (count($day5) > 0) {
                array_push($toBeSorted, $day5);
            }

            if (count($day6) > 0) {
                array_push($toBeSorted, $day6);
                // array_push($day3, $row);
            }
            if (count($day7) > 0) {
                array_push($toBeSorted, $day7);
            }
            if (count($day8) > 0) {
                array_push($toBeSorted, $day8);
            }
            if (count($day9) > 0) {
                array_push($toBeSorted, $day9);
            }
            if (count($day10) > 0) {
                array_push($toBeSorted, $day10);
            }

            //Pass full list of days time slots to sortDays() function to be bubble sorted into correct order

            $sortedDays = sortDays($toBeSorted);

            ?>

            <form action="slotRoundUp.php<?php if (isset($edit)) {
                echo "?edit=$edit";
            } ?>" method="post">
                <?php

                //Loop through contents of $sortedDays array and present in button format for user selection
                for ($i = 0; $i < count($sortedDays); $i++) {
                    $ref = 0;
                    ?>
                    <div class="mb-1">
                        <button class="btn btn-primary btn-block" type="button" data-toggle="collapse"
                                data-target="#collapse<?php echo $sortedDays[$i][$ref][0] ?>"
                                aria-expanded="false" aria-controls="collapse<?php echo $sortedDays[$i][$ref][0] ?>">
                            <?php echo date('l jS \of F Y', strtotime($sortedDays[$i][0][1])) ?></button>

                        <div class="collapse" id="collapse<?php echo $sortedDays[$i][$ref][0] ?>">
                            <div class="card card-body">
                                <?php
                                for ($j = 0;
                                     $j < count($sortedDays[$i]);
                                     $j++) {

                                    if ($j <= count($sortedDays[$i])) {
                                        ?>
                                        <button type="submit" class="btn btn-outline-secondary btn-sm btn-block"
                                                name="slot" value=<?php echo $sortedDays[$i][$j][0] ?>>
                                            <?php
                                            echo date('G:i', strtotime($sortedDays[$i][$j][1])) . " - " .
                                                date('G:i', strtotime($sortedDays[$i][$j][2]));
                                            ?>
                                        </button>
                                        <?php
                                    }
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                    <?php
                    $ref++;
                }// end for loop
                ?>
                <!--                Now transfer other data to next form-->
                <input type="hidden" name="customerID"
                       value="<?php echo $customerID ?>">

                <input type="hidden" name="serviceID"
                       value="<?php echo $serviceID ?>">

                <input type="hidden" name="stylistID"
                       value="<?php echo $stylistID ?>">

            </form>
        </div>
    </div>
    </div>


    </body>
    </html>

<?php
