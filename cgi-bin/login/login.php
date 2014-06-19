<!DOCTYPE html>
<?php
 session_start();
?>
<html>
	<head>
		<meta charset="UTF-8">
		<title>ArchLearn - Login</title>
	</head>
	<body>
		<?php
			//Si la sesión está activa, enviar a menú principal
			if(isset($_SESSION['name'])){
				header('Location: home.php');
			}
			if($_GET){
				if(isset($_GET['no_user']) && $_GET['no_user']==true){
					echo "Invalid Login.<br>
						You should write your username.<br>
						Try Again.<br>";
				}
				if(isset($_GET['no_pass']) && $_GET['no_pass']==true){
					echo "Invalid Login.<br>
						You should write your password.<br>
						Try Again.<br>";
				}
				if(isset($_GET['inexistent_user']) && $_GET['inexistent_user']==true){
					echo "Invalid Login.<br>
						User not found.<br>
						Try Again.<br>";
				}
				if(isset($_GET['invalid_pass']) && $_GET['invalid_pass']==true){
					echo "Invalid Login.<br>
						Incorrect Password.<br>
						Try Again.<br>";
				}
				//Si se ha ingresado mal datos, preguntar nuevamente datos
				if(isset($_GET['incorrect']) && $_GET['incorrect']==true){
					echo "Invalid Login.<br> Try Again.<br>";
				}
			}
		?>
		<div id="session_forms">
			<h2>Welcome to ArchLearn</h2>
		<div id="login_div">
			Log In:<br>
			<form action="session_manager.php" name="login" id="login" accept-charset="UTF-8" method="POST" enctype="multipart/form-data">
				<fieldset>
					<p>
						<label for="login_user_input"><b>Username: </b></label>
						<input type="text" name="login_user_input" id="login_user_input" size="10" maxlength="20">
					</p>
					<p>
						<label for="login_password_input"><b>Contraseña: </b></label>
						<input type="password" name="login_password_input" id="login_password_input" size="10" maxlength="20">
					</p>
					<p>
						<input type="submit" value="Log In">
					</p>
				</fieldset>
			</form>
		</div>
		new account? <a href="register.php">Sign Up</a>.
	</body>
</html>