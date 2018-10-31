<?
	header('Content-Type: application/json');
    require "config/config.php";
    $objPacientes= new Paciente();
  	$chequeo = $objPacientes->agregarPaciente();
  	if ($chequeo) {
		$datos = array(
		'status' => 'success',
		'id' => $objPacientes->getId()
		);
		echo json_encode($datos, JSON_FORCE_OBJECT);
	}
?>

	