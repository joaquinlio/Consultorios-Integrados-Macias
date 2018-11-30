<?
  $titulo= "Medicos";
  require "config/config.php";
  require "autenticar.php";
  require "listadoTurnosFunc.php";
  $objMedico= new Medico();
  $listado= $objMedico->listarMedicos();
  $objEspecialidad= new Especialidad();
  $listarEsp = $objEspecialidad->listarEspecialidad();
 include 'templates/encabezado.php';
?>
<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
    <h1 class="h2"><?=$titulo?></h1>
  </div> 
  <div class="table-responsive">
    <?tablaMedicos($listado,$listarEsp);?>
  </div>          
</main>
<? function tablaMedicos($listado,$listarEsp){
  ?>
  <table id="tablaMedicos" class="table table-striped table-sm">
            <thead>
              <tr>
                <th class="text-center" scope="col">Nombre</th>
                <th class="text-center" scope="col">Telefono</th>
                <th class="text-center" scope="col">Especialidad</th>
                <th class="text-center" scope="col">Intervalo de Atencion</th>
                <th class="text-center" scope="col">Dia No Habil</th>
                <th class="text-center" scope="col">Pacientes</th>
                <th class="text-center" scope="col"><img src='imagenes/add.png' data-toggle='modal' onclick='modalMedicoAlta("<?=selectEspecialidad($listarEsp)?>"); return false'></th>
              </tr>
            </thead>
            <tbody>
            <?php 
              foreach( $listado as $value ){ 
                $diasHabiles = "'".obtenerDiasHabiles($value['id'])."'";
            ?>
              <tr id="<?=$value['id']; ?>">
                <th class="text-center" scope="row"><?=$value['medNombre'];?></th>
                <td class="text-center"><?=$value['telefono'];?></td> 
                <td class="text-center"><?=$value['titulo'];?></td>
                <td class="text-center"> Cada <?=$value['intervalo'];?> Minutos</td> 
                <td class="text-center"><fieldset disabled><textarea class="form-control" name="" id="" rows="1"><?=$value['evento'];?></textarea></fieldset></td> 
                <td class="text-center"><?=$value['pacientes'];?></td>       
                <td class="text-center"><button type="button" id="btnDetalle" class="btn btn-success" onclick="modalEditMed(<?=$value['id'];?>,'<?=$value['medNombre'];?>','<?=$value['telefono'];?>','<?=selectEspecialidad($listarEsp)?>',<?=$value['intervalo']?>,'<?=$value['pacientes'];?>'); return false">Detalles</button></td>            
              </tr>
              <?}?>
            </tbody>
          </table>
<?
}
?>
<div class="modal fade" id="modalMedicoAlta" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title col-5" id="">Agregar Medico</h5>
      </div>
      <div class="modal-body">
        <div class="form-row">
        <div class="form-group">
          <input type="hidden" id="medID" value="">
          <label>Nombre:</label>
          <input type="text" id="medNombre" class="form-control" autocomplete="off">
          <label>Telefono:</label>
          <input type="text" id="telefono" class="form-control" autocomplete="off">
          <label>Especialidad:</label>
          <select name="especialidad" id="especialidad" class="custom-select"></select>
          <label>Intervalo:</label>
          <select name="intervalo" id="intervalo" class="custom-select">
            <option value="10">10 Minutos</option>
            <option value="15">15 Minutos</option>
            <option value="20">20 Minutos</option>
          </select>
          <label>Paciente:</label>
          <select name="paciente" id="paciente" class="custom-select">
            <option value="Si">Si</option>
            <option value="No">No</option>
          </select>
          <label>Dia No Habil:</label>
          <input type="text" id="evento" class="form-control" autocomplete="off">
        </div>
        </div>
        <div class="modal-footer">         
          <button type="button" id="btnAgregar" class="btn btn-success">Agregar</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="modalDetalles" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="">Detalles</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
           <div class="form-row">
              <div class="form-group">
                <input type="hidden" id="medIDedit" value="">
                  <label>Nombre:</label>
                    <input type="text" id="medNombreEdit" class="form-control" autocomplete="off">
                  <label>Telefono:</label>
                    <input type="text" id="telefonoEdit" class="form-control" autocomplete="off">
                  <label>Especialidad:</label>
                    <select name="especialidadEdit" id="especialidadEdit" class="custom-select"></select>
                  <label>Intervalo:</label>
                    <select name="intervaloEdit" id="intervaloEdit" class="custom-select">
                      <option value="10">10 Minutos</option>
                      <option value="15">15 Minutos</option>
                      <option value="20">20 Minutos</option>
                    </select>
                  <label>Paciente:</label>
                    <select name="pacientesEdit" id="pacientesEdit" class="custom-select">
                      <option value="Si">Si</option>
                      <option value="No">No</option>
                    </select>
                  <label>Dia No Habil:</label>
                    <input type="text" id="eventoEdit" class="form-control" autocomplete="off">               
              </div>
            </div>
        <div class="modal-footer">
       
          <button type="button" id="btnBorrarEventos" class="btn btn-warning">Borrar Dias No Habiles</button>
          <button type="button" id="btnEditar" class="btn btn-success">Editar</button>
          <button type="button" id="btnBorrar" class="btn btn-danger">Borrar</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
        </div>
      </div>
    </div>
  </div>
</div> 
<script>
$(".alert").alert('close')
  var Medico;
  $("#btnAgregar").click(function(){
    Medico = {
         medNombre:$('#medNombre').val(),
         especialidad:$('#especialidad').val(),
         telefono:$('#telefono').val(),
         intervalo:$('#intervalo').val(),
         pacientes:$('#pacientes').val(),
         id:$('#medID').val(),
         evento: '"' + $('#evento').val() + '"'    
        };
       $.post('altaMedico.php', Medico, function(data, textStatus) {},"json");    
       $('#modalMedicoAlta').modal('toggle');
      location.reload();
      location.reload();
      });


  $("#btnEditar").click(function(){
    if (!$('#eventoEdit').val()) { var evento = null}else{var evento = '"' + $('#eventoEdit').val() + '",'}
      Medico = {
         medNombre:$('#medNombreEdit').val(),
         telefono:$('#telefonoEdit').val(),
         especialidad:$('#especialidadEdit').val(),
         intervalo:$('#intervaloEdit').val(),
         pacientes:$('#pacientesEdit').val(),
         id:$('#medIDedit').val(),
         evento: evento     
        };
       $.post('editarMedico.php', Medico, function(data, textStatus) {
         if (data.encontrado == 1) {
          var mensaje = confirm("El dia Posee Turnos pendientes.\n¿Ver Turnos?");
          //Detectamos si el usuario acepto el mensaje
          if (mensaje) {
            window.open('listadoTurnos.php?fecha='+ data.dia + '&med='+ data.medico);
        }
         } 
       }, "json"); 
       $('#modalEditMed').modal('toggle');
       location.reload();
        location.reload();
  });
  $("#btnBorrar").click(function(){
    Medico = {
         id:$('#medIDedit').val()      
        };
       $.post('bajaMedico.php', Medico, function(data, textStatus) {}, "json");  
       $('#modalDetalles').modal('toggle');
       location.reload();
      location.reload();
  });  
  $("#btnBorrarEventos").click(function(){
    Medico = {
         id:$('#medIDedit').val()      
        };
       $.post('bajaEventos.php', Medico, function(data, textStatus) {}, "json");  
       $('#modalDetalles').modal('toggle');
       location.reload();
      location.reload();
  });                   
</script>