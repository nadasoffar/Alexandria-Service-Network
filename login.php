<?php
session_start();

$email = $_POST['email'];
$password = $_POST['password'];

if ($email=='' || $password=='') {
echo  "please fill all the required data";
}
else
{
$db_host="localhost";
$db_username = "root";
$db_password = "";
$db_name ="ASN";

$conn= mysqli_connect("$db_host","$db_username","$db_password","$db_name");
if (!$conn) {
	die("connection failed");
}
$email = $_POST['email'];
$password = md5($_POST['password']);

$sql="SELECT * FROM user_data WHERE email='$email' and pw='$password'";


$result=$conn->query($sql);


if($result->num_rows > 0) {


 $row = $result->fetch_assoc();
 $_SESSION['First']=$row['fname'];
 $_SESSION['Last']=$row['lname'];
 $_SESSION['Id']=$row['ID'];
  $_SESSION['pp']=$row['profile_p'];
header('location:profile.php');

}
else {
echo "Wrong Username or Password";
}
mysqli_close($conn); // Closing Connection


 }


?>
