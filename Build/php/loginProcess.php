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



session_start();

include("connection.php");
include("functions.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Check if both username and password fields are filled
    if (!empty($username) && !empty($password)) {
        // Fetch user data based on the provided username
        $query = "SELECT UserId, Username, PasswordHash, Salt FROM users WHERE Username = ?";
        $stmt = mysqli_prepare($con, $query);

        if ($stmt) {
            // Bind parameters with references
            mysqli_stmt_bind_param($stmt, "s", $username);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);

            // Check if a user with the given username exists
            if (mysqli_stmt_num_rows($stmt) == 1) {
                // Bind the result variables
                mysqli_stmt_bind_result($stmt, $UserId, $FetchedUsername, $FetchedPasswordHash, $Salt);
                mysqli_stmt_fetch($stmt);

                // Hash the provided password with the fetched salt
                $hashed_password = password_hash($password . $Salt, PASSWORD_BCRYPT);

                // Compare the hashed password with the fetched password hash
                if (password_verify($hashed_password, $FetchedPasswordHash)) {
                    // Passwords match, user is authenticated
                    $_SESSION["user_id"] = $UserId;
                    $_SESSION["username"] = $FetchedUsername;
                    header("Location: homePage.php");
                    die();
                } else {
                    // Passwords don't match
                    echo "Incorrect password. Please try again.";
                }
            } else {
                // No user with the provided username exists
                echo "No user found with that username.";
            }

            mysqli_stmt_close($stmt);
        } else {
            echo "Error: " . mysqli_error($con);
        }
    } else {
        echo "Please fill in both the username and password fields.";
    }
}

