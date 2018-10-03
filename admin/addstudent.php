<?php session_start();

if(!isset($_SESSION['ID'])){

  header("location: index.php");

  exit;

}


include'admin-functions.php';



$db = connect_database();
if(isset($_POST['Submit'])) {
	$Fname = $_POST['Fname'];
        $Lname = $_POST['Lname'];
	$ID = $_POST['SID'];
	$Degree = $_POST['Degree'];
	$Department = $_POST['Dept_Name'];
	$pass = $_POST['pass'];
        $Credit = $_POST['Credit'];
        
        //finding corresponding dept 
        
        $sql ="Select Department_ID from department where Dept_Name=\"".$Department."\"";
        $result= mysqli_query($db, $sql);
        $res = mysqli_fetch_array($result) ;
        $dept_ID= $res['Department_ID'];
       

	// checking empty fields
	if(empty($Fname) ||empty($Lname) || empty($ID) || empty($Degree)|| empty($Department) || empty($pass)) {

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
	} else {
		// if all the fields are filled (not empty)

		//insert data to database

		$result = "INSERT INTO Student VALUES('$ID','$Fname','$Lname','$Degree','$Credit','$dept_ID','$pass')";
		$result = mysqli_query($db, $result);
		//display success message
                header("location:student.php");
		echo "<font color='green'>Data added successfully.";
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
      
      
      <div class="heading clearfix"><span class="titlebar">Add Student</span></div>
<div class="table-div">
  
    <form action="" method="post" name="form1">
		<table class="unitable">
			<tr>
				<td>ID</td>
                                <td><input type="text" name="SID" maxlength="10"></td>
			</tr>
			<tr>
				<td>First Name</td>
                                <td><input type="text" name="Fname" maxlength="25"></td>
			</tr>
                        <tr>
				<td>Last Name</td>
				<td><input type="text" name="Lname" maxlength="25"></td>
			</tr>
			<tr>
				<td>Degree</td>
				<td><input type="text" name="Degree" maxlength="60"></td>
			</tr>
                        <tr>
				<td>Credit</td>
				<td><input type="text" name="Credit" maxlength="3"></td>
			</tr>
                     
			<tr>
				<td>Department</td>
                                <td><?php  dept();?></td>
                        </tr>
                        
			<tr>
				<td>Password</td>
				<td><input type="password" name="pass" maxlength="60"></td>
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
