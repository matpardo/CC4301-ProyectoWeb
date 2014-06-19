<!DOCTYPE html>
<?php
	session_start();
	if(isset($_SESSION['name'])){
		header('Location: home.php');
	}
	include_once('../db/archlearn_dbconfig.php');
	$db = DbConfig::getConnection();
?>
<html>
	<head>
		<meta charset="UTF-8">
		<title>ArchLearn - Register</title>
	</head>
	<body>
		<h3>Archlearn - Register</h3>
			<form action="register_submit.php" name="register" id="register" accept-charset="UTF-8" method="POST" enctype="multipart/form-data">
				<fieldset>
					<p>
						<label for="register_user_input"><b>Nickname: </b></label>
						<input type="text" name="register_user_input" id="register_user_input" size="10" maxlength="10">
					</p>
					<p>
						<label for="register_password_input"><b>Password: </b></label>
						<input type="password" name="register_password_input" id="register_password_input" size="10" maxlength="10">
					</p>
					<p>
						<label for="register_first_name_input"><b>Name: </b></label>
						<input type="text" name="register_first_name_input" id="register_first_name_input" size="20" maxlength="59">
					</p>
					<p>
						<label for="register_last_name_input"><b>Last Names: </b></label>
						<input type="text" name="register_last_name_input" id="register_last_name_input" size="20" maxlength="255">
					</p>
					<p>
						<label for="register_email_input"><b>E-mail: </b></label>
						<input type="text" name="register_email_input" id="register_email_input" size="20" maxlength="255">
					</p>
					<p>
						<input type="submit" value="Register">
					</p>
				</fieldset>
			</form>
		<br><br>
	</body>
</html>