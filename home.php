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


</div><!--content inner end-->
</div>


<?php include 'template-parts/copyright.php'?>
