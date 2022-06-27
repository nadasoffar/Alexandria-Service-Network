<html>
  <head>
    <title>My profile</title>
    <link rel="stylesheet" type="text/css" href="profile.css">
  </head>
  <body>
    <div id="navigation">
      <ul>
        <li><a href="newsfeed.php">Home</a></li>
        <li><a href="profile.php">View Profile</a></li>
        <li><a href="profile-edit.php">Edit Profile</a></li>

        <li><a href="friend_list.php">Friend Lists</a></li>
        <li><a href="notifications.php">Notifications</a></li>
        <li><a href="logout.php">Logout</a></li>
          <li>
          <form action="search.php" method="GET" id="search" >
                      <input type="text" name="q"  placeholder="search" id="bar" required/>
                      <button>GO</button>
                </form>
            </li>
      </ul>

</div>
</body>
</html>
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

$userID=$_POST['show'];

$sql="SELECT * FROM friend_system WHERE (user_id='$userID' or friend_id='$userID') and (status='1')";
$result=$conn->query($sql);

if($result->num_rows > 0){

 while($row=$result->fetch_assoc()){
       $f_id  =$row['friend_id'];
       $s_id  =$row['user_id'];
       if ($f_id!=$userID) {

       $s="SELECT * FROM user_data WHERE ID='$f_id'";
       $r=$conn->query($s);
       $ro=$r->fetch_assoc();
       $pp=$ro['profile_p'];
       $f_name=$ro['fname'];
       $l_name=$ro['lname'];
       $friendid=$ro['ID'];

   echo "<ul>\n";
   if($pp =='')
          {
           echo '<img src="uploads/profile/facebook-default-no-profile-pic.jpg" width="50" hight="50">';
          }
          else
            if ($pp !='') {
              echo '<img src="uploads/profile/'.$pp.'" width="50" hight="50">';
            }
   echo "<li>" . "<a  href=\"user_profile.php?id=$friendid\">"   .$f_name . " " . $l_name .  "</a></li>\n";
   echo "</ul>";
   }
   else{
   	 $s="SELECT * FROM user_data WHERE ID='$s_id'";
       $r=$conn->query($s);
       $ro=$r->fetch_assoc();
       $f_name=$ro['fname'];
       $l_name=$ro['lname'];
       $friendid=$ro['ID'];
       $pp=$ro['profile_p'];
   echo "<ul>\n";
    if($pp =='')
          {
           echo '<img src="uploads/profile/facebook-default-no-profile-pic.jpg" width="50" hight="50">';
          }
          else
            if ($pp !='') {
              echo '<img src="uploads/profile/'.$pp.'" width="50" hight="50">';
            }
   echo "<li>" . "<a  href=\"user_profile.php?id=$friendid\">"   .$f_name . " " . $l_name .  "</a></li>\n";
   echo "</ul>";
   }
}
}
else{
  echo "user has no friends";
}
?>
