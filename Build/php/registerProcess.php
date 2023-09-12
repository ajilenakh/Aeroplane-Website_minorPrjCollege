<?php
session_start();

include("connection.php");
include("functions.php");

//$user_data = check_login($con);


if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $username = $_POST["username"];
  $email = $_POST["email"];
  $password = $_POST["password"];
  
  if (!empty($username) && !empty($password) && !is_numeric($username)) {
      // Save to database using prepared statement
      $UserId = random_num(20);
      $query = "INSERT INTO users (UserId, username, email, password) VALUES (?, ?, ?, ?)";
      $stmt = $con->prepare($query);
      $stmt->bind_param("ssss", $UserId, $username, $email, $password);
      if ($stmt->execute()) {
          header("Location: homePage.php");
          die();
      } else {
          echo "Error: " . $stmt->error;
      }
      $stmt->close();
  } else {
      echo "Please enter some valid information!";
  }
}
?>