<?php
session_start();
if(!isset($_SESSION['SID'])){

  header("location: index.php");

  exit;
}
?>

<?php
  include 'functions.php';
  $db=connect_database();

  $student_id= $_SESSION['SID'];
  $query= "select * from student where SID='$student_id'";
  $result= mysqli_query($db, $query);


  $sid;
  $name;
  $dept_id;
  $degree;
  $credit;
  $dept_name;

  while($res = mysqli_fetch_array($result)) {
    $sid= $res['SID'];
    $name= $res['Fname']." ".$res['Lname'];
    $dept_id= $res['Dept_ID'];
    $degree= $res['Degree'];
    $credit= $res['Total_Cr'];
  }

  $dept_name= student_dept_name($dept_id);

?>


<?php include 'template-parts/control-bar.php' ?>
<?php include 'template-parts/logo-bar.php'?>


<div class="content">
  <div class="content-inner">

    <div class="heading clearfix"><span class="titlebar">Info</span>
    </div>

    <div class="table-div">
        <table class="unitable">
          <thead>
            <tr>
              <th>Name</th>
              <th>ID</th>
              <th>Department</th>
              <th>Degree</th>
              <th>Credit</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td><?php echo $name; ?></td>
              <td><?php echo $sid; ?></td>
              <td><?php echo $dept_name; ?></td>
              <td><?php echo $degree; ?></td>
              <td><?php echo $credit; ?></td>
            </tr>
        </tbody>
      </table>
</div><!--table div end-->
</div><!--content inner end-->
</div>


<?php include 'template-parts/copyright.php'?>
