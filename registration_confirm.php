<?php
session_start();
include 'connectDb.php';
include 'myFunctions.php';

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
$userType = (int)$_POST['userType'];
$salt = '2plj*H6uXS&OXq' . $inputPassword . 'q4C5gnJYG235&n';//salting will make hashing even more secure
$hashed = hash('sha512', $salt);

/*
Check email address does not already exist
use select statement to return a record where email matches $email
If record returned - exit with error
*/

$query = "SELECT Username FROM tblusers";
$result = $db->query($query);

while ($row = $result->fetch_assoc()){
    $checkEmail = $row['Username'];
    if ($checkEmail == $email){
        Registration_error_email();
        exit();
    }
}



if(strlen($_POST['phonenumber'])!=11){
    //error
}else{
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
$query2="SELECT UserID FROM tblusers where Username = '$email'";
$result = mysqli_query($db, $query2);
$row=$result->fetch_assoc();

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

    //Iitialise Session variables
    $_SESSION['user']['id'] = $row['UserID'];
    $_SESSION['user']['type'] = $userType;
    $_SESSION['user']['firstname'] = $firstname;
    $_SESSION['user']['surname'] = $surname;
    $_SESSION['user']['email'] = $email;

    if($_SESSION['user']['type']==1) {
        $string1 = 'Home';
        $string2 = 'hair.com_home.php';
    }elseif ($_SESSION['user']['type']==2 || $_SESSION['user']['type']==3){
        $string1 = 'Admin Home';
        $string2 = 'hair.com_stylistAdmin_home.php';
    }   ;

    Button($string1, $string2)  ?></div>


<!--
*********************INSERT BANNER**********************************
-->
<?php banner('Hair.com', 'Your ultimate hair booking system...');?>


<div class="container text-muted">
    <div class="wrapper fadeInDown">
        <div id="formContent">
            <br>
            <h4>Registration Successful!!!</h4>


            <br>Hi <font color="black"><?php echo $_SESSION['user']['firstname']  ?></font>,</br>
            <p>Welcome to Hair.com!!!</p>
            <p>Your account has been created with the following details. Please be aware these details can be edited from your account page</p>




        <table width="400" visible="false">
            <tr>
                <td visible="false" >
                    <Label ID="Label8" Font-Size=Smaller runat=server> First Name:  </Label>
                </td>
                <td visible="false" >
                    <Label Font-Size=Smaller runat=server><font color="black"><?php echo $_SESSION['user']['firstname'] ?></font></Label>
                </td>
            </tr>
            <tr>
                <td visible="false" >
                    <Label Font-Size=Smaller runat=server> Surname:  </Label>
                </td>
                <td visible="false" >
                    <Label Font-Size=Smaller runat=server><font color="black"><?php echo $_SESSION['user']['surname'] ?></font></Label>
                </td>
            </tr>
            <tr>
                <td visible="false" >
                    <Label ID="Label8" Font-Size=Smaller runat=server> Email address/Username:  </Label>
                </td>
                <td visible="false" >
                    <Label Font-Size=Smaller runat=server><font color="black"><?php echo $_SESSION['user']['email'] ?></font></Label>
                </td>
            </tr>

            <tr>
                <td visible="false" >
                    <Label ID="Label8" Font-Size=Smaller runat=server> Phone  Number:  </Label>
                </td>
                <td visible="false" >
                    <Label Font-Size=Smaller runat=server><font color="black"><?php echo $phonenumber ?></font></Label>
                </td>
            </tr>

            <tr>
                <td visible="false" >
                    <Label ID="Label8" Font-Size=Smaller runat=server> Address:  </Label>
                </td>
                <td visible="false" >
                    <Label Font-Size=Smaller runat=server><font color="black"><?php echo $address1 ?></font></Label>
                </td>
            </tr>
            <tr>
                <td visible="false" >
                    <Label ID="Label8" Font-Size=Smaller runat=server>   </Label>
                </td>
                <td visible="false" >
                    <Label Font-Size=Smaller runat=server><font color="black"><?php echo $address2 ?></font></Label>
                </td>
            </tr>

            <tr>
                <td visible="false" >
                    <Label ID="Label8" Font-Size=Smaller runat=server>   </Label>
                </td>
                <td visible="false" >
                    <Label Font-Size=Smaller runat=server><font color="black"><?php echo $postcode?></font></Label>
                </td>
            </tr>

        </table>

        </div>
    </div>
</div>


</body>
</html>
