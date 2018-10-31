<?php
  require "Conexion.php";
  $link = Conexion::conectar();
	header('Content-Type: application/json');
	$accion = (isset($_GET['accion']))?$_GET['accion']:'leer';
  switch ($accion) {
    case 'agregar':
      # instruccion agregar 
      $sql = $link->prepare("INSERT INTO turnos2(title,descripcion,start,medico)VALUES(:title,:descripcion,:start,:medico)");
      $respuesta = $sql->execute(array(
        "title" =>$_POST['title'],
        "descripcion" =>$_POST['descripcion'],
        "start" =>$_POST['start'],
        "medico" =>$_POST['medico']
      ));
      echo json_encode($respuesta);
      break;
    case 'eliminar':
      # instruccion eliminar 
      $respuesta= false;
      if (isset($_POST['id'])) {
      	$sql = $link->prepare("DELETE FROM turnos2 WHERE id=:id");
    
      $respuesta = $sql->execute(array("id" =>$_POST['id']));
      }
      echo json_encode($respuesta);
      break;
    case 'modificar':
      # instruccion modificar 
      $sql = $link->prepare("UPDATE turnos2 SET
      title=:title,
      descripcion=:descripcion,
      start=:start WHERE id=:id"
  	);
    
      $respuesta = $sql->execute(array(
        "title" =>$_POST['title'],
            "descripcion" =>$_POST['descripcion'],
            "start" =>$_POST['start'],
            "id" =>$_POST['id']
      ));
      echo json_encode($respuesta);
      break; 
    /*case 'listarPorMed':
      $sql = $link->prepare("SELECT * FROM turnos WHERE medico=:medico");
      $sql->execute(array("medico" =>1));
      $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
      echo json_encode($resultado);
       break;*/ 
    default:
      $sql = $link->prepare("SELECT * FROM turnos2");
      $sql->execute();
      $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
      echo json_encode($resultado);
      break;
  }
	
 ?>	