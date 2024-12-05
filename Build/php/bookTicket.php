<?php
session_start();
include("connection.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Assuming the user is logged in and user_id is available in session
    if (isset($_SESSION['username'])) {
        // Get user_id from the session
        $username = $_SESSION['username'];

        // Query to get user_id based on username
        $sql = "SELECT id FROM users WHERE username = ?";
        $stmt = $con->prepare($sql);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $stmt->bind_result($user_id);
        $stmt->fetch();
        $stmt->close();
        
        // Now you have user_id, flight_id, and passenger_count
        if ($user_id) {
            $flight_id = $_POST['flight_id'];
            $passenger_count = $_POST['passenger_count'];

            // Insert reservation into the reservations table
            $sql = "INSERT INTO reservations (user_id, flight_id, passenger_count) 
                    VALUES (?, ?, ?)";
            $stmt = $con->prepare($sql);
            $stmt->bind_param("isi", $user_id, $flight_id, $passenger_count);

            if ($stmt->execute()) {
                echo json_encode(["success" => true]);
            } else {
                echo json_encode(["error" => $con->error]);
            }
            $stmt->close();
        } else {
            echo json_encode(["error" => "User not found."]);
        }
    } else {
        echo json_encode(["error" => "User not logged in."]);
    }
}
?>