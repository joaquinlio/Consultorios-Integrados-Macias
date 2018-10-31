<?
   	header('Content-Type: application/json');
    require "config/config.php";
    $objMedico= new Medico();
  	$chequeo = $objMedico->listarMedicosPorNombre($_POST["query"]);
  	if ($chequeo) {
  		$datos = array();
		foreach($chequeo as $value){
		    $datos[]=$value['medNombre'];

		}
		echo json_encode($datos, JSON_FORCE_OBJECT);
	}
?>