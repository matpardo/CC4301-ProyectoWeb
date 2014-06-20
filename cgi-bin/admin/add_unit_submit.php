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
		
		$unitName = $_POST['name_input'];
		$idFather = $_POST['unit_father'];
		
			$sql = sprintf("INSERT INTO Unit (unitName, idFather) 
							VALUES ('%s', '%d')",
							$db->real_escape_string($unitName), 
							$db->real_escape_string($idFather));
							
			if(!$db->query($sql)){ //Se ejecuta la query y se verifica si fue exitosa
				echo "Table insert failed: (" . $db->errno . ") " . $db->error ."<br/>";
				return;
			} else{
				$register_flag = TRUE;
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
										Insertion unit was succesfull!
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
										Insertion unit has failed!
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