<?php session_start();

if(!isset($_SESSION['ID'])){

  header("location: index.php");

  exit;

}


include'admin-functions.php';

$db = connect_database();
$oldcrsid = $_GET['id'];

if(isset($_POST['Submit'])) {
	$crsid = $_POST['crsid'];
	$crstitle = $_POST['$crstitle'];
	$crscredit = $_POST['$crscredit'];
	$deptname = $_POST['$deptname'];



  //checking course already exist or not?
  $query= "select * from department where Dept_Name='$deptname'";
  $result = mysqli_query($db, $query);
  $count = mysqli_num_rows($result);




  $db=connect_database();
  $query= "select Department_ID from department where Dept_Name ='$deptname' ";
  $result= mysqli_query($db, $query);
  $dept_id="";
  while($res = mysqli_fetch_array($result)) {
            $dept_id= $res['Department_ID'];
  }


	// checking empty fields
	if(empty($crsid) ||empty($crstitle) || empty($crscredit) || empty($deptname)) {

          $_SESSION['admin-notification']="Please Fill up All the Fields!";

	} else if($count!=1){

    $_SESSION['admin-notification']="This Department Does not Exist!";


  }else{


		$sql = "UPDATE course set Course_ID='$crsid', Crs_title ='$crstitle', Credit='$crscredit', dept_ID='$dept_id'   WHERE Course_ID='$oldcrsid' ";

            //    $sql = "update Student set Total_Cr=30 where SID=".$ID;

		mysqli_query($db, $sql);
		//display success message


	//	$_SESSION['admin-notification']="Course Updated Successfully!!!";


        header("location:course.php");



	}
}
?>
<?php


$crsid = $_GET['id'];


$result = "SELECT * FROM course WHERE Course_ID='$crsid'";
$result = mysqli_query($db, $result);

while($res = mysqli_fetch_array($result))
{
	//print_r($result);
	$crsid = $res['Course_ID'];
	$crstitle = $res['Crs_title'];
	$crscredit = $res['Credit'];
	$deptid = $res['dept_ID'];
}
?>

<?php include 'template-parts/control-bar.php' ?>
<?php include 'template-parts/logo-bar.php'?>

<div class="content">
  <div class="content-inner">

<?php
    function dept($deptid){
        $db=connect_database();

        $query= "select Dept_Name from department where Department_ID = ".$deptid.";";
        $result= mysqli_query($db, $query);



        while($res = mysqli_fetch_array($result)) {
                  $department= $res['Dept_Name'];
        }

        echo $department;

    }

    function  dept_id($Department){
        $db=connect_database();

        $query= "select Department_ID from department where Dept_Name = ".$Department.";";
        $result= mysqli_query($db, $query);


        $department="";
        while($res = mysqli_fetch_array($result)) {
                  $department= $res['Department_ID'];
        }

        echo  $department;

    }
?>

<?php if($_SESSION['admin-notification']!=null):?>
<div class="message-bar"><div class="message"><?php echo $_SESSION['admin-notification']; $_SESSION['admin-notification']=null;?></div></div>
<?php endif;?>
  <div class="heading clearfix"><span class="titlebar">Edit Course</span></div>
<div class="table-div">
    <form action="" method="post" name="form1">
		<table class="unitable">
			<tr>
				<td>Course ID</td>
        <td><input type="text" name="crsid" value="<?php echo $crsid; ?>" maxlength="10"></td>
			</tr>
			<tr>
				<td>Course Title</td>
				<td><input type="text" name="$crstitle" value="<?php echo $crstitle; ?>" maxlength="60"></td>
			</tr>
        <tr>
				<td>Credit</td>
				<td><input type="text" name="$crscredit" value="<?php echo $crscredit; ?>" maxlength="3"></td>
			</tr>
			<tr>
				<td>Department</td>
        <td><input type="text" name="$deptname" value="<?php dept($deptid);?>" maxlength="3"></td>
        </tr>
			<tr>
        <td colspan="2"><input type="submit" name="Submit" value="UPDATE"></td>
			</tr>
		</table>
	</form>


</div><!--table div end-->
</div><!--content inner end-->
</div>




<?php include 'template-parts/copyright.php'?>
