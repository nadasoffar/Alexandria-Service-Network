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
    $user_ID=$_SESSION['Id'];

    $new_email=$_POST['e'];
		if (filter_var($new_email, FILTER_VALIDATE_EMAIL)) {
    echo "Email address is considered valid.\n";

    $new_about=$_POST['about'];
    $new_dob=$_POST['bd'];
    $new_city=$_POST['c'];
    $new_pno=$_POST['pno'];
    $new_status=$_POST['sta'];

    if ($new_email=='') {
    	$new_email=$_SESSION['my_email'];
    }
    else
    	if ($new_about=='') {
    	$new_about=$_SESSION['about'];
    }else
    if ($new_dob=='') {
    	$new_dob=$_SESSION['my_dob'];
    }else
    if ($new_city=='') {
    	$new_city= $_SESSION['my_city'];
    }else
    if ($new_pno=='') {
    	$new_pno= $_SESSION['my_pno'];
    }else
    if ($new_status=='') {
    	$new_status=$_SESSION['my_status'];
    }

    $sql="UPDATE `user_data` SET `email`='$new_email',`pno`='$new_pno',`date_of_birth`='$new_dob',`city`='$new_city',`status`='$new_status',`about_me`='$new_about' WHERE ID='$user_ID'";
    echo "Your profile was updated";
		$conn->query($sql);
	}
	else{
		echo '<script>alert("Invalid email")</script>';
	}
		  ?>
		<html>
		<form action="profile.php" method="GET" id="profile" >
				<button>View profile</button>
		</form>
		</html>
