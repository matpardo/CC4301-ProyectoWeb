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
		<title>ArchLearn - Profile</title>
	</head>
	<body>
		Bienvenid@ <?php echo $_SESSION['name']." ".$_SESSION['last_name'];?>.<br>
		<a href="../login/session_manager.php?logout=yes">cerrar sesión</a>
		<h1>Profile</h1>
		This is your info.<br>
		<?php
			$sql = sprintf("SELECT id, nickname, password, type, name, lastname, idUnit FROM users WHERE id='%s'", 
			$db->real_escape_string($_SESSION['id']));
			$result = $db->query($sql);
			$row = $result->fetch_assoc();
			if(!$row){
				header('Location: login.php?inexistent_user=true');
			}
			echo "UserName: ".$row['nickname'];
		?>
	</body>
</html>