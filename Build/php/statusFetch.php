<?php
include("connection.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['flightId'])) {
        // Flight ID search
        $flightId = $_POST['flightId'];
        $sql = "SELECT * FROM flights WHERE flight_id='$flightId'";
    } elseif (isset($_POST['boardingFrom']) && isset($_POST['destination'])) {
        // Route search
        $boardingFrom = $_POST['boardingFrom'];
        $destination = $_POST['destination'];
        $departDateRoute = $_POST['departDateRoute'];  // Get the date from the form
        $sql = "SELECT * FROM flights WHERE origin='$boardingFrom' AND destination='$destination' AND depart_day='$departDateRoute'";
    } else {
        die("Invalid request.");
    }

    $result = mysqli_query($con, $sql);

    if ($result) {
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<div class='flight-result'>";
                echo "Flight Number: " . $row['flight_id'] . "<br>";
                echo "Origin: " . $row['origin'] . "<br>";
                echo "Destination: " . $row['destination'] . "<br>";
                echo "Departure Day: " . $row['depart_day'] . "<br>";
                echo "Departure Time: " . $row['depart'] . "<br>";
                echo "Arrival Day: " . $row['arrival_day'] . "<br>";
                echo "Arrival Time: " . $row['arrival'] . "<br>";
                echo "Flight Duration: " . $row['length'] . "<br>";
                echo "Price: " . $row['price'] . "<br>";
                echo "Available Seats: " . $row['seats_available'] . "<br>";
                echo "</div>";
            }
        } else {
            echo "No flights found for the selected criteria.";
        }
    } else {
        echo "Error executing query: " . mysqli_error($con);
    }
}

mysqli_close($con);
