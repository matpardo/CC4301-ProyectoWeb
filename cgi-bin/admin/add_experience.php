<!DOCTYPE html>
<?php
	session_start();
	if(!isset($_SESSION['name']) && ($_SESSION['type'] == 2 || $_SESSION['type'] == 3)){
		header('Location: login/login.php');
	}
	include_once('../db/archlearn_dbconfig.php');
	$db = DbConfig::getConnection();
?>
<html>
	<head>
		<meta charset="UTF-8">
		<title>ArchLearn - Add Experience</title>
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
                			<li class="active"><a href="new_course.php">Start new course</a></li>
                			<li><a href="continue.php">Continue course</a></li>
                			<li><a href="../info/records.php">Records</a></li>
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
          <h1>ArchLearn - Experience</h1>
        </div>
        <p class="lead">Add a experience.</p>
        	<form action="add_experience_submit.php" name="add_experience" id="add_experience" accept-charset="UTF-8" method="POST" enctype="multipart/form-data" class='navbar-form pull-left'>
			<fieldset>
				<p>
					<label for="name_input"><b>Experience Name: </b></label>
					<input type="text" name="name_input" id="name_input" size="10" maxlength="50" class="span2">
				</p>
				<p>
					<label for="eval_type"><b>Experience Type: </b></label>
					<select id="eval_type" name="eval_type">
					<?php
						$sql = sprintf("SELECT idEvaluation, evaluationName FROM evaluationtype ORDER BY evaluationName");
						$result = $db->query($sql);
						while( $row = $result->fetch_assoc() ){
							echo "<option value=".$row['idEvaluation'].">".$row['evaluationName']."</option>";
						}
					?>
					</select>
				</p>
				<p>
					<label for="src_type"><b>Resource Type: </b></label>
					<select id="src_type" name="src_type">
					<?php
						$sql = sprintf("SELECT id, resourceName FROM resourcetype ORDER BY resourceName");
						$result = $db->query($sql);
						while( $row = $result->fetch_assoc() ){
							echo "<option value=".$row['id'].">".$row['resourceName']."</option>";
						}
					?>
					</select>
				</p>
				<p>
					<label for="source"><b>URL Resource: </b></label>
					<input type="text" name="source" id="source" size="10" maxlength="11" class="span2">
				</p>
				<p>
					<label for="experience_father"><b>SubExp of?: </b></label>
					<select id="experience_father" name="experience_father">
						<opton value="0">None</option>
					<?php
						$sql = sprintf("SELECT idExperience, name FROM experience ORDER BY name");
						$result = $db->query($sql);
						while( $row = $result->fetch_assoc() ){
							echo "<option value=".$row['idExperience'].">".$row['name']."</option>";
						}
					?>
					</select>
				</p>
				<p>
					<label for="max_calification"><b>Experience Name: </b></label>
					<input type="text" name="max_calification" id="max_calification" size="1" maxlength="11" class="span2">
				</p>
				<p>
					<button type='submit' value='Add Experience' class='btn'>Add Experience</button>
				</p>
			</fieldset>
		</form>
       
      </div>
    </div>
		</div>


        
	
	</body>
</html>