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

 $Fname = $_POST['firstname'];
 $Lname = $_POST['lastname'];
 $password = $_POST['pass'];
 $email = $_POST['email'];

 $phonenumber =$_POST['pno'];
 $gender = $_POST['sex'];
 $date = date('Y-m-d',strtotime($_POST['dtime']));
 $selected = $_POST['combo'];
 $rstatus = $_POST['combo1'];
 $r;
 $y;
 $x;

 if($selected=='1'){
 	$y= null;
 }
 else

    if($selected=='2'){
 	$y= "alexandria";
   }
else
	if ($selected=='3') {
	$y="cairo";
}

else
	if ($selected=='4') {
	$y="giza";
}

 	if ($gender=="male") {
	$x=1;
}
else
 	if ($gender=="female") {
	$x=0;
}
 if($rstatus=='1'){
 	$r= null;
 }
 else

 if($rstatus=='2'){
 	$r= "married";
 }
 else

    if($rstatus=='3'){
 	$r= "single";
   }
else
	if ($rstatus=='4') {
	$r="in a relationship";
}
else
	if ($rstatus=='5') {
	$r="its complicated";
}
else
	if ($rstatus=='6') {
	$r="engaged";
}

 $sql="INSERT INTO `user_data`(`fname`, `lname`, `pw`, `email`, `pno`, `gender`,`date_of_birth`, `city`,`status`) VALUES ('$Fname','$Lname',md5('$password'),'$email','$phonenumber','$x','$date','$y','$r')";
 $conn->query($sql);
  // echo "welcome         ";
  // echo 'username:       '. $Fname;
  // echo '      '. $Lname;
  // echo 'Email:          '. $email;

$id = $conn->insert_id;
//echo $id;
$_SESSION['ID']=$id;
$_SESSION['name']=$Fname;
$_SESSION['pp']='';
 mysqli_close($conn);

?>
