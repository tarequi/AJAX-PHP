<?php
include "../config.php";


$id_std =$_POST['stdId'];
$course_name = $_POST['course_name'];
$mark = $_POST['course_mark'];

//insert sql
$sql = "INSERT INTO `courses` (`course_name`,`course_mark`,`std_id`) VALUES ('$course_name','$mark','$id_std')";

$result = mysqli_query($conn,$sql);
if($result){
    echo"yes";
}

?>