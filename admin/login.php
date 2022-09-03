<?php
include "../config.php";


if (isset($_POST['submit'])) {
    $adminEmail = $_POST['adminEmail'];
    $adminPass = $_POST['adminPass'];

    if (!empty($adminEmail) && !empty($adminPass)) {
        if (checkEmail($adminEmail)) {
            $sql = "SELECT * FROM `admin` WHERE `admin_email` ='$adminEmail'";
            $result = mysqli_query($conn, $sql);
            $info = mysqli_fetch_array($result); //get (id)
            $row = mysqli_num_rows($result);
            // echo $info['user_id'];
            if ($row > 0) {
                session_start();
                $_SESSION['admin_id'] = $info['admin_id'];
                header("Refresh:3; url=admin_home.php");
            }
        } else {
            echo "<div class='alert alert-danger' role='alert'>Email Not Valid</div>";
        }
    } else {
        echo "<div class='alert alert-danger' role='alert'>Empty Field</div>";
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
    <link rel="stylesheet" href="../css/all.min.css">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/bootstrap.min.css.map">
    <link rel="stylesheet" href="../css/style.css">
    <title>admin login</title>
</head>

<body>
    <div class="padding d-flex justify-content-center">
        <div class="col-md-10 col-md-offset-1">
            <form class="signup-form" enctype="multipart/form-data" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                <h2 class="text-center">Admin Login</h2>
                <div class="form-group"><input type="text" name="adminEmail" class="form-control" placeholder="Email Address"></div>
                <div class="form-group"><input type="password" name="adminPass" class="form-control" placeholder="Password"></div>
                <div class="form-group text-center">
                    <button type="submit" name="submit" class="btn btn-success btn-block mt-5">Start Now</button>
                </div>
            </form>
        </div>
    </div>
</body>

</html>