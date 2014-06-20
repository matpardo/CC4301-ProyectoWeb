<?php
	include_once('db/archlearn_dbconfig.php');
	$db = DbConfig::getConnection();

	function generateResourceCode($id){
		$sql = sprintf("SELECT idImage, link 
			FROM resourceimage WHERE idExperience=%d",$id);
		$result = $db->query($sql);
		$row = $result->fetch_assoc();
		echo "<img src='".$row['link']"'>";
	}
?>