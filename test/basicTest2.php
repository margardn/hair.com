<?php


?>

<html>
<head>



    <!--ajax start-->

    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <link href="css/formStyler.css" rel="stylesheet">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT
    4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZF
    Joft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y
    2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

    <!--    ajax end-->
</head>


<body>



<div id="display"></div>











<script>
    // jquery start
    $(document).ready(function () {
        $('#submit').click(function () {
            var name = $("#name").val();
            var surname = $("#surname").val();
            var dataString = 'name=' + name + '&surname=' + surname;


            ajax({
                type: "POST",
                url: "makeMoneyReport.php",
                data: name,
                cache: false,
                success: function (result) {
                    $("#display").html(result);

                }

            });

        }
        return false;
    });


    // jquery end

</script>
</body>

</html>
