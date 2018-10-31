<?
require "config/config.php";
$strFecha = ($_GET["fecha"]!="" ? $_GET["fecha"] : date("Y-m-d"));
$objMedico= new Medico();
$listadoMed= $objMedico->listarMedicosPorDia($strFecha);
$objliquidacion= new liquidacion();

header("Pragma: public");
header("Expires: 0");
$filename = "liquidacion".$strFecha.".xls";
header("Content-type: application/x-msdownload");
header("Content-Disposition: attachment; filename=$filename");
header("Pragma: no-cache");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
?>
<?foreach ($listadoMed as $key => $value) {?>
	<table width="50%" border="1" cellpadding="10" cellspacing="0" bordercolor="#666666" id="Exportar_a_Excel" style="border-collapse:collapse;">
	<thead>
	  <tr>
	    <th><?=$value['medNombre']?></th>         
	  </tr>
	</thead>
	<tbody>
		<tr>
			<th>Paciente</th>
			<th>Turno</th>  
			<th>Monto</th>
			<th>Adicional</th>
			<th>observacion</th>    
		</tr>
		   <?
		   $listado= $objliquidacion->listarLiquidacionPorMedico($strFecha,$value['id']);
		   tablaLiquidacion($listado);
		    ?>                   
                 
	</tbody>
</table>
<?} 
	function tablaLiquidacion($listado){
		$montoTotal = 0;
        foreach( $listado as $value ){
          if ($value['adicional']) {
            $adicional = $value['adicional'];
          }else{
             $adicional = 0;
          }
          $montoTotal = $montoTotal + $value['monto'] + $adicional?>
			<tr>
	        <td><?=$value['pacNombre'] ;?></td>
	        <td><?=$value['dia'] ;?></td>  
	        <td><?=$value['monto'] ;?></td>
	        <td><?=$value['adicional'] ;?></td>
	        <td><?=$value['observacion'] ;?></td>                       
	        </tr>
		<?}?>
        <tr>
          <th>Monto Total</th> 
          <td><?=$montoTotal;?></td>
        </tr>
<?}?>