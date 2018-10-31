<?
	header('Content-Type: application/json');
    require "config/config.php";
    $objDiaHabil= new diaHabil();
  	$chequeo= $objDiaHabil->editarConsultorio();
?>