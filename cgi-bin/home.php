<!DOCTYPE html>
<?php
	session_start();
	if(!isset($_SESSION['name'])){
		header('Location: login/login.php');
	}
	include_once('db/archlearn_dbconfig.php');
	$db = DbConfig::getConnection();
?>
<html>
	<head>
		<meta charset="UTF-8">
		<title>ArchLearn - Home</title>
	</head>
	<body>
		Bienvenid@ <?php echo $_SESSION['name'];?>.<br>
		<a href="login/session_manager.php?logout=yes">cerrar sesión</a>
		<h1>TravelSyst</h1>
		<table border='1' width='800'>
			<tr>
				<td width='200'>
					<h2>Menú</h2>
				</td>
				<td>
					<h2>Novedades</h2>
				</td>
			</tr>
			<tr>
				<td>
					<div class="menu">
						<ol>
							<?php
								$sql = sprintf("SELECT id, name FROM element_types ORDER BY id");
								$result = $db->query($sql);
								while( $row = $result->fetch_assoc() ){
									echo "<li><a href='section.php?section=".$row['id']."'>".$row['name']."</a>";
								}
								if(isset($_SESSION['user_type_id']) && $_SESSION['user_type_id'] == 1){
									echo "<li><a href='administrate.php'>Administrar</a>";
								}
							?>		
						</ol>
					</div>
				</td>
				<td>
					<b>Hemos inaugurado nuestro sitio!</b>
					<br><img src="../src/img/gandalf.jpg"><br><br>
					Bienvenido a nuestro sitio, le traemos lo mejor de la Tierra Media para planificar su viaje. Saludos
				</td>
			</tr>
		</table>
		<br><br>
	</body>
</html>