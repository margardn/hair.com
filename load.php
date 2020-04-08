<?php

//load.php

$connect = new PDO('mysql:host=localhost;dbname=hair.com', 'root', '');

$data = array();

$query = "SELECT * FROM tblappointments ORDER BY apptID";

$statement = $connect->prepare($query);

$statement->execute();

$result = $statement->fetchAll();

foreach($result as $row)
{
    $data[] = array(
        'id'   => $row["apptID"],
        'title'   => $row["title"],
        'start'   => $row["start_event"],
        'end'   => $row["end_event"]
    );
}

echo json_encode($data);

?>