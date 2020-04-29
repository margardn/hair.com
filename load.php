<?php


session_start();

$connect = new PDO('mysql:host=localhost;dbname=hair.com', 'root', '');
$currentUser = $_SESSION['user']['id'];

if (isset($_SESSION['schedule'][ 'stylist'])) {
    $currentUser=$_SESSION['schedule'][ 'stylist'];
}





$data = array();


if ($currentUser==0) {
    $query = "SELECT * FROM tblappointments, tblslots, tblusers, tblservices where tblappointments.slotID = tblslots.slotID 
                                                    and tblappointments.customerID = tblusers.UserID
                                                                 and tblappointments.serviceID = tblservices.serviceID
ORDER BY apptID";

}else {
    $query = "SELECT * FROM tblappointments, tblslots, tblusers, tblservices where tblappointments.slotID = tblslots.slotID
                                                   and tblappointments.stylistID = '$currentUser' 
                                                    and tblappointments.customerID = tblusers.UserID and tblappointments.serviceID = tblservices.serviceID     ORDER BY apptID";
}


$statement = $connect->prepare($query);

$statement->execute();

$result = $statement->fetchAll();

foreach($result as $row)
{
    $data[] = array(
        'id'   => $row["apptID"],
        'title'   => $row['Firstname'] . " " . $row['Surname'] . " - " . $row["serviceName"],
        'start'   => $row["start_event"],
        'end'   => $row["end_event"]
    );
}

echo json_encode($data);

?>