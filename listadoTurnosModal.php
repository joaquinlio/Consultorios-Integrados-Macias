<div class="modal fade" id="modalTurnoAlta" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title col-5" id="">Agregar Turno</h5>
        <input type="search" name="buscar" id='buscar' class="form-control col-5" placeholder="Buscar Por DNI" autocomplete="off">
        <button type="button" id="buscador" class="btn btn-outline-success my-2 my-sm-0">Buscar</button>
      </div>
      <div class="modal-body">
        <div class="form-row">
          <div class="form-group col-6">
            <input type="hidden" name="medID" id="medID">
            <input type="hidden" name="pacNombreID" id="pacNombreID">
            <fieldset disabled>        
            <label>Fecha:</label>
              <input type="text" name="fecha" id="fecha" class="form-control">
            </fieldset>
            <label>Horario:</label>          
              <input type="text" class="form-control" name="horario" id="horario">
            <label>Medico:</label>   
              <input type="text" class="form-control" name="medico" id="medico">
            <label>Especialidad:</label>   
              <input type="text" class="form-control" name="especialidad" id="especialidad">
            <label>Monto:</label>
              <input type='text' name="monto" id='monto' class="form-control" autocomplete="off">
            <label>Adicional:</label>
              <input type='text' name="adcional" id='adcional' class="form-control" autocomplete="off">                             
          </div>
          <div class="form-group col-6">            
            <label>Nombre: </label>
              <input type='text' name="pacNombre" id='pacNombre' class="form-control" autocomplete="off">
            <label>Obra Social:</label>
              <select name="obrasocial" id="obrasocial" class="custom-select">
              </select>
            <label>DNI:</label>
             <input type='text' name="dni" id='dni' class="form-control" autocomplete="off">
            <label>Telefono:</label>
              <input type='text' name="telefono" id='telefono' class="form-control" autocomplete="off">
            <label>Email:</label>
              <input type='text' name="email" id='email' class="form-control" autocomplete="off">
            <label>Observacion:</label>
              <input type='text' name="observacion" id='observacion' class="form-control" autocomplete="off">               
          </div>             
        </div>
        <div class="modal-footer">
          <button type="button" id="btnAgregarPacNuevo" class="btn btn-outline-info col-4">Agregar Paciente</button>        
          <button type="button" id="btnAgregar" class="btn btn-outline-success col-4">Agregar Turno</button>
          <button type="button" id="btnCancelar" class="btn btn-outline-secondary col-4" data-dismiss="modal">Cancelar</button>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="modalDetalles" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
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
            <input type="hidden" id="idTurno" name="idTurno">
            <input type="hidden" name="medIDDet" id="medIDDet">
            <input type="hidden" id="pacID" name="pacID">
            <input type="hidden" id="pago" name="pago">     
              <label>Fecha:</label>
                <input type="text" name="fechaDet" id="fechaDet" class="form-control">            
            <label>Horario:</label>                      
                <select name="horarioDet" id="horarioDet" class="custom-select">                              
                </select>            
            <label>Medico:</label>   
              <input type="text" class="form-control" name="medicoDet" id="medicoDet">
            <label>Especialidad:</label>   
              <input type="text" class="form-control" name="especialidadDet" id="especialidadDet">  
            <label>Monto:</label>         
              <input type='text' name="montoDet" id='montoDet' class="form-control" autocomplete="off">
            <label>Adicional:</label>
              <input type='text' name="adcionalDet" id='adcionalDet' class="form-control" autocomplete="off">              
          </div>
          <div class="form-group col-6">
            <label>Nombre:</label>
              <input type='text' name="pacNombreDet" id='pacNombreDet' class="form-control">
            <label>Obra Social:</label>
              <input type='text' name="obrasocialDet" id='obrasocialDet' class="form-control" autocomplete="off">
            <label>DNI:</label>
              <input type="text" class="form-control" name="dniDet" id="dniDet" autocomplete="off">
            <label>Telefono:</label>
              <input type='text' name="telefonoDet" id='telefonoDet' class="form-control" autocomplete="off">
            <label>Email:</label>
              <input type="text" class="form-control" name="emailDet" id="emailDet" autocomplete="off">
            <label>Observacion:</label>
              <input type='text' name="observacionDet" id='observacionDet' class="form-control" autocomplete="off">                           
          </div>
            
        </div>
        <div class="modal-footer">
          <button type="button" id="btnPagar" class="btn tooltip-test col-2" title="Realizar Pago">Realizar Pago</button>
          <button type="button" id="btnEditar" class="btn btn-outline-success col-3">Editar Turno</button>
          <button type="button" id="btnBorrar" class="btn btn btn-outline-danger col-3">Borrar</button>
          <button type="button" id="btnCancelarDet" class="btn btn-outline-secondary" data-dismiss="modal">Cancelar</button>
        </div>
      </div>
    </div>
  </div>
</div> 
<div class="modal fade" id="modalSobreTurnoAlta" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title col-5" id="">Agregar Sobre Turno</h5>
        <input type="search" name="buscarST" id='buscarST' class="form-control col-5" placeholder="Buscar Por DNI" autocomplete="off">
        <button type="button" id="buscadorST" class="btn btn-outline-success my-2 my-sm-0">Buscar</button>
      </div>
      <div class="modal-body">
        <form class="needs-validation" novalidate>
          <div class="form-row">
            <div class="form-group col-6">
              <input type="hidden" name="medIDST" id="medIDST">
              <input type="hidden" name="pacNombreIDST" id="pacNombreIDST"> 
              <fieldset disabled>
                <label>Fecha:</label>
                  <input type="text" name="fechaST" id="fechaST" class="form-control">
              </fieldset>    
              <label>Horario:</label>          
                <div class="input-group clockpicker" data-autoclose="true">
                  <input type="text" name="horarioST" id="horarioST" class="form-control">
                </div>
              <label>Medico:</label>   
                <input type="text" class="form-control" name="medicoST" id="medicoST">
              <label>Especialidad:</label>   
                <input type="text" class="form-control" name="especialidadST" id="especialidadST">
              <label>Monto:</label>
                <input type='text' name="montoST" id='montoST' class="form-control" autocomplete="off">
              <label>Adicional:</label>
              <input type='text' name="adcionalST" id='adcionalST' class="form-control" autocomplete="off">                                
            </div>
            <div class="form-group col-6">
              <label>Nombre:</label>
                <input type='text' name="pacNombreST" id='pacNombreST' class="form-control" autocomplete="off">
              <label>Obra Social:</label>
                <select name="obrasocialST" id="obrasocialST" class="custom-select"></select>
              <label>DNI:</label>
               <input type='text' name="dniST" id='dniST' class="form-control" autocomplete="off">
              <label>Telefono:</label>
                <input type='text' name="telefonoST" id='telefonoST' class="form-control" autocomplete="off">
              <label>Email:</label>
                <input type='text' name="emailST" id='emailST' class="form-control" autocomplete="off">
              <label>Observacion:</label>
                <input type='text' name="observacionST" id='observacionST' class="form-control" autocomplete="off">          
            </div>             
          </div>
      </form>
        <div class="modal-footer">
          <button type="button" id="btnAgregarPacNuevoST" class="btn btn-outline-info">Agregar Paciente</button>
          <button type="submit" id="btnAgregarST" class="btn btn-outline-success">Agregar Turno</button>
          <button type="button" id="btnCancelar" class="btn btn-outline-secondary" data-dismiss="modal">Cancelar</button>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="modalDetallesST" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
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
            <input type="hidden" id="idTurnoST" name="idTurnoST">
            <input type="hidden" name="medIDDetST" id="medIDDetST">
            <input type="hidden" id="pacIDST" name="pacIDST">
            <input type="hidden" id="pagoST" name="pagoST">
            <fieldset disabled>
              <label>Fecha:</label>
                <input type="text" name="fechaDetST" id="fechaDetST" class="form-control">
            </fieldset>    
            <label>Horario:</label>                      
                <div class="input-group clockpicker" data-autoclose="true">
                  <input type="text" name="horarioDetST" id="horarioDetST" class="form-control">
                </div>            
            <label>Medico:</label>   
              <input type="text" class="form-control" name="medicoDetST" id="medicoDetST">
            <label>Especialidad:</label>   
              <input type="text" class="form-control" name="especialidadDetST" id="especialidadDetST">  
            <label>Monto:</label>         
              <input type='text' name="montoDetST" id='montoDetST' class="form-control" autocomplete="off">
            <label>Adicional:</label>
              <input type='text' name="adcionalDetST" id='adcionalDetST' class="form-control" autocomplete="off">     
            
          </div>
          <div class="form-group col-6">
            <label>Nombre:</label>
              <input type='text' name="pacNombreDetST" id='pacNombreDetST' class="form-control">
            <label>Obra Social:</label>
              <input type='text' name="obrasocialDetST" id='obrasocialDetST' class="form-control" autocomplete="off">
            <label>DNI:</label>
              <input type="text" class="form-control" name="dniDetST" id="dniDetST" autocomplete="off">
            <label>Telefono:</label>
              <input type='text' name="telefonoDetST" id='telefonoDetST' class="form-control" autocomplete="off">
            <label>Email:</label>
              <input type="text" class="form-control" name="emailDetST" id="emailDetST" autocomplete="off">
            <label>Observacion:</label>
                <input type='text' name="observacionDetST" id='observacionDetST' class="form-control" autocomplete="off">                         
          </div>     
        </div>
        <div class="modal-footer">
          <button type="button" id="btnPagarST" class="btn tooltip-test col-2" title="Realizar Pago">Realizar Pago</button>
          <button type="button" id="btnEditarST" class="btn btn-outline-success col-3">Editar Turno</button>
          <button type="button" id="btnBorrarST" class="btn btn btn-outline-danger col-3">Borrar</button>
          <button type="button" id="btnCancelar" class="btn btn-outline-secondary" data-dismiss="modal">Cancelar</button>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="modalDatos" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="">Datos</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <table class="table table-bordered table-sm">
          <thead>
            <tr>
              <th scope="col" class="text-center">Obra Social</th>
              <th scope="col" class="text-center">Monto</th>
            </tr>
          </thead>
          <tbody id="bodyDatos" class="text-center">

          </tbody>
        </table>
        <div class="modal-footer">
          <button type="button" id="btnCancelar" class="btn btn-outline-secondary" data-dismiss="modal">Cancelar</button>
        </div>
      </div>
    </div>
  </div>
</div>  
<script>
    var Turno;
    var Paciente;
    var buscador;
    var selectHorarios;
    $("#modalDetalles").on('hidden.bs.modal', function () {
      $('#pacNombreDet').val('');
      $('#obrasocialDet').val('');
      $('#dniDet').val('');
      $('#telefonoDet').val('');
      $('#emailDet').val('');      
      $('#fechaDet').val('');
      //$('select option').remove();
      $('#horarioDet').empty();
      $('#medIDDet').val('');
      $('#pacID').val('');
      $('#montoDet').val('');
      $('#adcionalDet').val('');
      $('#observacionDet').val('');
    });
    $("#modalTurnoAlta").on('hidden.bs.modal', function () {
       $('#pacNombre').val('');
      $('#obrasocial').val('');
      $('#dni').val('');
      $('#telefono').val('');
      $('#email').val('');      
      $('#fecha').val('');
      $('#horario').val('');
      $('#medID').val('');
      $('#pacNombreID').val('');
      $('#monto').val('');
      $('#buscar').val('');
      $('#adcional').val('');
      $('#observacion').val('');
    });

    $("#btnAgregarPacNuevo").click(function(){
     Paciente = {
      pacNombre:$('#pacNombre').val(),
      obrasocial:$('#obrasocial').val(),
      dni:$('#dni').val(),
      telefono:$('#telefono').val(),
      email:$('#email').val()      
      };
    $.post('altaPaciente.php', Paciente, function(data, textStatus) {
      if (textStatus === 'success') {
        $('#pacNombreID').val(data.id);
        alert("Se Agrego Nuevo Paciente");
      }           
    },"json").fail( function(data) {
      alert("El Paciente Ya Existe");
      });
  });
  $("#btnAgregar").click(function(){
    Turno = {
      dia:$('#fecha').val()+ " " +$('#horario').val() ,
      medico:$('#medID').val(),
      paciente : $('#pacNombreID').val(),
      monto:$('#monto').val(),
      adicional:$('#adcional').val(),
      observacion:$('#observacion').val() 
    };
    //alert(Turno.dia+" "+ Turno.medico+" "+ Turno.paciente+" "+Turno.monto+" "+Turno.adicional+" "+Turno.observacion);
    $.post('altaTurno.php', Turno, function(data, textStatus) {},"json"); 
    $('#modalTurnoAlta').modal('toggle');
    location.reload();         location.reload();
  
  });
  $("#modalTurnoAlta").keypress(function (e) {
    if (e.which == 13) {
      Turno = {
      dia:$('#fecha').val()+ " " +$('#horario').val() ,
      medico:$('#medID').val(),
      paciente : $('#pacNombreID').val(),
      monto:$('#monto').val(),
      adicional:$('#adcional').val(),
      observacion:$('#observacion').val() 
    };
    //alert(Turno.dia+" "+ Turno.medico+" "+ Turno.paciente+" "+Turno.monto+" "+Turno.adicional+" "+Turno.observacion);
    $.post('altaTurno.php', Turno, function(data, textStatus) {},"json"); 
    $('#modalTurnoAlta').modal('toggle');
  location.reload();         location.reload();
    }
  });

  $("#btnBorrar").click(function(){
    Turno = {
      id:$('#idTurno').val()    
    };
   $.post('bajaTurno.php', Turno, function(data, textStatus) {},"json");
    $('#modalTurnoDetalles').modal('toggle');
  location.reload();         location.reload();
  
  });

$("#btnEditar").click(function(){
  var selected = $('#selected').val();
  if (!$('#horarioDet').val()) { var horario = selected}else{var horario = $('#horarioDet').val()}
    Turno = {
      id:$('#idTurno').val(),
      paciente:$('#pacID').val(),
      dia:$('#fechaDet').val()+" "+horario,
      monto:$('#montoDet').val(),
      adicional:$('#adcionalDet').val(),
      observacion:$('#observacionDet').val()  
    };
//alert(Turno.dia);
   $.post('editarTurno.php', Turno, function(data, textStatus) {},"json");
    $('#modalTurnoDetalles').modal('toggle');
    location.reload();         location.reload();
    
  });
  $("#modalDetalles").keypress(function (e) {
    if (e.which == 13) {
          var selected = $('#selected').val();
      if (!$('#horarioDet').val()) { var horario = selected}else{var horario = $('#horarioDet').val()}
        Turno = {
          id:$('#idTurno').val(),
          paciente:$('#pacID').val(),
          dia:$('#fechaDet').val()+" "+horario,
          monto:$('#montoDet').val(),
          adicional:$('#adcionalDet').val(),
          observacion:$('#observacionDet').val()  
        };
    //alert(Turno.dia);
      $.post('editarTurno.php', Turno, function(data, textStatus) {},"json");
        $('#modalTurnoDetalles').modal('toggle');
        location.reload();         location.reload();
    
    }
  });
$("#btnAgregarPacNuevoST").click(function(){
     Paciente = {
      pacNombre:$('#pacNombreST').val(),
      obrasocial:$('#obrasocialST').val(),
      dni:$('#dniST').val(),
      telefono:$('#telefonoST').val(),
      email:$('#emailST').val(),      
      };
    $.post('altaPaciente.php', Paciente, function(data, textStatus) {
      if (textStatus === 'success') {
        $('#pacNombreIDST').val(data.id);
        alert("Se Agrego Nuevo Paciente");
      }           
    },"json").fail( function(data) {
      alert("El Paciente Ya Existe");
      });
   
      
  });
$("#btnAgregarST").click(function(){
    Turno = {
      dia:$('#fechaST').val()+ " " +$('#horarioST').val() ,
      medico:$('#medIDST').val(),
      paciente:$('#pacNombreIDST').val(),
      monto:$('#montoST').val(),
      adicional:$('#adcionalST').val(),
      observacion:$('#observacionST').val()      
    };
   $.post('altaTurno.php', Turno, function(data, textStatus) {},"json");
    $('#modalSobreTurnoAlta').modal('toggle');
    location.reload();         location.reload();
    
  });
  $("#modalSobreTurnoAlta").keypress(function (e) {
    if (e.which == 13) {
    Turno = {
      dia:$('#fechaST').val()+ " " +$('#horarioST').val() ,
      medico:$('#medIDST').val(),
      paciente:$('#pacNombreIDST').val(),
      monto:$('#montoST').val(),
      adicional:$('#adcionalST').val(),
      observacion:$('#observacionST').val()      
    };
   $.post('altaTurno.php', Turno, function(data, textStatus) {},"json");
    $('#modalSobreTurnoAlta').modal('toggle');
    location.reload();         location.reload();
    }
  });

  $("#btnBorrarST").click(function(){
    Turno = {
      id:$('#idTurnoST').val()    
    };
   $.post('bajaTurno.php', Turno, function(data, textStatus) {},"json");
    $('#modalTurnoDetalles').modal('toggle');
   location.reload();         location.reload();
  });

$("#btnEditarST").click(function(){
    Turno = {
      id:$('#idTurnoST').val(),
      paciente:$('#pacIDST').val(),
      dia:$('#fechaDetST').val()+" "+$('#horarioDetST').val(),
      monto:$('#montoDetST').val(),
      adicional:$('#adcionalDetST').val(),
      observacion:$('#observacionDetST').val()  
    };
//alert(Turno.id+" "+ Turno.paciente+" "+ Turno.dia+" "+Turno.monto+" "+Turno.adicional+" "+Turno.observacion);
   $.post('editarTurno.php', Turno, function(data, textStatus) {},"json");
    $('#modalTurnoDetalles').modal('toggle');
   location.reload();         location.reload();
  
  });
  $("#modalDetallesST").keypress(function (e) {
    if (e.which == 13) {
    Turno = {
      id:$('#idTurnoST').val(),
      paciente:$('#pacIDST').val(),
      dia:$('#fechaDetST').val()+" "+$('#horarioDetST').val(),
      monto:$('#montoDetST').val(),
      adicional:$('#adcionalDetST').val(),
      observacion:$('#observacionDetST').val()  
    };
//alert(Turno.id+" "+ Turno.paciente+" "+ Turno.dia+" "+Turno.monto+" "+Turno.adicional+" "+Turno.observacion);
   $.post('editarTurno.php', Turno, function(data, textStatus) {},"json");
    $('#modalTurnoDetalles').modal('toggle');
   location.reload();         location.reload();
    }
  });
$("#buscador").click(function(){
       buscador = {
          dni:$('#buscar').val(),
          medico:$('#medID').val()
      }; 
    $.post('buscador.php', buscador, function(data, textStatus) {
      //data contains the JSON object
      //textStatus contains the status: success, error, etc
      if(textStatus=="success"){
        $("#pacNombreID").val(data.pacNombreID);
        $("#pacNombre").val(data.pacNombre);
        $("#obrasocial").val(data.obrasocialID);
        $("#dni").val(data.dni);
        $("#telefono").val(data.telefono);
        $("#monto").val(data.monto);
        $("#email").val(data.email);
      }else{
        alert("no anda");
      }
    }, 
    "json");    
  });
$("#btnBorrarST").click(function(){
    Turno = {
      id:$('#idTurnoST').val()    
    };
   $.post('bajaTurno.php', Turno, function(data, textStatus) {},"json");
    $('#modalTurnoDetallesST').modal('toggle');
  location.reload();         location.reload();
  });
$("#buscadorST").click(function(){
       buscador = {
          dni:$('#buscarST').val(),
          medico:$('#medIDST').val()
      }; 
    $.post('buscador.php', buscador, function(data, textStatus) {
      //data contains the JSON object
      //textStatus contains the status: success, error, etc
      if(textStatus=="success"){
        $("#pacNombreIDST").val(data.pacNombreID);
        $("#pacNombreST").val(data.pacNombre);
        $("#obrasocialST").val(data.obrasocialID);
        $("#dniST").val(data.dni);
        $("#telefonoST").val(data.telefono);
        $("#montoST").val(data.monto);
        $("#emailST").val(data.email);
      }else{
        alert("no anda");
      }
    }, 
    "json");    
  });
$("#fechaDet").on("change",function(){
    selectHorarios = {
          fecha: $('#fechaDet').val(),
          medico: $('#medIDDet').val()
      }; 
      //alert(selectHorarios.fecha+" "+selectHorarios.medico);
    $.post('buscadorSelectHorarios.php', selectHorarios, function(data, textStatus) {
      if(textStatus=="success"){
        //$('#horarioDet').empty();     
        $("#horarioDet").html('<option id="selected" disabled selected>Selecionar Horario</option>'+data);
      }else{
        alert("no anda");
      }
    }, 
    "json");
});
$("#obrasocial").on("change",function(){
  var buscadorOb = {
          obrasocial:$('#obrasocial').val(),
          medico:$('#medID').val()
      }; 
    $.post('buscadorConOb.php', buscadorOb, function(data, textStatus) {
      if(textStatus=="success"){
        $("#monto").val(data.monto);
      }else{
        alert("no anda");
      }
    }, 
    "json"); 
});
$("#obrasocialST").on("change",function(){
  var buscadorObST = {
          obrasocial:$('#obrasocialST').val(),
          medico:$('#medIDST').val()
      }; 
    $.post('buscadorConOb.php', buscadorObST, function(data, textStatus) {
      //data contains the JSON object
      //textStatus contains the status: success, error, etc
      if(textStatus=="success"){
        $("#montoST").val(data.monto);
      }else{
        alert("no anda");
      }
    }, 
    "json"); 
});
 $("#btnPagar").click(function(){
  var selected = $('#selected').val();
  if (!$('#horarioDet').val()) { var horario = selected}else{var horario = $('#horarioDet').val()}
    Pagar = {
      id:$('#idTurno').val(),
      medico:$('#medIDDet').val(),
      paciente:$('#pacID').val(),
      dia:$('#fechaDet').val()+" "+horario,
      monto:$('#montoDet').val(),
      adicional:$('#adcionalDet').val(),
      observacion:$('#observacionDet').val()
    };
  //alert(Pagar.dia);
   $.post('realizarPago.php', Pagar, function(data, textStatus) {
    alert("Se Realizo el Pago Correspondiente");
    },"json");
  $('#modalTurnoDetalles').modal('toggle');
   location.reload();         location.reload();
  });
$("#btnPagarST").click(function(){
    Pagar = {
      id:$('#idTurnoST').val(),
      medico:$('#medIDDetST').val(),
      paciente:$('#pacIDST').val(),
      dia:$('#fechaDetST').val()+" "+$('#horarioDetST').val(),
      monto:$('#montoDetST').val()
    };
    alert("Se Realizo el Pago Correspondiente");
    //alert(Pagar.id+" "+ Pagar.medico+" "+ Pagar.paciente+" "+Pagar.dia+" "+Pagar.monto);
   $.post('realizarPago.php', Pagar, function(data, textStatus) {
      //data contains the JSON object
      //textStatus contains the status: success, error, etc
    }, 
    "json");
  $('#modalTurnoDetallesST').modal('toggle');
  location.reload();         location.reload();
  });
</script>