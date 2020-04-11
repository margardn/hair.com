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
    <title>Customers</title>
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

    $query = "SELECT * FROM tblusers";


    $result = $db->query($query);
    if ($result->num_rows > 0) {
    ?>

    <h3>Client list</h3>
    <table id="custTbl" class="display nowrap">
        <thead>
        <tr>
            <th scope="col">User ID</th>
            <th scope="col">User Type</th>
            <th scope="col">Name</th>
            <th scope="col">Email Address</th>
            <th scope="col">Contact No</th>
            <th scope="col">Address</th>
            <th scope="col">Date Registered</th>
            <th scope="col">Action</th>

        </tr>
        </thead>
        <?php

        while ($row = mysqli_fetch_array($result)) {

            $id = $row['UserID'];
            $Firstname = $row['Firstname'];
            $surname = $row['Surname'];
            $username = $row['Username'];
            $phonenumber = $row['phonenumber'];
            $address1 = $row['address1'];
            $address2 = $row['address2'];
            $postcode = $row['postcode'];

            ?>
            <tr >
                <td> <?php echo $row['UserID'] ?> </td>
                <td>  <?php

                    if ($row['UserType'] == 1)
                        echo "Client";
                    elseif ($row['UserType'] == 2)
                        echo "Stylist";
                    elseif ($row['UserType'] == 3)
                        echo "Admin";
                    ?> </td>



<!--                <td> --><?php //echo $row['Firstname'] . " " . $row['Surname'] ?><!-- </td>-->

                <td> <div contentEditable='true' class='edit' id='Firstname_<?php echo $id; ?>'>
                        <?php echo $Firstname; ?>
                    </div> <div contentEditable='true' class='edit' id='Surname_<?php echo $id; ?>'>
                        <?php echo $surname; ?>
                    </div></td>

                <td> <div contentEditable='true' class='edit' id='username_<?php echo $id; ?>'>
                        <?php echo $username; ?>
                    </div></td>
                <td> <div contentEditable='true' class='edit' id='phonenumber_<?php echo $id; ?>'>
                        <?php echo $phonenumber; ?>
                    </div></td>


                <td> <div contentEditable='true' class='edit' id='address1_<?php echo $id; ?>'>
                        <?php echo $address1; ?>
                    </div> <div contentEditable='true' class='edit' id='Address2_<?php echo $id; ?>'>
                        <?php echo $address2; ?>
                    </div><div contentEditable='true' class='edit' id='postcode_<?php echo $id; ?>'>
                        <?php echo $postcode; ?>
                    </div></td>

                <td> <?php echo strtok($row['DateRegistered'], " ") ?></td>

                <td>
                    <button type="button" class="btn btn-info" onclick="location.href='stylistAppBookForm.php?val=<?php echo $id  ?>';">Book</button>
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
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    });

    $('.dataTables_length').addClass('bs-select');

</script>

<script>
    $(document).ready(function(){

        // Add Class
        $('.edit').click(function(){
            $(this).addClass('editMode');
        });

        // Save data
        $(".edit").focusout(function(){
            $(this).removeClass("editMode");
            var id = this.id;
            var split_id = id.split("_");
            var field_name = split_id[0];
            var edit_id = split_id[1];
            var value = $(this).text();

            $.ajax({
                url: 'updateCust.php',
                type: 'post',
                data: { field:field_name, value:value, id:edit_id },
                success:function(response){
                    console.log('Save successfully');
                }
            });

        });

    });
</script>

</body>
</html>
