<?php

function connect_database(){
   $db = mysqli_connect("localhost","root","","rds")
			or die("cannot connected");
      return $db;
}

function session_tracker(){

}

function login_checker(){

}



function student_dept_name($dept_id){

  $db=connect_database();


  $query="select Dept_Name from department where department_id='$dept_id'";

  $result= mysqli_query($db, $query);

  $dept_name='';

  while($res = mysqli_fetch_array($result)) {
    $dept_name= $res['Dept_Name'];
  }
  return $dept_name;

}





?>
