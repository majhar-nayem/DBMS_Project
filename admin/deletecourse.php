<?php session_start();

if(!isset($_SESSION['ID'])){

  header("location: index.php");

  exit;

}


include'admin-functions.php';

$db = connect_database();
  $crsid = $_GET['id'];


  $query= "delete from course where Course_ID='$crsid'";
  $result = mysqli_query($db, $query);
  $count = mysqli_num_rows($result);

$_SESSION['admin-notification']="Course Deleted Successfully!";
  header("location:course.php");



  ?>
