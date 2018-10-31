<?
  $titulo= "ObraSociales";
  require "config/config.php";
  /*require "autenticar.php";*/
  $objObraSocial= new ObraSocial();
  $listado= $objObraSocial->listarObraSocial();
  include 'templates/encabezado.php'; 
  $idModal= "modalObraSocialAlta";
  $tituloModal = "Agregar ObraSocial";
  $modalBody = '<div class="form-row"><div class="form-group"><input type="hidden" id="obID"><label>Razon Social:</label><input type="text" id="rs" class="form-control" autocomplete="off"></div></div>';
  $botonModal= "Agregar";
  include "modal.php";
?>
<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
    <h1 class="h2"><?=$titulo?></h1>
  </div> 
  <div class="table-responsive">
    <?tablaObraSociales($listado);?>
  </div>          
</main>
<? function tablaObraSociales($listado){?>
  <table id="tablaObraSociales" class="table table-striped table-sm">
            <thead>
              <tr>
                <th class="text-center" scope="col">ID</th>
                <th class="text-center" scope="col">Razon Social</th>
                <th class="text-center" scope="col"><img src="imagenes/add.png" data-toggle="modal" data-target="#modalObraSocialAlta"></th>
              </tr>
            </thead>
            <tbody>
            <?foreach( $listado as $fila ){?>
              <tr id="<?=$fila['id']; ?>">
                <th class="text-center" scope="row"><?=$fila['id']; ?></th>
                <td class="text-center"><?=$fila['razonsocial'];?></td>          
                <td class="text-center"><button type="button" id="btnDetalle" class="btn btn-success" onclick="modalEditOb(<?=$fila['id'];?>,'<?=$fila['razonsocial'];?>'); return false">Detalles</button></td>               
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
                <input type="hidden" id="obIDedit" value="">
                  <label>Razon Social:</label>
                    <input type="text" id="rsEdit" class="form-control" autocomplete="off">
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
  var ObraSocial;
  $("#btnAgregar").click(function(){
    ObraSocial = {
         razonsocial:$('#rs').val(),
         id:$('#obID').val()      
        };
       $.post('altaObraSocial.php', ObraSocial, function(data, textStatus) {}, 
        "json");    
       $('#modalObraSocialAlta').modal('toggle');
       location.reload();
location.reload();
      });
  $("#btnEditar").click(function(){
      ObraSocial = {
         razonsocial:$('#rsEdit').val(),
         id:$('#obIDedit').val()      
        };
       $.post('editarObraSocial.php', ObraSocial, function(data, textStatus) {}, "json"); 
       $('#modalDetalles').modal('toggle');
       location.reload();
location.reload();
  });
  $("#btnBorrar").click(function(){
    ObraSocial = {
         razonsocial:$('#rsEdit').val(),
         id:$('#obIDedit').val()      
        };
       $.post('bajaObraSocial.php', ObraSocial, function(data, textStatus) {}, "json"); 
       $('#modalDetalles').modal('toggle');
       location.reload();
location.reload(); 
  });
</script> 