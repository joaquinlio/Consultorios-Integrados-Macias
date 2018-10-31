<?
require "config/config.php";
require "listadoTurnosFunc.php";
  $objPacientes= new Paciente();
	$chequeo = $objPacientes->listarPacientesPorDNI();
	if ($chequeo) {
		foreach ($chequeo as $key => $value) {
	 	$datos = array(
		'pacNombreID' => $value["id"],
		'pacNombre' => $value["pacNombre"],
		'id' => $value["id"],
		'dni' => $value["dni"],
		'obrasocialID' => $value["obrasocial"],
		'obrasocial' => $value["razonsocial"],
		'telefono' => $value["telefono"],
		'email' => $value["email"],
		'monto' => obtenerMonto($_POST['medico'],$value["obrasocial"])
		);
		} 
		echo json_encode($datos, JSON_FORCE_OBJECT);	 			
	}
?>