<!DOCTYPE html>
<?php
	session_start();
	if(!isset($_SESSION['name'])){
		header('Location: ../login/login.php');
	}
	include_once('../db/archlearn_dbconfig.php');
	$db = DbConfig::getConnection();
?>
<html>
	<head>
		<meta charset="UTF-8">
		<title>ArchLearn - Continue Course</title>
		<link href="../css/bootstrapHome.css" rel="stylesheet">
    	<style type="text/css">
      		body {
        		padding-top: 20px;
        		padding-bottom: 60px;
      		}


      		.container {
        		width: auto;
        		
      		}
      		.container .credit {
        		margin: 20px 0;
      		}

      		#wrap {
        		min-height: 100%;
        		height: auto !important;
        		height: 100%;
		        /* Negative indent footer by it's height */
        		margin: 0 auto -60px;
      		}

      		/* Customize the navbar links to be fill the entire space of the .navbar */
      		.navbar .navbar-inner {
      		  padding: 0;
     		}
      		.navbar .nav {
        		margin: 0;
        		display: table;
        		width: 100%;
      		}
      		.navbar .nav li {
        		display: table-cell;
        		width: 1%;
        		float: none;
      		}
      		.navbar .nav li a {
        		font-weight: bold;
        		text-align: center;
        		border-left: 1px solid rgba(255,255,255,.75);
       	 		border-right: 1px solid rgba(0,0,0,.1);
      		}
      		.navbar .nav li:first-child a {
        		border-left: 0;
        		border-radius: 3px 0 0 3px;
      		}
      		.navbar .nav li:last-child a {
        		border-right: 0;
        		border-radius: 0 3px 3px 0;
      		}
    	</style>
    	<link href="../css/bootstrap-responsiveHome.css" rel="stylesheet">
	</head>
	<body>

		<div class="container">
			<div class="masthead">
        	<h3 class="muted">Bienvenid@ <?php echo $_SESSION['name']." ".$_SESSION['last_name'];?>. </h3>
        	<h4 class="muted"> <a href="login/session_manager.php?logout=yes">cerrar sesión</a> </h3>
        	<div class="navbar">
    	      	<div class="navbar-inner">
	    	        <div class="container">
            			<ul class="nav">
                			<li><a href="../home.php">Home</a></li>
                			<li><a href="../info/profile.php">Profile</a></li>
                			<li><a href="new_course.php">Start new course</a></li>
                			<li class="active"><a href="continue.php">Continue course</a></li>
                			<li><a href="../info/records.php">Records</a></li>
                			<li><a href=<?php if(isset($_SESSION['type']) && ($_SESSION['type'] == 3 || $_SESSION['type'] == 2)){ echo "'administrate.php'>";} else {echo "'#'>";}?>Administrate</a></li>
              			</ul>
            		</div>
          		</div>
        	</div><!-- /.navbar -->
    </div>	

	<div id="wrap">

      <!-- Begin page content -->
      <div class="container">
        <div class="page-header">
          <h1>ArchLearn - Courses</h1>
        </div>
        <p class="lead">
		<?php
			if(isset($_SESSION['unit'])){
				echo "You are in the unit ".$_SESSION['unit'];
				echo "<form action='experience_generator.php' name='continue' id='continue' method='POST' class='navbar-form pull-left'>
					<input type='hidden' id='user_id' name='user_id' value='".$_SESSION['id']."'>
					<button type='submit' value='Proceed'class='btn'>Proceed</button></form>";
			}
			else{
				echo "You arent in a course yet. <a href='new_course.php'>Start a new one</a>.";
			}
		?></p>
      </div>
    </div>
		</div>
	</body>
</html>	