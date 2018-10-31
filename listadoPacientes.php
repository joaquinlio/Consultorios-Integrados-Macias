<?php
  $titulo= "Pacientes";
  require "config/config.php";
  /*require "autenticar.php";*/
  $objPacientes= new Paciente();
  $listado= $objPacientes->listarPacientes();
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
  <div class="table-responsive-sm">
  <?tablaPacientes($listado);?>
  </div>          
</main>

<? function tablaPacientes($listado){?>
  <table id="tablaPacientes" class="table table-striped table-sm">
            <thead>
              <tr class="text-center">
                <th class="text-center align-middle" scope="col">Nombre</th>
                <th class="text-center align-middle" scope="col">ObraSocial</th>
                <th class="text-center align-middle" scope="col">DNI</th>
                <th class="text-center align-middle" scope="col">Telefono</th>
                <th class="text-center align-middle" scope="col">Email</th>
                <th class="text-center align-middle" scope="col"><img src="imagenes/add.png" data-toggle="modal" data-target="#modalPacienteAlta"></th>
              </tr>
            </thead>
            <tbody>
            <?php 
              foreach( $listado as $fila ){ 
            ?>
              <tr id="<?=$fila['id']; ?>">
                <th class="text-center align-middle" scope="row"><?=$fila['pacNombre'];?></th>
                <td class="text-center align-middle"><?=$fila['razonsocial'];?></td>
                <td class="text-center align-middle"><?=$fila['dni'];?></td>
                <td class="text-center align-middle"><?=$fila['telefono'];?></td>
                <td class="text-center align-middle"><?=$fila['email'];?></td>        
                <td><button type="button" id="btnDetalle" class="btn btn-success" onclick="modalEditPac(<?=$fila['id'];?>,'<?=$fila['pacNombre'];?>',<?=$fila['dni'];?>,<?=$fila['idOB'];?>,<?=$fila['telefono'];?>,'<?=$fila['email'];?>'); return false">Detalles</button></td>               
              </tr>
              <?php } ?>
            </tbody>
          </table>
<?
}
?>
<div class="modal fade" id="modalPacienteAlta" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title col-5" id="">Agregar Paciente</h5>
      </div>
      <div class="modal-body">
       <div class="form-row">
        <div class="form-group col-6">
          <input type="hidden" id="pacID" value="">
          <label>Nombre:</label>
            <input type="text" id="pacNombre" name="pacNombre" class="form-control" autocomplete="off">
          <label>DNI:</label>
            <input type="text" id="dni" name="dni" class="form-control" autocomplete="off">
          <label>Obra Social:</label>
          <select name="obrasocial" id="obrasocial" name="obrasocial" class="custom-select"><?=$obrasociales?></select>             
        </div>
        <div class="form-group col-6">
          <label>Telefono:</label>
            <input type="text" name="telefono" id="telefono" class="form-control" autocomplete="off">
          <label>Email:</label>
            <input type="text" class="form-control" id="email" name="email" autocomplete="off">  
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
              <div class="form-group col-6">
                <input type="hidden" id="pacIDEdit" name="pacIDEdit" value="">
                  <label>Nombre:</label>
                    <input type="text" id="pacNombreEdit" name="pacNombreEdit" class="form-control" autocomplete="off">
                  <label>DNI:</label>
                    <input type="text" id="dniEdit" name="dniEdit" class="form-control" autocomplete="off">
                  <label>Obra Social:</label>
                    <select name="obrasocialEdit" id="obrasocialEdit" class="custom-select"><?=$obrasociales?></select>
              </div>
              <div class="form-group col-6">
                <label>Telefono:</label>
                  <input type="text" name="telefonoEdit" id="telefonoEdit" class="form-control" autocomplete="off">
                <label>Email:</label>
                  <input type="text" class="form-control" id="emailEdit" name="emailEdit" autocomplete="off">  
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
  var Paciente;
  $("#btnAgregar").click(function(){
    Paciente = {
         pacNombre:$('#pacNombre').val(),
         id:$('#pacID').val(),
         dni:$('#dni').val(),
         obrasocial:$('#obrasocial').val(),
         telefono:$('#telefono').val(),
         email:$('#email').val()      
        };
       $.post('altaPaciente.php', Paciente, function(data, textStatus) {}, 
        "json");       
       $('#modalPacienteAlta').modal('toggle');
       location.reload();
      location.reload();
      });
  $("#btnEditar").click(function(){
      Paciente = {
         pacNombre:$('#pacNombreEdit').val(),
         id:$('#pacIDEdit').val(),
         dni:$('#dniEdit').val(),
         obrasocial:$('#obrasocialEdit').val(),
         telefono:$('#telefonoEdit').val(),
         email:$('#emailEdit').val()       
        };
        //alert(Paciente.pacNombre+" "+Paciente.id+" "+Paciente.dni+" "+Paciente.obrasocial+" "+Paciente.telefono+" "+Paciente.email);
       $.post('editarPaciente.php', Paciente, function(data, textStatus) {}, 
        "json");      
       $('#modalDetalles').modal('toggle');
       location.reload();
      location.reload();
  });


  $("#btnBorrar").click(function(){
    Paciente = {
         id:$('#pacIDEdit').val()      
        };
       $.post('bajaPaciente.php', Paciente, function(data, textStatus) {}, "json");
       
       $('#modalDetalles').modal('toggle');
       location.reload();
location.reload();
  });
</script>