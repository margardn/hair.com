<?php
session_start();
include 'connectDb.php';
include 'myFunctions.php';


if (!isset($_SESSION['user']['type'])) {



    resetPW_forgot();
    exit();
}elseif ($_SESSION['user']['type']==1){
    resetPW_ClientChoice();
    exit();
}else{
    echo "User type is either 2 or 3";
}




?>


