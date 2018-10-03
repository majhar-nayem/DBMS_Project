<?php

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


	// checking empty fields
	if(empty($Fname) ||empty($Lname) || empty($ID) || empty($Degree)|| empty($Department) || empty($pass)) {

		if(empty($Fname)) {
			echo "<font color='red'>First Name field is empty.</font><br/>";
		}
                if(empty($Lname)) {
			echo "<font color='red'>Last Name field is empty.</font><br/>";
		}

		if(empty($ID)) {
			echo "<font color='red'>ID field is empty.</font><br/>";
		}

		if(empty($Degree)) {
			echo "<font color='red'>Degree field is empty.</font><br/>";
		}

		if(empty($Department)) {
			echo "<font color='red'>Department is empty.</font><br/>";
		}

		if(empty($pass)) {
			echo "<font color='red'>Password field is empty.</font><br/>";
		}

		//link to the previous page
		echo "<br/><a href='javascript:self.history.back();'>Go Back</a>";
	} else {
		// if all the fields are filled (not empty)

		//insert data to database

		$result = "INSERT INTO Student VALUES('$ID','$Fname','$Lname','$Degree','$Credit','1','$pass')";
		$result = mysqli_query($db, $result);
		//display success message
		echo "<font color='green'>Data added successfully.";

	}
}
?>
