<?php 

class conexion{


	private function __construct() {}

	static function conectar(){
		date_default_timezone_set('America/Buenos_Aires');
		setlocale(LC_ALL, 'es_RA');
		$opciones  = array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8");
		$link = new PDO("mysql:host=localhost;dbname=consultorio", "root", "", $opciones);

		$link->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);

		return $link;

	}
}
