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
        $year= date("Y");

        $month= date("m");

        if($month>=1 && $month<=5){
            $semester= "Spring";
        }else if($month>=6 && $month<=8){
            $semester= "Summar";
        }else{
            $semester= "Fall";
        }
$db=connect_database();
$query="select * from section as s, faculty as f, timeslot as t, classroom as c where s.FID= f.FID and s.Ts_ID = t.Ts_ID and s.Room_No= c.Room_No and s.semester = '$semester' and s.year='$year'";
$result= mysqli_query($db, $query);
?>
      <div class="heading clearfix"><span class="titlebar">Offered Course List </span></div>

<div class="table-div">
  <form name="form1" method="post" action="edit/department.php">
    <table class="unitable">
      <thead>
        <tr>
          <th>Course</th>
          <th>Section</th>
          <th>Faculty</th>
          <th>Time</th>
          <th>Room No</th>
          <th>Capacity</th>

        </tr>
      </thead>
      <tbody>
      <?php

      while($res = mysqli_fetch_array($result)) {
        echo "<tr>";
        echo "<td>".$res['Crs_ID']."</td>";
        echo "<td>".$res['Sec_No']."</td>";
        echo "<td>".$res['Initial']."</td>";
        echo "<td>".$res['DAY']." ".$res['S_time']."-".$res['E_time']."</td>";
        echo "<td>".$res['Room_No']."</td>";
        echo "<td>".$res['Capacity']."</td>";
      }
      ?>
    </tbody>
  </table>
</form>
</div><!--table div end-->
<div style="margin-bottom: 100px;"></div>
</div><!--content inner end-->
</div>



<?php include 'template-parts/copyright.php'?>
