<?php

session_start();
include 'connectDb.php';
include 'myFunctions.php';

user(); //This function check to see if the user is currently logged in

$customerID = $_GET["customerID"];


$serviceID = $_POST["serviceID"];
$stylistID = $_POST["stylistID"];

echo $customerID . " <br>" . $serviceID . "<br>" . $stylistID . "<br>";


$result = get1Week();//Returns $result containing result of query for all slots for next 2 weeks
//var_dump($result);

?>

    <style type="text/css">
        body {
            margin: 2rem;
        }
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

        <link rel="stylesheet"
              type="text/css"
              href="https://cdn.rawgit.com/JacobLett/bootstrap4-latest/504729ba/bootstrap-4-latest.min.css"/>


        <title>Admin/Home Hair.com</title>
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
            <div id="formContent">


                Please select an option: <p/>
                <p/>
                <p/>

                <?php
                $day1 = [];
                $day2 = [];
                $day3 = [];
                $day4 = [];
                $day5 = [];


                if ($result->num_rows > 0) {

                    while ($row = mysqli_fetch_array($result)) {

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

                    }//end "while ($row = mysqli_fetch_array($result))"
                }//end "if ($result->num_rows > 0)"

//                echo "Day 1 = " . count($day1) . "<br>" . "Day 2 = " . count($day2) . "<br>" . "Day 3 = " . count($day3)
//                    . "<br>" . "Day 4 = " . count($day4) . "<br>" . "Day 5 = " . count($day5) . "<br>";

                //sort arrays
                $sortedDays = sortDays(array($day1, $day2, $day3, $day4, $day5));

                //echo count($sortedDays[1][0]);
              // var_dump($sortedDays);
//                print_r($sortedDays[1][0]);
//                echo $sortedDays[1][0][2];

                ?>

                <form action="slotRoundUp.php" method="post">

                <?php


                for ($i = 0; $i < count($sortedDays); $i++) {
                    ?>


                    <div class="mb-1">
                        <button class="btn btn-primary btn-block" type="button" data-toggle="collapse"
                                data-target="#collapse<?php echo $sortedDays[0][$i][0] ?>"
                                aria-expanded="false" aria-controls="collapse<?php echo $sortedDays[0][$i][0] ?>">
                            <?php echo date('l jS \of F Y', strtotime($sortedDays[$i][0][1]))?></button>


                        <div class="collapse" id="collapse<?php echo $sortedDays[0][$i][0] ?>">
                            <div class="card card-body">
                                <?php
                                for ($j = 0; $j < count($sortedDays[$i]); $j++) {
                                    ?>



                                    <button type="submit" class="btn btn-outline-secondary btn-sm btn-block"
                                            name="slot" value=<?php echo $sortedDays[$i][$j][0]  ?>>
                                        <?php
                                        echo date('G:i', strtotime($sortedDays[$i][$j][1])) . " - " .
                                            date('G:i', strtotime($sortedDays[$i][$j][2]));
                                        ?>
                                    </button>


                                    <?php
                                }
                                ?>

                            </div>
                        </div>


                    </div>



                    <?php
                }// end for loop
                ?>

                    <input type="hidden" name="customerID"
                           value="<?php echo $customerID  ?>">

                    <input type="hidden" name="serviceID"
                           value="<?php echo $serviceID   ?>">

                    <input type="hidden" name="stylistID"
                           value="<?php echo $stylistID   ?>">

                </form>


            </div>
        </div>
    </div>


    </body>
    </html>

<?php

//var_dump($sortArray[0][0][1]);
//var_dump($sortArray[1][0][1]);

function sortDays($array1)
{


    $isSorted = false;

    while (!$isSorted) {

        $isSorted = true;


        for ($i = 0; $i < count($array1) - 1; $i++) {


            if ($array1[$i][0][1] > $array1[$i + 1][0][1]) {

                $temp = $array1[$i];
                $array1[$i] = $array1[$i + 1];
                $array1[$i + 1] = $temp;

                $isSorted = false;
            }


        }
    }

    return $array1;

}

