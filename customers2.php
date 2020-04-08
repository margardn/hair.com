<?php

session_start();
include 'connectDb.php';
include 'myFunctions.php';

if(isset($_SESSION['field']))
    echo $_SESSION['field'] . " - Field <br>" .  $_SESSION['value'] . " - Value <br>" . $_SESSION['EditID'] . " - EditID <br>";

?>
<style>
    .edit{
        width: 100%;
        height: 25px;
    }
    .editMode{
        border: 1px solid black;
    }

    /* Table Layout */
    table {
        border:3px solid lavender;
        border-radius:3px;
    }

    table tr:nth-child(1){
        background-color:dodgerblue;
    }
    table tr:nth-child(1) th{
        color:white;
        padding:10px 0px;
        letter-spacing: 1px;
    }

    /* Table rows and columns */
    table td{
        padding:10px;
    }
    table tr:nth-child(even){
        background-color:lavender;
        color:black;
    }
</style>
<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
<div class='container'>

    <table width='100%' border='0'>
        <tr>
            <th width='10%'>User ID</th>
            <th width='40%'>Username</th>
            <th width='40%'>Name</th>
        </tr>
        <?php
        $query = "select * from tblusers";
        $result = mysqli_query($db,$query);

        while($row = mysqli_fetch_array($result) ){
            $id = $row['UserID'];
            $username = $row['Username'];
            $Firstname = $row['Firstname'];
            ?>
            <tr>
                <td><?php echo $row['UserID']; ?></td>
                <td>
                    <div contentEditable='true' class='edit' id='username_<?php echo $id; ?>'>
                        <?php echo $username; ?>
                    </div>
                </td>
                <td>
                    <div contentEditable='true' class='edit' id='Firstname_<?php echo $id; ?>'>
                        <?php echo $Firstname; ?>
                    </div>
                </td>
            </tr>
            <?php
        }
        ?>
    </table>

</div>

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
                url: 'update.php',
                type: 'post',
                data: { field:field_name, value:value, id:edit_id },
                success:function(response){
                    console.log('Save successfully');

                    echo '<script>alert("Updated successfully")</script>';
                }
            });

        });

    });
</script>