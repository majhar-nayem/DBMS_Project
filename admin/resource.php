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
<div class="heading clearfix"><span class="titlebar">Student</span></div>
<div class="table-div">

    <table class="unitable">
      <thead>
        <tr>
          <th>ID</th>
          <th>Name</th>
          <th>Department</th>
          <th>Degree</th>
          <th>Credit</th>
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
            echo "</tr>";
      }
      ?>
    </tbody>
  </table>
</div><!--table div end-->

<div style="margin-bottom: 100px;"></div>

<!--faculty-->
<?php
$query= "select * from faculty as f, department as d where f.dept_ID= d.Department_ID";
$result= mysqli_query($db, $query);
?>

<div class="heading clearfix"><span class="titlebar">Faculty</span></div>
<div class="table-div">

    <table class="unitable">
      <thead>
        <tr>
          <th>Faculty Name</th>
          <th>Department</th>
        </tr>
      </thead>
      <tbody>
      <?php

      while($res = mysqli_fetch_array($result)) {
        echo "<tr>";
        echo "<td>".$res['Initial']."</td>";
        echo "<td>".$res['Dept_Name']."</td>";
        echo "</tr>";
      }
      ?>
    </tbody>
  </table>
</div><!--faculty div end-->

<div style="margin-bottom: 100px;"></div>


<?php
$db=connect_database();
$query= "select * from department as d left join faculty as f on d.chair_ID = f.FID";
$result= mysqli_query($db, $query);
?>
<div class="heading clearfix"><span class="titlebar">Department</span></div>
<div class="table-div">
    <table class="unitable">
      <thead>
        <tr>
          <th>Name</th>
          <th>Chairman</th>
        </tr>
      </thead>
      <tbody>
      <?php

      while($res = mysqli_fetch_array($result)) {
        echo "<tr>";
        echo "<td>".$res['Dept_Name']."</td>";
        echo "<td>".$res['Initial']."</td>";
        echo "<tr>";
      }
      ?>
    </tbody>
  </table>
</div><!--Department div end-->


<div style="margin-bottom: 100px;"></div>


<?php
$db=connect_database();
$query="select * from classroom";
$result= mysqli_query($db, $query);
?>
<div class="heading clearfix"><span class="titlebar">Classroom</span></div>

<div class="table-div">
  <form name="form1" method="post" action="edit/department.php">
    <table class="unitable">
      <thead>
        <tr>
          <th>Room Number</th>
          <th>Capacity</th>
        </tr>
      </thead>
      <tbody>
      <?php

      while($res = mysqli_fetch_array($result)) {
        echo "<tr>";
        echo "<td>".$res['Room_No']."</td>";
        echo "<td>".$res['Capacity']."</td>";
        echo "</tr>";
      }
      ?>
    </tbody>
  </table>
</form>
</div><!--classrooom div end-->

<div style="margin-bottom: 100px;"></div>


<?php
$db=connect_database();
$query="select * from timeslot";
$result= mysqli_query($db, $query);
?>
<div class="heading clearfix"><span class="titlebar">TimeSlot</span></div>

<div class="table-div">
  <form name="form1" method="post" action="edit/department.php">
    <table class="unitable">
      <thead>
        <tr>
          <th>Day</th>
          <th>Start Time</th>
            <th>End Time</th>
        </tr>
      </thead>
      <tbody>
      <?php

      while($res = mysqli_fetch_array($result)) {
        echo "<tr>";
        echo "<td>".$res['DAY']."</td>";
        echo "<td>".$res['S_time']."</td>";
          echo "<td>".$res['E_time']."</td>";
        echo "</tr>";
      }
      ?>
    </tbody>
  </table>
</form>
</div><!--Timeslot div end-->

<div style="margin-bottom: 100px;"></div>


</div><!--content inner end-->
</div>


<?php include 'template-parts/copyright.php'?>
