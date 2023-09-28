<?php
include("connection.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["flightNum"])) {
        // Search by flight number
        $flightNum = $_POST["flightNum"];

        $sql = "SELECT * FROM flights WHERE flight_id='$flightNum'";
    } else if (isset($_POST["origin"]) && isset($_POST["destination"]) && isset($_POST["departDate"])) {
        // Search by origin, destination, and departure date
        $origin = $_POST["origin"];
        $destination = $_POST["destination"];
        $departDate = $_POST["departDate"];

        $sql = "SELECT * FROM flights WHERE origin='$origin' AND destination='$destination' AND departure_date='$departDate'";
    } else {
        echo json_encode(["error" => "Invalid request"]);
        exit();
    }

    $result = $con->query($sql);

    $flights = [];

    while ($row = $result->fetch_assoc()) {
        $flights[] = $row;
    }

    echo json_encode($flights);
}
