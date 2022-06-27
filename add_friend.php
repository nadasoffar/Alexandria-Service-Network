<?php
session_start();

$db_host="localhost";
$db_username = "root";
$db_password = "";
$db_name ="ASN";

$conn= mysqli_connect("$db_host","$db_username","$db_password","$db_name");
if (!$conn) {
	die("connection failed");
}

$user_id=$_SESSION['Id'];
$reciving_id=$_GET['reciving_id'];


$sql="INSERT INTO `friend_system`(`user_id`, `friend_id`,`status`) VALUES ('$user_id','$reciving_id','2')";

$result=$conn->query($sql);
echo "your request has been sucessfully sent";


?>
