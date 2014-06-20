<?php
	include_once('db/archlearn_dbconfig.php');
	$db = DbConfig::getConnection();
	function tutor(){
		$sql = sprintf("SELECT idExperience FROM experience ORDER BY id DESC");
		$result = $db->query($sql);
		$row = $result->fetch_assoc();

		return rand(1,$row['idExperience']);
	}
?>