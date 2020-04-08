<?php
session_start();
include 'connectDb.php';
include 'myFunctions.php';

user();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Service</title>
    <link href="bootstrap-4.0.0-dist\css\bootstrap.min.css" rel="stylesheet"/><!-- Link to CSS Bootstrap -->

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

<div class="container text-muted">
    <div class="wrapper fadeInDown">
        <div id="formContent">

            <BR>
            <h4>Add service</h4>
            <BR>
            <div class="modal-body">

                <form action="addServiceConfirm.php" method="post">

                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Service Name</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="servicename" required>
                        </div>
                    </div>


                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Duration in Mins</label>
                        <select class="col-sm-9" name="duration" required>
                            <option value="" disabled selected hidden>Please select...</option>
                            <option value="30">30 mins</option>
                            <option value="60">60 mins/1 hour</option>
                            <option value="90">90 mins/1.5 hours</option>
                            <option value="120">120 mins/2 hours</option>
                        </select>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Development time required?</label>
                        <select class="col-sm-9" name="devtime" required>
                            <option value="" disabled selected hidden>Please select...</option>
                            <option value="0">No</option>
                            <option value="1">Yes</option>

                        </select>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Price</label>
                        <div class="col-sm-9">
                            <input type="number" min="0.00" max="10000.00" step="0.01" pattern="^\$\d{1,3}(,\d{3})*(\.\d+)?$"
                                   class="form-control" id="fixed2" name="price" required>




                        </div>
                    </div>



                    <div><input type="submit" class="btn btn-default" id="submit-button" value="Submit"></div>
                </form>


            </div>
        </div>
    </div>
</div> <!-- close container -->


    <script type="text/javascript">
        var myInput = document.querySelector('#fixed2');
        myInput.addEventListener("keyup", function(){
            myInput.value = myInput.value.replace(/(\.\d{2})\d+/g, '$1');
        });

    </script>

</body>
</html>