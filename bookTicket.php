<?php
session_start();
include("connection.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Assuming user is logged in and user_id is available in session
    $user_id = $_SESSION['username'];
    $flight_id = $_POST['flight_id'];
    $passenger_count = $_POST['passenger_count'];

    // Insert reservation into database
    $sql = "INSERT INTO reservations (user_id, flight_id, passenger_count) 
            VALUES ('$user_id', '$flight_id', '$passenger_count')";

    if ($con->query($sql) === TRUE) {
        echo json_encode(["success" => true]);
    } else {
        echo json_encode(["error" => $con->error]);
    }
}
