<?php
include("connection.php");

$flightIdResults = array(); // Array to store flight ID search results
$routeResults = array(); // Array to store route search results

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['flightId'])) {
        $flightId = $_POST['flightId'];
        $sql = "SELECT * FROM flights WHERE flight_id='$flightId'";

        $result = mysqli_query($con, $sql);

        if ($result) {
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $flightIdResults[] = $row;
                }
            } else {
                $flightIdResults['error'] = "No flights found for the selected flight ID.";
            }
        } else {
            $flightIdResults['error'] = "Error executing query: " . mysqli_error($con);
        }
    }

    if (isset($_POST['boardingFrom']) && isset($_POST['destination'])) {
        $boardingFrom = $_POST['boardingFrom'];
        $destination = $_POST['destination'];
        $departDateRoute = $_POST['departDateRoute'];
        $sql = "SELECT * FROM flights WHERE origin='$boardingFrom' AND destination='$destination' AND depart_day='$departDateRoute'";

        $result = mysqli_query($con, $sql);

        if ($result) {
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $routeResults[] = $row;
                }
            } else {
                $routeResults['error'] = "No flights found for the selected route and date.";
            }
        } else {
            $routeResults['error'] = "Error executing query: " . mysqli_error($con);
        }
    }
}
echo json_encode(array("flightIdResults" => $flightIdResults, "routeResults" => $routeResults));

mysqli_close($con);
