<?php
session_start();

if(!isset($_SESSION['SID'])){

  header("location: index.php");

  exit;

}


include'functions.php';

$db = connect_database();
$crsid = $_GET['course_id'];
$stdid= $_SESSION['SID'];
$secno = $_GET['sec_no'];

$current_year= date("Y");

$month= date("m");

$current_semester;

if($month>=1 && $month<=5){
    $current_semester= "Spring";
}else if($month>=6 && $month<=8){
    $current_semester= "Summar";
}else{
    $current_semester= "Fall";
}




$query="Delete from advised_course where Crs_ID='$crsid' and SID= '$stdid' and Semester= '$current_semester' and year = '$current_year' ";
mysqli_query($db, $query);


$query="update section set takes=takes-1 where Crs_ID='$crsid' and Semester='$current_semester' and year='$current_year' and sec_no='$secno'";
$result= mysqli_query($db, $query);



$_SESSION['student-notification']= "Course Removed.";




  header("location:advising.php");















?>
