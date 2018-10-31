<?
$titulo= "Turnos";
$strFecha = ($_GET["fecha"]!="" ? $_GET["fecha"] : date("Y-m-d"));
require "config/config.php";
require "autenticar.php";
require "listadoTurnosFunc.php";
$objTurno = new Turno();
$objMedico = new Medico();
(!isset($_GET["med"])) ? $rs = $objMedico->listarMedicosPorDia($strFecha) : $rs = $objMedico->listarMedicosPorID($strFecha,$_GET["med"]) ;
$objEspecialidad= new Especialidad();
$listarEsp = $objEspecialidad->listarEspecialidad();

  include 'templates/encabezado.php';
  require 'listadoTurnosModal.php';

?>
<script>
     $.datepicker.regional['es'] = {
     closeText: 'Cerrar',
     prevText: '< Ant',
     nextText: 'Sig >',
     currentText: 'Hoy',
     monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
     monthNamesShort: ['Ene','Feb','Mar','Abr', 'May','Jun','Jul','Ago','Sep', 'Oct','Nov','Dic'],
     dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
     dayNamesShort: ['Dom','Lun','Mar','Mié','Juv','Vie','Sáb'],
     dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sá'],
     weekHeader: 'Sm',
     dateFormat: 'dd/mm/yy',
     firstDay: 1,
     isRTL: false,
     showMonthAfterYear: false,
     yearSuffix: ''
     };
     $.datepicker.setDefaults($.datepicker.regional['es']);
</script>
<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h2 class="h2 col-3"><?=$titulo." ".strftime("%d %b",strtotime($strFecha))?></h2>
    <form class="form-inline col-4">
      <input class="form-control" type="text" id="BuscarMed" name="BuscarMed" autocomplete="off" placeholder="Buscar Medico">
      <button type="button" class="btn btn-outline-secondary" id="BuscadorMed"><i class="fas fa-search"></i></button>
    </form>
    <div class="btn-toolbar mb-2 mb-md-0">
        <div class="btn-group mr-2">
        <h6 class="h6">Filtrar Por Especialidad</h6>
          <select id="filtrarMed" name="filtrarMed" class="custom-select">
            <?=selectEspecialidad($listarEsp);?>
          </select>
        </div>
        <button id="btnFiltrar" class="btn btn-sm btn-outline-secondary">Filtrar
        </button>
    </div>          
  </div>
  <div class="accordion" id="accordionExample">
    <?foreach ($rs as $key => $value) {?>
    <div class="card-header" id="heading" class="card" data-toggle="collapse" data-target="#collapse<?=$value["medico"];?>" aria-expanded="true" aria-controls="collapse">
      <h5 class="mb-0"><?=$value['medNombre'];?><input type="hidden" id="medicoID" value="<?=$value["medico"];?>"></h5>
    </div>
    <div id="collapse<?=$value["medico"]; ?>" class="<?=(isset($_GET["med"])) ? 'collapse show' : 'collapse' ?>" aria-labelledby="heading" data-parent="#accordionExample">
      <div class="card-body"> 
        <div class="input-group">
          <i class="far fa-calendar-alt fa-3x"></i>
          <input type="text" class="form-control col-2" id="<?=$value['id']; ?>" value="<?=$strFecha?>">
          <fieldset class="col-4" disabled>  
          <input type="text" class="form-control" value="<?=strftime("%A %e De %B",strtotime($strFecha));?>">
          </fieldset>  
        </div>
        <br> 
        <script>                      
          $( function() {
            $( "#<?=$value['id']; ?>" ).datepicker({
              dateFormat: 'yy-mm-dd',
              showOtherMonths: true,
              selectOtherMonths: true,
              minDate: 0,
              beforeShowDay: function(date) {
                var day = date.getDay();
                return [(day != 0 && day != <?
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
              location.href='?fecha='+ $( this ).val() + "<?if(isset($_GET['filtrarMed'])){echo "&filtrarMed=".$_GET['filtrarMed'];}?>&med=<?=$value['medico'];?>";
              
            })          
          });
        </script>
        <div class="table-sm">            
          <table class="table table-bordered">
            <thead class="thead-dark">
              <tr>
                <th class="text-center" scope="col" colspan="7"><h2>Turnos</h2></th>
              </tr>
            </thead>
            <tbody>
              <tr class="text-center table-success">
                <th class="text-center" scope="col"><h4>Horarios</h4></th>
                <th scope="col" class="align-middle"><h6>00</h6></th>
                <th scope="col" class="align-middle"><h6>15</h6></th>
                <th scope="col" class="align-middle"><h6>30</h6></th>
                <th scope="col" class="align-middle"><h6>45</h6></th> 
                <th scope="col"><h7>Sobre Turnos</h7><img src='imagenes/add.png' data-toggle='modal' onclick='modalSobreTurnoAlta(<?='"'.$strFecha.'","'.$value["medNombre"].'","'.$value["medico"].'","'.$value["titulo"].'","'.selectObrasociales($value["medico"]).'"'?>); return false'></th>               
              </tr>                 
              <? 
              $rsTurno = $objTurno->listarTurnos($strFecha,$value["medico"]);                                   
              for($a=$value["horadesde"];$a<=$value["horahasta"];$a++){
              ?>
              <tr class="text-center">  
                <th scope="row" class="align-middle table-info"><h6><?=$a?>:00</h6></th>
                <th id="<?=$a.":00";?>" class="align-middle"><? obtenerPaciente($rsTurno, $a.":00", $strFecha,$value['medNombre'],$value['medico'],$value["titulo"],$value["horadesde"],$value["horahasta"])?></th>
                <th id="<?=$a.":15";?>" class="align-middle"><? obtenerPaciente($rsTurno, $a.":15", $strFecha,$value['medNombre'],$value['medico'],$value["titulo"],$value["horadesde"],$value["horahasta"])?></th>
                <th id="<?=$a.":30";?>" class="align-middle"><? obtenerPaciente($rsTurno, $a.":30", $strFecha,$value['medNombre'],$value['medico'],$value["titulo"],$value["horadesde"],$value["horahasta"])?></th>
                <th id="<?=$a.":45";?>" class="align-middle"><? obtenerPaciente($rsTurno, $a.":45", $strFecha,$value['medNombre'],$value['medico'],$value["titulo"],$value["horadesde"],$value["horahasta"])?></th>
                <th><ul class="list-group"><? obtenerSobreTurnos($rsTurno,$a, $strFecha,$value['medico'],$value['medNombre'],$value["titulo"])?></ul></th>           
              </tr>
              <?                   
              }               
              ?>                                                          
            </tbody>
          </table>
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
  $("#BuscadorMed").click(function(){
    medico = {query:$('#BuscarMed').val()};
    $.post('medicosJsonID.php', medico, function(data, textStatus){
      location.href='buscadorMedico.php?fecha=<?=$strFecha?>&med='+ data.id
    },"json");
  
  });
</script>