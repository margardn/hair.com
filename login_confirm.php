<?php

session_start();
include 'connectDb.php';
include 'myFunctions.php';


//initialise variables
$username = strtolower($_POST['login']);
$password = $_POST['password'];

$salt = '2plj*H6uXS&OXq' . $password . 'q4C5gnJYG235&n';//salting will make hashing even more secure
$password = hash('sha512', $salt);


$q = "SELECT * from tblusers where Username='$username'";
$result = $db->query($q);

//set one row as the result
$row = $result->fetch_assoc(); // fetch_assoc() - Fetch a result row as an associative array... Can now be called "$row["name"]"
//print_r($row);


if (($row['Username'] != $username) || ($row['Password'] != $password)) {
    //echo $row['Username'];
    echo '<script>alert("Error!!! Your username and/or password is not recognised. Please try again...")</script>';
    echo "<script>window.location=\"index.php\"</script>";
    exit();
} else {

    $_SESSION['user']['id'] = $row['UserID'];
    $_SESSION['user']['type'] = $row['UserType'];
    $_SESSION['user']['firstname'] = $row['Firstname'];
    $_SESSION['user']['surname'] = $row['Surname'];
    $_SESSION['user']['email'] = $row['Username'];

}


if ($_SESSION['user']['type'] == 1) {
    //header("Location: hair.com_home.php?error=invalidmail&uid=".$username);


    echo '<script>window.location="hair.com_home.php"</script>';
    exit();
} elseif ($_SESSION['user']['type'] == 2 || $_SESSION['user']['type'] == 3) {
    echo '<script>window.location="hair.com_stylistAdmin_home.php"</script>';
    exit();
    //echo $_SESSION['user']['type'];
}




