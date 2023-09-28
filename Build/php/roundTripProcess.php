<?php
include("connection.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $origin = $_POST['origin'];
    $destination = $_POST['destination'];
    $depart_date = $_POST['depart_date'];
    $return_date = $_POST['arrival_date'];

    $sql = "SELECT * FROM flights WHERE origin = '$origin' AND destination = '$destination' AND DATE(departure_time) = '$depart_date'";

    $result = $con->query($sql);

    if ($result) {
        $flights = array();

        while ($row = $result->fetch_assoc()) {
            $flights[] = $row;
        }

        // Now, let's fetch the round trip flights
        $return_sql = "SELECT * FROM flights WHERE origin = '$destination' AND destination = '$origin' AND DATE(departure_time) = '$return_date'";

        $return_result = $con->query($return_sql);

        if ($return_result) {
            while ($row = $return_result->fetch_assoc()) {
                $flights[] = $row;
            }
        }

        // Convert the flights array to JSON format
        $flights_json = json_encode($flights);

        // Send the JSON data to a JavaScript file
        echo "<script>var flightsData = $flights_json;</script>";
    }
}
