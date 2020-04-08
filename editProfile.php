<?php

session_start();
include 'connectDb.php';
include 'myFunctions.php';

user(); //This function check to see if the user is currently logged in

//initialise vars

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


if(strlen($_POST['phonenumber'])!=11){
    //error
}else{
    $phonenumber = $_POST['phonenumber'];
}

$userID = $_SESSION['user']['id'];
$address1 = $_POST['address1'];
$address2 = ucfirst(strtolower($_POST['address2']));
$postcode = strtoupper($_POST['postcode']);


//check for changes
$q="SELECT * from tblusers where UserID=$userID";
$result = mysqli_query($db, $q);
$row = $result->fetch_assoc();
//print_r($row);

if($firstname==$row['Firstname']&& $surname==$row['Surname']&& $phonenumber==$row['phonenumber'] && $address1==$row['address1']
    && $address2==$row['address2'] && $postcode==$row['postcode']){

    echo '<script>alert("No changes detected... Try again")</script>';
    echo '<script>window.location="profile.php"</script>';
    exit();

}else {
    $query = "UPDATE tblusers SET Firstname = '$firstname', Surname = '$surname', phonenumber = '$phonenumber', address1 = '$address1',
                    address2 = '$address2', postcode = '$postcode' WHERE UserID='$userID'";
    if (mysqli_query($db, $query)) {

        $_SESSION['user']['firstname'] = $firstname;
        $_SESSION['user']['surname'] = $surname;

        echo '<script>alert("Your details were successfully updated")</script>';
        echo '<script>window.location="profile.php"</script>';

    } else {
        echo '<script>alert("There was an error updating your details... Please contact the salon directly to resolve.")</script>';
        echo '<script>window.location="profile.php"</script>';
    }

}