<?php session_start();

if(!isset($_SESSION['ID'])){

  header("location: index.php");

  exit;

}
?>

<?php include'admin-functions.php'?>
<?php include 'template-parts/control-bar.php' ?>
<?php include 'template-parts/logo-bar.php'?>



<div class="content">
  <div class="content-inner">
<?php
$db=connect_database();
$query= "select * from student,department where Department_ID=Dept_ID";
$result= mysqli_query($db, $query);
?>
      <div class="heading clearfix"><span class="titlebar">Student</span><a href="addstudent.php"><span class="addbutton">Add Student</span></a></div>
<div class="table-div">

    <table class="unitable">
      <thead>
        <tr>
          <th>ID</th>
          <th>Name</th>
          <th>Department</th>
          <th>Degree</th>
          <th>Credit</th>
          <th>Modify</th>
        </tr>
      </thead>
      <tbody>
      <?php

      while($res = mysqli_fetch_array($result)) {
        echo "<tr>";
        echo "<td>".$res['SID']."</td>";
        echo "<td>".$res['Fname']." ".$res['Lname']."</td>";
        echo "<td>".$res['Dept_Name']."</td>";
          echo "<td>".$res['Degree']."</td>";
            echo "<td>".$res['Total_Cr']."</td>";
            echo "<td><a href=\"editstudent.php?id=$res[SID]\"<span class=\"edit\">EDIT</span></a> </td>";
            echo "</tr>";
      }
      ?>
    </tbody>
  </table>
</div><!--table div end-->
</div><!--content inner end-->
</div>


<?php include 'template-parts/copyright.php'?>
