<?
$titulo= "Medicos";
/*require "autenticar.php";*/
require "config/config.php";
require "listadoTurnosFunc.php";
$objEspecialidad= new Especialidad();
$listarEsp = $objEspecialidad->listarEspecialidad();

  include 'templates/encabezado.php';
  require 'listadoTurnosModal.php';

$strFecha = ($_GET["fecha"]!="" ? $_GET["fecha"] : date("Y-m-d"));
?>
<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h2 class="h2"><?=$titulo?></h2>
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
	<div class="table-responsive col-5">
		<table id="tablaDiasHabiles" class="table table-hover table-bordered table-sm">
			<thead>
              <tr>
               <?$rsEspTitulo = mysql_query("SELECT titulo FROM especialidad WHERE id =".$_GET['filtrarMed']);
			foreach ($rsEspTitulo as $key => $value) {?>
					<th scope="col" class="text-center" colspan="2"><h4>Medicos <?=$value['titulo'];?></h4></th>
			<?}?>
            	</tr>
            </thead>
            <tbody>
        	<tr>
        		<th scope="col" class="text-center align-middle">Medico</th>
        		<th scope="col" class="text-center align-middle">Calendario</th>
        	</tr>				
		<?
			$rsFiltrado = mysql_query("SELECT medNombre, id FROM medicos WHERE especialidad =".$_GET['filtrarMed']);
			foreach ($rsFiltrado as $key => $value) {
		?>
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
        	<tr>
        		<th class="text-center align-middle"><h6><?=$value['medNombre'];?></h6></th>
        		<th class="align-middle"><div id="<?=$value['id'];?>"></div></th>
        	</tr>
		  <? } ?>
		  </tbody>
		</table>
	</div>  
</main>
<script>
  $("#btnFiltrar").click(function(){
    location.href="?fecha=<?=$strFecha?>&filtrarMed="+$('#filtrarMed').val();
  });
</script>