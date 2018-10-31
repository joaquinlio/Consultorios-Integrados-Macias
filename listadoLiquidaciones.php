<?
  $titulo= "Liquidaciones";
  require "config/config.php";
  /*require "autenticar.php";*/
  $strFecha = ($_GET["fecha"]!="" ? $_GET["fecha"] : date("Y-m-d"));
  $objMedico= new Medico();
  $listadoMed= $objMedico->listarMedicosPorDia($strFecha);
  $objliquidacion= new liquidacion();
 include 'templates/encabezado.php'; 
?>
<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
  <div class="d-flex flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
    <h1 class="h2"><?=$titulo." ".strftime("%d %b",strtotime($strFecha))?></h1>
    <input class='form-control col-2' type="text" id="calendarioLiq" placeholder="Cambiar Fecha">
    <button class="btn btn-outline-dark" id="importar">Guardar En Excel</button>
    
  </div> 
    <div class="accordion" id="accordionExample">
      <?foreach ($listadoMed as $key => $value) {?>  
    <div class="card">
      <div class="card-header" id="heading" class="card" data-toggle="collapse" data-target="#collapse<?=$value["id"];?>" aria-expanded="true" aria-controls="collapse">
      <h5 class="mb-0"><?=$value['medNombre'];?><input type="hidden" id="medID" value="<?=$value["id"];?>"></h5>
    </div>
      <div id="collapse<?=$value["id"];?>" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
        <div class="card-body">
          <?
          $listado= $objliquidacion->listarLiquidacionPorMedico($strFecha,$value["id"]);          
          tablaLiquidaciones($listado)
          ?>
        </div>
      </div>
    </div>
    <?}?>  
    </div>      
</main>
<? function tablaLiquidaciones($listado){?>
    <table id="tablaLiquidaciones" class="table table-bordered table-sm">
      <thead>
        <tr>
          <th scope="col" class="text-center">Paciente</th>
          <th scope="col" class="text-center">Turno</th>  
          <th scope="col" class="text-center">Monto</th>
          <th scope="col" class="text-center">Adicional</th>    
        </tr>
      </thead>
      <tbody> 
        <? $montoTotal = 0;
        foreach( $listado as $value ){
          if ($value['adicional']) {
            $adicional = $value['adicional'];
          }else{
             $adicional = 0;
          }
          $montoTotal = $montoTotal + $value['monto'] + $adicional?>              
        <tr>
        <td class="text-center"><?=$value['pacNombre'] ;?></td>
        <td class="text-center"><?=$value['dia'] ;?></td>  
        <td class="text-center"><?=$value['monto'] ;?></td>
        <td class="text-center"><?=$value['adicional'] ;?></td>                      
        </tr>
        <?
        }
        ?>
        <table class="table table-bordered table-sm">
        <tr>
          <th scope="col" class="text-center">Monto Total</th> 
          <td class="text-center"><?=$montoTotal;?></td>
        </tr>
        </table>
      </tbody>
    </table>
<?
}
?>
<script>                      
  $( function() {
    $( "#calendarioLiq" ).datepicker({
      beforeShowDay: function(date) {
        var day = date.getDay();
        return [(day != 0)];
      }                        
    });
    $("#calendarioLiq").on("change", function(){
      location.href='?fecha='+ $( this ).val();
      
    }) 
    $("#importar").on("click", function(){
      location.href= "liquidacionExcel.php?fecha=<?$strFecha?>";
    })  
              
  });
</script>
