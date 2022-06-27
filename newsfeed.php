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

$userId = $_SESSION['Id'];

$sql="SELECT * FROM `post` INNER JOIN user_data WHERE post.id=user_data.ID";
$result = $conn->query($sql);
if($result->num_rows > 0){
 while($row=$result->fetch_assoc()){
   $x=0;
  $pp=$row['profile_p'];
  $usrID=$row['ID'];
  $f=$row['fname'];
  $l=$row['lname'];
  $p_text=$row['txt'];
  $p_image=$row['img'];
  $p_time=$row['post_time'];
  $p_prvt=$row['prvt'];
  $p_pid=$row['pid'];


     if($p_prvt==1){
     $s="SELECT * FROM friend_system WHERE (user_id='$userId' and friend_id='$usrID' and status='1' )
     or(user_id='$usrID' and friend_id='$userId' and status='1' )";
   $res=$conn->query($s);
   if(!$res->num_rows > 0){
    $x=1;
    }
  }
    else{
      $x=0;
    }

    if ($x==0) {


     echo "<ul>\n";
   if($pp =='')
          {
           $img= '<img src="uploads/profile/facebook-default-no-profile-pic.jpg" width="50" hight="50">';
          }
          else
            if ($pp !='') {
              $img='<img src="uploads/profile/'.$pp.'" width="25" hight="25">';
            }

            echo "<li>" . $img. "<a  href=\"user_profile.php?id=$usrID\">"   .$f . " " . $l .  "</a></li>\n";
            echo "<br>";
            echo "<td>";
            echo $p_text ;
            echo "<br>";

    if($p_image != '')
    {

    echo  "<img src='uploads/post/".$p_image ."' width='50' hieght='50' /> ";
    }

    echo "<br>";
    echo "posted in:".$p_time."</br>";

    echo '<form action="like.php" method="post">
          <input type="hidden" value="'.$p_pid.'" name="post_id">
          <button>like</button>
          </form>';
   echo "</ul>";

$likes="SELECT * FROM `likes` WHERE likes.pid='$p_pid'";
$l=$conn->query($likes);
$likes_no=0;
if ($l->num_rows > 0){

  while ($w=$l->fetch_assoc()){
    $likes_no++;
  }

  echo  "<a  href=\"likers.php?pid=$p_pid\">"." ".$likes_no." likes";

}
else{
  echo "";
}

   //ctrl+u "in browser"//
}


}

}



?>
