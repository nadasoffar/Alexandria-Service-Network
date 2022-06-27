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
 ?>
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


<?php
  $friends=0;
  $g='Female';
  $userid=$_SESSION['Id'];
  $x=$_GET['id'];

  $sql="SELECT * FROM user_data  WHERE ID='$x'";
  $result=$conn->query($sql);

  if($result->num_rows > 0) {
  $row = $result->fetch_assoc();
  $pp=$row['profile_p'];
  $usrID=$row['ID'];
  $f=$row['fname'];
  $l=$row['lname'];
  $email=$row['email'];
  $pno=$row['pno'];
  $gender=$row['gender'];
   $dob=$row['date_of_birth'];
  $city=$row['city'];
  $st=$row['status'];
  $about_me=$row['about_me'];

  if ($gender==1) {
    $g='Male';
  }

  if ($usrID==$userid) {
    header('location:profile.php');
  }

 $sq="SELECT * FROM friend_system WHERE (user_id='$userid' and friend_id='$x') or (user_id='$x' and friend_id='$userid')  ";
 $res=$conn->query($sq);

if($res->num_rows > 0) {
  $ro = $res->fetch_assoc();
  $status=$ro['status'];
  $me=$ro['friend_id'];

  if ($status==1) {
    $friends=1;
  }
  elseif ($status==2) {
    $friends=2;
  }
}

}

?>
</h2>

   <h2><?php echo "".$f; echo " "; echo "".$l; ?> Profile</h2>


   <?php
            if($pp =='')
          {
           echo '<img src="uploads/profile/facebook-default-no-profile-pic.jpg" width="100" hight="100">';
          }
          else
            if ($pp !='') {
              echo '<img src="uploads/profile/'.$pp.'" width="100" hight="100">';
            }
      echo "<br>";

      if ($friends==1) {
    echo " <form action='update_friend_status.php?' method='post'>
    <input type='hidden' name='request' value='".$x."'>
    <button>unfriend</button>
    </form>
    ";

      echo "Email:". $email;
      echo "<br>";
      echo "Gender:" .$g;

      echo "<br>";
      echo "Home town:   "  .$city;
      echo "<br>";
      echo     "status: "        . $st.   "<br>" ;
      echo"About me: " . $about_me;
      echo "<br>";
      echo " Date of birth: ". $dob;
      echo "<br>";
      echo "phone number:  " .$pno;
          echo " <form action='show_friends.php?' method='post'>
    <input type='hidden' name='show' value='".$x."'>
    <button>show friends</button>
    </form>
    ";
    }
    else if($friends==2)
    { if($me!=$userid){
    echo " <form action='update_friend_status.php?' method='post' >
    <h3>request sent</h3>
    <button>cancel request</button>
    <input type='hidden' name='cancel' value='".$x."'>
    </form>";
    }
    elseif ($me==$userid) {
      echo " <form action='notifications.php?' method='post' >
    <button>respond to the request</button>
    </form>";
      }
      echo "Email: ". $email;
      echo "<br>";
      echo "Gender:" .$g;

      echo "<br>";
      echo "Home town:   "  .$city;
      echo "<br>";
        echo     "status: "        . $st.   "<br>" ;
    }
    else{
     echo " <form action='add_friend.php?' method='GET' >
    <button>Add friend</button>
    <input type='hidden' name='reciving_id' value='".$x."'>
    </form>";
      echo "Email:". $email;
      echo "<br>";
      echo "Gender:" .$g;

      echo "<br>";
      echo "Home town:   "  .$city;
      echo "<br>";
        echo     "status: "        . $st.   "<br>" ;
}
   ?>
</body>
</html>
