<?php


function connect_database(){
   $db = mysqli_connect("localhost","root","","rds")
			or die("cannot connected");
      return $db;
}

function session_tracker(){

}

function login_checker(){
  if(isset($_POST['Submit'])) {
  		$user_name = $_POST ['user_name'];
  		$password = $_POST['password'];

  		if(empty($user_name) || empty($password)) {

    		if(empty($user_name)) {
    			echo "<font color='red'>User Name field is empty.</font><br/>";
    		}

    		if(empty($password)) {
    			echo "<font color='red'>Password field is empty.</font><br/>";
    		}
  		//link to the previous page
  		echo "<br/><a href='javascript:self.history.back();'>Go Back</a>";
  	} else {

        connect_database();


        $user_exist = "select count(user_name) from admin  where user_name= $user_name";
        $user_exist= mysqli_query( $db, $user_exist);


        if($user_exist==0){
          echo "<font color='red'>User does not exist.</font><br/>";
        }else{

          $user_data== "select user_name, password from admin where user_name= $user_name";
          $user_data= mysqli_query( $db, $user_data);


          while($res = mysqli_fetch_array($user_data))
          {
          	$db_username = $res['user_name'];
          	$db_password = $res['Password'];
          }

          if($password == $db_password){

            header("Location:http://localhost/lab311/home.php");
            exit;
          }
        }
  		}
  	}

}

function logout(){
  session_unset();
  session_destroy();
}

function edit(){


}



?>
