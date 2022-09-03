<?php
include "../config.php";
session_start();


if (isset($_SESSION['admin_id'])) {
    // echo $_SESSION['admin_id'];
} else {
    header("location:login.php");
}
// session_destroy();

//get All Users from table user






//update 
if (isset($_POST['userEmail'])) {
    $user_id = $_POST['id'];
    $user_name = $_POST['userName'];
    $userEmail = $_POST['userEmail'];
    $user_pass = $_POST['userPass'];


    $sql = "UPDATE `users` SET `user_name` = '$user_name' , `user_email` = '$userEmail' , `user_password` = '$user_pass'  WHERE `user_id` = '$user_id'";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        echo $success_message = "yess";
    } else {
        echo "noo";
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
    <script src="../js/bootstrap.bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <title>admin home</title>
    <style>
        .buttons {
            justify-content: space-between;
            display: flex;
        }
    </style>
</head>


<body>
    <div class="container">
        <table class="table table-striped justify-content-center mt-auto">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Password</th>
                    <th scope="col">Status</th>
                    <th scope="col">Edit</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT * FROM `users`";
                $result = mysqli_query($conn, $sql);
                while ($info = mysqli_fetch_assoc($result)) {
                    $status = $info['status'];
                ?>
                    <tr id="<?php echo $info['user_id'] ?>">
                        <td> <?php echo $info["user_id"]; ?></td>
                        <td data-target="userName"> <?php echo $info["user_name"]; ?></td>
                        <td data-target="userEmail"> <?php echo $info["user_email"]; ?></td>
                        <td data-target="userPass"> <?php echo $info["user_password"]; ?></td>


                        <td id="status<?= $info['user_id'] ?>">
                            <?php
                            if ($status == 1) {
                            ?>
                                <button onclick="change_status(<?= $info['user_id'] ?>)" type="button" class="btn btn-success">Active</button>
                            <?php
                            } else {
                            ?>
                                <button onclick="change_status(<?= $info['user_id'] ?>)" type="button" class="btn btn-danger">Not Active</button>
                            <?php
                            }
                            ?>
                        </td>
                        <td> <a href="#" data-role="update" data-id="<?php echo $info['user_id'] ?>" class="btn btn-success">Edit</a><br>
                        </td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>

        <div class="buttons">
            <button id="btn-mark" class="btn btn-primary">Add marks</button>
            <button id="btn-add-std" class="btn btn-secondary">Add Student</button>
        </div>
    </div>


    <!----------------------------------------- Modal  update------------------------------------->
    <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="userName">User Name</label>
                        <input type="text" id="userName" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="userEmail">User Email</label>
                        <input type="text" id="userEmail" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="userPass">User Password</label>
                        <input type="text" id="userPass" class="form-control">
                    </div>
                    <input type="hidden" id="userId" class="form-control">
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-danger float-left" data-bs-dismiss="modal">Close</button>
                    <button type="button" id="save-btn" class="btn btn-success">Save changes</button>
                </div>
            </div>
        </div>
    </div>

    <!----------------------------------------- Modal  update------------------------------------->




















    <!----------------------------------------- Modal  add mark------------------------------------->

    <div class="modal fade" id="Modal_add_mark" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Marks</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">



                    <div class="form-group">
                        <label>Select student</label>
                        <select class="form-control" id="select_std_name">
                            <option>Select Student</option>
                            <?php
                            $sql2 = "SELECT * FROM `users`";
                            $result2 = mysqli_query($conn, $sql2);
                            while ($row = mysqli_fetch_assoc($result2)) {
                            ?>
                                <option value="<?php echo $row['user_id'] ?>"><?php echo $row['user_name'] ?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>



                    <div class="form-group">
                        <label for="course_name">course name</label>
                        <input type="text" id="course_name" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="mark">Mark</label>
                        <input type="number" id="mark" class="form-control">
                    </div>
                    <input type="hidden" id="Id_std" class="form-control">
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" id="close" class="btn btn-danger float-left" data-bs-dismiss="modal">Close</button>
                    <button type="button" onclick="addstd()" class="btn btn-success">Add</button>
                </div>
            </div>
        </div>
    </div>

    <!----------------------------------------- Modal  add mark------------------------------------->





    <!----------------------------------------- Modal  add Student------------------------------------->


    <div class="modal fade" id="Modal_add_std" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Student</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="std_name">Student Name</label>
                        <input type="text" id="std_name" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="std_email">Student Email</label>
                        <input type="text" id="std_email" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="std_pass">Student Password</label>
                        <input type="password" id="std_pass" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="std_con_pass">Confirm Password</label>
                        <input type="password" id="std_con_pass" class="form-control">
                    </div>
                    <input type="hidden" id="Id_std" class="form-control">
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" id="close" class="btn btn-danger float-left" data-bs-dismiss="modal">Close</button>
                    <button type="button" id="add_student" class="btn btn-success">Add Student</button>
                </div>
            </div>
        </div>
    </div>

    <!----------------------------------------- Modal  add Student------------------------------------->












    <script>
        $(document).ready(function() {
            /********************************************Edit Button**************************************/
            $(document).on('click', 'a[data-role=update]', function() {
                //save user information in variable (from table)
                var id = $(this).data('id');
                var username = $('#' + id).children('td[data-target=userName]').text();
                var useremail = $('#' + id).children('td[data-target=userEmail]').text();
                var userpass = $('#' + id).children('td[data-target=userPass]').text();


                //to put the data in popup
                $('#userName').val(jQuery.trim(username)); //remove white space
                $('#userEmail').val(jQuery.trim(useremail)); //remove white space
                $('#userPass').val(jQuery.trim(userpass)); //remove white space
                $('#userId').val(id);
                $('#myModal').modal('toggle');
            });

            $("#save-btn").on('click', function() {
                //save new value in variable
                var id = $('#userId').val(); //(input type hidden)
                var userName = $('#userName').val();
                var userEmail = $('#userEmail').val();
                var userPass = $('#userPass').val();

                $.ajax({
                    url: "admin_home.php",
                    method: "POST",
                    data: {
                        userEmail: userEmail,
                        userName: userName,
                        userPass: userPass,
                        id: id
                    },
                    success: function(response) {
                        $('#' + id).children('td[data-target=userName]').text(userName);
                        $('#' + id).children('td[data-target=userEmail]').text(userEmail);
                        $('#' + id).children('td[data-target=userPass]').text(userPass);
                        $('#myModal').modal('toggle');
                    }
                });
            });

            /********************************************Edit Button**************************************/






            /********************************************Add Marks Button**************************************/

            //add student marks
            $(document).on("click", "#btn-mark", function() {
                $("#select_std_name").on("change", function() {
                    var id = $(this).val(); //(student id)
                    // console.log(id);
                    $('#Id_std').val(id); //put the id in (input type hidden)
                });

                $("#Modal_add_mark").modal("toggle");

            });
        });
        //add student marks
        function addstd() {
            var id_std = $('#Id_std').val(); //id that it will go to ajax
            var c_name = $("#course_name").val(); //data that it will go to ajax
            var mark = $("#mark").val(); //data that it will go to ajax


            $.ajax({
                url: "add_course.php",
                method: "POST",
                data: {
                    stdId: id_std,
                    course_name: c_name,
                    course_mark: mark
                },
                success: function(response) {
                    console.log(response);


                    $("#Modal_add_mark").modal("toggle");
                    $("#mark").val(""); //to empty the text after added
                    $("#course_name").val(""); //to empty the text after added
                    $("#select_std_name").val(""); //to empty the text after added
                }
            });
        }


        /********************************************Add Marks Button**************************************/



        function change_status(id) {
            $.ajax({
                url: "status.php",
                method: "POST",
                data: {
                    id: id
                },
                success: function(data) {
                    $("#status" + id).html(data); //[to change avtive => not active in real time]
                }
            });
        }


        /*********************************add student ******************************/
        $(document).ready(function() {
            $("#btn-add-std").on("click", function() {
                $("#Modal_add_std").modal("toggle");
            });
            $("#add_student").on('click', function() {
                var std_name = $("#std_name").val();
                var std_email = $("#std_email").val();
                var std_pass = $("#std_pass").val();
                var std_con_pass = $("#std_con_pass").val();

                // console.log(std_name);
                // console.log(std_email);
                // console.log(std_pass);
                // console.log(std_con_pass);
                $.ajax({
                    url: "add_std.php",
                    method: "POST",
                    data: {
                        std_n: std_name,
                        std_e: std_email,
                        std_p: std_pass,
                        std_c_pass: std_con_pass,
                        status: 0
                    },
                    success: function(data) {
                        console.log(data);
                        $("#Modal_add_std").modal("toggle");
                    }
                });
            });
        });
        /*********************************add student ******************************/
    </script>

</body>

</html>