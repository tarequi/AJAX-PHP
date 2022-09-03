<?php
include "../config.php";




$std_name = $_POST['std_n'];
$std_email = $_POST['std_e'];
$std_pass = $_POST['std_p'];
$std_con_p = $_POST['std_c_pass'];
$status = $_POST['status'];



if (checkEmail($std_email) && !empty($std_email)) {
    if (!empty($std_name) && !empty($std_pass) && !empty($std_con_p)) {
        if ($std_pass === $std_con_p) {
            $sql = "INSERT INTO `users` (`user_name`,`user_email`,`user_password`,`status`) VALUES
                ('$std_name','$std_email','$std_pass','$status')";
            $result = mysqli_query($conn, $sql);
            if ($result) {
                echo "<div class='alert alert-success' role='alert'>success</div>";
            } else {
                echo "<div class='alert alert-danger' role='alert'>Erorr Insert</div>";
            }
        } else {
            echo "<div class='alert alert-danger' role='alert'>confirm Password</div>";
        }
    } else {
        echo "<div class='alert alert-danger' role='alert'>Empty Field</div>";
    }
} 
else {
    echo "<div class='alert alert-danger' role='alert'>Not Valid Email!!</div>";
}



function checkEmail($email)
{
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return true;
    } else {
        return false;
    }
}


?>