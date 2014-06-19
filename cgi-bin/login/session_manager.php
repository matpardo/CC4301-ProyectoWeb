<!DOCTYPE html>
<?php
	session_start();
	include_once('archlearn_dbconfig.php');
	$db = DbConfig::getConnection();
	if(!isset($_SESSION['name']) && $_POST){
	
		if(isset($_POST['login_user_input']) && 0 < strlen($_POST['login_user_input'])){
			if(isset($_POST['login_password_input']) && 0 < strlen($_POST['login_password_input'])){
			
				$sql = sprintf("SELECT id, username, password, user_type_id, first_name, last_name FROM users WHERE username='%s'", 
					$db->real_escape_string($_POST['login_user_input']));
				$result = $db->query($sql);
				$row = $result->fetch_assoc();
				if(!$row){
					header('Location: login.php?inexistent_user=true');
				}
			
				if($_POST['login_password_input'] == $row['password']){
			
					$_SESSION['name'] = $row['username'];
					$_SESSION['user_type_id'] = $row['user_type_id'];
					$_SESSION['id'] = $row['id'];
					$_SESSION['real_name'] = $row['first_name']." ".$row['last_name'];
			
					echo "Session started! Welcome: ".$_SESSION['name']."<br>Redirecting...";
				} else {
					header('Location: login.php?invalid_pass=true');
				}
			} else {
				header('Location: login.php?no_pass=true');
			}
		} else {
			header('Location: login.php?no_user=true');
		}
		//Si han sido incorrectos los datos preguntar otra vez
		//header('Location: login.php?incorrect=true');
	}
	//Control Cierre: Si se ha iniciado sesión y se ha recibido en el GET, logout=yes; cerrar la sesión.
	if(isset($_SESSION['name']) && $_GET){
		if(isset($_GET['logout']) && $_GET['logout']=="yes"){
			session_destroy();
			echo "Session Destroyed!<br>Redirecting...";
		}
	}
?>
<html>
	<head>
		<meta charset="UTF-8">
		<title>TravelSyst - SessionManagement</title>
		<script type="text/javascript">
			window.location="login.php";
		</script>
	</head>
	<body>
	</body>
</html>