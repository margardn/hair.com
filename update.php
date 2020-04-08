<?php

//update.php

$connect = new PDO('mysql:host=localhost;dbname=hair.com', 'root', '');

if(isset($_POST["id"]))
{
    $query = "
 UPDATE tblappointments 
 SET title=:title, start_event=:start_event, end_event=:end_event 
 WHERE apptID=:id
 ";
    $statement = $connect->prepare($query);
    $statement->execute(
        array(
            ':title'  => $_POST['title'],
            ':start_event' => $_POST['start'],
            ':end_event' => $_POST['end'],
            ':id'   => $_POST['id']
        )
    );
}

?>