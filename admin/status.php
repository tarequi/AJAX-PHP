<?php
include "../config.php";


$id = $_POST['id'];//get the id from ajax method

$sql = "SELECT * FROM `users` WHERE `user_id` = '$id'";
$result = mysqli_query($conn, $sql);
$info = mysqli_fetch_assoc($result);

if ($info['status'] == 1) {
    $update = mysqli_query($conn, "UPDATE `users` SET `status`=0 WHERE `user_id` = $id");
?>
    <button id="tog" onclick="change_status(<?= $id ?>)" type="button" class="btn btn-danger">Not Active</button>

<?php
} else {
    $update = mysqli_query($conn, "UPDATE `users` SET `status`=1 WHERE `user_id` = $id");
?>
    <button id="tog" onclick="change_status(<?= $id ?>)" type="button" class="btn btn-success">Active</button>

<?php
}
?>

