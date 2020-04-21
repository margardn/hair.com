<?php


include "../myFunctions.php";
include "testConnectDb.php";

//
//function updateSlotsOLD($month, $year)
//{
//    $count = 0;
//    $string = null;
//    foreach (slotsInAMonth($month, $year) as $value) {
//
//
//        //echo "Slot " . $count . " = $value <br>";
//
//        $string .= "('" . $value . "')'";
//
//        $count++;
//    }
//
//
//    $string = substr($string, 0, -2) ;
//    return "INSERT INTO tblslots (`start_event`, `end_event`) VALUES " . $string;
//
//}
//
//
//function updateSlots($month, $year)
//{
//
//    $string = null;
//
//    $length = count(slotsInAMonth($month, $year)) - 1;
//
//    echo $length;
//
//    for ($index = 0; $index < $length; $index++) {
//
//        if ($length = 372)
//            $comma = null;
//
//        $string .= "('" . slotsInAMonth($month, $year)[$index] . "', '" . slotsInAMonth($month, $year)[$index + 1] . "'), ";
//        //echo slotsInAMonth($month, $year)[$index] . "<br>";
//
//    }
//
//    $string = substr($string, 0, -2);
//    return "INSERT INTO tblslots (`start_event`, `end_event`) VALUES " . $string;
//
//}

$query = updateSlots(5, 2020);
echo $query;

//$db->query($query);

