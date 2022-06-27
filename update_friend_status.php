<?php

include 'validation.php';

$db_host="localhost";
$db_username = "root";
$db_password = "";
$db_name ="ASN";

$conn= mysqli_connect("$db_host","$db_username","$db_password","$db_name");
if (!$conn) {
	die("connection failed");
}

//var_dump($_POST);
 $my_ID=$_SESSION['Id'];
$va = @$_POST['request'];
$val = @$_POST['request_ID'];
$cancel=@$_POST['cancel'];
$status=0;

if(isset($_POST['accept']))
{
  $status=1;
  $sql= "UPDATE `friend_system` SET `status`='$status' WHERE (user_id='$val' and friend_id='$my_ID')";
 $result=$conn->query($sql);
 echo "you have accepted the request";

} else
if (isset($_POST['cancel'])) {
    $ignore_request="DELETE FROM `friend_system` WHERE (user_id='$cancel' and friend_id='$my_ID')or(user_id='$my_ID' and friend_id='$cancel') ";
	$result=$conn->query($ignore_request);
	echo "you cancelled the request";
}
else{
	$ignore_request="DELETE FROM `friend_system` WHERE (user_id='$val' and friend_id='$my_ID')or(user_id='$my_ID' and friend_id='$val') ";
	$result=$conn->query($ignore_request);
	echo "you have ignored the request";
}

?>
