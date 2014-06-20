<?php
	include_once('db/archlearn_dbconfig.php');
	$db = DbConfig::getConnection();

	function generateTypeCode($id){
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
					<input type='checkbox' name="user_answer">".$row['option1']."</input><br>
					<input type='checkbox' name="user_answer">".$row['option2']."</input><br>
					<input type='checkbox' name="user_answer">".$row['option3']."</input><br>
				</p>
				<p>
					<button type='submit' class='btn'>Answer!</button>
					
				</p>
			</fieldset>
		</form>";
	}
?>