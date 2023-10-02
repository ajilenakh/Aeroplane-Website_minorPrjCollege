<?php
include("connection.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["flightNum"])) {
        // Search by flight number
        $flightNum = $_POST["flightNum"];

        $sql = "SELECT * FROM flights WHERE flight_id='$flightNum'";
    } else if (isset($_POST["routeOrigin"]) && isset($_POST["routeDestination"]) && isset($_POST["departDateRoute"])) {
        // Search by origin, destination, and departure date
        $routeOrigin = $_POST["routeOrigin"];
        $routeDestination = $_POST["routeDestination"];
        $departDateRoute = $_POST["departDateRoute"];

        $sql = "SELECT * FROM flights WHERE origin='$routeOrigin' AND destination='$routeDestination' AND depart_day='$departDateRoute'";
    } else {
        echo json_encode(["error" => "Invalid request"]);
        exit();
    }

    $result = $con->query($sql);

    if ($result === false) {
        echo json_encode(["error" => "Database query failed: " . $con->error]);
        exit();
    }

    $flights = [];

    while ($row = $result->fetch_assoc()) {
        $flights[] = $row;
    }

    echo json_encode($flights);
}
