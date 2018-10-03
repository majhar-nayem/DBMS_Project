<?php
session_start();

if(!isset($_SESSION['SID'])){

  header("location: index.php");

  exit;

}
?>
<?php
$stdid= $_SESSION['SID'];
include 'functions.php';
        $year= date("Y");

        $month= date("m");
$semester;
        if($month>=1 && $month<=5){
            $semester= "Spring";
        }else if($month>=6 && $month<=8){
            $semester= "Summar";
        }else{
            $semester= "Fall";
        }
$db=connect_database();
$query="select S.Crs_ID,S.Sec_No,F.Initial,T.Day,T.S_time,T.E_time,S.Room_No,S.Takes, C.Capacity from section AS S JOIN faculty AS F ON S.FID=F.FID JOIN timeslot AS T ON S.Ts_ID=T.Ts_ID join classroom as C on S.Room_No=C.Room_No where S.Semester='$semester' AND Year='$year' order by S.Crs_ID, S.Sec_No";
$offeredcl= mysqli_query($db, $query);


$sql = "select A.Crs_ID, A.Sec_No, F.Initial, T.DAY, T.S_time, T.E_time, S.Room_No, C.Credit from advised_course as A, course as C, section as S, faculty as F, timeslot as T where SID='$stdid' and A.Crs_ID = C.Course_ID and A.Sec_No = S.Sec_No and A.Crs_ID = S.Crs_ID and S.FID = F.FID and S.Ts_ID= T.Ts_ID and A.Semester='$semester' and A.Year='$year' and A.Semester= S.Semester and A.Year= S.Year";
$advisedcl= mysqli_query($db, $sql);

?>

<?php include 'template-parts/control-bar.php' ?>
<?php include 'template-parts/logo-bar.php'?>


<div class="content">

<div class="content-inner">


  <div class="advising clearfix">
    <div class="advising-column column-one">
    <div class="advising-heading">Advised Courses</div>
    <div class="advised-course-list">
      <table class="acl">
        <thead>
          <tr>
            <th>#</th>
            <th>Course</th>
            <th>Credit</th>
            <th>Faculty</th>
            <th>Section</th>
            <th>Time</th>
            <th>Room</th>
            <th></th>


          </tr>
        </thead>
        <tbody>
          <?php
          $sr=1;
          while($res = mysqli_fetch_assoc($advisedcl)) {

            echo "<tr>";
            echo "<td>".$sr."</td>";
            echo "<td>".$res['Crs_ID']."</td>";
            echo "<td>".$res['Credit']."</td>";
            echo "<td>".$res['Initial']."</td>";
            echo "<td>".$res['Sec_No']."</td>";
            echo "<td>".$res['DAY']." ".$res['S_time']."-".$res['E_time']."</td>";
            echo "<td>".$res['Room_No']."</td>";
            echo "<td><a href=\"deletecourse.php?course_id=".$res['Crs_ID']."&sec_no=".$res['Sec_No']."\" ><span class=\"icon icon-trash\" onclick='confirm('Are you sure?')' ></span></a></td>";
            $sr++;

          }
          ?>
        </tbody>
      </table>
    </div><!--advised course list end-->



    <?php
    $sql = "select * from advised_course as A, course as C, section as S, faculty as F, timeslot as T where SID='$stdid' and A.Crs_ID = C.Course_ID and A.Sec_No = S.Sec_No and A.Crs_ID = S.Crs_ID and S.FID = F.FID and S.Ts_ID= T.Ts_ID and A.Semester='$semester' and A.Year='$year' and A.Semester= S.Semester and A.Year= S.Year";
    $advisedcl= mysqli_query($db, $sql);
    $advisedcr=0;
    while ($res = mysqli_fetch_array($advisedcl)) {
        $advisedcr+=$res['Credit'];
    }
    ?>

    <?php if($advisedcr>0):?>
    <div class="fees-heading">Fees</div>
    <div class="fees">
      <table class="tfl">
        <tbody>
          <tr>
            <td>Tuition Fees</td>
            <td><?php echo $advisedcr."*5500";?></td>
            <td><?php echo $advisedcr*5500;?></td>
          </tr>
          <tr>
            <td>Student Activity Fee</td>
            <td> </td>
            <td>2000</td>
          </tr>
          <tr>
            <td>Computer Lab Fee</td>
            <td> </td>
            <td>1500</td>
          </tr>
          <tr>
            <td>Library Fee</td>
            <td> </td>
            <td>500</td>
          </tr>
          <tr>
            <td>Total</td>
            <td> </td>
            <td><?php echo $advisedcr*5500+4000; echo " TK.";?></td>
          </tr>
        </tbody>
      </table>
    </div>
  <?php endif;?>

  <div style="margin-bottom: 30px;"></div>
  <?php if($_SESSION['student-notification']!=null): ?>
  <div class="advising-msg"><?php echo $_SESSION['student-notification']; $_SESSION['student-notification']=null; ?></div>
<?php endif;?>


    </div>
    <div class="advising-column column-two">
      <div class="advising-heading">Offered Courses</div>
      <div class="offered-course-list">
        <table class="ocl">
          <?php
          while($res = mysqli_fetch_array($offeredcl)) {
            echo "<tr>";
            echo "<td class=\"tooltip\"><a href=\"savecourse.php?course_id=".$res['Crs_ID']."&sec_no=".$res['Sec_No']."\">".$res['Crs_ID'].".".$res['Sec_No']."<span class=\"faka\">(".$res['Takes']."/".$res['Capacity'].")</span>"."<span class=\"tooltiptext\">".$res['Day']." ".$res['S_time']."-".$res['E_time']."</span></a></td>";
            echo "</tr>";
          }
          ?>
        </table>
    </div>
  </div><!--column-two-->



  </div>
</div>


<?php include 'template-parts/copyright.php'?>
