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
		<title>ArchLearn - Administrate</title>
	</head>
	<body>
		Bienvenid@ <?php echo $_SESSION['name']." ".$_SESSION['last_name'];?>.<br>
		<a href="../login/session_manager.php?logout=yes">cerrar sesión</a>
		<h1>Administration</h1>
		Select an Action.<br>
		<ul>
		<?php
			if(isset($_SESSION['type']) && ($_SESSION['type'] == 3 || $_SESSION['type'] == 2)){
				echo "
					<li><a href='add_experience.php'>Add Experience</a></li>
					<li><a href='edit_experience.php'>Edit Experience</a></li>
					<li><a href='delete_experience.php'>Delete Experience</a></li>
				";

			}
			if(isset($_SESSION['type']) && ($_SESSION['type'] == 3)){
				echo "
					<li><a href='manage_user.php'>Manage userse</a></li>
				";
			}
		?>
		</ul>
	</body>
</html>