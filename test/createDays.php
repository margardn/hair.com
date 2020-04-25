<?php

//function dates_month($month, $year) {
//$num = cal_days_in_month(CAL_GREGORIAN, $month, $year);
//$dates_month = array();
//
//for ($i = 1; $i <= $num; $i++) {
//$mktime = mktime(0, 0, 0, $month, $i, $year);
//$date = date("d-M-Y", $mktime);
//$dates_month[$i] = $date;
//}
//
//return $dates_month;
//}
//
//echo"<pre>";
//print_r(dates_month(1, 2020));
//echo"</pre>";

//clude '../myFunctions.php';
include '../connectDb.php';

//Desired format -------> '2020-03-25 09:00:00'
$workdays = array();
$type = CAL_GREGORIAN;

function get1Week(){
    include '../connectDb.php';

    $currentdate = date("Y-m-d") . " " .  date("G:i:s");
    $currentdateTemp = strtotime($currentdate);
    $endDate = strtotime("+6 day", strtotime(date("Y/m/d")));
    $endDate = date("Y-m-d", $endDate)  . " 18:00:00";

    $query = "SELECT * FROM tblslots WHERE start_event between  '$currentdate' and '$endDate'";

    //$query = "SELECT * FROM tblslots WHERE start_event between  '$currentdate' and '2020-04-30 18:00:00'";
    $result = $db->query($query);

    return $query;
}


echo get1Week();
