<?php
session_start();

include("connection.php");
include("functions.php");

$username = $_POST["username"];
$password = $_POST["password"];

// Retrieve the stored salt and passwordhash for the given username from your database
$query = "SELECT passwordhash FROM users WHERE username = ?";
$stmt = mysqli_prepare($con, $query);


    if ($stmt) {
        // Bind parameters with references
        mysqli_stmt_bind_param($stmt, "s", $username);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);

                // Check if a user with the given email exists
                if (mysqli_stmt_num_rows($stmt) == 1) {
                    // Bind the result variables
                    mysqli_stmt_bind_result($stmt, $HashedPassword);
            
                    // Fetch the stored hashed password and salt from the database
                    mysqli_stmt_fetch($stmt);
            
                    // Verify the password
                    if (password_verify($password, $HashedPassword)) {
                        // Passwords match, grant access
                       // $_SESSION["email"] = $email;
                        $_SESSION["username"] = $username; // Store user's email in the session
                        echo json_encode(array("success" => true, "message" => "Login successful!"));
                        //header("location: homePage.php");
                    } 
                    else {
                        // Invalid credentials
                        //echo "Login failed. Please check your credentials.";
                        echo json_encode(array("success" => false, "message" => "Invalid username or password"));
                    }
                }

        mysqli_stmt_close($stmt);
    } else {
        echo "Error: " . mysqli_error($con);
    }

?>
