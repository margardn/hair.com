<?php
$timeslots = [
    '26-04-2020' => [
        '12PM' => ['available' => true],
        '1PM' => ['available' => false],
        '2PM' => ['available' => true],
        '3PM' => ['available' => true],
        '4PM' => ['available' => true],
        '5PM' => ['available' => false]
    ],
    '27-04-2020' => [
        '12PM' => ['available' => true],
        '1PM' => ['available' => false],
        '2PM' => ['available' => true],
        '3PM' => ['available' => true],
        '4PM' => ['available' => true],
        '5PM' => ['available' => false]
    ]
];

$filteredSlots = [];

foreach($timeslots as $day => $slots) {
    $outputSlots = [];
    $availableSlots = [];
    foreach($slots as $time => $slot) {
        if(count($availableSlots) == 3) {
            // Store our slots.
            $outputSlots = array_merge($outputSlots, $availableSlots);
            $availableSlots = [];
        }
        if($slot['available']) {
            // Add to our list.
            $availableSlots[$time] = $slot;
        } else {
            // We don't have an available slot, start over.
            $availableSlots = [];
        }
    }
    if(count($availableSlots) == 3) {
        // Store our slots, since we won't have triggered a new loop.
        $outputSlots = array_merge($outputSlots, $availableSlots);
        $availableSlots = [];
    }
    if(count($outputSlots) > 0) {
        $filteredSlots[$day] = $outputSlots;
    }
}

var_dump($filteredSlots);