<?
header('Content-Type: application/json');
    require "config/config.php";
    $objMedico= new Medico();
  	$resultado = $objMedico->listarMedicosPorNombre($_POST["query"]);
  	  foreach ($resultado as $value) {
  	  			$id = $value['id'];
  	  		}		
  	$datos = array(
		'id' => $id
		);
		echo json_encode($datos, JSON_FORCE_OBJECT);
	
 ?>