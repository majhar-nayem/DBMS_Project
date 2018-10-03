<?php session_start();

if(!isset($_SESSION['ID'])){

  header("location: index.php");

  exit;

}


include'admin-functions.php';

$db = connect_database();
$crsid = $_GET['course'];
$secno = $_GET['sec'];


$year= date("Y");

$month= date("m");

if($month>=1 && $month<=5){
    $semester= "Spring";
}else if($month>=6 && $month<=8){
    $semester= "Summar";
}else{
    $semester= "Fall";
}


  $query= "delete from section where Crs_ID='$crsid' and Sec_No='$secno' and semester='$semester' and year='$year'";
  $result = mysqli_query($db, $query);
  $count = mysqli_num_rows($result);

  $_SESSION['admin-notification']="Section Deleted Successfully!";
  header("location:section.php");



  ?>
