<?php

session_start();
include "config.php";


// echo   "Id User = " . $_SESSION['user_id'];



$userId = $_SESSION['user_id']; //the id user

// query to get data from (users) Table
$sql = "SELECT * FROM `users` WHERE `user_id` = '$userId'";
$result = mysqli_query($conn, $sql);
$info = mysqli_fetch_array($result);

// query to get data from (courses) Table
$sql2 = "SELECT * FROM `courses` WHERE `std_id` = '$userId'";
$result2 = mysqli_query($conn, $sql2);




?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/all.min.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <title>HOME</title>
    <style>
        .info {
            position: relative;
            width: 100%;
        }

        .box {
            margin-left: auto;
            margin-right: auto;
        }

        .course {
            margin-left: auto;
            margin-right: auto;
        }
    </style>
</head>

<body>
    <div class="info mt-5">
        <div class="col-lg-6 box">
            <div class="card mb-4">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-3">
                            <p class="mb-0">Full Name</p>
                        </div>
                        <div class="col-sm-9">
                            <p class="text-muted mb-0"><?php echo $info['user_name'] ?></p>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-3">
                            <p class="mb-0">Email</p>
                        </div>
                        <div class="col-sm-9">
                            <p class="text-muted mb-0"><?php echo $info['user_email'] ?></p>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-3">
                            <p class="mb-0">Password</p>
                        </div>
                        <div class="col-sm-9">
                            <p class="text-muted mb-0"><?php echo $info['user_password'] ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6 course mt-5 pt-5">
        <table class="table table-striped justify-content-center mt-auto text-center">
            <thead>
                <tr>
                    <th scope="col">Course Name</th>
                    <th scope="col">Mark</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($row = mysqli_fetch_assoc($result2)) {
                ?>
                    <tr>
                        <td><?php echo $row['course_name'] ?></td>
                        <td><?php echo $row['course_mark'] ?></td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </div>

    
</body>

</html>