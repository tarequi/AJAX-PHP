<?php
    include "config.php";


if (isset($_POST['submit'])) {
    $userEmail =trim($_POST['userEmail']);
    $userPass =trim($_POST['userPass']);

    if(!empty($userEmail) && !empty($userPass)){
        if(checkEmail($userEmail)){
            $sql = "SELECT * FROM `users` WHERE user_email ='$userEmail' AND user_password = '$userPass'";
            $result = mysqli_query($conn, $sql);
            $info = mysqli_fetch_assoc($result); //get (id)
            $row = mysqli_num_rows($result);
            if ($row > 0) {
                if($info['status'] == 1){//if your account active
                        session_start();
                        $_SESSION['user_id'] = $info['user_id'];
                        header("Refresh:2; url=home.php");
                    } 
                    else {
                    echo "<div class='alert alert-danger' role='alert'>Admin Should activate Your Account</div>";
                }
            }
            }
            else{
                echo "<div class='alert alert-danger' role='alert'>Email Not Valid</div>";
            }
        }
        else{
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
    <link rel="stylesheet" href="css/all.min.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/bootstrap.min.css.map">
    <link rel="stylesheet" href="css/style.css">
    <title>login</title>
</head>

<body>
    <div class="padding d-flex justify-content-center">
        <div class="col-md-10 col-md-offset-1">
            <form class="signup-form" enctype="multipart/form-data" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                <h2 class="text-center">Login</h2>
                <div class="form-group"><input type="text" name="userEmail" class="form-control" placeholder="Email Address"></div>
                <div class="form-group"><input type="password" name="userPass" class="form-control" placeholder="Password"></div>
                <div class="form-group text-center">
                    <button type="submit" name="submit" class="btn btn-success btn-block mt-5">Start Now</button>
                </div>
            </form>
        </div>
    </div>
</body>

</html>