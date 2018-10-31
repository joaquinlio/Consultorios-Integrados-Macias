<?
require "config/config.php";
require "listadoTurnosFunc.php";
$strFecha = ($_GET["fecha"]!="" ? $_GET["fecha"] : date("Y-m-d"));
$titulo = obtenerNombreMed($_GET['med']);
$rs = mysql_query("SELECT medNombre, id FROM medicos WHERE id =".$_GET['med']);
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
    <h2 class="h2"><?=$titulo?></h2>
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
  <div class="list-group col-4">
  <a href="#" class="list-group-item list-group-item-action flex-column align-items-start">
    <div class="d-flex w-100 justify-content-between">
      <?foreach ($rs as $key => $value) {?>
        <h4 class="mb-1"><?=$value['medNombre']?></h4>
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
              location.href='listadoTurnos.php?fecha='+ $( this ).val() + "<?if(isset($_GET['filtrarMed'])){echo "&filtrarMed=".$_GET['filtrarMed'];}?>&med=<?=$value['id'];?>";
            })          
          });
        </script>
     <? } ?>   
    </div>
   <div class="align-middle" id="<?=$value['id'];?>"></div>
    <small>Selecionar Fecha en Calendario</small>
  </a>
</div>
	
</main>
<script>
  $("#btnFiltrar").click(function(){
    location.href="?fecha=<?=$strFecha?>&filtrarMed="+$('#filtrarMed').val();
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
      window.open("buscadorMedico.php?fecha=<?=$strFecha?>&med="+ data.id);
    },"json");
  
  });
</script>