<?php

date_default_timezone_set('Europe/London');

session_start();
include 'connectDb.php';
include 'myFunctions.php';

user(); //This function check to see if the user is currently logged in
if ($_SESSION['user']['type'] != 3 && $_SESSION['user']['type'] != 2) {
    echo '<script>window.location="hair.com_home.php"</script>';
    exit();
}


//pull stylist names for dropdown options
//Get stylist name from Db
$query = "SELECT UserID, Firstname, Surname FROM tblusers where UserType != 1";
$result = mysqli_query($db, $query);


?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link href="bootstrap-4.0.0-dist\css\bootstrap.min.css" rel="stylesheet"/><!-- Link to CSS Bootstrap -->


    <!--    google charts start-->
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <!--    Google charts end-->

    <!--Date picker START -->
    <!--  jQuery -->
    <script type="text/javascript" src="https://code.jquery.com/jquery-1.11.3.min.js"></script>

    <!-- Isolated Version of Bootstrap, not needed if your site already uses Bootstrap -->
    <link rel="stylesheet" href="https://formden.com/static/cdn/bootstrap-iso.css"/>

    <!-- Bootstrap Date-Picker Plugin -->
    <script type="text/javascript"
            src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>


    <!--  Datepicker   end-->


    <title>Stylists Reports</title>
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

            Stylists Reports: <p/>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6 col-sm-6 col-xs-12">

                        <form action="moneyReports.php" method="get" autocomplete="off">


                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Money</label>
                                <select class="col-sm-9" name="moneyChoice" required>
                                    <option value="1" disabled selected hidden>Please select...</option>
                                    <option value="money_in">Money in (No tips)</option>
                                    <option value="tip">Tips only</option>

                                </select>
                            </div>


                            <div class="form-group row"> <!-- Date input -->
                                <label class="col-sm-3 col-form-label" for="date">From date</label>
                                <input class="col-sm-9" id="date1" name="date1" placeholder="MM/DD/YYY"
                                       type="text" required/>
                            </div>


                            <div class="form-group row"> <!-- Date input -->
                                <label class="col-sm-3 col-form-label" for="date">To date</label>
                                <input class="col-sm-9" id="date2" name="date2" placeholder="MM/DD/YYY"
                                       type="text" required/>
                            </div>


                            <div class="form-group"> <!-- Submit button -->
                                <button class="btn btn-primary " id="submit" name="submit" type="submit" value="submit">
                                    Submit
                                </button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>

            <?php
            if (isset($_GET['submit'])) {


                $moneyType = $_GET['moneyChoice'] ?? 'all';
                $dateFrom = $_GET['date1'];
                //Convert date format
                $array = explode('/', $dateFrom);
                $tmp = $array[2];
                $array[2] = $array[0];
                $array[0] = $tmp;
                unset($tmp);
                $dateFrom = implode('-', $array);

                $dateTo = $_GET['date2'];
                //Convert date format
                $array = explode('/', $dateTo);
                $tmp = $array[2];
                $array[2] = $array[0];
                $array[0] = $tmp;
                unset($tmp);
                $dateTo = implode('-', $array);
            }
            ?>

            <div id="chart_div"></div>
        </div>
    </div>
</div>

<script>


    // datepicker start
    $(document).ready(function () {
        var date_input = $('input[name="date1"]'); //our date input has the name "date"
        var container = $('.bootstrap-iso form').length > 0 ? $('.bootstrap-iso form').parent() : "body";
        var options = {
            format: 'dd/mm/yyyy',
            container: container,
            todayHighlight: true,
            autoclose: true,
        };
        date_input.datepicker(options);
    })

    $(document).ready(function () {
        var date_input = $('input[name="date2"]'); //our date input has the name "date"
        var container = $('.bootstrap-iso form').length > 0 ? $('.bootstrap-iso form').parent() : "body";
        var options = {
            format: 'dd/mm/yyyy',
            container: container,
            todayHighlight: true,
            autoclose: true,
        };
        date_input.datepicker(options);
    })

    // datepicker end

</script>


<script>
    google.charts.load('current', {packages: ['corechart', 'bar']});
    google.charts.setOnLoadCallback(drawBasic);

    function drawBasic() {

        var data = google.visualization.arrayToDataTable([
            ['<?php echo $moneyType ?>', '<?php echo $moneyType ?> per stylist in £',],

            <?php
                $queryStylist = "select UserID FROM tblusers where userType!=1";
            $resultStylist = $db->query($queryStylist);

            while ($rowStylist=$resultStylist->fetch_assoc()){
                $stylist=$rowStylist['UserID'];


            $queryDetails = "select SUM($moneyType), tblusers.Firstname, tblusers.Surname from tblappointments
JOIN tblslots ON tblappointments.slotID=tblslots.slotID 
JOIN tblusers on tblappointments.stylistID=tblusers.UserID
where tblappointments.stylistID =$stylist AND tblslots.start_event BETWEEN '$dateFrom' AND '$dateTo'";


            $resultDetails = mysqli_query($db, $queryDetails);
            $rowDetails = $resultDetails->fetch_assoc();
            $stylistName = $rowDetails['Firstname'] . " " . $rowDetails['Surname'];

            if ($moneyType=='money_in') {
            $detail = $rowDetails['SUM(money_in)'];
            }
                if($moneyType=='tip') {
                    $detail = $rowDetails['SUM(tip)'] ?? 0;
                }
            ?>
            ['<?php echo $stylistName ?>', <?php echo $detail ?>],
            <?php
            }
            ?>
        ]);

        var options = {
            title: 'Money in between <?php echo $dateFrom . " to " . $dateTo ?>',
            chartArea: {width: '50%'},
            hAxis: {
                title: 'Money in £',
                minValue: 0
            },
            vAxis: {
                title: 'Stylist'
            }
        };

        var chart = new google.visualization.BarChart(document.getElementById('chart_div'));

        chart.draw(data, options);
    }</script>


</body>
</html>