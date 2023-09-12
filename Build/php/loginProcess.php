<?php
include("connection.php");
include("functions.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Check if both email and password fields are filled
    if (!empty($email) && !empty($password)) {
        // Fetch user data based on the provided email
        $query = "SELECT id, User_Id, username, email, passwordhash, salt FROM users WHERE email = ?";
        $stmt = mysqli_prepare($con, $query);

        if ($stmt) {
            // Bind parameters with references
            mysqli_stmt_bind_param($stmt, "s", $email);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);

            // Check if a user with the given email exists
            if (mysqli_stmt_num_rows($stmt) == 1) {
                // Bind the result variables
                mysqli_stmt_bind_result($stmt, $id, $UserId, $username, $FetchedEmail, $FetchedPasswordHash, $Salt);
                mysqli_stmt_fetch($stmt);

                // Hash the provided password with the fetched salt
                $hashed_password = password_hash($password . $Salt, PASSWORD_BCRYPT);

                // Compare the hashed password with the fetched password hash
                if (password_verify($hashed_password, $FetchedPasswordHash)) {
                    // Passwords match, user is authenticated
                    session_start();
                    $_SESSION["user_id"] = $UserId;
                    $_SESSION["email"] = $FetchedEmail;
                    $_SESSION["username"] = $username;
                    header("Location: homePage.php");
                    die();
                } else {
                    // Passwords don't match
                    echo "Incorrect password. Please try again.";
                }
            } else {
                // No user with the provided email exists
                echo "No user found with that email.";
            }

            mysqli_stmt_close($stmt);
        } else {
            echo "Error: " . mysqli_error($con);
        }
    } else {
        echo "Please fill in both the email and password fields.";
    }
}








/*session_start();

include("connection.php");
include("functions.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Check if both email and password fields are filled
    if (!empty($email) && !empty($password)) {
        // Fetch user data based on the provided email
        $query = "SELECT UserId, email, passwordhash, salt FROM users WHERE email = ?";
        $stmt = mysqli_prepare($con, $query);

        if ($stmt) {
            // Bind parameters with references
            mysqli_stmt_bind_param($stmt, "s", $email);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);

            // Check if a user with the given email exists
            if (mysqli_stmt_num_rows($stmt) == 1) {
                // Bind the result variables
                mysqli_stmt_bind_result($stmt, $UserId, $FetchedEmail, $FetchedPasswordHash, $Salt);
                mysqli_stmt_fetch($stmt);

                // Hash the provided password with the fetched salt
                $hashed_password = password_hash($password . $Salt, PASSWORD_BCRYPT);

                // Compare the hashed password with the fetched password hash
                if (password_verify($hashed_password, $FetchedPasswordHash)) {
                    // Passwords match, user is authenticated
                    $_SESSION["user_id"] = $UserId;
                    $_SESSION["email"] = $FetchedEmail;
                    header("Location: homePage.php");
                    die();
                } else {
                    // Passwords don't match
                    echo "Incorrect password. Please try again.";
                }
            } else {
                // No user with the provided email exists
                echo "No user found with that email.";
            }

            mysqli_stmt_close($stmt);
        } else {
            echo "Error: " . mysqli_error($con);
        }
    } else {
        echo "Please fill in both the email and password fields.";
    }
}*/


?>