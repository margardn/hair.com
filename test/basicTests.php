<?php

session_start();
include '../connectDb.php';
include '../myFunctions.php';


//
////Build hair analysis array containin all customerID's with out of date skin tests
//$previousDate = date("Y-m-d", date(strtotime("-6 months"), strtotime(date("Y-m-d"))));
//$query = "Select customerID from tblhairanalysis where skinTestDate <= '$previousDate'";
//
//$outOfDate = array();
//
//$result = $db->query($query);
//if ($result->num_rows > 0) {
//
//    while ($row = mysqli_fetch_array($result)) {
//
//        array_push($outOfDate, $row['customerID']);
//
//    }//end "while ($row = mysqli_fetch_array($result))"
//}
////remove duplicate entries
//$outOfDate=array_unique($outOfDate);
//
//
//// Now get all customerID's with test which are in date
//$inDate = array();
//
//$query2 = "Select customerID from tblhairanalysis where skinTestDate >= '$previousDate'";
//$result2 = $db->query($query2);
//if ($result2->num_rows > 0) {
//
//    while ($row2 = mysqli_fetch_array($result2)) {
//
//        array_push($inDate, $row2['customerID']);
//
//    }//end "while ($row = mysqli_fetch_array($result))"
//}
//
////remove duplicate entries
//$inDate=array_unique($inDate);
//
////Now compare and leave only customerID's which were in the outofdate() array and not in the inDate() array
//$highlightedCustomers = array_values(array_diff($outOfDate, $inDate));
//
//// Pass to function where this list is compared to customer who need tested
//$highlightedCustomers = outOfDateTests($highlightedCustomers);
//
//print_r($highlightedCustomers);
//


//$query = "SELECT tblappointments.appID ,tblusers.Firstname, tblusers.Surname, tblservices.serviceName, tblservices.cost,
//       tblslots.start_event, tblSlots.end_event
//
//FROM tblappointments join tblslots on tblappointments.slotID = tblslots.slotID
//    join tblusers on tblappointments.stylistID = tblusers.UserID
//    join tblservices t on tblappointments.serviceID = t.serviceID
//    where tblappointments.customerID = 2";

$query = "SELECT tblusers.Firstname, tblusers.Surname

FROM tblappointments 
    JOIN tblusers ON tblappointments.stylistID = tblusers.UserID
    


WHERE tblappointments.apptID=93";

echo $query;


//$result = $db->query($query);
//
//while ($row = $result->fetch_assoc()){
//
//    echo "£" . $row['start_event']. "<br>";
//
//
//
//}






























