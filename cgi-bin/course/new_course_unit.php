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
		<title>ArchLearn - Select Unit</title>
	</head>
	<body>
		Bienvenid@ <?php echo $_SESSION['name']." ".$_SESSION['last_name'];?>.<br>
		<a href="login/session_manager.php?logout=yes">cerrar sesión</a>
		<h1>ArchLearn - New Unit</h1>
		Select a Unit.
		<form action="new_course_submit.php" name="new_course" id="new_course" accept-charset="UTF-8" method="POST" enctype="multipart/form-data">
			<p>
				<label for="new_unit"><b>Unidad: </b></label>
					<select id="new_unit" name="new_unit">
					<?php
						$sql = sprintf("SELECT id, unitName FROM unit ORDER BY unitName");
						$result = $db->query($sql);
						while( $row = $result->fetch_assoc() ){
							echo "<option value=".$row['id'].">".$row['unitName']."</option>";
						}
					?>
					</select>
			</p>
			<p>
				<input type="submit" value="Start!">
			</p>
		</form>
	</body>
</html>