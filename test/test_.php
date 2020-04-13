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


$workdays = array();
$type = CAL_GREGORIAN;

$month = date('n'); // Month ID, 1 through to 12.
$year = date('Y'); // Year in 4 digit 2009 format.
$day_count = cal_days_in_month($type, $month, $year); // Get the amount of days




//loop through all days
for ($i = 1; $i <= $day_count; $i++) {

    $date = $year.'/'.$month.'/'.$i; //format date
    $get_name = date('l', strtotime($date)); //get week day
   // $day_name = substr($get_name, 0, 3); // Trim day name to 3 chars

    //if not a weekend add day to array
    if($get_name != 'Sunday' && $get_name != 'Monday'){
        $workdays[] = $i . " " . $get_name;
    }

}

print_r($workdays);


for ($i = 1; $i <= $day_count; $i++){

}