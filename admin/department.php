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
$query= "select * from department";
$result= mysqli_query($db, $query);
?>
<div class="heading clearfix"><span class="titlebar">Department</span></div>
<div class="table-div">
  <form name="form1" method="post" action="edit/department.php">
    <table class="unitable">
      <thead>
        <tr>
          <th>ID</th>
          <th>Name</th>
          <th>Chairman</th>

        </tr>
      </thead>
      <tbody>
      <?php

      while($res = mysqli_fetch_array($result)) {
        echo "<tr>";
        echo "<td>".$res['Department_ID']."</td>";
        echo "<td>".$res['Dept_Name']."</td>";
        echo "<td>".$res['Chair_ID']."</td>";
      }
      ?>
    </tbody>
  </table>
</form>
</div><!--table div end-->
</div><!--content inner end-->
</div>


<?php include 'template-parts/copyright.php'?>
