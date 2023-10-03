<?php

function check_login($con)
{
    if (isset($_SESSION['UserId'])) {

        $id = $_SESSION['UserId'];
        $query = "select * from users where UserId = '$id' limit 1";

        $result = mysqli_query($con, $query);
        if ($result && mysqli_num_rows($result) > 0) {
            $user_data = mysqli_fetch_assoc($result);
            return $user_data;
        }
    }

    //redirect to login
    header("location: ../php/loginPage.php");
    die;
}

function show_login()
{
    if (isset($_SESSION['username'])) {
        echo '<div class="hidden lg:flex lg:flex-1 lg:justify-end">';
        echo '<span class="text-sm font-semibold leading-6 text-gray-900 hover:underline mx-5">' . $_SESSION['username'] . '</span>';
        echo '<form action="Build/php/logout.php" method="post">';
        echo '<input type="submit" value="Logout" class="hover:underline">';
        echo '</form>';
        echo '</div>';
    } else {
        // If the user is not logged in, show the login button
        echo '<div class="hidden lg:flex lg:flex-1 lg:justify-end">';
        echo '<a href="Build/php/loginPage.php" class="text-sm font-semibold leading-6 text-gray-900 hover:underline">Log in<span aria-hidden="true">&rarr;</span></a>';
        echo '</div>';
    }
}


function random_num($length)
{

    $text = "";
    if ($length < 5) {
        $length = 5;
    }
    $len = rand(4, $length);

    for ($i = 0; $i < $len; $i++) {
        $text .= rand(0, 9);
    }
    return $text;
}
