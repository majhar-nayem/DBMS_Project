<?php

      session_start();

      if(isset($_SESSION['SID'])){

        header("location: home.php");

        exit;

      }




      if($_SERVER["REQUEST_METHOD"] == "POST") {
          include 'functions.php';
          $db= connect_database();

          $sid = $_POST ['sid'];
          $password = $_POST['password'];

          if(empty($sid) || empty($password)){
            echo "<div class=\"message-bar\"><div class=\"message\">Please Input both Student ID and Password.</div></div>";
          }



         $sql = "SELECT * FROM student WHERE SID = '$sid' and Password = '$password'";
         $result = mysqli_query($db, $sql);
         $count = mysqli_num_rows($result);


         if($count==1) {
           while($res = mysqli_fetch_array($result)) {
              		$_SESSION['SID']=$res['SID'];
                  $_SESSION['SFname']=$res['Fname'];
                 $_SESSION['SLname']=$res['Lname'];
                 $_SESSION['student-notification']=null;
              }

            header("location: advising.php");
         }else {
              echo "<div class=\"message-bar\"><div class=\"message\">Your Student ID or Password is invalid!</div></div>";
         }
      }else{
        header("location: index.php");
      }
?>
