<?php

session_start();

if(isset($_SESSION['SID'])){

  header("location: advising.php");

  exit;

}

?>
<!DOCTYPE html>
<html lang="en-US">
<head>
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1" />
<link rel="stylesheet" type="text/css" href="css/login-style.css">
<title>NSU RDS</title>
</head>
<body class="login-body">
  <div class="login-page">
    <div class="form">
    <span class="login-title"><p>Student Login</p></span>
      <form class="login-form" method= "post" action="login.php">
        <input name="sid" placeholder="Student ID" type="text" maxlength="10">
        <input name="password" placeholder="Password" type="password" maxlength="60">
        <button>LOGIN</button>
      </form>
    </div>
  </div>
</body>
</html>
