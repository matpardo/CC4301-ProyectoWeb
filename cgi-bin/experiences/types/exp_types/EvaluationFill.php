<?php
	include_once('db/archlearn_dbconfig.php');
	$db = DbConfig::getConnection();

	function generateTypeCode($id){
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
					<<input type='text' name='user_answer' id='user_answer' size='10' maxlength='255' class='span2'>
				</p>
				<p>
					<button type='submit' class='btn'>Answer!</button>
					
				</p>
			</fieldset>
		</form>";
	}
?>