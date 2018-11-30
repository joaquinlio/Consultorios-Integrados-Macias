<?
  $titulo= "Medicos";
  require "config/config.php";
  require "autenticar.php";
  require "listadoTurnosFunc.php";
  $strFecha = ($_GET["fecha"]!="" ? $_GET["fecha"] : date("Y-m-d"));
  $objMedico= new Medico();
  $listado= $objMedico->listarMedicos();
  $objEspecialidad= new Especialidad();
  $listarEsp = $objEspecialidad->listarEspecialidad();
 include 'templates/encabezado.php';
?>
<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h2 class="h2 col-3"><?=$titulo." ".strftime("%d %b",strtotime($strFecha))?></h2>
    <div class="btn-group col-4">
      <input class="form-control" type="text" id="BuscarMed" name="BuscarMed" autocomplete="off" placeholder="Buscar Medico">
    </div> 
    <div class="btn-group col-5">
    <h6>Filtrar Por Especialidad</h6>
      <select id="filtrarMed" name="filtrarMed" class="custom-select">
        <?=selectEspecialidad($listarEsp);?>
      </select>
      <button id="btnFiltrar" class="btn btn-outline-secondary">Filtrar</button>
    </div>        
  </div>
  <div class="accordion col-4" id="accordionExample">
  <?foreach( $listado as $value ){ ?>
    <div class="card">
      <div class="card-header" id="headingOne"  data-toggle="collapse" data-target="#collapse<?=$value['id']?>" aria-expanded="true" aria-controls="collapseOne">
      <li class="d-flex justify-content-between align-items-center">
      <h5><?=$value['medNombre']?></h5>
        <span class="badge badge-info badge-pill"><?=$value['titulo']?></span>
      </li>
      </div>
    <div id="collapse<?=$value['id']?>" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
        <div class="card-body">
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
              window.open("listadoTurnos.php?fecha="+ $( this ).val() + "<?if(isset($_GET['filtrarMed'])){echo "&filtrarMed=".$_GET['filtrarMed'];}?>&med=<?=$value['id'];?>");
              
            })           
          });
        </script>
        <div id="<?=$value['id'];?>"></div>
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
</script>
