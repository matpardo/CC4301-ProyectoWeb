<!DOCTYPE html>
<?php
	session_start();
	if(!isset($_SESSION['name'])){
		header('Location: ../home.php');
	}
	include_once('../db/archlearn_dbconfig.php');
	$db = DbConfig::getConnection();
?>
<html>
	<head>
		<meta charset="UTF-8">
		<title>ArchLearn - ProcessUnit</title>
	</head>
	<body>
<?php
	if($_POST){

		$user_id = $_SESSION['id'];
		$unit_id = NULL;


		if(isset($_POST['new_unit']) && is_numeric($_POST['new_unit']) && strlen($_POST['new_unit']) <= 11){
			$unit_id = htmlspecialchars($_POST['new_unit']);
		} else {
			echo "Error: Invalid unit id.<br>";
		}

		if($user_id != NULL 
			&& $unit_id != NULL 
			){
				$sql = sprintf("UPDATE users 
								SET idUnit = %d WHERE id=%d;",
								$db->real_escape_string($unit_id), $db->real_escape_string($user_id));
				if(!$db->query($sql)){ //Se ejecuta la query y se verifica si fue exitosa
					echo "Table edit failed: (" . $db->errno . ") " . $db->error ."<br/>";
					return;
				}
				$_SESSION['unit']=$unit_id;
				echo "REDIRECT New Unit added <a href='continue.php'>OK!</a>";
		}
	}
		?>
	</body>
</html>