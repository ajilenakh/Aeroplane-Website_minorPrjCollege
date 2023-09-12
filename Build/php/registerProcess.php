<?php
session_start();

include("connection.php");
include("functions.php");

//$user_data = check_login($con);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Check if the username is not a number
    if (!preg_match('/^\d+$/', $username)) {
        // Check if both the username and password fields are filled
        if (!empty($username) && !empty($password)) {
            // Generate a random salt
           //$salt = bin2hex(random_bytes(32));

            // Hash the password with the salt
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            // Generate a random User ID
            $UserId = random_num(20);

            // insert user data
            $query = "INSERT INTO users (UserId, username, email, passwordhash, salt) VALUES (?, ?, ?, ?, ?)";
            $stmt = mysqli_prepare($con, $query);

            if ($stmt) {
                mysqli_stmt_bind_param($stmt, "issss", $UserId, $username, $email, $hashed_password, $salt);
                mysqli_stmt_execute($stmt);
                mysqli_stmt_close($stmt);

                header("Location: homePage.php");
            } else {
                echo "Error: " . mysqli_error($con);
            }
        } else {
            echo "Please fill in both the username and password fields.";
        }
    } else {
        echo "Username cannot be a number.";
    }
}
?>