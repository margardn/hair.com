<?php


//===================================================================================================================
echo "Dates on month" . "<br>";

$month = 2;
$year = 2020;

$start_date = "01-" . $month . "-" . $year;
$start_time = strtotime($start_date);

$end_time = strtotime("+1 month", $start_time);

for ($i = $start_time; $i < $end_time; $i += 86400) {
    // $list3[] = date('Y-m-d', $i);


    if (date('D', $i) != 'Sun') {
        if (date('D', $i) != 'Mon') {

            echo date('Y-m-d', $i);
            //var_dump(date('D', $i));

            for ($z = 0; $z < 17; $z++) {
                $list3[] = date('Y-m-d', $i) . " " . get_hours_range()[$z];
            }
        }
    }


}

var_dump($list3);
//ME FUCKING ABOUT 2 END
//===================================================================================================================


//=============================MAke timeslots =====>

echo "Time slots per day";

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


//var_dump(get_hours_range());
//
//echo get_hours_range()[4];

/*
 * //FUCKING WORKED=====>
INSERT INTO `tblslots` (`start_event`, `end_event`) VALUES
('2020-04-20 09:00:00', '2020-04-20 09:30:00'),
('2020-04-20 09:30:00', '2020-04-20 10:00:00'),
('2020-04-20 10:00:00', '2020-04-20 10:30:00'),
('2020-04-20 10:30:00', '2020-04-20 11:00:00');
 */
