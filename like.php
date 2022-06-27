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
$pID=$_POST['post_id'];

$sql="INSERT INTO `likes`(`liker_id`, `pid`) VALUES ('$user_ID','$pID')";

$result=$conn->query($sql);
echo "You liked the post"
?>
<html>
<form action="newsfeed.php" method="GET" id="profile" >
		<button>Go back to home</button>
</form>
</html>
