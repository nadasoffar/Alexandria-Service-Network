<html>
<head>
	<title></title>
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
include ('validation.php');

   $db_host="localhost";
$db_username = "root";
$db_password = "";
$db_name ="ASN";

$conn= mysqli_connect("$db_host","$db_username","$db_password","$db_name");
if (!$conn) {
	die("connection failed");
}

$user_ID=$_SESSION['Id'];


  $sql="SELECT  * FROM `user_data` WHERE ID='$user_ID' ";
           $result=$conn->query($sql);
          if($result->num_rows > 0){

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
             $status=$row['status'];
             $about_me=$row['about_me'];
          }

          echo '
           <h2> Edit Profile</h2> ' ;
          if($pp =='')
          {
	         echo '<img src="uploads/profile/facebook-default-no-profile-pic.jpg" width="100" hight="100">';
          }
          else
          	if ($pp !='') {
            	echo '<img src="uploads/profile/'.$pp.'" width="100" hight="100">';
            }


	echo '
<form action="upload.php" method="post" enctype="multipart/form-data">
    Select image to upload:
    <input type="file" name="fileToUpload" id="fileToUpload">
     <input type="submit" value="Upload Image" name="submit">
		 </form>';


    echo '<h2>Edit personal information</h2>';
    echo "<form action='update_profile.php' method='post'>";
    echo "<br>";
      echo "Email:". $email;
      echo "<br>";
      echo '<input type="text" placeholder="Edit email"    name="e" ><br>';
      echo "<br>";
      echo"About me: " . $about_me;
      echo "<br>";
      echo '<input type="text" placeholder="Edit aboutme"    name="about" ><br>';
      echo "<br>";
      echo " Date of birth: ". $dob;
      echo "<br>";
      echo '<input type="date" placeholder="Edit birthdate"    name="bd" ><br>';
      echo "<br>";
      echo "Home town:   "  .$city;
      echo "<br>";
      echo '<input type="text" placeholder="Edit city"    name="c" ><br>';
      echo "<br>";
      echo "phone number:  " .$pno;
      echo "<br>";
      echo '<input type="text" placeholder="Edit phonenumber"    name="pno" ><br>';
      echo "<br>";
      echo "status: "        . $status.   "<br>" ;
      echo '<input type="text" placeholder="Edit status"    name="sta" ><br>';
      echo "<br>";
      echo "<button>update</button>";
      echo "<br>";
      echo "</form>";

    $_SESSION['my_email'] = $email;
    $_SESSION['about'] =   $about_me;
    $_SESSION['my_dob'] =  $dob;
    $_SESSION['my_city'] = $city;
    $_SESSION['my_pno'] =  $pno;
    $_SESSION['my_status'] = $status;
?>
