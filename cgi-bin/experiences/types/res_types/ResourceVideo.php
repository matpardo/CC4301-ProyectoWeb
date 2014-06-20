<?php
	include_once('.../db/archlearn_dbconfig.php');
	$db = DbConfig::getConnection();

	function generateResourceCode($id){
		$sql = sprintf("SELECT idVideo, link 
			FROM resourcevideo WHERE idExperience=%d",$id);
		$result = $db->query($sql);
		$row = $result->fetch_assoc();
		echo "<iframe width='560' height='315' src='".$row['link']."' frameborder='0' allowfullscreen></iframe>";
	}
?>
