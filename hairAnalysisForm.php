<?php
session_start();
include 'connectDb.php';
include 'myFunctions.php';

user();


$customerID = $_GET['val'];

$query = "SELECT Firstname, Surname, hairAnalysis FROM tblusers where UserID = $customerID";

$result = $db->query($query);
if ($result->num_rows > 0) {
    $row = mysqli_fetch_array($result);
    $customerName = $row['Firstname'] . " " . $row['Surname'];
    $hairAnalysis = $row['hairAnalysis'];
}
//    $query = "SELECT * FROM tblusers where UserType = '1'";

$query2 = "SELECT * FROM tblhairanalysis where customerID = $customerID";
$result2 = $db->query($query2);
if ($result2->num_rows > 0) {
    $row2 = mysqli_fetch_array($result2);
    $texture = $row2['texture'];
    $condition = $row2['hairCondition'];
    $form = $row2['naturalForm'];
}

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

        <h3>Add New Hair Analysis for <?php echo $customerName ?></h3>

        <div class="wrapper fadeInDown">
            <div id="formContent">

                <BR>

                <div class="modal-body">

                    <form action="hairAnalysisAdd.php" method="post">

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Texture</label>
                            <select class="col-sm-9" name="texture" required>

                                <?php
                                if (!isset($texture)) {
                                    ?>
                                    <option value="" disabled selected hidden>Please select...</option>

                                    <?php
                                }
                                ?>

                                <option value="0" <?php if (isset($texture) && ($texture == 0)) echo "selected" ?> >
                                    Fine
                                </option>
                                <option value="1" <?php if (isset($texture) && ($texture == 1)) echo "selected" ?> >
                                    Average
                                </option>
                                <option value="2" <?php if (isset($texture) && ($texture == 2)) echo "selected" ?> >
                                    Course
                                </option>
                            </select>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Condition</label>
                            <select class="col-sm-9" name="condition" required>

                                <?php
                                if (!isset($condition)) {
                                    ?>
                                    <option value="" disabled selected hidden>Please select...</option>

                                    <?php
                                }
                                ?>

                                <option value="0" <?php if (isset($condition) && ($condition == 0)) echo "selected" ?>>
                                    Dry
                                </option>
                                <option value="1"<?php if (isset($condition) && ($condition == 1)) echo "selected" ?>>
                                    Normal
                                </option>
                                <option value="2"<?php if (isset($condition) && ($condition == 2)) echo "selected" ?>>
                                    Oily
                                </option>
                            </select>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Natural Form</label>
                            <select class="col-sm-9" name="form" required>

                                <?php
                                if (!isset($form)) {
                                    ?>
                                    <option value="" disabled selected hidden>Please select...</option>

                                    <?php
                                }
                                ?>

                                <option value="0"<?php if (isset($form) && ($form == 0)) echo "selected" ?>>Straight
                                </option>
                                <option value="1"<?php if (isset($form) && ($form == 1)) echo "selected" ?>>Wavy
                                </option>
                                <option value="2"<?php if (isset($form) && ($form == 2)) echo "selected" ?>>Curly
                                </option>
                            </select>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Date of skin test</label>
                            <div class="col-sm-9" required>
                                <input type="text" class="form-control" name="date"
                                       value="<?php echo date("d-m-Y") ?>" readonly>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Observations</label>
                            <div class="col-sm-9">
                                <textarea type="text" rows="5" class="form-control" name="obs" required></textarea>
                            </div>
                        </div>


                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Further analysis required?</label>
                            <select class="col-sm-9" name="test" required>

                                <?php
                                if (!isset($form)) {
                                    ?>
                                    <option value="" disabled selected hidden>Please select...</option>

                                    <?php
                                }//end if(!isset($form))

                                ?>
                                <option value="1"<?php if (isset($hairAnalysis) && ($hairAnalysis == 1)) echo "selected" ?>>
                                    Yes
                                </option>
                                <option value="0"<?php if (isset($hairAnalysis) && ($hairAnalysis == 0)) echo "selected" ?>>
                                    No
                                </option>

                            </select>
                        </div>


                        <input type="hidden" name="customerID"
                               value="<?php echo $customerID ?>">


                        <div><input type="submit" class="btn btn-default" id="submit-button" value="Submit">
                            <button type="button" class="btn btn-info" onclick="location.href='Customers.php';">Back to
                                Customers
                            </button>
                        </div>
                    </form>
                    <div>

                    </div>

                </div>
            </div>
        </div>
    </div> <!-- close container -->

    <script src="js/myJS.js"></script>
    </body>
    </html>

<?php