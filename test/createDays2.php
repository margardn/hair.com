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


//Desired format -------> '2020-03-25 09:00:00'


$list = array();
for ($d = 1; $d <= 31; $d++) {
    $time = mktime(12, 0, 0, date('m'), $d, date('Y'));
    if (date('m', $time) == date('m'))
        $list[] = date('Y-m-d', $time);
}
echo "<pre>";
print_r($list);
echo "</pre>";

//echo $list[3];

//===================================================================================================================
echo "ME FUCKING ABOUT START" . "<br>";


$list = array();
$list2 = array();
$month = 2;
$year = 2020;

for ($d = 1; $d <= 31; $d++) {
    $time = mktime(12, 0, 0, $month, $d, $year);



    if (date('m', $time) == $month) {
        $list[] = date('Y-m-d-D', $time);
        $list2[] = date('D', $time);
    }
}
echo "<pre>";
var_dump($list);
var_dump($list2);
echo "</pre>";
//ME FUCKING ABOUT END
//===================================================================================================================


//===================================================================================================================
echo "ME FUCKING ABOUT START 2" . "<br>";

$month = 2;
$year = 2020;

$start_date = "01-".$month."-".$year;
$start_time = strtotime($start_date);

$end_time = strtotime("+1 month", $start_time);

for($i=$start_time; $i<$end_time; $i+=86400)
{
    $list3[] = date('Y-m-d', $i);
}

var_dump($list3);
//ME FUCKING ABOUT 2 END
//===================================================================================================================



//=============================MAke timeslots =====>

function get_hours_range($start = 32400, $end = 63000, $step = 1800, $format = 'G:i:s')
{
    $i = 0;
    $times = array();
    foreach (range($start, $end, $step) as $timestamp) {
        $hour_mins = gmdate('H:i', $timestamp);




        if (!empty($format)) {
            $times[$i] = gmdate($format, $timestamp);
            $i++;
        } else {
            $times[$i] = $hour_mins;
            $i++;
        }
    }
    return $times;
}


var_dump(get_hours_range());

echo get_hours_range()[4];
//=============================MAke timeslots =====END


/*
 * //FUCKING WORKED=====>
INSERT INTO `tblslots` (`start_event`, `end_event`) VALUES
('2020-04-20 09:00:00', '2020-04-20 09:30:00'),
('2020-04-20 09:30:00', '2020-04-20 10:00:00'),
('2020-04-20 10:00:00', '2020-04-20 10:30:00'),
('2020-04-20 10:30:00', '2020-04-20 11:00:00');
 */

