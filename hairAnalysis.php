<?php

session_start();
include 'connectDb.php';
include 'myFunctions.php';

user();


$customerID = $_GET['val'];

$query = "SELECT Firstname, Surname, hairAnalysis FROM tblusers where UserID = $customerID";

$result = $db->query($query);
if ($result->num_rows > 0)

    $row = mysqli_fetch_array($result);
    $customerName = $row['Firstname'] . " " . $row['Surname'];
    $hairAnalysis = $row['hairAnalysis'];

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
    <title>Hair Analysis</title>
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
    //    $query = "SELECT * FROM tblusers where UserType = '1'";

    $query2 = "SELECT * FROM tblhairanalysis where customerID = $customerID";


?>
    <h3>Hair Analysis for <?php echo $customerName ?></h3>
    <p>Hair analysis setting - <span class="text-danger" ><?php if($hairAnalysis) echo "ENABLED";
    else echo "DISABLED";
    ?>
        </span>
        <?php

        if (in_array($customerID, hairAnalysis())) {
            echo "<p class='text-danger'>***WARNING: This customers most recent skin test has expired***</p>";
        }

        ?></p>

    <?php

    $result2 = $db->query($query2);





    ?>


    <table id="custTbl" class="display">
        <thead>
        <tr>
            <th scope="col">Analysis No.</th>
            <th scope="col">Date taken</th>
            <th scope="col">Texture</th>
            <th scope="col">Condition</th>
            <th scope="col">Natural Form</th>
            <th scope="col">Result</th>


        </tr>
        </thead>
        <?php
        if ($result2->num_rows > 0) {
        while ($row2 = mysqli_fetch_array($result2)) {



            $analysisNumber = $row2['analysisNo'];
            $dateTaken = date('d-m-Y', strtotime($row2['skinTestDate']));
            $texture = $row2['texture'];
            $condition = $row2['hairCondition'];
            $naturalform = $row2['naturalForm'];
            $testResult = $row2['result'];

            ?>
            <tr >
                <td> <?php echo $analysisNumber ?> </td>
                <td> <?php echo $dateTaken ?> </td>
                <td>  <?php

                    if ($row2['texture'] == 0)
                        echo "Fine";
                    elseif ($row2['texture'] == 1)
                        echo "Average";
                    elseif ($row2['texture'] == 2)
                        echo "Course";
                    ?> </td>

                <td>  <?php

                    if ($row2['hairCondition'] == 0)
                        echo "Dry";
                    elseif ($row2['hairCondition'] == 1)
                        echo "Normal";
                    elseif ($row2['hairCondition'] == 2)
                        echo "Oily";
                    ?> </td>

                <td>  <?php

                    if ($row2['naturalForm'] == 0)
                        echo "Straight";
                    elseif ($row2['naturalForm'] == 1)
                        echo "Wavy";
                    elseif ($row2['naturalForm'] == 2)
                        echo "Curly";
                    ?> </td>

                <td> <?php echo $testResult ?> </td>





            </tr>

            <?php


        }//end "while ($row = mysqli_fetch_array($result))"

        }//end "if ($result->num_rows > 0)"
        ?>
    </table>

    <div>
            <button type="button" class="btn btn-info" onclick="location.href='hairAnalysisForm.php?val=<?php echo $customerID ?>'">Add new analysis</button>


        <button type="button" class="btn btn-info" onclick="location.href='Customers.php';">Back to Customers</button>
    </div>

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
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    });

    $('.dataTables_length').addClass('bs-select');

</script>


</body>
</html>
