<?php
  $titulo= "Turnos";
  /*require "autenticar.php";*/
  require "config/config.php";
  $objMedico= new Medico();
  $listar = $objMedico->listarMedicos();
  include 'templates/encabezado.php';

?>
    <div class="container">
      <div class="row">
        <div class="col"></div>
        <div class="col-7">
          <div class="accordion" id="accordionExample">
             <?php foreach ($listar as $medico) {  ?>
            <div class="card" data-toggle="collapse" data-target="#collapse<?php echo $medico['id'];?>" aria-expanded="true" aria-controls="collapse">
              <div class="card-header" id="heading">
                <h5 class="mb-0">
                  <button class="btn btn-info" type="button">
                    <input id="filtrarMed" type="hidden" value="<?php echo $medico['id'];?>">
                    <?php echo $medico['nombre']; ?>
                  </button>
                </h5>
              </div>
              <div id="collapse<?php echo $medico['id']; ?>" class="collapse" aria-labelledby="heading" data-parent="#accordionExample">
                <div class="card-body">
                 <div id="calendario<?php echo $medico['id']; ?>"></div>
                </div>
              </div>
            </div>
            <?php
            }
            ?>
          </div>
        </div>
        <div class="col"></div>
      </div>
    </div>
    <script src="js/calendario.js"></script>
    <script src="js/calendario1.js"></script>
    <script src="js/calendario2.js"></script>
    <script src="js/calendario3.js"></script>
    
<!-- Modal agregar editar borrar -->
<div class="modal fade" id="modalTurnos" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="tituloTurno"></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <input type="hidden" name="txtID" id="txtID">
          <input type="hidden" name="txtFecha" id="txtFecha">
            <div class="form-row">
              <div id="pacienteAuto" class="form-group col-md-8">
                  <label>Titulo:</label>
                  <input type='text' class='typeahead form-control' id='txtTitulo' placeholder='Buscar Paciente..' autocomplete='off' spellcheck='false'>
                </div>
                 <div class="form-group col-md-4">
                    <label>Hora:</label>
                    <div class="input-group clockpicker" data-autoclose="true">
                    <input type="text" name="txtHora" id="txtHora" value="09:30" class="form-control">
                    </div>
                </div>
                <div class="form-group col-md-8">
                  <label>Descripcion:</label>
                  <textarea id="txtDescripcion" rows="2" class="form-control"></textarea>
                </div>
                <div class="form-group col-md-4">
                   <label>Medico:</label>
                  <select id="medico" name="medico" class="custom-select">
                <?php foreach ($resultado as $medico ) {  ?>
                  <option value="<?php echo $medico['id']; ?>"><?php echo $medico['nombre']; ?></option>
                <?php
                }
                ?>
                  </select>
                </div>           
            </div>
        <div class="modal-footer">
          <button type="button" id="btnAgregar" class="btn btn-success">Agregar</button>
          <button type="button" id="btnModificar" class="btn btn-success">Modificar </button>
          <button type="button" id="btnEliminar" class="btn btn-danger">Borrar</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
        </div>
      </div>
    </div>
  </div>
</div>
    <script>
      var NuevoTurno;
      $('#btnAgregar').click(function(){
        RecolectarDatos();
        EnviarInformacion('agregar',NuevoTurno);
      });
      $('#btnEliminar').click(function(){
        RecolectarDatos();
        EnviarInformacion('eliminar',NuevoTurno);
      });
       $('#btnModificar').click(function(){
        RecolectarDatos();
        EnviarInformacion('modificar',NuevoTurno);
      });
      $('#filtrarMed').on('change',function(){
        medico = $('#filtrarMed').val();
      $('#calendario').fullCalendar('rerenderEvents');        
      });

      function RecolectarDatos(){
        NuevoTurno = {
          id:$('#txtID').val(),
          title:$('#txtTitulo').val(),
          start:$('#txtFecha').val()+" "+$('#txtHora').val(),
          descripcion:$('#txtDescripcion').val(),
          medico:$('#medico').val()        
        };
      }
      function EnviarInformacion(accion,objEvento){        
        $.ajax({
          type:'POST',
          url:'clases/turnos.php?accion='+accion,
          data:objEvento,
          success: function(msg){
            if (msg) {
              $('#calendario').fullCalendar('refetchEvents');
              $('#modalTurnos').modal('toggle');
            }
          },
          error: function(){
            alert("El Horario ya Posee un Turno");
          }
        });
      }
      function filtrarDia(){
         
        switch(medico){
          case 1:return [1,5];
          case 2:return [2,4];
        }
      }
       
   $('.clockpicker').clockpicker();

    function limpiarFormulario(){
        $('#txtDescripcion').val('');
        $('#txtID').val('');
        $('#txtTitulo').val('');
        $('#txtColor').val('');
    }

    
    </script>
 <?php 
  include 'templates/pie.php' 
?>