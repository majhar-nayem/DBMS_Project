<?php session_start();

if(!isset($_SESSION['ID'])){

  header("location: index.php");

  exit;

}


include'admin-functions.php';



$db = connect_database();
if(isset($_POST['Submit'])) {
	$crsid = $_POST['crs_id'];
	$crstitle = $_POST['crs_title'];
	$dept = $_POST['Dept_Name'];
  $credit = $_POST['credit'];

  //checking course already exist or not?
  $query= "select * from course where Course_ID='$crsid'";
  $result = mysqli_query($db, $query);
  $count = mysqli_num_rows($result);





	// checking empty fields
	if(empty($crsid) ||empty($crstitle) || empty($dept) || empty($credit)) {


    $_SESSION['admin-notification']="Please Fill up All the Fields!";

		//link to the previous page
		//echo "<br/><a href='javascript:self.history.back();'>Go Back</a>";
	} else if($count==1){

  $_SESSION['admin-notification']="Course Already Exist!";


}else{
		// if all the fields are filled (not empty)

		//insert data to database

    $deptid;
    $query= "select * from department where Dept_Name='$dept'";
    $result = mysqli_query($db, $query);

    while($res = mysqli_fetch_array($result)) {
      $deptid= $res['Department_ID'];
    }



		$query = "INSERT INTO Course VALUES('$crsid','$crstitle','$credit','$deptid')";
		$result = mysqli_query($db, $query);
		//display success message
      $_SESSION['admin-notification']="Course added successfully.";


	}
}
?>

<?php include 'template-parts/control-bar.php' ?>
<?php include 'template-parts/logo-bar.php'?>

<div class="content">
  <div class="content-inner">

<?php
    function dept(){
        $db=connect_database();

        $query= "select Dept_Name from department";
        $result= mysqli_query($db, $query);


        echo "<select name=\"Dept_Name\">";
        while($res = mysqli_fetch_array($result)) {
          echo "<option value=\"".$res['Dept_Name']."\">".$res['Dept_Name']."</option>";
        }
        echo "</select>";
    }
?>

<?php if($_SESSION['admin-notification']!=null):?>
<div class="message-bar"><div class="message"><?php echo $_SESSION['admin-notification']; $_SESSION['admin-notification']=null;?></div></div>
<?php endif;?>

      <div class="heading clearfix"><span class="titlebar">Add Course</span></div>
<div class="table-div">

    <form action="" method="post" name="form1">
		<table class="unitable">
			<tr>
				<td>Course ID</td>
        <td><input type="text" name="crs_id" maxlength="10"></td>
			</tr>
			<tr>
				<td>Course Title</td>
        <td><input type="text" name="crs_title" maxlength="60"></td>
			</tr>
      <tr>
				<td>Credit</td>
				<td><input type="text" name="credit" maxlength="25"></td>
			</tr>
			<tr>
				<td>Department</td>
        <td><?php  dept();?></td>
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
