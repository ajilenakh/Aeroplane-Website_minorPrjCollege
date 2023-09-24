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
            AND depart_date = '$departDate' 
            AND passenger_count >= '$passengerCount' 
            AND class_type = '$classType'";

    $result = $con->query($sql);

    if ($result->num_rows > 0) {
        $flights = [];
        while ($row = $result->fetch_assoc()) {
            $flights[] = $row;
        }
        echo json_encode($flights);
    } else {
        echo json_encode(["error" => "No flights found"]);
    }
}
