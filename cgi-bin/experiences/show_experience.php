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
		<title>ArchLearn - Profile</title>
				<link href="../css/bootstrapHome.css" rel="stylesheet">
    	<style type="text/css">
      		body {
        		padding-top: 20px;
        		padding-bottom: 60px;
      		}


      		.container {
        		width: auto;
        		
      		}
      		.container .credit {
        		margin: 20px 0;
      		}

      		#wrap {
        		min-height: 100%;
        		height: auto !important;
        		height: 100%;
		        /* Negative indent footer by it's height */
        		margin: 0 auto -60px;
      		}

      		/* Customize the navbar links to be fill the entire space of the .navbar */
      		.navbar .navbar-inner {
      		  padding: 0;
     		}
      		.navbar .nav {
        		margin: 0;
        		display: table;
        		width: 100%;
      		}
      		.navbar .nav li {
        		display: table-cell;
        		width: 1%;
        		float: none;
      		}
      		.navbar .nav li a {
        		font-weight: bold;
        		text-align: center;
        		border-left: 1px solid rgba(255,255,255,.75);
       	 		border-right: 1px solid rgba(0,0,0,.1);
      		}
      		.navbar .nav li:first-child a {
        		border-left: 0;
        		border-radius: 3px 0 0 3px;
      		}
      		.navbar .nav li:last-child a {
        		border-right: 0;
        		border-radius: 0 3px 3px 0;
      		}
    	</style>
    	<link href="../css/bootstrap-responsiveHome.css" rel="stylesheet">
	</head>
	<body>



		<div class="container">
			<div class="masthead">
        	<h3 class="muted">Bienvenid@ <?php echo $_SESSION['name']." ".$_SESSION['last_name'];?>. </h3>
        	<h4 class="muted"> <a href="login/session_manager.php?logout=yes">cerrar sesión</a> </h3>
        	<div class="navbar">
    	      	<div class="navbar-inner">
	    	        <div class="container">
            			<ul class="nav">
                			<li><a href="../home.php">Home</a></li>
                			<li><a href="../info/profile.php">Profile</a></li>
                			<li><a href="../course/new_course.php">Start new course</a></li>
                			<li><a href="../course/continue.php">Continue course</a></li>
                			<li><a href="../indo/records.php">Records</a></li>
                			<li><a href=<?php if(isset($_SESSION['type']) && ($_SESSION['type'] == 3 || $_SESSION['type'] == 2)){ echo "'..admin/administrate.php'>";} else {echo "'#'>";}?>Administrate</a></li>
              			</ul>
            		</div>
          		</div>
        	</div><!-- /.navbar -->
    </div>	

	<div id="wrap">

      <!-- Begin page content -->
      <div class="container">
        <div class="page-header">
          <h1>ArchLearn - Experience</h1>
        </div>
        <p class="lead">Do the following experience chosen by your tutor.</p>
        <hr>
        <?php
          function tutor($db){
            $sql = sprintf("SELECT idExperience FROM experience ORDER BY id DESC");
            $result = $db->query($sql);
            $row = $result->fetch_assoc();

            return rand(1,$row['idExperience']);
          }
           $id = 1;
			     $sql = sprintf("SELECT name, idEvaluation, idResource  FROM experience WHERE idExperience=%d", 
			     $id);
			     $result = $db->query($sql);
           $row = $result->fetch_assoc();

           function generateResourceCode($id,$db,$type){
            if($type == 1){
              $sql = sprintf("SELECT idVideo, link 
                FROM resourcevideo WHERE idExperience=%d",$id);
              $result = $db->query($sql);
              $row = $result->fetch_assoc();
              echo "<iframe width='560' height='315' src='".$row['link']."' frameborder='0' allowfullscreen></iframe>";
            } elseif($type == 2){
              $sql = sprintf("SELECT idImage, link 
                FROM resourceimage WHERE idExperience=%d",$id);
              $result = $db->query($sql);
              $row = $result->fetch_assoc();
             echo "<img src='".$row['link']."'>";
            }
           }

           generateResourceCode($id,$db,$row['idResource']);

          function generateTypeCode($id,$db,$type){
            if($type == 1){
              $sql = sprintf("SELECT idMultiple, question, idExperience, option1, option2, option3, answer 
                  FROM evaluationmultiple WHERE idExperience=%d",$id);
              $result = $db->query($sql);
              $row = $result->fetch_assoc();
    echo "Question: ".$row['question']."<br>
       <form action='evaluate_Multiple' name='Multiple' id='Multiple' accept-charset='UTF-8' method='POST' enctype='multipart/form-data' class='navbar-form pull-left'>
      <fieldset>
        <input type='hidden' id='id_exp' name='id_exp' value='".$id."'>
        <p>
          <label for='user_answer'><b>Choose one: </b></label>
          <input type='checkbox' name='user_answer'>".$row['option1']."</input><br>
          <input type='checkbox' name='user_answer'>".$row['option2']."</input><br>
          <input type='checkbox' name='user_answer'>".$row['option3']."</input><br>
        </p>
        <p>
          <button type='submit' class='btn'>Answer!</button>
          
        </p>
      </fieldset>
    </form>";

            }elseif($type==2){
              $sql = sprintf("SELECT idFill, question, idExperience, string1, word, string2 
      FROM evaluationfill WHERE idExperience=%d",$id);
    $result = $db->query($sql);
    $row = $result->fetch_assoc();
    echo "Write the word in the blanket: <br>
      <b>".$row['string1']."__________".$row['string2']."
       <form action='evaluate_Fill.php' name='Fill' id='Fill' accept-charset='UTF-8' method='POST' enctype='multipart/form-data' class='navbar-form pull-left'>
      <fieldset>
        <input type='hidden' id='id_exp' name='id_exp' value='".$id."'>
        <p>
          <label for='user_answer'><b>Write the word: </b></label>
          <input type='text' name='user_answer' id='user_answer' size='10' maxlength='255' class='span2'>
        </p>
        <p>
          <button type='submit' class='btn'>Answer!</button>
          
        </p>
      </fieldset>
    </form>";

            }
          }

           generateTypeCode($id,$db,$row['idEvaluation']);
           
		      ?>
      </div>
    </div>
	</div>
	</body>
</html>