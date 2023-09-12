<?php
include ("connection.php");

// Sanitize user input
$username = $_POST["username"];
$password = $_POST["password"];

// Retrieve the stored salt and hashed_password for the given username from your database
// ... (database retrieval code)

// Verify the password
if (password_verify($password . $salt_from_database, $hashed_password_from_database)) {
    // Passwords match, grant access
    echo "Login successful!";
} else {
    // Invalid credentials
    echo "Login failed. Please check your credentials.";
}

$conn->close();
?>