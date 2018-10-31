<?
	require "config/config.php";
	Conexion::conectar();
	$objUsuario= new Usuario();
	$autenticar= $objUsuario -> logout();
 ?>