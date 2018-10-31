<?
  $titulo= "Especialidad";
  require "config/config.php";
  /*require "autenticar.php";*/
  $objEspecialidad= new Especialidad();
  $listado= $objEspecialidad->listarEspecialidad();
  include 'templates/encabezado.php'; 
  $idModal= "modalEspecialidadAlta";
  $tituloModal = "Agregar Especialidad";
  $modalBody = '<div class="form-row"><div class="form-group"><input type="hidden" id="espID" value=""><label>Nombre:</label><input type="text" id="titulo" class="form-control" autocomplete="off"></div></div>';
  $botonModal= "Agregar";
  include "modal.php";

?>
<script>
  
</script>
<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
    <h1 class="h2"><?=$titulo?></h1>
  </div> 
  <div class="table-responsive">
    <?tablaEspecialidades($listado);?>
  </div>          
</main>
<? function tablaEspecialidades($listado){?>
  <table id="tablaEspecialidades" class="table table-striped table-sm">
            <thead>
              <tr>
                <th class="text-center" scope="col">ID</th>
                <th class="text-center" scope="col">Titulo</th>
                <th class="text-center" scope="col"><img src="imagenes/add.png" data-toggle="modal" data-target="#modalEspecialidadAlta"></th>
              </tr>
            </thead>
            <tbody>
            <?foreach( $listado as $fila ){?>
              <tr id="<?=$fila['id']; ?>">
                <th class="text-center" scope="row"><?=$fila['id']; ?></th>
                <td class="text-center"><?=$fila['titulo'];?></td>          
                <td class="text-center"><button type="button" id="btnDetalle" class="btn btn-success" onclick="modalEditEsp(<?=$fila['id'];?>,'<?=$fila['titulo'];?>'); return false">Detalles</button></td>               
              </tr>
              <?}?>
            </tbody>
          </table>
<?
}
?>
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
                <input type="hidden" id="espIDedit" value="">
                  <label>Titulo:</label>
                    <input type="text" id="tituloEdit" name="tituloEdit" class="form-control" autocomplete="off">
              </div>
            </div>
        <div class="modal-footer">
          <button type="button" id="btnEditar" class="btn btn-success">Editar</button>
          <button type="button" id="btnBorrar" class="btn btn-danger">Borrar</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
        </div>
      </div>
    </div>
  </div>
</div> 
<script>
  var Especialidad;
  $("#btnAgregar").click(function(){
    Especialidad = {
         titulo:$('#titulo').val(),
         id:$('#espID').val()      
        };
       $.post('altaEspecialidad.php', Especialidad, function(data, textStatus) {}, 
        "json");    
       $('#modalEspecialidadAlta').modal('toggle');
        location.reload();
location.reload();
      });
  $("#btnEditar").click(function(){
      Especialidad = {
         titulo:$('#tituloEdit').val(),
         id:$('#espIDedit').val()      
        };
       $.post('editarEspecialidad.php', Especialidad, function(data, textStatus) {}, "json"); 
       $('#modalDetalles').modal('toggle');
        location.reload();
location.reload();
  });
  $("#btnBorrar").click(function(){
    Especialidad = {
         id:$('#espIDedit').val()      
        };
       $.post('bajaEspecialidad.php', Especialidad, function(data, textStatus) {}, "json");     
       $('#modalDetalles').modal('toggle');
        location.reload();
location.reload();
  });
</script> 