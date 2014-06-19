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
		<title>ArchLearn - New Course</title>
	</head>
	<body>
		Bienvenid@ <?php echo $_SESSION['name']." ".$_SESSION['last_name'];?>.<br>
		<a href="login/session_manager.php?logout=yes">cerrar sesión</a>
		<h1>ArchLearn - Courses</h1>
		<?php
			if(isset($_SESSION['unit'])){
				echo "You are in the unit ".$_SESSION['unit'];
				echo "You want to start a new one? <a href='new_course_unit.php'>YES!</a>";
			}
			else{
				echo "REDIRECT TO <a href='new_course_unit.php'";
				//header('Location: new_course_unit.php');
			}
		?>
	</body>
</html>