<?php
session_start();
include("connection.php");

$response = ['isLoggedIn' => false];

if (isset($_SESSION['username'])) {
    // Get user_id based on the session username
    $username = $_SESSION['username'];
    
    // Query to get user_id from users table
    $sql = "SELECT id FROM users WHERE username = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->bind_result($user_id);
    $stmt->fetch();
    
    if ($user_id) {
        $response['isLoggedIn'] = true;
        $response['user_id'] = $user_id;
    }
    
    $stmt->close();
}

echo json_encode($response);
?>