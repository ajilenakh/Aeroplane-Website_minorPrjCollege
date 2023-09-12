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



