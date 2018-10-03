<?php session_start();

if(!isset($_SESSION['ID'])){

  header("location: index.php");

  exit;

}


include'admin-functions.php';



$db = connect_database();
if(isset($_POST['Submit'])) {
	$crsid = $_POST['course_id'];
	$faculty = $_POST['faculty'];
	$timeslot = $_POST['timeslot'];
	$room = $_POST['room'];



  $year= date("Y");

  $month= date("m");

  if($month>=1 && $month<=5){
      $semester= "Spring";
  }else if($month>=6 && $month<=8){
      $semester= "Summar";
  }else{
      $semester= "Fall";
  }

        $sql ="Select * from section where Crs_ID='$crsid' and Semester='$semester' and year='$year'";
        $result = mysqli_query($db, $sql);
        $count = mysqli_num_rows($result);

        if($count>=1){
          $section= $count+1;
        }else{
          $section= 1;
        }


        //checking time and room available
        $sql = "select * from section as s where s.Crs_ID ='$crsid' and s.Ts_ID= '$timeslot' and s.Room_No= '$room' and s.Semester='$semester' and s.Year='$year'";
        $result = mysqli_query($db, $sql);
        $timeroom = mysqli_num_rows($result);

        //checking faculty available
        $sql = "select * from section where FID='$faculty' and Ts_ID='$timeslot'";
        $result = mysqli_query($db, $sql);
        $facultytime = mysqli_num_rows($result);




	if($timeroom>=1){
      $_SESSION['admin-notification']="This room is not available in this TimeSlot";
  }else if($facultytime>=1){
      $_SESSION['admin-notification']="This faculty is not available in this TimeSlot";
  }
  else{




		$result = "INSERT INTO Section VALUES('$crsid','$section','$semester','$year','$faculty','$timeslot','$room',0)";
		$result = mysqli_query($db, $result);
		$_SESSION['admin-notification']="Section Added Succesfully!";
            //    header("location:section.php");

	}
}
?>

<?php include 'template-parts/control-bar.php' ?>
<?php include 'template-parts/logo-bar.php'?>

<div class="content">
  <div class="content-inner">

<?php


    function course(){
        $db=connect_database();

        $query= "select * from course";
        $result= mysqli_query($db, $query);


        echo "<select name=\"course_id\">";
        while($res = mysqli_fetch_array($result)) {
          echo "<option value=\"".$res['Course_ID']."\">".$res['Course_ID']."</option>";
        }
        echo "</select>";
    }

    function faculty(){
        $db=connect_database();

        $query= "select * from faculty";
        $result= mysqli_query($db, $query);


        echo "<select name=\"faculty\">";
        while($res = mysqli_fetch_array($result)) {
          echo "<option value=\"".$res['FID']."\">".$res['Initial']."</option>";
        }
        echo "</select>";
    }


    function timeslot(){
        $db=connect_database();

        $query= "select * from timeslot";
        $result= mysqli_query($db, $query);


        echo "<select name=\"timeslot\">";
        while($res = mysqli_fetch_array($result)) {
          echo "<option value=\"".$res['Ts_ID']."\">".$res['DAY']." ".$res['S_time']."-".$res['E_time']."</option>";
        }
        echo "</select>";
    }

    function room(){
        $db=connect_database();

        $query= "select * from classroom";
        $result= mysqli_query($db, $query);


        echo "<select name=\"room\">";
        while($res = mysqli_fetch_array($result)) {
          echo "<option value=\"".$res['Room_No']."\">".$res['Room_No']." (".$res['Capacity'].")</option>";
        }
        echo "</select>";
    }
?>
<?php if($_SESSION['admin-notification']!=null):?>
<div class="message-bar"><div class="message"><?php echo $_SESSION['admin-notification']; $_SESSION['admin-notification']=null;?></div></div>
<?php endif;?>


      <div class="heading clearfix"><span class="titlebar">Add Section</span></div>
<div class="table-div">

    <form action="" method="post" name="form1">
		<table class="unitable">
			<tr>
				<td>ID</td>
        <td><?php course(); ?></td>
			</tr>
                        <tr>
				<td>Faculty</td>
				<td><?php faculty(); ?></td>
			</tr>
			<tr>
				<td>TimeSlot</td>
				<td><?php timeslot(); ?></td>
			</tr>
                        <tr>
				<td>Room No</td>
				<td><?php room(); ?></td>
			</tr>
			<tr>
        <td colspan="2"><input type="submit" name="Submit" value="ADD"></td>
			</tr>
		</table>
	</form>


</div><!--table div end-->
</div><!--content inner end-->
</div>




<?php include 'template-parts/copyright.php'?>
