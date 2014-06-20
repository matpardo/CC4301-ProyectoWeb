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
		<title>ArchLearn - Records</title>
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
                			<li><a href="profile.php">Profile</a></li>
                			<li><a href="../course/new_course.php">Start new course</a></li>
                			<li><a href="../course/continue.php">Continue course</a></li>
                			<li class="active"><a href="records.php">Records</a></li>
                			<li><a href=<?php if(isset($_SESSION['type']) && ($_SESSION['type'] == 3 || $_SESSION['type'] == 2)){ echo "'../admin/administrate.php'>";} else {echo "'#'>";}?>Administrate</a></li>
              			</ul>
            		</div>
          		</div>
        	</div><!-- /.navbar -->
    </div>	

	<div id="wrap">

      <!-- Begin page content -->
      <div class="container">
        <div class="page-header">
          <h1>ArchLearn - Records</h1>
        </div>
        <p class="lead">Here you find the experiences you've done and the califications obtained.</p>
        <hr>
        <?php
			     $sql = sprintf("SELECT idExperience, calification  FROM UserExperience WHERE idUser='%s'", 
			     $db->real_escape_string($_SESSION['id']));
			     $result = $db->query($sql);
           while( $row = $result->fetch_assoc() ){
            $sql2= sprintf("SELECT name FROM experience WHERE idExperience='%s'", $row['idExperience']);
            $result2 = $db->query($sql2);
            $row2 = $result2->fetch_assoc();
              echo "<p> Experience Name: ".$row2['name']." Experience Calification".$row['calification']."</p><br>";
            }
		      ?>
      </div>
    </div>
	</div>
	</body>
</html>