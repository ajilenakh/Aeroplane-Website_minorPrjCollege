<?php
session_start();

include("connection.php");
include("functions.php");

$email = $_POST["email"];
$password = $_POST["password"];

// Retrieve the stored salt and passwordhash for the given email from your database
$query = "SELECT salt, passwordhash FROM users WHERE email = ?";
$stmt = mysqli_prepare($con, $query);

if ($stmt) {
    // Bind parameters with references
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);

    // Check if a user with the given email exists
    if (mysqli_stmt_num_rows($stmt) == 1) {
        // Bind the result variables
        mysqli_stmt_bind_result($stmt, $salt, $HashedPassword);

        // Fetch the stored hashed password and salt from the database
        mysqli_stmt_fetch($stmt);

        // Verify the password
        if (password_verify($password . $salt, $HashedPassword)) {
            // Passwords match, grant access
            $_SESSION["email"] = $email; // Store user's email in the session
            header("Location: homePage.php");
        } else {
            // Invalid credentials
            echo "Login failed. Please check your credentials.";
        }
    } else {
        // No user with the provided email exists
        echo "No user found with that email.";
    }

    mysqli_stmt_close($stmt);
} else {
    echo "Error: " . mysqli_error($con);
}
?>
