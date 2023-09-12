<?php

function check_login($con)
{

    if(isset($_SESSION['UserId']))
    {

        $id = $_SESSION['UserId'];
        $query = "select * from users where UserId = '$id' limit 1";

        $result = mysqli_query($con,$query);
        if ($result && mysqli_num_rows($result) > 0)
        {
            $user_data = mysqli_fetch_assoc($result);
            return $user_data;
        }
    }

    //redirect to login
    header("location: ..\Login-Page\index.php");
    die;
    
}
?>