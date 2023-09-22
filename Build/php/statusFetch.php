<?php

include ("connection.php");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form data (you'll need to adapt this based on your actual form fields)
$flightNumber = $_POST['flightNumber'];
$departDate = $_POST['departDate'];

// Example query to get flight data based on form input
$sql = "SELECT * FROM flights WHERE flight_number='$flightNumber' AND depart_date='$departDate'";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<div class='flight-result'>";
        echo "Flight Number: " . $row['flight_number'] . "<br>";
        echo "Departure Time: " . $row['departure_time'] . "<br>";
        echo "Arrival Time: " . $row['arrival_time'] . "<br>";
        echo "Price: " . $row['price'] . "<br>";
        echo "</div>";
    }
} else {
    echo "No flights found for the selected criteria.";
}

$conn->close();
?>
