<?php

function banner($text, $text2)
{ ?>

    <div class="jum bg-fluid bg-info text-white text-center">
        <div class="container">

            <h1 class="display-4"> <?php echo $text; ?></h1>
            <p class="lead"><?php echo $text2; ?></p>

        </div><!--end h1 container div-->
    </div><!-- End h1 div -->

    <?php

}

function ContainsNumbers($String)
{
    return preg_match('/\\d/', $String) > 0;
}

function Error_num_in_string($string)
{
    ?>
    <!doctype html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link href="bootstrap-4.0.0-dist\css\bootstrap.min.css" rel="stylesheet"/><!-- Link to CSS Bootstrap -->
        <title>ERROR</title>
    </head>
    <body>
    <!--
    *********************INSERT BANNER**********************************
    -->
    <?php banner('Hair.com', 'Your ultimate hair booking system...'); ?>
    <div class="container text-muted">
        <div class="wrapper fadeInDown">
            <div id="formContent">
                <BR>
                <h1 style="color: #dc3545">Error</h1>
                <BR>
                <h2>Registration Failed</h2>
                <p>Error: You have entered numbers in your <b><?php echo $string ?></b> field... <br>Please return and
                    try again...</p>
            </div>
        </div>
    </div>
    </body>
    </html>
    <?php
}

function Registration_error_email()
{
    ?>
    <!doctype html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link href="bootstrap-4.0.0-dist\css\bootstrap.min.css" rel="stylesheet"/><!-- Link to CSS Bootstrap -->
        <title>ERROR</title>
    </head>
    <body>
    <!--
    *********************INSERT BANNER**********************************
    -->
    <?php banner('Hair.com', 'Your ultimate hair booking system...'); ?>
    <div class="container text-muted">

        <div class="wrapper fadeInDown">
            <div id="formContent">
                <BR>
                <h1 style="color: #dc3545">Error</h1>
                <BR>
                <h2>Registration Failed</h2>
                <p>Unfortunately this email address is already registered by another user<br>Please go back and try
                    another email address</p>

                <?php

                if (isset($_SESSION['user']['type'])) {
                    if ($_SESSION['user']['type'] == 2 || $_SESSION['user']['type'] == 3)
                        Button("Back", "createUser.php");
                } //Close if (isset($_SESSION['user']['type']))

                elseif (!isset($_SESSION['user']['type']))
                    Button("Back", "registration.php");

                ?>
            </div>
        </div>
    </div>
    </body>
    </html>
    <?php
}

function Button($string, $string2)
{
    ?>
    <a href="<?php echo $string2 ?>" class="btn btn-info btn-lg">
        <span class="glyphicon glyphicon-shopping-cart"></span><?php echo $string ?></a>

    <?php

}

function navBar()
{

    if ($_SESSION['user']['type']==1)
        $string = "hair.com_home.php";
    if ($_SESSION['user']['type']==2 || $_SESSION['user']['type']==3)
        $string = "hair.com_stylistAdmin_home.php";
    ?>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand">Hi <?php echo $_SESSION['user']['firstname'] ?></a>


        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">

                <?php if ($_SESSION['user']['type'] != 1) { ?>
                    <li class="nav-item active">
                        <a class="nav-link"><?php if ($_SESSION['user']['type'] == 2) {
                                echo "[STYLIST]";
                            } elseif ($_SESSION['user']['type'] == 3) {
                                echo "[ADMIN]";
                            }
                            ?></a>
                    </li>
                <?php } ?>
                <li class="nav-item">
                    <a class="nav-link" href="profile.php">Profile <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo $string ?>">Home <span class="sr-only">(current)</span></a>
                </li>

            </ul>
            <a class="nav-link" style="color: #383d41" href="loggedOut.php">Logout</a>
        </div>
    </nav>
    <?php
}

function navBarOld()
{
    ?>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand">Hi <?php echo $_SESSION['user']['firstname'] ?></a>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <?php if ($_SESSION['user']['type'] != 1) { ?>
                    <li class="nav-item">
                        <a class="nav-link" href="" style="color: #dc143c"><?php if ($_SESSION['user']['type'] == 2) {
                                echo "STYLIST CONSOLE";
                            } elseif ($_SESSION['user']['type'] == 3) {
                                echo "ADMIN CONSOLE";
                            }
                            ?></a>
                    </li>
                <?php } ?>
                <li class="nav-item" style="color: #dc143c">
                    <a class="nav-link" href="loggedOut.php">Logout</a>
                </li>


            </ul>
        </div>
    </nav>


    <?php
}

function createUser()
{


    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>
            <?php
            if (isset($_SESSION['user']['type'])) {
                if ($_SESSION['user']['type'] == 2 || $_SESSION['user']['type'] == 3)
                    echo "Create User";
            } //Close if (isset($_SESSION['user']['type']))

            elseif (!isset($_SESSION['user']['type']))
                echo "Registration form";
            ?>


        </title>
        <link href="bootstrap-4.0.0-dist\css\bootstrap.min.css" rel="stylesheet"/><!-- Link to CSS Bootstrap -->
        <link href="bootstrap-4.0.0-dist\js\bootstrap.min.js" rel="stylesheet"/>
        <link href="js/jquery-3.4.1.js">

    </head>


    <body>
    <div class="float-right sticky-top" style="padding:1% 18%"><?php

        if (isset($_SESSION['user']['type'])) {
            if ($_SESSION['user']['type'] == 2 || $_SESSION['user']['type'] == 3)
                Button('Admin Home', 'hair.com_stylistAdmin_home.php');
        } //Close if (isset($_SESSION['user']['type']))

        elseif (!isset($_SESSION['user']['type']))
            Button('Login', 'index.php');

        ?>

    </div>


    <?php

    banner('Hair.com', 'Your ultimate hair booking system...'); ?>

    <div class="container text-muted">

        <?php
        if (isset($_SESSION['user']['type'])) {
            if ($_SESSION['user']['type'] == 2 || $_SESSION['user']['type'] == 3)
                navBar();

        }
        ?>

        <div class="wrapper fadeInDown">
            <div id="formContent">

                <BR>

                <?php if (isset($_SESSION['user']['type'])) {
                    if ($_SESSION['user']['type'] == 2) { ?>
                        <h2>New client account setup</h2>
                        <h4 class="text-danger">You have "Stylist" privileges and can create client accounts only</h4>
                        <p>Please enter customers details below:</p>

                    <?php }// close if ($_SESSION['user']['type']==2)

                    if ($_SESSION['user']['type'] == 3) { ?>
                        <h2>New account setup</h2>
                        <h4 class="text-danger">You have "ADMIN" privileges and can create all account types</h4>
                        <p>Please enter user details below:</p>

                    <?php }// close if ($_SESSION['user']['type']==3)


                    ?>
                <?php }//close if(isset($_SESSION['user']['type']))

                elseif (!isset($_SESSION['user']['type'])) {

                    ?> <h4>Registration Form</h4>
                    <?php
                }// end (!isset($_SESSION['user']['type']))


                ?>


                <div class="modal-body">

                    <form action="registration_confirm.php" method="post">

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Firstname</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="firstname" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Surname</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="surname" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Phone Number</label>
                            <div class="col-sm-9">
                                <input type="tel" class="form-control" name="phonenumber" pattern="[0-9]{11}" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Address 1</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="address1" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Address 2</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="address2" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Postcode</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="postcode"
                                       pattern="[A-Za-z]{1,2}[0-9Rr][0-9A-Za-z]? [0-9][ABD-HJLNP-UW-Zabd-hjlnp-uw-z]{2}"
                                       required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Email</label>
                            <div class="col-sm-9">
                                <input type="email" class="form-control" name="email" placeholder="email@example.com"
                                       required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Password</label>
                            <div class="col-sm-9">
                                <input type="password" class="form-control" name="inputPassword" id="password"
                                       placeholder="Password"
                                       required onkeyup='check();'>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Confirm Password</label>
                            <div class="col-sm-9">
                                <input type="password" class="form-control" name="confirmPassword" id="confirm_password"
                                       placeholder="Confirm Password"
                                       required onkeyup='check();'>
                                <span id='message'></span>
                            </div>
                        </div>

                        <?php


                        if (isset($_SESSION['user']['type']) && $_SESSION['user']['type'] == 3) {

                            ?>

                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">User Type</label>
                                <select class="col-sm-9" name="userType" required>
                                    <option value="1" disabled selected hidden>Please select...</option>
                                    <option value="1">Client</option>
                                    <option value="2">Stylist</option>
                                    <option value="3">Full Admin</option>
                                </select>
                            </div>

                            <?php
                        } //Close if (isset($_SESSION['user']['type']) && $_SESSION['user']['type'] == 3)
                        ?>

                        <div><input type="submit" class="btn btn-default" id="submit-button" value="Submit"></div>
                    </form>


                </div>
            </div>
        </div>
    </div> <!-- close container -->

    <script src="js/myJS.js"></script>
    </body>
    </html>

    <?php
}

function confirmCreate()
{

    include 'connectDb.php';

    //Initialise variables
//The following if statements will also validate some variables before initialising them
    if (ContainsNumbers($_POST['firstname'])) {
        // Error
        Error_num_in_string('First name');
        exit();
    } else {
        //set $firstname variable
        $firstname = ucfirst(strtolower($_POST['firstname'])); //This will set 1st char to Upper case and rest to lower case
    }

    if (ContainsNumbers($_POST['surname'])) {
        // Error
        Error_num_in_string('Surname');
        exit();
    } else {
        //set var
        $surname = ucfirst(strtolower($_POST['surname']));
    }

//Convert email to lower case to avoid same username registration
    $email = strtolower($_POST['email']);

    $inputPassword = $_POST['inputPassword'];
    $confirmPassword = $_POST['confirmPassword'];


    if (isset($_POST['userType'])) {
        $userType = (int)$_POST['userType'];
    } else
        $userType = (int)1;

    $salt = '2plj*H6uXS&OXq' . $inputPassword . 'q4C5gnJYG235&n';//salting will make hashing even more secure
    $hashed = hash('sha512', $salt);

    /*
    Check email address does not already exist
    use select statement to return a record where email matches $email
    If record returned - exit with error
    */

    $query = "SELECT Username FROM tblusers";
    $result = $db->query($query);

    while ($row = $result->fetch_assoc()) {
        $checkEmail = $row['Username'];
        if ($checkEmail == $email) {
            Registration_error_email();
            exit();
        }
    }


    if (strlen($_POST['phonenumber']) != 11) {
        //error
    } else {
        $phonenumber = $_POST['phonenumber'];
    }

    $address1 = $_POST['address1'];
    $address2 = ucfirst(strtolower($_POST['address2']));
    $postcode = strtoupper($_POST['postcode']);


//insert validated user input to database------------------------------>


    $query = "INSERT INTO tblusers (Firstname, Surname, Username, Password, phonenumber, address1, address2, postcode, 
                      UserType) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $db->prepare($query);
    $stmt->bind_param('ssssssssi'/*i for integer, s for string*/, $firstname, $surname, $email, $hashed, $phonenumber, $address1,
        $address2, $postcode, $userType);
    $stmt->execute();

//Now retrieve the UserID assigned to the new user to set Session var
    $query2 = "SELECT UserID FROM tblusers where Username = '$email'";
    $result = mysqli_query($db, $query2);
    $row = $result->fetch_assoc();
    $newUser = false;
//---------------------------------------------------------------------

    ?>

    <!doctype html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link href="bootstrap-4.0.0-dist\css\bootstrap.min.css" rel="stylesheet"/><!-- Link to CSS Bootstrap -->
        <title>Reg_confirm</title>
    </head>
    <body>
    <div class="float-right sticky-top" style="padding:1% 18%"><?php


        if (!isset($_SESSION['user']['type'])) {

            $newUser = true;

            //Iitialise Session variables
            $_SESSION['user']['id'] = $row['UserID'];
            $_SESSION['user']['type'] = $userType;
            $_SESSION['user']['firstname'] = $firstname;
            $_SESSION['user']['surname'] = $surname;
            $_SESSION['user']['email'] = $email;
        }//end elseif (!isset($_SESSION['user']['type']))

        if ($_SESSION['user']['type'] == 1) {
            $string1 = 'Home';
            $string2 = 'hair.com_home.php';
        } elseif ($_SESSION['user']['type'] == 2 || $_SESSION['user']['type'] == 3) {
            $string1 = 'Admin Home';
            $string2 = 'hair.com_stylistAdmin_home.php';
        };


        Button($string1, $string2);
        ?></div>


    <!--
    *********************INSERT BANNER**********************************
    -->
    <?php banner('Hair.com', 'Your ultimate hair booking system...'); ?>


    <div class="container text-muted">

        <?php
        if (isset($_SESSION['user']['type'])) {
            if ($_SESSION['user']['type'] == 2 || $_SESSION['user']['type'] == 3)
                navBar();
        }
        ?>

        <div class="wrapper fadeInDown">
            <div id="formContent">
                <br>
                <h4>Registration Successful!!!</h4>


                <?php
                if ($newUser) {
                    ?>
                    <br>Hi <font color="black"><?php echo $_SESSION['user']['firstname'] ?></font>,</br>
                    <p>Welcome to Hair.com!!!</p>
                    <p>Your account has been created with the following details. Please be aware these details can be
                        edited
                        from your account page</p>
                    <?php

                } elseif (!$newUser) {
                    ?>
                    <p>New user successfully created with the following details. Please pass these details on to the
                        customer</p>

                    <?php
                }

                ?>


                <table width="400" visible="false">
                    <tr>
                        <td visible="false">
                            <Label ID="Label8" Font-Size=Smaller runat=server> First Name: </Label>
                        </td>
                        <td visible="false">
                            <Label Font-Size=Smaller runat=server><font
                                        color="black"><?php echo $firstname ?></font></Label>
                        </td>
                    </tr>
                    <tr>
                        <td visible="false">
                            <Label Font-Size=Smaller runat=server> Surname: </Label>
                        </td>
                        <td visible="false">
                            <Label Font-Size=Smaller runat=server><font
                                        color="black"><?php echo $surname ?></font></Label>
                        </td>
                    </tr>
                    <tr>
                        <td visible="false">
                            <Label ID="Label8" Font-Size=Smaller runat=server> Email address/Username: </Label>
                        </td>
                        <td visible="false">
                            <Label Font-Size=Smaller runat=server><font
                                        color="black"><?php echo $email ?></font></Label>
                        </td>
                    </tr>

                    <tr>
                        <td visible="false">
                            <Label ID="Label8" Font-Size=Smaller runat=server> Phone Number: </Label>
                        </td>
                        <td visible="false">
                            <Label Font-Size=Smaller runat=server><font
                                        color="black"><?php echo $phonenumber ?></font></Label>
                        </td>
                    </tr>

                    <tr>
                        <td visible="false">
                            <Label ID="Label8" Font-Size=Smaller runat=server> Address: </Label>
                        </td>
                        <td visible="false">
                            <Label Font-Size=Smaller runat=server><font
                                        color="black"><?php echo $address1 ?></font></Label>
                        </td>
                    </tr>
                    <tr>
                        <td visible="false">
                            <Label ID="Label8" Font-Size=Smaller runat=server> </Label>
                        </td>
                        <td visible="false">
                            <Label Font-Size=Smaller runat=server><font
                                        color="black"><?php echo $address2 ?></font></Label>
                        </td>
                    </tr>

                    <tr>
                        <td visible="false">
                            <Label ID="Label8" Font-Size=Smaller runat=server> </Label>
                        </td>
                        <td visible="false">
                            <Label Font-Size=Smaller runat=server><font
                                        color="black"><?php echo $postcode ?></font></Label>
                        </td>
                    </tr>

                </table>

            </div>
        </div>
    </div>


    </body>
    </html>
    <?php

}

function user()
{


    if (!isset($_SESSION['user']['type'])) {
        header("Location: index.php");
        exit();
    }


}

function printAllSessionVars()
{
    // echo "Logged in : " . $_SESSION['user']['logged_in'] . "<br>";
    echo "User Type: " . $_SESSION['user']['type'] . "<br>";
    echo "First name: " . $_SESSION['user']['firstname'] . "<br>";
    echo "Surname: " . $_SESSION['user']['surname'] . "<br>";
    echo "Email: " . $_SESSION['user']['email'] . "<br>";
    echo "User ID: " . $_SESSION['user']['id'] . "<br>";

}

function updatePassword($string, $string2)
{
    //include 'connectDb.php';

    $query = "UPDATE tblusers SET Password = '$string' WHERE Username='$string2'";
    return $query;
}

function resetPW_forgot()
{
    include 'connectDb.php';
    ?>
    <!doctype html>
    <html lang="en">
    <head>


        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>


        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link href="bootstrap-4.0.0-dist\css\bootstrap.min.css" rel="stylesheet"/><!-- Link to CSS Bootstrap -->
        <title>Reset Password Hair.com</title>
    </head>
    <body>
    <div class="float-right sticky-top" style="padding:1% 18%"><?php Button('Login', 'index.php') ?></div>

    <!--
    *********************INSERT BANNER**********************************
    -->
    <?php banner('Hair.com', 'Your ultimate hair booking system...'); ?>


    <div class="container text-muted">

        <div class="wrapper fadeInDown">
            <div id="formContent">
                <BR>
                <h4>Reset Password</h4>
                <BR>

                <?php
                if (!isset($_POST['submit-button'])) {
                ?>
                <form method="POST" action="reset_password.php">
                    <div class="form-group">
                        <input type="email" class="fadeIn second" name="login" placeholder="Username/email" required>
                    </div>
                    <div class="form-group">
                        <input type="text" class="fadeIn third" name="postcode" placeholder="Postcode"
                               pattern="[A-Za-z]{1,2}[0-9Rr][0-9A-Za-z]? [0-9][ABD-HJLNP-UW-Zabd-hjlnp-uw-z]{2}"
                               required>
                    </div>

                    <hr/>


                    <div class="form-group">
                        <div><input type="submit" class="btn btn-default" id="submit-button" name="submit-button"
                                    value="Submit"></div>
                    </div>
                    <?php
                    }
                    ?>

                </form>

                <?php
                if (isset($_POST['submit-button'])) {

                    $username = strtolower($_POST['login'] ?? null);
                    $postcode = strtoupper($_POST['postcode'] ?? null);

                    $q = "SELECT * from tblusers where Username='$username'";
                    $result = $db->query($q);
                    //set one row as the result
                    $row = $result->fetch_assoc(); // fetch_assoc() - Fetch a result row as an associative array... Can now be called "$row["name"]"
                    //print_r($row);

                    if ($row['postcode'] == $postcode) {


                        ?>
                        <p>Please select a new password</p>
                        <hr/>
                        <form action="reset_confirm.php" method="post">

                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Username</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="username"
                                           value="<?php echo $username ?>" readonly>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">New Password</label>
                                <div class="col-sm-9">
                                    <input type="password" class="form-control" name="inputPassword" id="password"
                                           placeholder="Password"
                                           required onkeyup='check();'>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Confirm Password</label>
                                <div class="col-sm-9">
                                    <input type="password" class="form-control" name="confirmPassword"
                                           id="confirm_password"
                                           placeholder="Confirm Password"
                                           required onkeyup='check();'>
                                    <span id='message'></span>
                                </div>
                            </div>

                            <div><input type="submit" class="btn btn-default" id="submit-button2" name="submit-button2"
                                        value="Submit"></div>
                        </form>
                        <?php
                    } else {

                        echo '<script>alert("Your details are not recognised. Please try again")</script>';
                        echo '<script>window.location="reset_password.php"</script>';

                    }

                }


                ?>


            </div>
        </div>
    </div>

    <script src="js/myJS.js"></script>
    </body>
    </html>
    <?php
}

function resetPW_forgotConfirm()
{
    include 'connectDb.php';

    $username = $_POST['username'];
    $inputPassword = $_POST['inputPassword'];
    $confirmPassword = $_POST['confirmPassword'];
    $salt = '2plj*H6uXS&OXq' . $inputPassword . 'q4C5gnJYG235&n';//salting will make hashing even more secure
    $password = hash('sha512', $salt);


    if ($inputPassword == $confirmPassword) {


        //update password was previously but was changed to function -->

//    $query = "UPDATE tblusers SET Password = '$password' WHERE Username='$username'";
//    $db->query($query);

        $db->query(updatePassword($password, $username));

        /*
        TEST IF DB UPDATE WAS SUCCESSFUL==>
        if (mysqli_query($db, $query)) {
              echo "success";
          } else {
              echo "Failed";
          }
      */
        echo '<script>alert("Your password has been successfully reset. Please login...")</script>';
        echo '<script>window.location="index.php"</script>';

    } elseif ($inputPassword != $confirmPassword) {


        echo '<script>alert("It seems your passwords do not match. Try again or contact your stylist for help resetting your password....")</script>';
        echo '<script>window.location="reset_password.php"</script>';
    }


}

function resetPW_ClientChoice()
{

    include 'connectDb.php';
    ?>
    <!doctype html>
    <html lang="en">
    <head>


        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>


        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link href="bootstrap-4.0.0-dist\css\bootstrap.min.css" rel="stylesheet"/><!-- Link to CSS Bootstrap -->
        <title>Reset Password Hair.com</title>
    </head>
    <body>
    <div class="float-right sticky-top" style="padding:1% 18%"><?php Button('Home', 'hair.com_home.php') ?></div>

    <!--
    *********************INSERT BANNER**********************************
    -->
    <?php banner('Hair.com', 'Your ultimate hair booking system...'); ?>


    <div class="container text-muted">
        <?php navBar(); ?>
        <div class="wrapper fadeInDown">
            <div id="formContent">
                <BR>
                <h4>Change Password</h4>
                <BR>
                <p>Hi <?php echo $_SESSION['user']['firstname'] ?></p>


                <?php


                $username = $_SESSION['user']['email'];


                ?>
                <p>Please select a new password</p>
                <hr/>
                <form action="reset_confirm.php" method="post">

                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Username</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="username"
                                   value="<?php echo $username ?>" readonly>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Current Password</label>
                        <div class="col-sm-9">
                            <input type="password" class="form-control" name="currentPassword" id="currentPassword"
                                   placeholder="Current Password"
                                   required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">New Password</label>
                        <div class="col-sm-9">
                            <input type="password" class="form-control" name="newPassword" id="newPassword"
                                   placeholder="New Password"
                                   required onkeyup='check();'>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Confirm Password</label>
                        <div class="col-sm-9">
                            <input type="password" class="form-control" name="confirmPassword"
                                   id="confirm_password"
                                   placeholder="Confirm Password"
                                   required onkeyup='check();'>
                            <span id='message'></span>
                        </div>
                    </div>

                    <div><input type="submit" class="btn btn-default" id="submit-button2" name="submit-button2"
                                value="Submit"></div>
                </form>

            </div>
        </div>
    </div>

    <script src="js/myJS.js"></script>
    </body>
    </html>
    <?php
}

function resetPW_ClientChoiceConfirm()
{
    include 'connectDb.php';

    $username = $_SESSION['user']['email'];


    $query = "SELECT * FROM tblusers where Username = '$username'";
    $result = mysqli_query($db, $query);


    $row = $result->fetch_assoc();
    $currentPW = $row['Password'];
    $currentPWForm = $_POST['currentPassword'];

    $salt = '2plj*H6uXS&OXq' . $currentPWForm . 'q4C5gnJYG235&n';//salting will make hashing even more secure
    $currentPWForm = hash('sha512', $salt);


    $inputPassword = $_POST['newPassword'];
    $confirmPassword = $_POST['confirmPassword'];
    $salt = '2plj*H6uXS&OXq' . $inputPassword . 'q4C5gnJYG235&n';//salting will make hashing even more secure
    $password = hash('sha512', $salt);

//    echo $currentPW . "<br>";
//    echo $password;
//    exit();


    if ($currentPW != $currentPWForm) {
        echo '<script>alert("You have entered incorrect current password... Please try again")</script>';
        echo '<script>window.location="reset_password.php"</script>';
    } elseif ($currentPW == $currentPWForm) {


        if ($inputPassword == $confirmPassword) {


            $db->query(updatePassword($password, $username));

            /*
            TEST IF DB UPDATE WAS SUCCESSFUL==>
            if (mysqli_query($db, $query)) {
                  echo "success";
              } else {
                  echo "Failed";
              }
          */
            echo '<script>alert("Your password has been successfully changed")</script>';
            echo '<script>window.location="profile.php"</script>';

        } elseif ($inputPassword != $confirmPassword) {


            echo '<script>alert("It seems your passwords do not match. Try again or contact your stylist for help resetting your password....")</script>';
            echo '<script>window.location="reset_password.php"</script>';
        }
    }
}

