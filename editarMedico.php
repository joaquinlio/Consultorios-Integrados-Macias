<?
		require "config/config.php";
		require "listadoTurnosFunc.php";
    $objMedico= new Medico();
		$objMedico->editarMedico();
		$rest = substr($_POST['evento'], -12, 10);
		$rs = mysql_query("SELECT * FROM turnos WHERE dia LIKE '".$rest." %'");
		//print_r($rs);
		(!$rs) ? $encontrado = 0 : $encontrado = 1;
		$datos = array(
			'encontrado' => $encontrado, 
			'dia' => $rest,
			'medico' => $_POST['id'] 
			);
			echo json_encode($datos, JSON_FORCE_OBJECT);
?>