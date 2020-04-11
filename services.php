<?php
session_start();
include 'connectDb.php';
include 'myFunctions.php';

user();

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
    <title>Services</title>
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

    $query = "SELECT * FROM tblservices";


    $result = $db->query($query);
    if ($result->num_rows > 0) {
    ?>

    <h3>Services</h3>
    <table id="custTbl" class="display nowrap">
        <thead>
        <tr>
            <th scope="col">Service</th>
            <th scope="col">Duration</th>
            <th scope="col">Dev time</th>
            <th scope="col">Price</th>
            <?php
            if (isset($_SESSION['user']['type']) && $_SESSION['user']['type'] == 3) {
                ?>

                <th scope="col">Remove?</th>

                <?php
            }//close if(isset($_SESSION['user']['type'])==3)
            ?>


        </tr>
        </thead>
        <?php

        while ($row = mysqli_fetch_array($result)) {

            $id = $row['serviceID'];
            $service = $row['serviceName'];
            $duration = $row['durationMins'];
            $devTime = $row['devTimeMins'] ?? "No";
            $price = $row['cost'];

            ?>
            <tr>
                <td>

                    <div contentEditable='true' class='edit' id='serviceName_<?php echo $id; ?>'>
                        <?php echo $service ?>
                    </div>


                </td>
                <td>
                    <div contentEditable='true' class='edit' id='durationMins_<?php echo $id; ?>'>
                        <?php echo $duration ?>
                    </div>
                </td>
                <td>
                    <div contentEditable='true' class='edit' id='devTimeMins_<?php echo $id; ?>'>
                        <?php echo $devTime ?>
                    </div>
                </td>
                <td>
                    <div contentEditable='true' class='edit' id='cost_<?php echo $id; ?>'>
                        £<?php echo $price ?>
                    </div>
                </td>
                <?php
                if (isset($_SESSION['user']['type']) && $_SESSION['user']['type'] == 3) {
                    ?>

                    <td>
                        <button type="button" class="btn btn-info"

                                deletePost()
                                onclick=deletePost()>Delete</button>
                    </td>

                    <?php
                }
                ?>


            </tr>

            <?php
        }//end "while ($row = mysqli_fetch_array($result))"

        }//end "if ($result->num_rows > 0)"
        ?>
    </table>
    <p/>
    <form action="addService.php">
        <input type="submit" class="btn btn-lg btn-block" id="addrow" value="Add Service"/>
    </form>

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

<script>
    $(document).ready(function () {

        // Add Class
        $('.edit').click(function () {
            $(this).addClass('editMode');
        });

        // Save data
        $(".edit").focusout(function () {
            $(this).removeClass("editMode");
            var id = this.id;
            var split_id = id.split("_");
            var field_name = split_id[0];
            var edit_id = split_id[1];
            var value = $(this).text();


            $.ajax({
                url: 'updateService.php',
                type: 'post',
                data: {field: field_name, value: value, id: edit_id},
                beforeSend: function () {
                    return confirm("You have changed a value. Are you sure you want to save?");
                },
                success: function (response) {
                    console.log('Save successfully');
                }
            });

        });



    });


    function deletePost() {
        var ask = window.confirm("Are you sure you want to delete this Service?");
        if (ask) {
            //window.alert("This post was successfully deleted.");

            window.location.href = "removeService.php?val=<?php echo $id  ?>";

        }
    }

</script>


</body>
</html>