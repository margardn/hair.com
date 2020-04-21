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

include '../myFunctions.php';

//Desired format -------> '2020-03-25 09:00:00'
$workdays = array();
$type = CAL_GREGORIAN;

$month = date('n'); // Get gurrent month - Month ID, 1 through to 12.

//$month++;

$year = date('Y'); // Year in 4 digit 2009 format.
$day_count = cal_days_in_month($type, $month, $year); // Get the amount of days in current month

//======================================================



echo "Month = " . $month . "<br>" . "Year = " . $year . "<br>" . "Day Count = " . $day_count . "<p></p>";

//======================================================

//loop through all days
for ($i = 1; $i <= $day_count; $i++) {


    $get_name = date('l', strtotime("1 April 2020")); //get week day
    var_dump($get_name);
   // $day_name = substr($get_name, 0, 3); // Trim day name to 3 chars

    //if not a weekend add day to array
    if($get_name != 'Sunday' && $get_name != 'Monday'){
        $workdays[] = $i . " " . $get_name;
    }


    //THIS IS THE DATE I WANT
    $date = $year . '-' . $month . '-' . $i; //format date
    echo $date . "<p>";


}


//$time2 =  date("Y/m/d H:i:s", strtotime("now")) . "\n";
//
////echo date("Y/m/d H:i:s", strtotime("+30 minutes"));
//
//for($time=60*9;$time<=60*24;$time=$time+30){
//    //show the time slots// take the time as minute and format as hour:minute base to show as link(store in a var) and somepage.php?time=$time to pass the value
//
//    //echo time() . "<br>";
//
//
//    echo $time2 . "<br>";
//    echo date("Y/m/d H:i:s", strtotime("+30 minutes")) . "<p>";
//
//
//};
//
//echo date("h:i:s") . "<br>";
//
//
//$start = new \DateTime('00:00');
//$times = 24 * 2; // 24 hours * 30 mins in an hour
//
//for ($i = 0; $i < $times-1; $i++) {
//    $result[] = $start->add(new \DateInterval('PT30M'))->format('H:i A');
//}
//
//print_r($result);
//
//
////
////for ($i = 1; $i <= $day_count; $i++) {
////
////}