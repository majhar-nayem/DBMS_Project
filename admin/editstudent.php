<?php session_start();

if(!isset($_SESSION['ID'])){

  header("location: index.php");

  exit;

}


include'admin-functions.php';

$db = connect_database();
$oldid = $_GET['id'];

if(isset($_POST['Submit'])) {
	$Fname = $_POST['Fname'];
        $Lname = $_POST['Lname'];
	$ID = $_POST['SID'];
	$Degree = $_POST['Degree'];
	$Department = $_POST['Dept_Name'];
	$pass = $_POST['pass'];
        $Credit = $_POST['Credit'];
        
       
        
echo $ID;

	// checking empty fields
	if(empty($Fname) ||empty($Lname) || empty($ID) || empty($Degree)|| empty($Department) || empty($pass) || empty($Credit)) {
            
            echo "<div class=\"message-bar\"><div class=\"message\">Please Fill up all the fields</div></div>";
/*
		if(empty($Fname)) {
			echo "<div class=\"message-bar\"><div class=\"message\">First Name field is empty.</div></div>";
		}
                if(empty($Lname)) {
                    echo "<div class=\"message-bar\"><div class=\"message\">Last Name field is empty.</div></div>";
			
		}

		if(empty($ID)) {
                    echo "<div class=\"message-bar\"><div class=\"message\">ID field is empty.</div></div>";
			
		}

		if(empty($Degree)) {
                    echo "<div class=\"message-bar\"><div class=\"message\">Degree field is empty.</div></div>";
			
		}

		if(empty($Department)) {
                     echo "<div class=\"message-bar\"><div class=\"message\">Department is empty.</div></div>";
			
		}

		if(empty($pass)) {
                    echo "<div class=\"message-bar\"><div class=\"message\">Password field is empty.</div></div>";
			
		}

		//link to the previous page
		//echo "<br/><a href='javascript:self.history.back();'>Go Back</a>";
 * 
 */
	} else {
		// if all the fields are filled (not empty)

		//insert data to database
          //  $dept_ID= dept_id($Department);
           
        
            

		$sql = "UPDATE Student SET Fname='$Fname',Lname='$Lname',SID='$ID',Degree='$Degree',Total_Cr='$Credit',Password='$pass'  WHERE SID='$oldid' ";
                
            //    $sql = "update Student set Total_Cr=30 where SID=".$ID;
                
		mysqli_query($db, $sql);
		//display success message
                
                
		 echo "<div class=\"message-bar\"><div class=\"message\">EUREKA</div></div>";
                 
                 header("location:student.php");
                 
                 
		
	}
}
?>
<?php

$id = $_GET['id'];


$result = "SELECT * FROM Student WHERE SID='$id'";
$result = mysqli_query($db, $result);

while($res = mysqli_fetch_array($result))
{
	//print_r($result);
	$sid = $res['SID'];
	$fname = $res['Fname'];
	$lname = $res['Lname'];
	$deptid = $res['Dept_ID'];
	$degree = $res['Degree'];
        $credit = $res['Total_Cr'];      
        $pass= $res['Password'];
        
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
      
      
      <div class="heading clearfix"><span class="titlebar">Edit Student</span></div>
<div class="table-div">
  
    <form action="" method="post" name="form1">
		<table class="unitable">
			<tr>
				<td>ID</td>
                                <td><input type="text" name="SID" value="<?php echo $sid; ?>" maxlength="10"></td>
			</tr>
			<tr>
				<td>First Name</td>
                                <td><input type="text" name="Fname" value="<?php echo $fname; ?>" maxlength="25"></td>
			</tr>
                        <tr>
				<td>Last Name</td>
				<td><input type="text" name="Lname" value="<?php echo $lname; ?>" maxlength="25"></td>
			</tr>
			<tr>
				<td>Degree</td>
				<td><input type="text" name="Degree" value="<?php echo $degree; ?>" maxlength="60"></td>
			</tr>
                        <tr>
				<td>Credit</td>
				<td><input type="text" name="Credit" value="<?php echo $credit; ?>" maxlength="3"></td>
			</tr>
                     
			<tr>
				<td>Department</td>
                                <td><input type="text" name="Dept_Name" value="<?php dept($deptid);?>" maxlength="3"></td>
                        </tr>
                        
			<tr>
				<td>Password</td>
				<td><input type="text" name="pass" value="<?php echo $pass; ?>" maxlength="60"></td>
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
