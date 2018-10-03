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
$query="select * from course as c, department as d where c.dept_ID = d.Department_ID";
$result= mysqli_query($db, $query);
?>
<?php if($_SESSION['admin-notification']!=null):?>
<div class="message-bar"><div class="message"><?php echo $_SESSION['admin-notification']; $_SESSION['admin-notification']=null;?></div></div>
<?php endif;?>
      <div class="heading clearfix"><span class="titlebar">Course</span><a href="addcourse.php"><span class="addbutton">Add Course</span></a></div>

<div class="table-div">
  <form name="form1" method="post" action="edit/department.php">
    <table class="unitable">
      <thead>
        <tr>
          <th>Course ID</th>
          <th>Course title</th>
          <th>Credit</th>
          <th>Department</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
      <?php

      while($res = mysqli_fetch_array($result)) {
        echo "<tr>";
        echo "<td>".$res['Course_ID']."</td>";
        echo "<td>".$res['Crs_title']."</td>";
        echo "<td>".$res['Credit']."</td>";
        echo "<td>".$res['Dept_Name']."</td>";
        echo "<td><a href=\"editcourse.php?id=$res[Course_ID]\"<span class=\"edit\">EDIT</span></a>  <a href=\"deletecourse.php?id=$res[Course_ID]\"><span class=\"delete\">DELETE</span></a></td>";

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
