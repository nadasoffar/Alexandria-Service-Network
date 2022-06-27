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

$conn= mysqli_connect("$db_host", "$db_username", "$db_password", "$db_name");
if (!$conn) {
    die("connection failed");
}
 $user_ID=$_SESSION['Id'];



$s="select ud.*from friend_system fs left outer join user_data ud on fs.user_id=ud.id where fs.friend_id=$user_ID and fs.status =2";
$res=$conn->query($s);
if ($res->num_rows > 0) {

    while ($row=$res->fetch_assoc()) {
        $request_from =$row['ID'];
        $firstname=$row['fname'];
        $lastname=$row['lname'];
        $pp=$row['profile_p'];
                echo "<ul>\n";
                 if($pp =='')
          {
           echo '<img src="uploads/profile/facebook-default-no-profile-pic.jpg" width="50" hight="50">';
          }
          else
            if ($pp !='') {
              echo '<img src="uploads/profile/'.$pp.'" width="50" hight="50">';
            }
              echo "<li>" . "<a  href=\"user_profile.php?id=$request_from\">".$firstname." "."".$lastname."</li>";
        echo "<form action='update_friend_status.php' method='post'>";
        echo "<input type='hidden' value='$request_from' name='request_ID'>";
        echo "<input type='submit' value='accept request' name='accept'>";
        echo "<input type='submit' value='ignore request' name='ignore'>";
        echo "</form>";
        echo "</li>";
        echo "</ul>";


        }



} else {
      echo "you have no new notifications";
  }
