<? 
	header('Content-Type: application/json');
    require "config/config.php";
    $objTurnos= new Turno();
  	$chequeo= $objTurnos->listarTurnosPorDNI();
	if ($chequeo) {
		$datos = array(
		'pacNombre' => $objTurnos->getPacNombre()
		);
		echo json_encode($datos, JSON_FORCE_OBJECT);
	}
	
		