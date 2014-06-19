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
	</head>
	<body>
		Bienvenid@ <?php echo $_SESSION['name']." ".$_SESSION['last_name'];?>.<br>
		<a href="login/session_manager.php?logout=yes">cerrar sesión</a>
		<h1>ArchLearn - Courses</h1>
		<?php
			if(isset($_SESSION['unit'])){
				echo "You are in the unit ".$_SESSION['unit'];
				echo "<form action='experience_generator.php' name='continue' id='continue' method='POST'>
					<input type='hidden' id='user_id' name='user_id' value='".$_SESSION['id']."'>
					<input type='submit' value='Proceed'></form>";
			}
			else{
				echo "You arent in a course yet. <a href='new_course.php'>Start a new one</a>.";
			}
		?>
	</body>
</html>