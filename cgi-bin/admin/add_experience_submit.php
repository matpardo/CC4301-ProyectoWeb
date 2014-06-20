<!DOCTYPE html>
<?php
	session_start();
	if(isset($_SESSION['name'])){
		header('Location: ../home.php');
	}
	include_once('../db/archlearn_dbconfig.php');
	$db = DbConfig::getConnection();
?>
<html>
	<head>
		<meta charset="UTF-8">
		<title>TravelSyst - Procesar Submit Unit</title>
	</head>
	<body>
<?php
	if($_POST){
		
		$name = $_POST['name_input'];
		$idEvaluation = $_POST['eval_type'];
		$idResource =$_POST['src_type'];
		$source = $_SESSION['source'];
		$idNextExperience=$_POST['experience_father'];
		$idPublisher=$_SESSION['id'];
		
			$sql = sprintf("INSERT INTO experience (name, idExperience, idResource, idNextExperience, idPublisher) 
							VALUES ('%s', '%d')",
							$db->real_escape_string($name), 
							$db->real_escape_string($idEvaluation),
							$db->real_escape_string($idResource),
							$db->real_escape_string($idNextExperience),
							$db->real_escape_string($idPublisher)); 
							
			if(!$db->query($sql)){ //Se ejecuta la query y se verifica si fue exitosa
				echo "Table insert failed: (" . $db->errno . ") " . $db->error ."<br/>";
				return;
			} else{
				$register_flag = TRUE;
			}



			$sql2 = sprintf("SELECT idExperience FROM experience ORDER BY idExperience DESC LIMIT 1");
			$result = $db->query($sql);
			$row = $result->fetch_assoc();
			$idExp = $row['idExperience'];

			if ($idResource == 1){
				$sql = sprintf("INSERT INTO resourceVideo (idExperience, link) 
							VALUES ('%s', '%s')",
							$db->real_escape_string($idExp), 
							$db->real_escape_string($source)); 
			
			if(!$db->query($sql)){ //Se ejecuta la query y se verifica si fue exitosa
				echo "Table insert failed: (" . $db->errno . ") " . $db->error ."<br/>";
				return;
			} else{
				$register_flag = TRUE;
			}}else {
				if ($idResource == 2) {
						$sql = sprintf("INSERT INTO resourceImage (idExperience, link) 
							VALUES ('%s', '%s')",
							$db->real_escape_string($idExp), 
							$db->real_escape_string($source)); 
			
			if(!$db->query($sql)){ //Se ejecuta la query y se verifica si fue exitosa
				echo "Table insert failed: (" . $db->errno . ") " . $db->error ."<br/>";
				return;
			} else{
				$register_flag = TRUE;
			}
				} else {

						$sql = sprintf("INSERT INTO resourceFile (idExperience, link) 
							VALUES ('%s', '%s')",
							$db->real_escape_string($idExp), 
							$db->real_escape_string($source)); 
			
			if(!$db->query($sql)){ //Se ejecuta la query y se verifica si fue exitosa
				echo "Table insert failed: (" . $db->errno . ") " . $db->error ."<br/>";
				return;
			} else{
				$register_flag = TRUE;
			}
				}
			}
		
	}

			if($register_flag){
				echo " 
				<head>
					<link href='css/bootstrap.min.css' rel='stylesheet' media='screen'>
				</head>
				<body>
				 <script src='js/bootstrap.min.js'></script>
				<div class='container'>
							<div class='row clearfix'>
								<div class='col-md-12 column'>
									<div class='jumbotron'>
									<h1>
										Insertion experience was succesfull!
									</h1>
									<p>
										<a href='administrate.php'>Go back to administrate.</a>
									</p>
									</div>
								</div>
							</div>
						</div>
				</body>";
			} else {
				echo "<head>
					<link href='css/bootstrap.min.css' rel='stylesheet' media='screen'>
				</head>
				<body>
				 <script src='js/bootstrap.min.js'></script>
				<div class='container'>
							<div class='row clearfix'>
								<div class='col-md-12 column'>
									<div class='jumbotron'>
									<h1>
										Insertion experience has failed!
									</h1>
									<p>
										<a href='administrate.php'>Go back to administrate.</a>
									</p>
									</div>
								</div>
							</div>
						</div>
				</body>";
			}
		?>
	</body>
</html>