<?php
include 'admin-functions.php';
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
    <span class="login-title"><p>Admin Login</p></span>
      <form class="login-form" method= "post" action="login.php">
        <input name="user_name" placeholder="User Name" type="text" maxlength="25">
        <input name="password" placeholder="Password" type="password" maxlength="60">
        <button>LOGIN</button>
      </form>
    </div>
  </div>
</body>
</html>
