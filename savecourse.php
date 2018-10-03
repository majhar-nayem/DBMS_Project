<?php
session_start();

if(!isset($_SESSION['SID'])){

  header("location: index.php");

  exit;

}


include'functions.php';

$db = connect_database();
$crsid = $_GET['course_id'];
$secno = $_GET['sec_no'];
$stdid= $_SESSION['SID'];
$flag=true;

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

$_SESSION['student-notification']="";

//max credit checking
$sql = "select * from advised_course as A, course as C, section as S, faculty as F, timeslot as T where SID='$stdid' and a.Crs_ID = C.Course_ID and A.Sec_No = S.Sec_No and A.Crs_ID = S.Crs_ID and S.FID = F.FID and S.Ts_ID= T.Ts_ID and A.Semester='$current_semester' and A.Year='$current_year' and A.Semester= S.Semester and A.Year= S.Year";
$advisedcl= mysqli_query($db, $sql);
$advisedcr=0;
while ($res = mysqli_fetch_array($advisedcl)) {
    $advisedcr+=$res['Credit'];
}
if($advisedcr >=9){
  $flag=false;
  //  echo "<div class=\"message-bar\"><div class=\"message\">You Have Exceeded Credit Limit! </div></div>";
  if($_SESSION['student-notification']==""){
    $_SESSION['student-notification']="You Have Exceeded Credit Limit!";
  }else{
    $_SESSION['student-notification']= $_SESSION['student-notification']."   You Have Exceeded Credit Limit!";
  }

}


//prereq check

$query="SELECT Prereq_ID FROM prereq where Crs_ID='$crsid'";
$result= mysqli_query($db, $query);



while($res = mysqli_fetch_array($result)) {

  $precrs=$res['Prereq_ID'];

  $query = "SELECT * FROM advised_course where sid='$stdid' and Crs_ID='$crsid' and Grade>2";
  $result= mysqli_query($db, $query);
  $count = mysqli_num_rows($result);

  if($count==0){
    $flag=false;
  //  echo "<div class=\"message-bar\"><div class=\"message\">Please check prerequisite!</div></div>";
  if($_SESSION['student-notification']==""){
    $_SESSION['student-notification']="Please check prerequisite!";
  }else{
    $_SESSION['student-notification']= $_SESSION['student-notification'].".......Please check prerequisite!";
  }


//    $_SESSION['student-notification']= $_SESSION['student-notification']."Please check prerequisite!";
    break;
  }


}

//same course check
$query="select * from advised_course where SID='$stdid' and Crs_ID = '$crsid' and Semester='$current_semester' and year='$current_year'";
$result= mysqli_query($db, $query);
$count = mysqli_num_rows($result);

if($count!=0){
  $flag=false;
//    echo "<div class=\"message-bar\"><div class=\"message\">Already Advised This Course!</div></div>";

if($_SESSION['student-notification']==""){
  $_SESSION['student-notification']="Already Advised This Course!";
}else{
  $_SESSION['student-notification']= $_SESSION['student-notification'].".......Already Advised This Course!";
}

  //  $_SESSION['student-notification']= $_SESSION['student-notification']."Already Advised This Course!";
}


//same time checking
$tsid;
$query ="select * from section where Crs_ID='$crsid' and sec_no='$secno' and Semester='$current_semester' and year='$current_year'";
$result= mysqli_query($db, $query);
while ($res = mysqli_fetch_array($result)) {
    $tsid= $res['Ts_ID'];
}

$sql = "select * from advised_course as A, course as C, section as S, faculty as F, timeslot as T where SID='$stdid' and a.Crs_ID = C.Course_ID and A.Sec_No = S.Sec_No and A.Crs_ID = S.Crs_ID and S.FID = F.FID and S.Ts_ID= T.Ts_ID and A.Semester='$current_semester' and A.Year='$current_year' and A.Semester= S.Semester and A.Year= S.Year";
$advisedcl= mysqli_query($db, $sql);
while ($res = mysqli_fetch_array($advisedcl)) {
    $tsid1= $res['Ts_ID'];

    if($tsid1==$tsid){
      $flag=false;
  //      echo "<div class=\"message-bar\"><div class=\"message\">Time Clash with ".$res['Course_ID']." </div></div>";
  if($_SESSION['student-notification']==""){
    $_SESSION['student-notification']="Time Clash with ".$res['Course_ID']."!";
  }else{
    $_SESSION['student-notification']= $_SESSION['student-notification']. ".......Time Clash with ".$res['Course_ID']."!";
  }

  //      $_SESSION['student-notification']= $_SESSION['student-notification']."Time Clash with ".$res['Course_ID'];

        break;
    }
}

//section full checking
$takes;
$capacity;
$query="select * from section s join classroom c on s.room_no=c.Room_No  where semester='$current_semester' and year='$current_year' and Crs_ID='$crsid' and sec_no='$secno'";
$result= mysqli_query($db, $query);
while ($res = mysqli_fetch_array($result)) {
    $takes= $res['Takes'];
    $capacity=$res['Capacity'];


}
if($takes>=$capacity){
  $flag=false;
//  echo "<div class=\"message-bar\"><div class=\"message\">Section FULL!!!</div></div>";
if($_SESSION['student-notification']==""){
  $_SESSION['student-notification']="Section FULL!!!";
}else{
   $_SESSION['student-notification']= $_SESSION['student-notification']."....... Section FULL!!!";
}

}




//insert

if($flag==true){

  $query="insert into advised_course values('$stdid','$crsid','$secno','$current_semester','$current_year', 0)";
  $result= mysqli_query($db, $query);


  $query="update section set takes=takes+1 where Crs_ID='$crsid' and Semester='$current_semester' and year='$current_year' and sec_no='$secno'";
  $result= mysqli_query($db, $query);

//  $_SESSION['student-notification']= $_SESSION['student-notification']."Course Added.";

//  header("location:advising.php");


}

if($_SESSION['student-notification']==""){
  $_SESSION['student-notification']=null;
}

header("location:advising.php");






?>
