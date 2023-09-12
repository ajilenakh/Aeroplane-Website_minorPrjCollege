<?php
include ("connection.php");
include ("functions.php");

$conn = new mysqli("localhost", "root", "", "aeroplane_website");
// Sanitize user input
$email = mysqli_real_escape_string($conn, $_POST['email']);
$password = mysqli_real_escape_string($conn, $_POST['password']);


$sql = "SELECT * FROM users WHERE Email='$email'";
$result = $conn->query($sql);

// Before the password verification, add:
    $user = mysqli_fetch_array($result, MYSQLI_ASSOC);  
    
if($user)
{
    if(password_verify($password, $user["Password"]))
    {
        session_start();
        $_SESSION["user"] = "yes";
        header("Location: ../php/homePage.php");
        die();
    }else{
        echo "Password does not match";
    }

}else{
    echo "Email does not match";
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

