<?
require "config/config.php";
require "listadoTurnosFunc.php";
$fechaNum = date("w", strtotime($_POST['fecha']));
 $option = mysql_query("SELECT horadesde,horahasta, medicos.intervalo FROM medicos_reservas LEFT JOIN medicos ON medicos_reservas.medico = medicos.id WHERE diasemana LIKE ".$fechaNum." AND medico=".$_POST['medico']);
 foreach ($option as $key => $value) {
 	$horadesde = $value['horadesde'];
 	$horahasta = $value['horahasta'];
 	$intervalo = $value['intervalo'];
 }
 //echo  selectHorarios($_POST['medico'],$_POST['fecha'],$horadesde,$horahasta,$intervalo ); 
		
		$datos = selectHorarios($_POST['medico'],$_POST['fecha'],$horadesde,$horahasta,$intervalo );

		echo json_encode($datos, JSON_HEX_QUOT | JSON_HEX_TAG);	
?>