<?php
	header('Content-Type: application/json');
    require "config/config.php";
    $objEspecialidad= new Especialidad();
  	$chequeo= $objEspecialidad->agregarEspecialidad();
	if ($chequeo) {
		$datos = array(
		'status' => 'ok',
		'titulo' => $objEspecialidad->getTitulo(),
		'id' => $objEspecialidad->getId()
		);
		echo json_encode($datos, JSON_FORCE_OBJECT);
	}
?>
	