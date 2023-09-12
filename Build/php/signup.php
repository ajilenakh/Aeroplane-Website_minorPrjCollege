<?php
session_start();

    include("connection.php");
    include("functions.php");

    //$user_data = check_login($con);


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["register"])) {
    $Username = $_POST["username"];
    $Email = $_POST["email"];
    $password = $_POST["password"];

    // Check if the username is not a number
    if (!preg_match('/^\d+$/', $Username)) {
        // Check if both the username and password fields are filled
        if (!empty($Username) && !empty($password)) {

            // Encrypting password
            $salt = bin2hex(random_bytes(32));
            $hashed_password = password_hash($password . $salt, PASSWORD_BCRYPT);

            // Generate a random User ID (adjust the range as needed)
            $UserId = rand(100000, 999999);

            // Inserting data
            $query = "INSERT INTO users (UserId, Username, Email, PasswordHash, Salt) VALUES (?, ?, ?, ?, ?)";
            $stmt = mysqli_prepare($conn, $query);

            if ($stmt) {
                // Bind parameters with references
                mysqli_stmt_bind_param($stmt, "issss", $UserId, $Username, $Email, $hashed_password, $salt);
                mysqli_stmt_execute($stmt);
                echo "Registration successful!";
                mysqli_stmt_close($stmt);
            } else {
                echo "Error: " . mysqli_error($conn);
            }
        } else {
            echo "Please fill in both the username and password fields.";
        }
    } else {
        echo "Username cannot be a number.";
    }
}
?>
