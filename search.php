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
$id = $_SESSION['Id'];
$search =$_GET['q']; ;

$sql="SELECT * FROM user_data WHERE  fname LIKE '%$search%' or lname LIKE '%$search%' or city LIKE '%$search%' or pno LIKE '%$search%' or email LIKE '%$search%'";
$result=$conn->query($sql);
if($result->num_rows > 0){
 while($row=$result->fetch_assoc()){

       $pp=$row['profile_p'];
       $FirstName  =$row['fname'];
       $LastName  =$row['lname'];
       $ID  =$row['ID'];
       $city  =$row['city'];
       if ($ID!=$id) {
   echo "<ul>\n";
      if($pp =='')
          {
           echo '<img src="uploads/profile/facebook-default-no-profile-pic.jpg" width="50" hight="50">';
          }
          else
            if ($pp !='') {
              echo '<img src="uploads/profile/'.$pp.'" width="50" hight="50">';
            }
   echo "<li>" . "<a  href=\"user_profile.php?id=$ID\">"   .$FirstName . " " . $LastName .  "</a></li>\n";
   echo "</ul>";
}
else{

}
 }
}
 else
 	echo "no results found..";

?>
