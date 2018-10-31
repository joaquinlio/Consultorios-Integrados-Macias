<?
	header('Content-Type: application/json');
    require "config/config.php";
    $objDiaHabil= new diaHabil();
  	$chequeo= $objDiaHabil->agregarDiaHabil();
	if ($chequeo) {
		$datos = array(
		'medico' => $objDiaHabil->getMedico(),
		'diasemana' => $objDiaHabil->getDiasemana(),
		'horadesde' => $objDiaHabil->getHoradesde(),
		'horahasta' => $objDiaHabil->getHorahasta()
		);
		echo json_encode($datos, JSON_FORCE_OBJECT);
	}
?>
	