<?php
session_start();

if(!isset($_SESSION['SID'])){

  header("location: index.php");

  exit;

}
?>
<?php

  if(isset($_POST['Submit'])) {

    $old_password=$_POST ['oldpass'];
    $new_password=$_POST ['newpass'];

    include 'functions.php';
    $db=connect_database();

    $student_id= $_SESSION['SID'];
    $query= "select password from student where SID='$student_id'";
    $result= mysqli_query($db, $query);

    $password;
    while($res = mysqli_fetch_array($result)) {
      $password= $res['password'];
    }

    if(!empty($old_password) && !empty($new_password)){
      if($old_password==$password){

        $query= "update student set password='$new_password'where sid='$student_id'";
        mysqli_query($db, $query);

        echo "<div class=\"message-bar\"><div class=\"message\">Password Changed Successfully!</div></div>";
      }
      else{
        echo "<div class=\"message-bar\"><div class=\"message\">Incorrect Password!</div></div>";
      }
    }else{
      echo "<div class=\"message-bar\"><div class=\"message\">Please Enter Both OLD and NEW Password!</div></div>";
    }



  }


?>

<?php include 'template-parts/control-bar.php' ?>
<?php include 'template-parts/logo-bar.php'?>


<div class="content">
  <div class="content-inner">
    <div class="heading clearfix"><span class="titlebar">Setting</span></div>
    <div class="table-div">
        <form action="" method="post" name="form1">
      		<table class="unitable">

            <tr>
      				<td>Old Password</td>
      				<td><input type="text" name="oldpass" value="" maxlength="60"></td>
      			</tr>
      			<tr>
      				<td>New Password</td>
      				<td><input type="text" name="newpass" value="" maxlength="60"></td>
      			</tr>
      			<tr>
              <td colspan="2"><input type="submit" name="Submit" value="CHANGE"></td>
      			</tr>
      		</table>
      	</form>
    </div><!--table div end-->
  </div><!--content inner end-->
</div>
<?php include 'template-parts/copyright.php';?>
