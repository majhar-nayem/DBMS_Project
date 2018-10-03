<?php
session_start();
if(!isset($_SESSION['SID'])){

  header("location: index.php");

  exit;
}
?>




<?php include 'template-parts/control-bar.php' ?>
<?php include 'template-parts/logo-bar.php'?>


<div class="content">
  <div class="content-inner">
<?php
      include 'functions.php';
      $db=connect_database();

      $student_id= $_SESSION['SID'];

      $current_year= date("Y");

      $month= date("m");

      $current_semester;

      if($month>=1 && $month<=5){
          $current_semester= "Spring";
      }else if($month>=6 && $month<=8){
          $current_semester= "Summar";
      }else{
          $current_semester= "Fall";
      }


      $query= "select * from advised_course join course on Crs_ID = Course_ID where SID='$student_id' and Semester <> '$current_semester' and year <> '$current_year' ";
      $result= mysqli_query($db, $query);


?>
    <table class="unitable">
      <thead>
        <tr>
          <th>Semester</th>
          <th>Course</th>
          <th>Credit</th>
          <th>Grade</th>

        </tr>
      </thead>
      <tbody>
      <?php

      while($res = mysqli_fetch_array($result)) {
        echo "<tr>";

        echo "<td>".$res['Semester']." ".$res['Year']."</td>";
        echo "<td>".$res['Course_ID']."</td>";
          echo "<td>".$res['Credit']."</td>";
            echo "<td>".$res['Grade']."</td>";
            echo "</tr>";
      }
      ?>
    </tbody>
  </table>
</div><!--table div end-->
</div><!--content inner end-->
</div>


<?php include 'template-parts/copyright.php'?>



<?php include 'template-parts/copyright.php'?>
