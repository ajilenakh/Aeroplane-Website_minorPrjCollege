<?php
include("connection.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstName = $_POST["firstName"];
    $lastName = $_POST["lastName"];
    $email = $_POST["email"];
    $phoneNumber = $_POST["phoneNumber"];
    $message = $_POST["message"];

    // Sanitize user input (for security)
    $firstName = mysqli_real_escape_string($con, $firstName);
    $lastName = mysqli_real_escape_string($con, $lastName);
    $email = mysqli_real_escape_string($con, $email);
    $phoneNumber = mysqli_real_escape_string($con, $phoneNumber);
    $message = mysqli_real_escape_string($con, $message);

    // Insert data into the database
    $query = "INSERT INTO contact (firstName, lastName, email, phoneNumber, message) VALUES ('$firstName', '$lastName','$email', '$phoneNumber', '$message')";

    if (mysqli_query($con, $query)) {
        echo json_encode(array("success" => true, "message" => "Contact Details submitted successfully"));
        //header("location: ../../index.php");
    } else {
        echo "Error: " . mysqli_error($con);
    }

    mysqli_close($con);
}
