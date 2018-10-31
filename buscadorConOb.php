<?
require "config/config.php";
require "listadoTurnosFunc.php";	
		$datos = array(
		'monto' => obtenerMonto($_POST['medico'],$_POST['obrasocial'])
		);
		echo json_encode($datos, JSON_FORCE_OBJECT);	
?>