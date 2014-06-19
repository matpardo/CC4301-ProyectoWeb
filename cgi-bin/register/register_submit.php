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
		<title>TravelSyst - Procesar Registro</title>
	</head>
	<body>
<?php
	if($_POST){
		// Parámetros del POST para addmaster.php
		$register_user = NULL;
		$register_password = NULL;
		$register_first_name = NULL;
		$register_last_name = NULL;
		$register_email = NULL;
		$register_type = 1; //1 Is Student Type
		$register_flag = FALSE; //Flag para ver si el registro es correcto.
		$email_pattern = '/^[-0-9a-zA-Z.+_]+@[-0-9a-zA-Z.+_]+\.[a-zA-Z]{2,4}$/';
		//Fuente de la ER de mail: http://blog.trojanhunter.com/2012/09/26/the-best-regex-to-validate-an-email-address/
	
		//Verificación correctitud del usuario (register_user_input)
		if(isset($_POST['register_user_input']) && strlen($_POST['register_user_input'])<= 10 && 0 < strlen($_POST['register_user_input'])){
			$sql = sprintf("SELECT nickname FROM users WHERE nickname='%s'", $db->real_escape_string($_POST['register_user_input']));
			$result = $db->query($sql);
			$exist = FALSE;
			while($row = $result->fetch_assoc()){
				$exist = TRUE;
			}
			if(!$exist){
				$register_user = htmlspecialchars($_POST['register_user_input']); 
			} else {
				echo "Error: user already exists.<br>";
			}
		} else {
			echo "Error: invalid user.<br>";
		}
		//Verificación correctitud del password (register_password_input)
		if(isset($_POST['register_password_input']) && strlen($_POST['register_password_input']) > 0 && strlen($_POST['register_password_input']) <= 10){
			$register_password = htmlspecialchars($_POST['register_password_input']);
		} else {
			echo "Error: invalid password.<br>";
		}
		//Verificación correctitud del Nombre (register_first_name_input)
		if(isset($_POST['register_first_name_input']) && strlen($_POST['register_first_name_input']) > 0 && strlen($_POST['register_first_name_input']) <= 255){
			$register_first_name = htmlspecialchars($_POST['register_first_name_input']);
		} else {
			echo "Error: Invalid name.<br>";
		}
		//Verificación correctitud del Apellido (register_last_name_input)
		if(isset($_POST['register_last_name_input']) && strlen($_POST['register_last_name_input']) > 0 && strlen($_POST['register_last_name_input']) <= 255){
			$register_last_name = htmlspecialchars($_POST['register_last_name_input']);
		} else {
			echo "Error: Apellido inválido.<br>";
		}
		//Verificación de correctitud del mail ($register_email_input)
		if(isset($_POST['register_email_input']) && preg_match($email_pattern, $_POST['register_email_input'])){
			$register_email = htmlspecialchars($_POST['register_email_input']); 
		} else {
			echo "Error: Mail inválido.<br>";
		}
		if($register_user != NULL 
			&& $register_password != NULL 
			&& $register_first_name != NULL 
			&& $register_last_name != NULL 
			&& $register_email != NULL
			){
			$sql = sprintf("INSERT INTO users (nickname, password, type,
							name, lastname, email) 
							VALUES ('%s', '%s', %d, '%s', '%s', '%s')",
							$db->real_escape_string($register_user), 
							$db->real_escape_string($register_password), 
							$db->real_escape_string($register_type),
							$db->real_escape_string($register_first_name),
							$db->real_escape_string($register_last_name),
							$db->real_escape_string($register_email));
			if(!$db->query($sql)){ //Se ejecuta la query y se verifica si fue exitosa
				echo "Table insert failed: (" . $db->errno . ") " . $db->error ."<br/>";
				return;
			} else{
				$register_flag = TRUE;
			}
		}
	}

			if($register_flag){
				echo "<br>El registro se ha realizado exitosamente.<br>
				<a href='../login/login.php'>Volver a login</a>.";
			} else {
				echo "<br>El registro ha fallado.<br>
				<a href='register.php'>Volver a registro</a>.<br>
				<a href='../login/login.php'>Volver a login</a>.";
			}
		?>
	</body>
</html>