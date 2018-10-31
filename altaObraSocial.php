<?
	header('Content-Type: application/json');
    require "config/config.php";
    $objObraSocial= new ObraSocial();
  	$chequeo= $objObraSocial->agregarObraSocial();
	if ($chequeo) {
		$datos = array(
		'id' => $objObraSocial->getId(),
		'razonsocial' => $objObraSocial->getRazonsocial()
		);
		echo json_encode($datos, JSON_FORCE_OBJECT);
	}
?>