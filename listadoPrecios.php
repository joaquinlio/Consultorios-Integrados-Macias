<?
  $titulo= "Precios";
  require "config/config.php";
  require "listadoTurnosFunc.php";
  $objPrecios= new Precios();
  $objObraSocial= new ObraSocial();
  $listadoOb= $objObraSocial->listarObraSocial();
  $obrasociales = NULL;
  foreach ($listadoOb as $key => $value) {
    $obrasociales .= '<option value='.$value["id"].'>'.$value['razonsocial'].'</option>';
  }
  include 'templates/encabezado.php'; 
?>
<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
    <h1 class="h2"><?=$titulo?></h1>
  </div> 
    <div class="accordion" id="accordionExample">
      <?foreach ($listadoOb as $key => $value) {?>  
    <div class="card">
      <div class="card-header" id="heading" class="card" data-toggle="collapse" data-target="#collapse<?=$value["id"];?>" aria-expanded="true" aria-controls="collapse">
      <h5 class="mb-0"><?=$value['razonsocial'];?><input type="hidden" id="obID" value="<?=$value["id"];?>"></h5>
    </div>
      <div id="collapse<?=$value["id"];?>" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
        <div class="card-body">
          <?
          $listado= $objPrecios->listarPrecios($value["id"]);
          tablaPrecios($listado)
          ?>
        </div>
      </div>
    </div>
    <?}?>  
    </div>      
</main>
<? function tablaPrecios($listado){?>
    <table id="tablaPrecios" class="table table-striped table-sm">
      <thead>
        <tr>
          <th scope="col" class="text-center">Medico</th>
          <th scope="col" class="text-center">Monto</th>
          <th scope="col" class="text-center"><img src="imagenes/add.png" onclick="modalAltaPr('<?=selectMedicos()?>'); return false"></th>     
        </tr>
      </thead>
      <tbody> 
        <?foreach( $listado as $fila ){?>              
        <tr>
        <td class="text-center"><?=$fila['medNombre'];?></td>
        <td class="text-center"><?=$fila['monto'];?></td>          
        <td class="text-center"><button type="button" id="btnDetalle" class="btn btn-success" onclick="modalEditPr(<?=$fila['idPrecio'];?>,<?=$fila['medico']?>,<?=$fila['obID'];?>,<?=$fila['monto'];?>); return false">Detalles</button></td>              
        </tr>
        <?
        }
        ?>
      </tbody>
    </table>
<?
}
?>
<div class="modal fade" id="modalPreciosAlta" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title col-5" id="">Agregar Precios</h5>
      </div>
      <div class="modal-body">
        <div class="form-row">
          <div class="form-group">
            <label>Medico:</label>
            <select name="medico" id="medico" class="custom-select"><?=selectMedicos()?>
            </select>
            <label>Obra Social:</label>
            <select name="obrasocial" id="obrasocial" class="custom-select"><?=$obrasociales?>
            </select>
            <label>Monto:</label>
            <input type="text" id="monto" class="form-control" autocomplete="off">
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
                <input type="hidden" id="idPrecioEdit" name="idPrecioEdit">
                  <label>Medico:</label>
                    <select name="medEdit" id="medEdit" name="medEdit" class="custom-select"><?=selectMedicos()?></select>
                  <label>Obra Social:</label>
                  <select name="obrasocialEdit" id="obrasocialEdit" class="custom-select"><?=$obrasociales?></select>
                  <label>Monto:</label>
                    <input type="text" id="montoEdit" name="montoEdit" class="form-control" autocomplete="off">    
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
  var Precios;
  $("#btnAgregar").click(function(){
    Precios = {
         medico:$('#medico').val(),
         obrasocial:$('#obrasocial').val(),
         monto:$('#monto').val()      
        };
       $.post('altaPrecios.php', Precios, function(data, textStatus) {}, 
        "json");    
       $('#modalPreciosAlta').modal('toggle');
       location.reload();
location.reload();
      });
  $("#btnEditar").click(function(){
       Precios = {
        idPrecio:$('#idPrecioEdit').val(),
         medico:$('#medEdit').val(),
         obrasocial:$('#obrasocialEdit').val(),
         monto:$('#montoEdit').val()      
        };
       $.post('editarPrecios.php', Precios, function(data, textStatus) {}, "json"); 
       $('#modalDetalles').modal('toggle');
       location.reload();
location.reload();
  });
  $("#btnBorrar").click(function(){
    Precios = {
         idPrecio:$('#idPrecioEdit').val()      
        };
       $.post('bajaPrecios.php', Precios, function(data, textStatus) {}, "json"); 
       $('#modalDetalles').modal('toggle');
       location.reload();
location.reload(); 
  });
</script> 