<?php
$serverName = "localhost";
$dbuser = "root";
$password = "";
$dbname = "test_comp";


$conn = mysqli_connect($serverName, $dbuser, $password, $dbname);



if(!$conn){
    echo "Error conn";
}
?>