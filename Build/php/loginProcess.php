<?php
session_start();

include("connection.php");
include("functions.php");

$username = $_POST["username"];
$password = $_POST["password"];

$query = "SELECT passwordhash, UserId FROM users WHERE username = ?";
$stmt = mysqli_prepare($con, $query);

if ($stmt) {
    // Bind parameters with references
    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);

    if (mysqli_stmt_num_rows($stmt) == 1) {
        // Bind the result variables
        mysqli_stmt_bind_result($stmt, $hashedPassword, $userId);

        // Fetch the stored hashed password and UserId from the database
        mysqli_stmt_fetch($stmt);

        if (password_verify($password, $hashedPassword)) {
            // Passwords match, grant access

            // Store the user's UserId and username in the session
            $_SESSION["UserId"] = $userId;
            $_SESSION["username"] = $username;
            echo json_encode(array("success" => true, "message" => "Login successful!"));
        } else {
            // Invalid credentials
            echo json_encode(array("success" => false, "message" => "Invalid username or password"));
        }
    } else {
        // No user found with the given username
        echo json_encode(array("success" => false, "message" => "User not found"));
    }

    mysqli_stmt_close($stmt);
} else {
    echo "Error: " . mysqli_error($con);
}
