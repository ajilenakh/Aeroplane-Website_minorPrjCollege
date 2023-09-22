<?php

$airplaneData = [
    [
        'airline' => 'Airline A',
        'flight_number' => 'AA123',
        'departure' => 'New York',
        'arrival' => 'Los Angeles',
        'depart_time' => '2023-09-20 08:00:00',
        'arrival_time' => '2023-09-20 11:00:00',
        'price' => 250.00,
        'available_seats' => 120,
        'class' => 'Economy'
    ],
    [
        'airline' => 'Airline B',
        'flight_number' => 'BB456',
        'departure' => 'Los Angeles',
        'arrival' => 'Chicago',
        'depart_time' => '2023-09-21 12:00:00',
        'arrival_time' => '2023-09-21 15:00:00',
        'price' => 350.00,
        'available_seats' => 80,
        'class' => 'Business'
    ],
    // Add more entries as needed...
];

header('Content-Type: application/json');
echo json_encode($airplaneData);
?>
