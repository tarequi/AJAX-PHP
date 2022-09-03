<?php
include "config.php";

if (isset($_POST['submit'])) {
    $userName = $_POST['userName'];
    $userEmail = $_POST['userEmail'];
    $userPass = $_POST['userPass'];
    $userPassVer = $_POST['vere_Pass'];



    if (checkEmail($userEmail) && !empty($userEmail)) {
        if (!empty($userName) && !empty($userPass) && !empty($userPassVer)) {
            if ($userPass === $userPassVer) {
                $sql = "INSERT INTO `users` (`user_name`,`user_email`,`user_password`) VALUES
                ('$userName','$userEmail','$userPass')";
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
    } else {
        echo "<div class='alert alert-danger' role='alert'>Not Valid Email!!</div>";
    }
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




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/all.min.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/bootstrap.min.css.map">
    <link rel="stylesheet" href="css/style.css">
    <title>Reg</title>
</head>

<body>
    <div class="padding d-flex justify-content-center">
        <div class="col-md-10 col-md-offset-1">
            <form class="signup-form" enctype="multipart/form-data" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                <h2 class="text-center">Regestration</h2>
                <div class="form-group"><input type="text" name="userName" class="form-control text-center" placeholder="User Name"></div>
                <div class="form-group"><input type="text" name="userEmail" class="form-control text-center" placeholder="Email Address"></div>
                <div class="form-group"><input type="password" name="userPass" class="form-control text-center" placeholder="Password"></div>
                <div class="form-group"><input type="password" name="vere_Pass" class="form-control text-center" placeholder="Confirm Password"></div>
                <div class="form-group text-center">
                    <button type="submit" name="submit" class="btn btn-success btn-block mt-5">Start Now</button>
                </div>
            </form>
        </div>
    </div>
</body>

</html>