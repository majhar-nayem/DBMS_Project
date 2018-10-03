<?php session_start();

if(!isset($_SESSION['ID'])){

  header("location: index.php");

  exit;

}


include 'admin-functions.php';
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


if(isset($_POST['Submit'])) {
	$faculty = $_POST['faculty'];
	$timeslot = $_POST['timeslot'];
	$room = $_POST['room'];







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




  		$result = "update Section set FID='$faculty' , Ts_ID='$timeslot', Room_No='$room' where semester='$semester' and year='$year' and Crs_ID='$crsid' and Sec_No='$secno'";
  		$result = mysqli_query($db, $result);
  		$_SESSION['admin-notification']="Section Updated Succesfully!";
              //    header("location:section.php");

  	}
}
?>

<?php include 'template-parts/control-bar.php' ?>
<?php include 'template-parts/logo-bar.php'?>

<div class="content">
  <div class="content-inner">


    <?php



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

<?php



$query="select * from section where Crs_ID='$crsid' and sec_no='$secno' and semester='$semester' and year='$year'";
$result = mysqli_query($db, $query);
$takes;

while($res = mysqli_fetch_array($result)) {

  $takes=$res['Takes'];

}

?>


<?php if($takes>0): ?>


  <div class="message-bar"><div class="message">This section is already taken by someone. So You cannot edit this section. But Delete option is available!</div></div>


<?php else:?>

  <?php if($_SESSION['admin-notification']!=null):?>
  <div class="message-bar"><div class="message"><?php echo $_SESSION['admin-notification']; $_SESSION['admin-notification']=null;?></div></div>
  <?php endif;?>
    <div class="heading clearfix"><span class="titlebar">Edit Section</span></div>
  <div class="table-div">
      <form action="" method="post" name="form1">
        <table class="unitable">
    			<tr>
    				<td>ID</td>
            <td><?php echo $crsid; ?></td>
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
            <td colspan="2"><input type="submit" name="Submit" value="UPDATE"></td>
    			</tr>
    		</table>
  	</form>


  </div><!--table div end-->

<?php endif; ?>
</div><!--content inner end-->
</div>




<?php include 'template-parts/copyright.php'?>
