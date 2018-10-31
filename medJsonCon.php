<?
header('Content-Type: application/json');
    require "config/config.php";
    $objMedico= new Medico();
  	$resultado = $objMedico->listarMedicosParaCons($_POST["query"],$_POST['diasemana']);
  	  foreach ($resultado as $value) {
  	  			$id = $value['id'];
            $horadesde = $value['horadesde'];
            $horahasta = $value['horahasta'];
  	  		}		
  	$datos = array(
		'id' => $id,
    'horadesde' => $horadesde,
    'horahasta' => $horahasta
		);
		echo json_encode($datos, JSON_FORCE_OBJECT);
	
 ?>