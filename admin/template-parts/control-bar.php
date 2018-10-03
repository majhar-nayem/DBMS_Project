<?php ?>
<!DOCTYPE html>
<html lang="en-US">
<head>
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1" />
<link rel="stylesheet" type="text/css" href="style.css">
<title>NSU RDS</title>
</head>
<body>
		<div class="wrap clearfix">
      <div class="control-bar clearfix">
        <div class="name-bar">
           <span class="icon icon-user-circle-o"></span><span class="name"><?php echo $_SESSION['Fname']." ".$_SESSION['Lname']; ?></name>
        </div>
        <div class="navigation">
          <ul class="nav-list">
      			<li><a href="offered-course-list.php"><span class="icon icon-home"></span><span class="nav-item">Offered Course List</span><span class="nav-corner icon icon-angle-right"></span></a></li>


      			<li><a href="course.php"><span class="icon icon-book"></span><span class="nav-item">Course</span><span class="nav-corner icon icon-angle-right"></span></a></li>
						<li><a href="section.php"><span class="icon icon-book"></span><span class="nav-item">Section</span><span class="nav-corner icon icon-angle-right"></span></a></li>
						<li><a href="resource.php"><span class="icon icon-building"></span><span class="nav-item">Resource</span><span class="nav-corner icon icon-angle-right"></span></a></li>
						<li><a href="setting.php"><span class="icon icon-gear"></span><span class="nav-item">Setting</span><span class="nav-corner icon icon-angle-right"></span></a></li>
            <li><a href="logout.php"><span class="icon icon-sign-out"></span><span class="nav-item">Logout</span><span class="nav-corner icon icon-angle-right"></span></a></li>
      		</ul>
        </div>
				<div class="copyright">
				<!--  <p>Developed by Razib Sikder</p>-->
				</div>
      </div>
      <div class="page clearfix">
