<?
$strFecha = ($_GET["fecha"]!="" ? $_GET["fecha"] : date("Y-m-d"));
require "config/config.php";
require "autenticar.php";
require "listadoTurnosFunc.php";
$objTurno = new Turno();
$objMedico = new Medico();
(!isset($_GET["med"])) ? $rs = $objMedico->listarMedicosPorDia($strFecha): $rs = $objMedico->listarMedicosPorID($strFecha,$_GET["med"]);
(!isset($_GET["med"])) ? $titulo = "Turnos": $titulo = obtenerNombreMed($_GET['med']);
$objEspecialidad= new Especialidad();
$listarEsp = $objEspecialidad->listarEspecialidad();
  include 'templates/encabezado.php';
  require 'listadoTurnosModal.php';
?>
<style>
.form-control{ 
    font-weight: bold; 
}
</style>
<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h2 class="h2 col-3"><?=$titulo." ".strftime("%d %b",strtotime($strFecha))?></h2>
    <div class="btn-group col-4">
      <input class="form-control mr-2" type="text" id="BuscarMed" name="BuscarMed" autocomplete="off" placeholder="Buscar Medico">
      <button type="button" class="btn btn-outline-secondary" id="imprimir">Imprimir Turnos</button>
    </div> 
    <div class="btn-group col-5">
    <h6>Filtrar Por Especialidad</h6>
      <select id="filtrarMed" name="filtrarMed" class="custom-select">
        <?=selectEspecialidad($listarEsp);?>
      </select>
      <button id="btnFiltrar" class="btn btn-outline-secondary">Filtrar</button>
    </div>        
  </div>
  <div class="accordion" id="accordionExample">
    <?foreach ($rs as $key => $value) {?>
    <div class="card">
    <div class="card-header" id="headingOne" data-toggle="collapse" data-target="#collapse<?=$value["medico"];?>" aria-expanded="true" aria-controls="collapseOne">
      <input type="hidden" id="medicoID" value="<?=$value["medico"];?>">      
      <h5 class="mb-0"><?=$value['medNombre'];?></h5>
    </div>
    <div id="collapse<?=$value["medico"]; ?>" class="<?=(isset($_GET["med"])) ? 'collapse show' : 'collapse' ?>" aria-labelledby="heading" data-parent="#accordionExample">
      <div class="card-body"> 
        <div class="input-group">
          <button class="btn btn-sm btn-outline-secondary" onclick='modalDatos("<?=obtenerPrecios($value["medico"])?>"); return false'>Datos</button>
          <i class="far fa-calendar-alt fa-3x"></i>
          <input type="text" class="form-control col-2" id="<?=$value['id']; ?>" value="<?=$strFecha?>">
          <fieldset class="col-4" disabled>  
          <input type="text" class="form-control" value="<?=strftime("%A %e De %B",strtotime($strFecha));?>">
          </fieldset>  
        </div>
        <br> 
        <script>                      
          $( function() {
            var holidays = [<?=$value['evento']?>];
            $( "#<?=$value['id']; ?>" ).datepicker({
              showOtherMonths: true,
              selectOtherMonths: true,
              minDate: 0,
              beforeShowDay: function(date) {
                var datestring = jQuery.datepicker.formatDate('yy-mm-dd', date);
                var day = date.getDay();
                return [( holidays.indexOf(datestring) == -1  && day != 0 && day != <?
                  $rsCalendario = mysql_query("SELECT diasemana FROM medicos_reservas WHERE medico =".$value['id']." AND horadesde = 0");
                  //print_r($rsCalendario);
                  foreach ($rsCalendario as $diaCal) {
                    echo $diaCal["diasemana"];             
                    foreach ($rsCalendario as $diasemana2) {
                      if ($diasemana2["diasemana"]!=$diaCal["diasemana"]) {
                        echo " && day !=".$diasemana2["diasemana"];
                      }                                         
                    }
                    break;                      
                  }                         
                ?>)];   
              }             
            });
            $("#<?=$value['id'];?>").on("change", function(){
              location.href='?fecha='+ $( this ).val() + "<?if(isset($_GET['filtrarMed'])){echo "&filtrarMed=".$_GET['filtrarMed'];}?>&med=<?=$value['id'];?>";         
            })                     
          });
        </script>
        <div class="table-sm">            
          <table class="table table-bordered table-hover">
            <thead class="thead-dark">
              <tr>
                <th class="text-center" scope="col" colspan="8"><h2>Turnos</h2></th>
              </tr>
            </thead>
            <tbody>
              <tr class="text-center table-success">
                <th class="text-center align-middle" scope="col"><h4>Horarios</h4></th>
                <th scope="col" class="text-center align-middle"><h6>Paciente</h6></th>
                <th scope="col" class="text-center align-middle"><h6>Obra Social</h6></th>
                <th scope="col" class="text-center align-middle"><h6>Monto</h6></th>
                <th scope="col" class="text-center align-middle"><h6>Adicional</h6></th> 
                <th scope="col" class="text-center align-middle"><h6>Observacion</h6></th>
                <th scope="col" class="text-center align-middle"><h6>Estado</h6></th>
                <th scope="col" class="text-center align-middle"><h7>Sobre Turno</h7><img src='imagenes/add.png' data-toggle='modal' onclick='modalSobreTurnoAlta(<?='"'.$strFecha.'","'.$value["medNombre"].'","'.$value["medico"].'","'.$value["titulo"].'","'.selectObrasociales($value["medico"]).'"'?>); return false'></th>                        
              </tr>                 
              <? 
              $rsTurno = $objTurno->listarTurnos($strFecha,$value["medico"]);                                               
              for($a=$value["horadesde"];$a<=$value["horahasta"];$a++){
              ?>
             <?switch ($value['intervalo']) {
              case 10:
                ?><tr>  
                <th scope="row" class="text-center align-middle table-info"><h6><?=$a?>:00</h6></th>
                <?obtenerPaciente($rsTurno, $a.":00", $strFecha,$value['medNombre'],$value['medico'],$value["titulo"],$value["horadesde"],$value["horahasta"],$value['intervalo'])?>            
                <td rowspan="6"><?obtenerSobreTurnos($a, $strFecha,$value['medico'],$value['medNombre'],$value["titulo"],$value['intervalo'])?></td>                                           
              </tr>
              <tr>
                <th scope="row" class="text-center align-middle table-info"><h6><?=$a?>:10</h6></th>
                <?obtenerPaciente($rsTurno, $a.":10", $strFecha,$value['medNombre'],$value['medico'],$value["titulo"],$value["horadesde"],$value["horahasta"],$value['intervalo'])?>              
              </tr>
              <tr>
                <th scope="row" class="text-center align-middle table-info"><h6><?=$a?>:20</h6></th>
                <?obtenerPaciente($rsTurno, $a.":20", $strFecha,$value['medNombre'],$value['medico'],$value["titulo"],$value["horadesde"],$value["horahasta"],$value['intervalo'])?>
              </tr>
              <tr>
                <th scope="row" class="text-center align-middle table-info"><h6><?=$a?>:30</h6></th> 
                <?obtenerPaciente($rsTurno, $a.":30", $strFecha,$value['medNombre'],$value['medico'],$value["titulo"],$value["horadesde"],$value["horahasta"],$value['intervalo'])?>                
              </tr>
              <tr>
                <th scope="row" class="text-center align-middle table-info"><h6><?=$a?>:40</h6></th> 
                <?obtenerPaciente($rsTurno, $a.":40", $strFecha,$value['medNombre'],$value['medico'],$value["titulo"],$value["horadesde"],$value["horahasta"],$value['intervalo'])?>                
              </tr>
              <tr>
                <th scope="row" class="text-center align-middle table-info"><h6><?=$a?>:50</h6></th> 
                <?obtenerPaciente($rsTurno, $a.":50", $strFecha,$value['medNombre'],$value['medico'],$value["titulo"],$value["horadesde"],$value["horahasta"],$value['intervalo'])?>                
              </tr>
              <?
                break;
               case 15:
               ?><tr>  
                <th scope="row" class="text-center align-middle table-info"><h6><?=$a?>:00</h6></th>
                <?obtenerPaciente($rsTurno, $a.":00", $strFecha,$value['medNombre'],$value['medico'],$value["titulo"],$value["horadesde"],$value["horahasta"],$value['intervalo'])?>            
                <td rowspan="4"><?obtenerSobreTurnos($a, $strFecha,$value['medico'],$value['medNombre'],$value["titulo"],$value['intervalo'])?></td>                                           
              </tr>
              <tr>
                <th scope="row" class="text-center align-middle table-info"><h6><?=$a?>:15</h6></th>
                <?obtenerPaciente($rsTurno, $a.":15", $strFecha,$value['medNombre'],$value['medico'],$value["titulo"],$value["horadesde"],$value["horahasta"],$value['intervalo'])?>              
              </tr>
              <tr>
                <th scope="row" class="text-center align-middle table-info"><h6><?=$a?>:30</h6></th>
                <?obtenerPaciente($rsTurno, $a.":30", $strFecha,$value['medNombre'],$value['medico'],$value["titulo"],$value["horadesde"],$value["horahasta"],$value['intervalo'])?>
              </tr>
              <tr>
                <th scope="row" class="text-center align-middle table-info"><h6><?=$a?>:45</h6></th> 
                <?obtenerPaciente($rsTurno, $a.":45", $strFecha,$value['medNombre'],$value['medico'],$value["titulo"],$value["horadesde"],$value["horahasta"],$value['intervalo'])?>                
              </tr>
              <?
                 break;
               case 20:
               ?><tr>  
                <th scope="row" class="text-center align-middle table-info"><h6><?=$a?>:00</h6></th>
                <?obtenerPaciente($rsTurno, $a.":00", $strFecha,$value['medNombre'],$value['medico'],$value["titulo"],$value["horadesde"],$value["horahasta"],$value['intervalo'])?>            
                <td rowspan="3"><?obtenerSobreTurnos($a, $strFecha,$value['medico'],$value['medNombre'],$value["titulo"],$value['intervalo'])?></td>                                           
              </tr>
              <tr>
                <th scope="row" class="text-center align-middle table-info"><h6><?=$a?>:20</h6></th>
                <?obtenerPaciente($rsTurno, $a.":20", $strFecha,$value['medNombre'],$value['medico'],$value["titulo"],$value["horadesde"],$value["horahasta"],$value['intervalo'])?>              
              </tr>
              <tr>
                <th scope="row" class="text-center align-middle table-info"><h6><?=$a?>:40</h6></th>
                <?obtenerPaciente($rsTurno, $a.":40", $strFecha,$value['medNombre'],$value['medico'],$value["titulo"],$value["horadesde"],$value["horahasta"],$value['intervalo'])?>
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
      </div>
    </div>
  </div>            
    <?
    }
    ?>               
  
</div>        
</main>
<script>
  $("#btnFiltrar").click(function(){
    location.href="filtrarMed.php?fecha=<?=$strFecha?>&filtrarMed="+$('#filtrarMed').val();
  });
  $('#BuscarMed').typeahead({
  source: function(query, result)
  {
   $.ajax({
    url:"medicosJson.php",
    method:"POST",
    data:{query:query},
    dataType:"json",
    success:function(data)
    {
     result($.map(data, function(item){
      return item;
     }));
    }
   })
  }
 });
 $("#BuscarMed").keypress(function (e) {
    if (e.which == 13) {
    medico = {query:$('#BuscarMed').val()};
    $.post('medicosJsonID.php', medico, function(data, textStatus){
      window.open("buscadorMedico.php?fecha=<?=$strFecha?>&med="+ data.id);
    },"json");
    }
  });
  $("#imprimir").click(function(){
    window.open("listadoTurnosImp.php?fecha=<?=$strFecha?>");
  });
  //setTimeout('document.location.reload()',20000);  
</script>