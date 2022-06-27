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
$pID=$_GET['pid'];

$sql="SELECT likes.liker_id,likes.pid,user_data.fname,user_data.lname,user_data.profile_p,user_data.ID FROM `likes`
INNER JOIN user_data on likes.liker_id=user_data.ID where likes.pid=$pID";


$result=$conn->query($sql);

if ($result->num_rows > 0){

 while ($row=$result->fetch_assoc()){

  $pp=$row['profile_p'];
  $usrID=$row['ID'];
  $f=$row['fname'];
  $l=$row['lname'];

              if($pp =='')
          {
           echo '<img src="uploads/profile/facebook-default-no-profile-pic.jpg" width="100" hight="100">';
          }
          else
            if ($pp !='') {
              echo '<img src="uploads/profile/'.$pp.'" width="50" hight="50">';
            }
            echo "<li>" . "<a  href=\"user_profile.php?id=$usrID\">"   .$f . " " . $l .  "</a></li>\n";
  }
}

?>
