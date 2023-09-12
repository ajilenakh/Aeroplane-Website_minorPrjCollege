<?php
session_start();

include("connection.php");
include("functions.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Check if the username is not a number
    if (!preg_match('/^\d+$/', $username)) {
        // Check if both the username and password fields are filled
        if (!empty($username) && !empty($password)) {
            // Check if the email or username already exists
            $query = "SELECT COUNT(*) FROM users WHERE username = ? OR email = ?";
            $stmt = mysqli_prepare($con, $query);

            if ($stmt) {
                mysqli_stmt_bind_param($stmt, "ss", $username, $email);
                mysqli_stmt_execute($stmt);
                mysqli_stmt_bind_result($stmt, $count);
                mysqli_stmt_fetch($stmt);
                mysqli_stmt_close($stmt);

                if ($count > 0) {
                    echo json_encode(array("success" => false, "message" => "Username or email already exists. Please choose another."));
                } else {
                    // Hash the password
                    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

                    // Generate a random User ID
                    $UserId = random_num(20);

                    // Insert user data
                    $insert_query = "INSERT INTO users (UserId, username, email, passwordhash) VALUES (?, ?, ?, ?)";
                    $insert_stmt = mysqli_prepare($con, $insert_query);

                    if ($insert_stmt) {
                        mysqli_stmt_bind_param($insert_stmt, "isss", $UserId, $username, $email, $hashed_password);
                        mysqli_stmt_execute($insert_stmt);
                        mysqli_stmt_close($insert_stmt);

                        $_SESSION["email"] = $email; // Store user's email in the session
                        echo json_encode(array("success" => true, "message" => "Registration successful!"));
                    } else {
                        echo json_encode(array("success" => false, "message" => "Error: " . mysqli_error($con)));
                    }
                }
            } else {
                echo json_encode(array("success" => false, "message" => "Error: " . mysqli_error($con)));
            }
        } else {
            echo json_encode(array("success" => false, "message" => "Please fill in both the username and password fields."));
        }
    } else {
        echo json_encode(array("success" => false, "message" => "Username cannot be a number."));
    }
}
?>