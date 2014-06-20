<?php
	function tutor($db){
		$sql = sprintf("SELECT idExperience FROM experience ORDER BY id DESC");
		$result = $db->query($sql);
		$row = $result->fetch_assoc();

		return rand(1,$row['idExperience']);
	}
?>