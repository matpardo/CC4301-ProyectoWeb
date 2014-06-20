<!DOCTYPE html>
<?php
	session_start();
	if(!isset($_SESSION['name']) && ($_SESSION['type'] == 2 || $_SESSION['type'] == 3)){
		header('Location: login/login.php');
	}
	include_once('../db/archlearn_dbconfig.php');
	$db = DbConfig::getConnection();
?>
<html>
	<head>
		<meta charset="UTF-8">
		<title>ArchLearn - Add Experience</title>
		
	</head>
	<body>
		<h3>Bienvenid@ <?php echo $_SESSION['name']." ".$_SESSION['last_name'];?>.</h3>
			<a href="../login/session_manager.php?logout=yes">cerrar sesión</a> </h3>
     
        <h1>ArchLearn - Add Experience</h1>
		<p>Adding a Experience.</p>
        <form action="add_experience_submit.php" name="add_experience" id="add_experience" accept-charset="UTF-8" method="POST" enctype="multipart/form-data">
			<fieldset>
				<p>
					<label for="name_input"><b>Experience Name: </b></label>
					<input type="text" name="name_input" id="name_input" size="10" maxlength="50">
				</p>
				<p>
					<label for="eval_type"><b>Experience Type: </b></label>
					<select id="eval_type" name="eval_type">
					<?php
						$sql = sprintf("SELECT idEvaluation, evaluationName FROM evaluationtype ORDER BY evaluationName");
						$result = $db->query($sql);
						while( $row = $result->fetch_assoc() ){
							echo "<option value=".$row['idEvaluation'].">".$row['evaluationName']."</option>";
						}
					?>
					</select>
				</p>
				<p>
					<label for="src_type"><b>Resource Type: </b></label>
					<select id="src_type" name="src_type">
					<?php
						$sql = sprintf("SELECT id, resourceName FROM resourcetype ORDER BY resourceName");
						$result = $db->query($sql);
						while( $row = $result->fetch_assoc() ){
							echo "<option value=".$row['id'].">".$row['resourceName']."</option>";
						}
					?>
					</select>
				</p>
				<p>
					<label for="source"><b>URL Resource: </b></label>
					<input type="text" name="source" id="source" size="10" maxlength="11">
				</p>
				<p>
					<label for="experience_father"><b>SubExp of?: </b></label>
					<select id="experience_father" name="experience_father">
						<opton value="0">None</option>
					<?php
						$sql = sprintf("SELECT idExperience, name FROM experience ORDER BY name");
						$result = $db->query($sql);
						while( $row = $result->fetch_assoc() ){
							echo "<option value=".$row['idExperience'].">".$row['name']."</option>";
						}
					?>
					</select>
				</p>
				<p>
					<label for="max_calification"><b>Experience Name: </b></label>
					<input type="text" name="max_calification" id="max_calification" size="1" maxlength="11">
				</p>
				<p>
					<input type="submit" value="Add Experience">
				</p>
			</fieldset>
		</form>
	
	</body>
</html>