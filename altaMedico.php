<?
   	header('Content-Type: application/json');
    require "config/config.php";
    $objMedico= new Medico();
  	$chequeo = $objMedico->agregarMedico();
  	if ($chequeo) {
		$datos = array(
		'status' => 'ok',
		'medNombre' => $objMedico->getMedNombre(),
		'id' => $objMedico->getId()
		);
		echo json_encode($datos, JSON_FORCE_OBJECT);
	}
?>