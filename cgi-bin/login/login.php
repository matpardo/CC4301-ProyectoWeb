<!DOCTYPE html>
<?php
 session_start();
?>
<html>
	<head>
		<meta charset="UTF-8">
		<title>ArchLearn - Login</title>
	</head>
	<body>

		<?php
			//Si la sesión está activa, enviar a menú principal
			if(isset($_SESSION['name'])){
				header('Location: home.php');
			}
			if($_GET){
				if(isset($_GET['no_user']) && $_GET['no_user']==true){
					echo "Invalid Login.<br>
						You should write your username.<br>
						Try Again.<br>";
				}
				if(isset($_GET['no_pass']) && $_GET['no_pass']==true){
					echo "Invalid Login.<br>
						You should write your password.<br>
						Try Again.<br>";
				}
				if(isset($_GET['inexistent_user']) && $_GET['inexistent_user']==true){
					echo "Invalid Login.<br>
						User not found.<br>
						Try Again.<br>";
				}
				if(isset($_GET['invalid_pass']) && $_GET['invalid_pass']==true){
					echo "Invalid Login.<br>
						Incorrect Password.<br>
						Try Again.<br>";
				}
				//Si se ha ingresado mal datos, preguntar nuevamente datos
				if(isset($_GET['incorrect']) && $_GET['incorrect']==true){
					echo "Invalid Login.<br> Try Again.<br>";
				}
			}
		?>

		<link class="cssdeck" rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/2.3.1/css/bootstrap.min.css">
		<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/2.3.1/css/bootstrap-responsive.min.css" class="cssdeck">

		<div class="" id="loginModal">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
			<h3>Have an Account?</h3>
		</div>
		<div class="modal-body">
			<div class="well">
				<ul class="nav nav-tabs">
					<li class="active"><a href="#login" data-toggle="tab">Login</a></li>
					<li><a href="#create" data-toggle="tab">Create Account</a></li>
				</ul>
				<div id="myTabContent" class="tab-content">
					<div class="tab-pane active in" id="login">
						<form  action="session_manager.php" name="login" id="login" accept-charset="UTF-8" method="POST" enctype="multipart/form-data" class="form-horizontal">
							<fieldset>
								<div id="legend">
									<legend class="">Login</legend>
								</div>    
								<div class="control-group">
									<!-- Username -->
									<label class="control-label"  for="username">Username</label>
									<div class="controls">
										<input name="login_user_input" id="login_user_input" size="10" maxlength="10" type="text" placeholder="" class="input-xlarge">
									</div>
								</div>
							
								<div class="control-group">
									<!-- Password-->
									<label class="control-label" for="password">Password</label>
									<div class="controls">
										<input  type="password" name="login_password_input" id="login_password_input" size="10" maxlength="20" placeholder="" class="input-xlarge">
									</div>
								</div>
							
							
								<div class="control-group">
									<!-- Button -->
									<div class="controls">
										<button class="btn btn-success">Login</button>
									</div>
								</div>
							</fieldset>
						</form>                
					</div>
					<div class="tab-pane fade" id="create">
						<form id="tab">
							<label>Username</label>
							<input type="text" value="" class="input-xlarge" name="">
							<label>Password</label>
							<input type="text" value="" class="input-xlarge">
							<label>First Name</label>
							<input type="text" value="" class="input-xlarge">
							<label>Last Name</label>
							<input type="text" value="" class="input-xlarge">
							<label>Email</label>
							<input type="text" value="" class="input-xlarge">
							<div>
								<button class="btn btn-primary">Create Account</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>

		<script class="cssdeck" src="//cdnjs.cloudflare.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
		<script class="cssdeck" src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/2.3.1/js/bootstrap.min.js"></script>
	</body>
</html>