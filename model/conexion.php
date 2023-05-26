<?php 
$contrasena = "AVNS_ItjzLCW9UeVBkQftXKv"
$usuario = "doadmin";
$nombre_bd = "defaultdb";

try {
	$bd = new PDO (
		'mysql:host=db-mysql-nyc1-29461-do-user-14089120-0.b.db.ondigitalocean.com:25060;
		dbname='.$nombre_bd,
		$usuario,
		$contrasena,
		array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8")
	);
} catch (Exception $e) {
	echo "Problema con la conexion: ".$e->getMessage();
}
?>