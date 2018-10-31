<?
$strFecha = ($_GET["fecha"]!="" ? $_GET["fecha"] : date("Y-m-d"));
require "config/config.php";
require "listadoTurnosFunc.php";
$objTurno = new Turno();
$objMedico = new Medico();
(!isset($_GET["med"])) ? $rs = $objMedico->listarMedicosPorDia($strFecha): $rs = $objMedico->listarMedicosPorID($strFecha,$_GET["med"]);
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="css/jquery-ui.min.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/bootstrap.bundle.min.js "></script>
    <script src="js/jquery-ui.min.js"></script>
  </head>
  <style>
  .imprimir { 
    page-break-after: always; 
  }
  </style>
<body>
<?foreach ($rs as $key => $value) {?>  
<div class="imprimir">      
          <table class="table-sm table-bordered" style="width: 100%;">
            <thead >
            </thead>
            <tbody>
              <tr>
                <th><h6><?=$value["medNombre"]?></h6></th>
                <th><h6>Paciente</h6></th>
                <th><h6>Obra Social</h6></th>
                <th><h7>Sobre Turno</h7></th>                        
              </tr>                 
              <? 
              $rsTurno = $objTurno->listarTurnos($strFecha,$value["medico"]);                                               
              for($a=$value["horadesde"];$a<=$value["horahasta"];$a++){
              ?>
             <?switch ($value['intervalo']) {
              case 10:
                ?><tr>  
                <th ><h6><?=$a?>:00</h6></th>
                <?obtenerPacienteIMP($rsTurno, $a.":00", $strFecha,$value['medNombre'],$value['medico'],$value["titulo"],$value["horadesde"],$value["horahasta"],$value['intervalo'])?>            
                <td rowspan="6"><?obtenerSobreTurnosIMP($a, $strFecha,$value['medico'],$value['medNombre'],$value["titulo"],$value['intervalo'])?></td>                                           
              </tr>
              <tr>
                <th ><h6><?=$a?>:10</h6></th>
                <?obtenerPacienteIMP($rsTurno, $a.":10", $strFecha,$value['medNombre'],$value['medico'],$value["titulo"],$value["horadesde"],$value["horahasta"],$value['intervalo'])?>              
              </tr>
              <tr>
                <th ><h6><?=$a?>:20</h6></th>
                <?obtenerPacienteIMP($rsTurno, $a.":20", $strFecha,$value['medNombre'],$value['medico'],$value["titulo"],$value["horadesde"],$value["horahasta"],$value['intervalo'])?>
              </tr>
              <tr>
                <th ><h6><?=$a?>:30</h6></th> 
                <?obtenerPacienteIMP($rsTurno, $a.":30", $strFecha,$value['medNombre'],$value['medico'],$value["titulo"],$value["horadesde"],$value["horahasta"],$value['intervalo'])?>                
              </tr>
              <tr>
                <th><h6><?=$a?>:40</h6></th> 
                <?obtenerPacienteIMP($rsTurno, $a.":40", $strFecha,$value['medNombre'],$value['medico'],$value["titulo"],$value["horadesde"],$value["horahasta"],$value['intervalo'])?>                
              </tr>
              <tr>
                <th><h6><?=$a?>:50</h6></th> 
                <?obtenerPacienteIMP($rsTurno, $a.":50", $strFecha,$value['medNombre'],$value['medico'],$value["titulo"],$value["horadesde"],$value["horahasta"],$value['intervalo'])?>                
              </tr>
              <?
                break;
               case 15:
               ?><tr>  
                <th><h6><?=$a?>:00</h6></th>
                <?obtenerPacienteIMP($rsTurno, $a.":00", $strFecha,$value['medNombre'],$value['medico'],$value["titulo"],$value["horadesde"],$value["horahasta"],$value['intervalo'])?>            
                <td rowspan="4"><?obtenerSobreTurnosIMP($a, $strFecha,$value['medico'],$value['medNombre'],$value["titulo"],$value['intervalo'])?></td>                                           
              </tr>
              <tr>
                <th><h6><?=$a?>:15</h6></th>
                <?obtenerPacienteIMP($rsTurno, $a.":15", $strFecha,$value['medNombre'],$value['medico'],$value["titulo"],$value["horadesde"],$value["horahasta"],$value['intervalo'])?>              
              </tr>
              <tr>
                <th><h6><?=$a?>:30</h6></th>
                <?obtenerPacienteIMP($rsTurno, $a.":30", $strFecha,$value['medNombre'],$value['medico'],$value["titulo"],$value["horadesde"],$value["horahasta"],$value['intervalo'])?>
              </tr>
              <tr>
                <th><h6><?=$a?>:45</h6></th> 
                <?obtenerPacienteIMP($rsTurno, $a.":45", $strFecha,$value['medNombre'],$value['medico'],$value["titulo"],$value["horadesde"],$value["horahasta"],$value['intervalo'])?>                
              </tr>
              <?
                 break;
               case 20:
               ?><tr>  
                <th><h6><?=$a?>:00</h6></th>
                <?obtenerPacienteIMP($rsTurno, $a.":00", $strFecha,$value['medNombre'],$value['medico'],$value["titulo"],$value["horadesde"],$value["horahasta"],$value['intervalo'])?>            
                <td rowspan="3"><?obtenerSobreTurnosIMP($a, $strFecha,$value['medico'],$value['medNombre'],$value["titulo"],$value['intervalo'])?></td>                                           
              </tr>
              <tr>
                <th ><h6><?=$a?>:20</h6></th>
                <?obtenerPacienteIMP($rsTurno, $a.":20", $strFecha,$value['medNombre'],$value['medico'],$value["titulo"],$value["horadesde"],$value["horahasta"],$value['intervalo'])?>              
              </tr>
              <tr>
                <th><h6><?=$a?>:40</h6></th>
                <?obtenerPacienteIMP($rsTurno, $a.":40", $strFecha,$value['medNombre'],$value['medico'],$value["titulo"],$value["horadesde"],$value["horahasta"],$value['intervalo'])?>
              </tr>     
              <?
                 break;           
             } ?>
              
              <?                   
              }               
              ?>                                                          
            </tbody>
          </table>
</div> 
    <?
    }
    ?>
    <script>
   $(document).ready(function(){
    window.print();
    window.addEventListener("afterprint", function(){
    this.close();
}, false);
  });

    </script>