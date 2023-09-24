<?php
include("connection.php");

$origin = $_POST['origin'];
$destination = $_POST['destination'];
$departDate = $_POST['departDate'];
$passengerCount = $_POST['passengerCount'];
$classType = $_POST['classType'];

$sql = "SELECT * FROM flights WHERE origin = '$origin' AND destination = '$destination' AND depart_date = '$departDate' AND passenger_count = '$passengerCount' AND class_type = '$classType'";

$result = $con->query($sql);

if ($result->num_rows > 0) {
    // Output data of each row
    $flights = [];
    while($row = $result->fetch_assoc()) {
        $flights[] = $row;
    }
    echo json_encode($flights);
} else {
    echo "No flights found";


}
