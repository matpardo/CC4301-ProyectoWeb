<?php
class DbConfig{
	
	private static $db_name = "tics";//Base de datos de la app
	private static $db_user = "root";//Usuario MySQL
	private static $db_pass = "";//Password
	private static $db_host = "localhost";//Servidor donde esta alojado, puede ser 'localhost' o una IP (externa o interna).

	public static function getConnection(){
		$mysqli = new mysqli(self::$db_host, self::$db_user, self::$db_pass, self::$db_name);

		$mysqli->set_charset("utf8"); //Encode, Muy importante!!
		return $mysqli;
	}
}
?>