<?php
include('validation.php');

$db_host="localhost";
$db_username = "root";
$db_password = "";
$db_name ="ASN";

$conn= mysqli_connect("$db_host","$db_username","$db_password","$db_name");
if (!$conn) {
	die("connection failed");
}

$user_ID=$_SESSION['Id'];
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


   <h2>Welcome: <?php echo "".$_SESSION['First'];echo " "; echo "".$_SESSION['Last']; ?></h2>

     	<?php
           $sql="SELECT  `profile_p` FROM `user_data` WHERE ID='$user_ID' ";
           $result=$conn->query($sql);
          if($result->num_rows > 0){

             $row = $result->fetch_assoc();
             $pp=$row['profile_p'];
          }

          if($pp =='')
          {
	         echo '<img src="uploads/profile/facebook-default-no-profile-pic.jpg" width="100" hight="100">';
          }
          else
          	if ($pp !='') {
            	echo '<img src="uploads/profile/'.$pp.'" width="100" hight="100">';
            }
        ?>
<h2>Status:</h2>
<div class="postForm" >
	     <form action= "post.php"  method="post"  enctype="multipart/form-data">
		 <textarea id="post" name="pst" rows="7" cols="80"></textarea>
		   <input type="checkbox" name="prvt" value="1"> Only Friends<br>
<input type="file" name="fileToUpload" id="fileToUpload">
		 <button type="submit">POST</button>
		 </form>
	</div>

    <h2>you have:(<?php
    	$i=0;
$sql="SELECT  * FROM `friend_system` WHERE friend_id='$user_ID'";
$result=$conn->query($sql);

if($result->num_rows > 0){

 while($row=$result->fetch_assoc()){

 	$status  =$row['status'];
 	$request_from =$row['user_id'];

 	if ($status=='2') {
 		$i++;
 }

}
echo "".$i;
}
	else
 		echo "0";

    ?>)Notifications </h2>

    <?php

      $s="SELECT *  FROM `post` WHERE id = ".$_SESSION['Id'] ." ORDER BY `post_time` DESC";


     $re=$conn->query($s);

    if($re->num_rows > 0){

 while($ro=$re->fetch_assoc()){
    echo "<td>";
 	echo $ro['txt'] ." - ";
 	if($ro['img'] != '')
 	{

 	echo  "<img src='uploads/post/".$ro['img'] ."' width='50' hieght='50' /> ";
 	}
 	echo $ro['prvt'] ." - ";
 	echo $ro['post_time'] ." - </br>";
}
  }

    ?>
</body>
</html>
