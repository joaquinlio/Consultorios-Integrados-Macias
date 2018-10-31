<?
	require "config/config.php";
	Conexion::conectar();
	$objUsuario= new Usuario();
	$autenticar= $objUsuario -> login();
	//print_r($_SESSION);
 ?>