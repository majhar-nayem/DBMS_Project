<?php
session_start();

if(!isset($_SESSION['Fname'])){

  header("location: index.php");

  exit;

}
session_unset();
session_destroy();

header("location:index.php");

?>
