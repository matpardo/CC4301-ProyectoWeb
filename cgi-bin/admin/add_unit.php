<!DOCTYPE html>
<?php
	session_start();
	if(!isset($_SESSION['name']) && $_SESSION['type'] == 3){
		header('Location: login/login.php');
	}
	include_once('../db/archlearn_dbconfig.php');
	$db = DbConfig::getConnection();
?>
<html>
	<head>
		<meta charset="UTF-8">
		<title>ArchLearn - Add Unit</title>
		
	</head>
	<body>
		<h3>Bienvenid@ <?php echo $_SESSION['name']." ".$_SESSION['last_name'];?>.</h3>
			<a href="../login/session_manager.php?logout=yes">cerrar sesión</a> </h3>
     
        <h1>ArchLearn - Add Unit</h1>
		<p>Adding a Unit.</p>
        <form action="add_unit_submit.php" name="add_unit" id="add_unit" accept-charset="UTF-8" method="POST" enctype="multipart/form-data">
			<fieldset>
				<p>
					<label for="name_input"><b>Unit Name: </b></label>
					<input type="text" name="name_input" id="name_input" size="10" maxlength="50">
				</p>
				<p>
					<label for="unit_father"><b>SubUnit of?: </b></label>
					<select id="unit_father" name="unit_father">
						<option value="0">None</option>
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
					<input type="submit" value="Add Unit">
				</p>
			</fieldset>
		</form>
	
	</body>
</html>