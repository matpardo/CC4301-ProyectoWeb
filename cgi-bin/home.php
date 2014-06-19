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
		Bienvenid@ <?php echo $_SESSION['name']." ".$_SESSION['last_name'];?>.<br>
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
								echo "<li><a href='info/profile.php'>Profile</a>";
								echo "<li><a href='course/new_course.php'>Start Course</a>";
								echo "<li><a href='course/continue.php'>Continue Course</a>";
								echo "<li><a href='info/history.php'>History</a>";
								if(isset($_SESSION['type']) && $_SESSION['type'] == 1){
									echo "<li><a href='administrate.php'>Administrar</a>";
								}
							?>		
						</ol>
					</div>
				</td>
				<td>
					<b>Hemos inaugurado nuestro sitio!</b>
					Bienvenido a nuestro sitio, le traemos lo mejor de la Tierra Media para planificar su viaje. Saludos
				</td>
			</tr>
		</table>
		<br><br>
	</body>
</html>