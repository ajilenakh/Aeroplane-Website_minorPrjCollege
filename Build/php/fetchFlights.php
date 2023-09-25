<?php
include("connection.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $origin = $_POST['origin'];
    $destination = $_POST['destination'];
    $departDate = $_POST['departDate'];
    $passengerCount = $_POST['passengerCount'];
    $classType = $_POST['classType'];

    $sql = "SELECT * FROM flights 
            WHERE origin = '$origin' 
            AND destination = '$destination' 
            AND depart_day = '$departDate' 
            AND seats_available >= '$passengerCount'";

    $result = $con->query($sql);

    if ($result) {
        $flights = [];
        while ($row = $result->fetch_assoc()) {
            $flights[] = $row;
        }
        if (count($flights) > 0) {
            echo json_encode($flights);
        } else {
            echo json_encode(["error" => "No flights found"]);
        }
    } else {
        echo json_encode(["error" => $con->error]);
    }
}
