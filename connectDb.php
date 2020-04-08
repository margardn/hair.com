<?php
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'hair.com';
$db = new mysqli($host, $username, $password, $database);
if (mysqli_connect_errno()) {
    echo "<p>Could not connect to database</p>";
} else {
   // echo "<p>Connected to " . $database . " ==> I live in the connectDb.php file!!! <br />";
}


?>