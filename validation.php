<?php
session_start();

if(!isset($_SESSION['Id'])){
	header("location:./");
	echo "please sign in";
}
$user_id = $_SESSION['Id'];
?>