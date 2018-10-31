<?
function selectEspecialidad($listarEsp){
        $especialidad = NULL;     
        foreach ($listarEsp as $value ) {
         $especialidad .= '<option value='.$value["id"].'>'.$value['titulo'].'</option>';        
        }
        return $especialidad;        
}

function mysql_query($sql){
  //echo $sql;
  $link = Conexion::conectar();
  $stmt= $link->prepare($sql);
  $stmt->execute();
  $listado=$stmt->fetchAll(PDO::FETCH_ASSOC);
  return $listado;
}
function obtenerPaciente($rsTurno, $FechaHora, $strFecha, $medNombre, $medID,$medEsp,$horaDesde,$horaHasta,$intervalo){
  //print_r($rsTurno);  
  $encontrado = false;
  $hora = '"'.$FechaHora.'"';
  $fecha = '"'.$strFecha.'"';
  $medico = '"'.$medNombre.'"';
  $especialidad = '"'.$medEsp.'"';
  $obrasocial = '"'.selectObrasociales($medID).'"';
  $diasHabiles = '"'.obtenerDiasHabiles($medID).'"';
    foreach($rsTurno as $key => $value){
      if ($value["pago"]==1) {
        $boton = '"btn btn-success disabled"';
      }else{
        $boton = '"btn btn-outline-warning"';
      }
      //echo "comp: ".$value["dia"]." ".$FechaHora." -- ";
      if($value["dia"]==$FechaHora){
        $encontrado=true;
        $paciente = '"'.$value["pacNombre"].'"';
        $dni = '"'.$value["dni"].'"';
        $email = '"'.$value["email"].'"'; 
        $dia = '"'.selectHorarios($medID, $strFecha,$horaDesde,$horaHasta,$intervalo).'"';
        $obraNom = '"'.$value["razonsocial"].'"';
        $estado = obtenerEstado($value['pago']);
        (!$value['adicional']) ? $adicional= NULL : $adicional = ','.$value["adicional"];
        (!$value['observacion']) ? $observacion= NULL : $observacion = ',"'.$value["observacion"].'"' ;
        echo "<td class='text-center align-middle' data-toggle='modal' id='btnDetalles' onclick='modalTurnoDetalles(".$hora.",".$dia.",".$medID.",".$medico.",".$fecha.",".$paciente.",".$value["paciente"].",".$value["id"].",".$obraNom.",".$dni.",".$value["telefono"].",".$value["monto"].",".$boton.",".$value["pago"].",".$especialidad.",".$diasHabiles.",".$email.$adicional.$observacion."); return false'>".$value["pacNombre"]."</td><td class='text-center align-middle'>".$value["razonsocial"]."</td><td id='monto' class='text-center align-middle'>".$value["monto"]."</td><td class='text-center align-middle'>".$value['adicional']."</td><td class='text-center align-middle'>".$value['observacion']."</td><td class='text-center align-middle' >".$estado."</td>";}   
    }
    if(!$encontrado){    
      echo "<td class='text-center'><img src='imagenes/add.png' data-toggle='modal' onclick='modalTurnoAlta(".$hora.",".$medID.",".$fecha.",".$medico.",".$obrasocial.",".$especialidad."); return false'></td><td></td><td></td><td></td><td></td><td></td>";      
    }
}
function obtenerSobreTurnos($a, $strFecha,$medID,$medNombre,$medEsp,$intervalo){
  switch ($intervalo) {
    case 10:
      $intervalos = "AND dia !='".$strFecha." ".$a.":00' AND dia != '".$strFecha." ".$a.":10' AND dia != '".$strFecha." ".$a.":20' AND dia != '".$strFecha." ".$a.":30' AND dia != '".$strFecha." ".$a.":40' AND dia != '".$strFecha." ".$a.":50' AND medico=".$medID;
      break;
    case 15:
      $intervalos = "AND dia !='".$strFecha." ".$a.":00' AND dia != '".$strFecha." ".$a.":15' AND dia != '".$strFecha." ".$a.":30' AND dia != '".$strFecha." ".$a.":45' AND medico=".$medID;
      break;
    case 20:
      $intervalos = "AND dia !='".$strFecha." ".$a.":00' AND dia != '".$strFecha." ".$a.":20' AND dia != '".$strFecha." ".$a.":40' AND medico=".$medID;
      break;
    default:
      # code...
      break;
  }
  $rsSobreTurno = mysql_query("SELECT DATE_FORMAT(turnos.dia,'%H:%i') as dia,DATE_FORMAT(turnos.dia,'%H:%i') as dia,turnos.monto, turnos.medico, turnos.id, turnos.paciente, turnos.pago, pacientes.pacNombre, pacientes.obrasocial, pacientes.dni, pacientes.telefono, pacientes.email, obrasocial.razonsocial FROM turnos LEFT JOIN pacientes ON turnos.paciente = pacientes.id LEFT JOIN obrasocial ON pacientes.obrasocial = obrasocial.id WHERE dia LIKE '%". $strFecha." ".$a."%' ".$intervalos." ORDER BY dia");
  $fecha = '"'.$strFecha.'"';
  $medico = '"'.$medNombre.'"';
  $especialidad = '"'.$medEsp.'"';
  foreach ($rsSobreTurno as $key => $value) {
    if ($value["pago"]==1) {
        $boton = '"btn btn-success disabled"';
      }else{
        $boton = '"btn btn-outline-warning"';
      }
      $paciente = '"'.$value["pacNombre"].'"';
      $dni = '"'.$value["dni"].'"';
      $email = '"'.$value["email"].'"';
      $dia = '"'.$value["dia"].'"';
      $obraNom = '"'.$value["razonsocial"].'"';
      $estado = obtenerEstado($value['pago']);
      echo "<li class='list-group-item d-flex justify-content-between align-items-center' data-toggle='modal' onclick='modalTurnoDetallesST(".$dia.",".$medID.",".$medico.",".$fecha.",".$paciente.",".$value["paciente"].",".$value["id"].",".$obraNom.",".$dni.",".$value["telefono"].",".$value["monto"].",".$boton.",".$value["pago"].",".$especialidad.",".$email.")'>".$value ['pacNombre']."<span class='badge badge-primary badge-pill'>".$estado."</span><span class='badge badge-primary badge-pill'>".$value ['dia']."</span></li>";     
  }
}
function obtenerEstado($estado){
  return ($estado == 0) ? "No Pago" : "Pago"; 
}
function selectHorarios($medID, $strFecha,$horaDesde,$horaHasta,$intervalo){
  $option = mysql_query("SELECT DATE_FORMAT(turnos.dia,'%H:%i') as dia FROM turnos WHERE dia LIKE '".$strFecha."%' AND medico='".$medID."' ORDER BY dia ");
  
  for ($a=$horaDesde;$a<=$horaHasta;$a++) {
    if ($intervalo == 10) {
      $select[]=$a.':00';
        $select[]=$a.':10';
        $select[]=$a.':20';
        $select[]=$a.':30';
        $select[]=$a.':40';
        $select[]=$a.':50';
    }
    if ($intervalo == 15) {
      $select[]=$a.':00';
      $select[]=$a.':15';
      $select[]=$a.':30';
      $select[]=$a.':45';
    }
    if ($intervalo == 20) {
        $select[]=$a.':00';
        $select[]=$a.':20';
        $select[]=$a.':40';
        }                               
  } 
 $horariosDisponibles2 = NULL;
 foreach ($select as $key => $value) {
   $horariosDisponibles2.= "<option>".$value."</option>";
 }
 if (empty($option)) {
     $resultado = $horariosDisponibles2;
 }else{
  foreach($option as $value){
      $turnos[]=$value['dia'];
    } 
   $resultado = array_diff($select, $turnos);
  $horariosDisponibles = NULL;
   foreach ($resultado as $key => $value) {
     $horariosDisponibles .= "<option>".$value."</option>";
   }
   $resultado = $horariosDisponibles;
 }
return $resultado;
}
function selectObrasociales($medID){
  $option = mysql_query("SELECT obrasocial.razonsocial, obrasocial.id FROM precios LEFT JOIN obrasocial ON precios.obrasocial = obrasocial.id WHERE medico=".$medID);
  $obrasociales = NULL;
  foreach ($option as $key => $value) {
    $obrasociales .= '<option value='.$value["id"].'>'.$value['razonsocial'].'</option>';
  }
  return $obrasociales;
}
function selectMedicos(){
  $rsMedico = mysql_query("SELECT * FROM medicos" );
  $medicos = NULL;
  foreach ($rsMedico as $key => $value) {
    $medicos .= '<option value='.$value["id"].'>'.$value['medNombre'].'</option>';
  }
  return $medicos;
}
function obtenerMonto($medico,$obrasocial){
  $rsMonto = mysql_query("SELECT monto FROM precios WHERE medico =".$medico." AND obrasocial = ".$obrasocial);
  foreach ($rsMonto as $key => $value) {
    return $value['monto'];
  }

}
function obtenerPrecios($medico){
  $rsPrecio  = mysql_query("SELECT obrasocial.razonsocial,precios.monto FROM precios LEFT JOIN obrasocial on precios.obrasocial = obrasocial.id WHERE medico=".$medico);
  $precios = NULL;
  foreach ($rsPrecio as $key => $value) {
   $precios .= '<tr><td>'.$value['razonsocial'].'</td><td>'.$value['monto'].'</td></tr>';
  }
  return $precios;
}
function obtenerDiasHabiles($medID){
$rsCalendario = mysql_query("SELECT diasemana FROM medicos_reservas WHERE medico =".$medID." AND horadesde = 0");
$diasHabil = NULL ;
  foreach ($rsCalendario as $diaCal) {
    $diasHabil = $diaCal["diasemana"];             
    foreach ($rsCalendario as $diasemana2) {
      if ($diasemana2["diasemana"]!=$diaCal["diasemana"]) {
        $diasHabil .= $diasemana2["diasemana"];
      }                                         
    }
    break;                      
  } 
 return $diasHabil;                     
}
function obtenerNombreMed($medico){
  $rsNombre  = mysql_query("SELECT medNombre FROM medicos WHERE id =".$medico);
  foreach ($rsNombre as $key => $value) {
    return $value['medNombre'];
  }
}
function obtenerConsultorios($diasemana){
  $rsConsultorio= mysql_query("SELECT medico AS id,consultorio AS resourceId, horadesde AS start,horahasta AS end, medicos.medNombre AS title,diasemana FROM medicos_reservas LEFT JOIN medicos ON medicos_reservas.medico = medicos.id WHERE horadesde != 0 AND consultorio != 0 AND diasemana =".$diasemana);
  
  foreach ($rsConsultorio as $key => $value) {
    $datos[]= array(
      'id' => $value["id"],
      'resourceId' => $value["resourceId"],
      'start' => "2018-04-07T".$value["start"],
      'end' => "2018-04-07T".$value["end"],
      'title' => $value["title"],
      'diasemana' => $value["diasemana"]
      );
  }
  echo json_encode($datos); 
}
function obtenerPacienteIMP($rsTurno, $FechaHora, $strFecha, $medNombre, $medID,$medEsp,$horaDesde,$horaHasta,$intervalo){
  //print_r($rsTurno);  
  $encontrado = false;
    foreach($rsTurno as $key => $value){
      if($value["dia"]==$FechaHora){
        $encontrado=true;
        echo "<td>".$value["pacNombre"]."</td><td>".$value["razonsocial"]."</td>";}   
    }
    if(!$encontrado){    
      echo "<td class='text-center'></td><td></td>";      
    }
}
function obtenerSobreTurnosIMP($a, $strFecha,$medID,$medNombre,$medEsp,$intervalo){
  switch ($intervalo) {
    case 10:
      $intervalos = "AND dia !='".$strFecha." ".$a.":00' AND dia != '".$strFecha." ".$a.":10' AND dia != '".$strFecha." ".$a.":20' AND dia != '".$strFecha." ".$a.":30' AND dia != '".$strFecha." ".$a.":40' AND dia != '".$strFecha." ".$a.":50' AND medico=".$medID;
      break;
    case 15:
      $intervalos = "AND dia !='".$strFecha." ".$a.":00' AND dia != '".$strFecha." ".$a.":15' AND dia != '".$strFecha." ".$a.":30' AND dia != '".$strFecha." ".$a.":45' AND medico=".$medID;
      break;
    case 20:
      $intervalos = "AND dia !='".$strFecha." ".$a.":00' AND dia != '".$strFecha." ".$a.":20' AND dia != '".$strFecha." ".$a.":40' AND medico=".$medID;
      break;
    default:
      # code...
      break;
  }
  $rsSobreTurno = mysql_query("SELECT DATE_FORMAT(turnos.dia,'%H:%i') as dia,DATE_FORMAT(turnos.dia,'%H:%i') as dia,turnos.monto, turnos.medico, turnos.id, turnos.paciente, turnos.pago, pacientes.pacNombre, pacientes.obrasocial, pacientes.dni, pacientes.telefono, pacientes.email, obrasocial.razonsocial FROM turnos LEFT JOIN pacientes ON turnos.paciente = pacientes.id LEFT JOIN obrasocial ON pacientes.obrasocial = obrasocial.id WHERE dia LIKE '%". $strFecha." ".$a."%' ".$intervalos." ORDER BY dia");
  $fecha = '"'.$strFecha.'"';
  $medico = '"'.$medNombre.'"';
  $especialidad = '"'.$medEsp.'"';
  foreach ($rsSobreTurno as $key => $value) {
      $paciente = '"'.$value["pacNombre"].'"';
      $dni = '"'.$value["dni"].'"';
      $email = '"'.$value["email"].'"';
      $dia = '"'.$value["dia"].'"';
      $obraNom = '"'.$value["razonsocial"].'"';
      $estado = obtenerEstado($value['pago']);
      echo "<li class='list-group-item d-flex justify-content-between align-items-center'>".$value ['pacNombre']."<span class='badge badge-pill'>".$value ['dia']."</span></li>";     
  }
}
function buscarDiaHabil($fecha,$medico){
  $rsDia  = mysql_query("SELECT diasemana FROM medicos_reservas WHERE medico =".$medico." AND horadesde != 0");
  $fechaNum = date("w", strtotime($fecha));
  /*$fechaSig = date("Y-m-d", strtotime($fecha)+86400);
  $fechaSigNum = date("w", strtotime($fechaSig));*/

  foreach($rsDia as $value){
    $diasemana[] = $value['diasemana'];
  } 
  //$fechaSig = in_array($fechaSigNum, $diasemana) ? $fechaSig : in_array(date("w", strtotime($fechaSig)+86400), $diasemana) ? date("Y-m-d", strtotime($fechaSig)+86400) : in_array(date("w", strtotime($fechaSig)+86400), $diasemana) ? date("Y-m-d", strtotime($fechaSig)+172800); 
  
  //echo in_array($fechaNum, $diasemana) ? $fecha : $fechaSig  ;   
}
?>