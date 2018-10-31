<?php
	require "config/config.php";
	$titulo = "prueba";
    $objTurno = new Turno();
  	$listarTurno = $objTurno->listarTurnosPorMedico(1);
  	$objMedico = new Medico();
  	$listar = $objMedico->listarMedicos();
	include 'templates/encabezado.php'; 
	$strFecha = ($_GET["fecha"]!="" ? $_GET["fecha"] : date("Ymd"));
?>
	<div class="container">
		<div class="row">
          <a href="?fecha=<?=date("Ymd", strtotime($strFecha)-86400)?>">&lt;&lt;</a>
          FECHA: <?=$strFecha?> 
          <a href="?fecha=<?=date("Ymd", strtotime($strFecha)+86400)?>">&gt;&gt;</a>
      </div>
		<div class="row">
			<div class="col"></div>
			<div class="col-7">
				<?selectMedico($listar)?>
				<div class="table-responsive-sm">
                <table class="table table-sm">
                    <thead>
                      <tr>
                        <th scope="col">Horarios</th>
                        <th scope="col">Turnos</th>
                        <th scope="col">&nbsp;</th>
                        <th scope="col">&nbsp;</th>
                        <th scope="col">&nbsp;</th>
                      </tr>
                    </thead>
                    <tbody> 
   					</div>
	                   	<th>&nbsp;</th>
                        <th>:00</th>
                        <th>:15</th>
                        <th>:30</th>
                        <th>:45</th>
					<?php 					
					for($a=10;$a<19;$a++){
				     ?> 
				    
				    <tr>
        <th><?=$a?>:00</th>                          
                <?foreach ($listarTurno as $turno) {       
          if (date("YmdHi", strtotime($turno['dia']))==$fechaTurno.$a."00") {?>
          <td><?=$turno['pacNombre'];?></td><?}?>
        <?if (date("YmdHi", strtotime($turno['dia']))==$fechaTurno.$a."15") {?>
          <td><?=$turno['pacNombre'];?></td><?}?>
        <?if (date("YmdHi", strtotime($turno['dia']))==$fechaTurno.$a."30") {?>
          <td><?=$turno['pacNombre'];?></td><?}?>
        <?if (date("YmdHi", strtotime($turno['dia']))==$fechaTurno.$a."45") {?>
          <td><?=$turno['pacNombre'];?></td><?}?>
        <?                
        }
        ?>
            </tr> 
				      
				    <?
					}
					?>
			    </tbody>
                  </table>
                </div>       
			</div>
			<div class="col"><?=$strFecha?></div>
		</div>

<?
function selectMedico($listar){
  ?>
    <div class="col-2">
       <select id="filtrarMed" name="filtrarMed" class="custom-select">
          <option value="all">Todos Los Medicos</option>
          <?php foreach ($listar as $strMedico ) {  ?>
          <option value="<?php echo $strMedico['id']; ?>"><?php echo $strMedico['medNombre']; ?></option>
        <?php
        }
        ?>
        </select>
        <button type="button" id="btnFiltrar" class="btn btn-primary">Filtrar</button>
      </div>
  <?
}
?>
<?php 
	include 'templates/pie.php' 
?>