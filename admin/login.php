<?php



      $db = mysqli_connect("localhost","root","","rds")
      or die("cannot connected");

      session_start();

      if($_SERVER["REQUEST_METHOD"] == "POST") {
         // username and password sent from form

          $myusername = $_POST ['user_name'];
          $mypassword = $_POST['password'];


         $sql = "SELECT * FROM admin WHERE user_name = '$myusername' and password = '$mypassword'";
         $result = mysqli_query($db, $sql);
         $count = mysqli_num_rows($result);


         if($count==1) {
           while($res = mysqli_fetch_array($result)) {

              		$_SESSION['ID']=$res['ID'];
              		$_SESSION['username']=$res['user_name'];
              	  $_SESSION['Fname']=$res['Fname'];
              		$_SESSION['Lname']=$res['Lname'];
                  $_SESSION['admin-notification']=null;

              }
           //$_SESSION['user_name'] = $myusername;
            header("location: offered-course-list.php");
         }else {
            echo "Your User Name or Password is invalid";
         }
      }



  ?>
