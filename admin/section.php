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

$year= date("Y");

$month= date("m");

if($month>=1 && $month<=5){
    $semester= "Spring";
}else if($month>=6 && $month<=8){
    $semester= "Summar";
}else{
    $semester= "Fall";
}

$query = "select * from section as s, faculty as f, timeslot as t, classroom as c where s.FID= f.FID and s.Ts_ID= t.Ts_ID and s.Room_No=c.Room_No and s.Semester='$semester' and s.Year='$year' order by s.Crs_ID, s.Sec_No";
$result= mysqli_query($db, $query);
?>
<?php if($_SESSION['admin-notification']!=null):?>
<div class="message-bar"><div class="message"><?php echo $_SESSION['admin-notification']; $_SESSION['admin-notification']=null;?></div></div>
<?php endif;?>
      <div class="heading clearfix"><span class="titlebar">Section</span><a href="addsection.php"><span class="addbutton">Add Section</span></a></div>

<div class="table-div">
  <form name="form1" method="post" action="editsection.php">
    <table class="unitable">
      <thead>
        <tr>
          <th>Course ID</th>
          <th>Section No</th>
          <th>Faculty</th>
          <th>TimeSlot</th>
          <th>Room No</th>
          <th>Capacity</th>
          <th>Takes</th>
          <th>Action</th>
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
        echo "<td>".$res['Takes']."</td>";
        echo "<td><a href=\"editsection.php?course=$res[Crs_ID]&sec=$res[Sec_No]\"<span class=\"edit\">EDIT</span></a>  <a href=\"deletesection.php?course=$res[Crs_ID]&sec=$res[Sec_No]\"><span class=\"delete\">DELETE</span></a></td>";

        echo "</tr>";
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
