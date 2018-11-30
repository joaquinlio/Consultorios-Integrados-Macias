function modalTurnoAlta(horario,medID,fecha,medico,obrasocial,medEsp){
    //$("#fecha").unbind();
    $("#fecha").val(fecha);
    $("#obrasocial").html("<option>Selecione Una ObraSocial</option>"+ obrasocial);
    $("#horario").val(horario);
    $("#medID").val(medID);
    $("#medico").val(medico);
    $("#especialidad").val(medEsp);
    $("#modalTurnoAlta").modal('show');                        
  }
  function modalTurnoDetalles(hora,horario,medID,medico,fecha,paciente,pacienteID,idTurno,obrasocial,dni,telefono,monto,boton,pago,medEsp,diasHabiles,email,adicional,observacion){
    $("#fechaDet").datepicker('destroy');
    $("#fechaDet").val(fecha);
    $("#horarioDet").append('<option id="selected" disabled selected>Selecionar Horario</option>'+horario);
    $("#selected").val(hora);
    $("#medIDDet").val(medID);
    $("#medicoDet").val(medico);
    $("#especialidadDet").val(medEsp);
    $("#pacNombreDet").val(paciente);
    $("#pacID").val(pacienteID);
    $("#obrasocialDet").val(obrasocial);
    $("#dniDet").val(dni);
    $("#telefonoDet").val(telefono);
    $("#montoDet").val(monto);
    $("#emailDet").val(email);
    $("#adcionalDet").val(adicional);
    $("#observacionDet").val(observacion);
    $("#idTurno").val(idTurno);
    $("#pago").val(pago);
    $("#btnPagar").removeClass();
    $("#btnPagar").addClass(boton);
    $( "#fechaDet" ).datepicker({ 
      showOtherMonths: true,
      selectOtherMonths: true,
      minDate: 0,           
      beforeShowDay: function(date) {
        var day = date.getDay();
        var dias;
        var array = Array.from(diasHabiles);        
        if (!array[1]) {
          dias = [( day !=  0  && day != array[0])];
        }else{
          dias = [( day !=  0  && day != array[0] && day != array[1])];
        }
        if (!array[2]) {
          dias = [( day !=  0  && day != array[0] && day != array[1])];
        }else{
          dias = [( day !=  0  && day != array[0] && day != array[1] && day != array[2])];
        }
        if (!array[3]) {
          dias = [( day !=  0  && day != array[0] && day != array[1] && day != array[2])];
        }else{
          dias = [( day !=  0  && day != array[0] && day != array[1] && day != array[2] && day != array[3])];
        }
        if (!array[4]) {
          dias = [( day !=  0  && day != array[0] && day != array[1] && day != array[2] && day != array[3])];
        }else{
          dias = [( day !=  0  && day != array[0] && day != array[1] && day != array[2] && day != array[3] && day != array[4])];
        }
        if (!array[5]) {
          dias = [( day !=  0  && day != array[0] && day != array[1] && day != array[2] && day != array[3] && day != array[4])];
        }else{
          dias = [( day !=  0  && day != array[0] && day != array[1] && day != array[2] && day != array[3] && day != array[4] && day != array[5])];
        }
     return dias;
      }                        
    });
    $("#modalDetalles").modal('show');
  }
  function modalSobreTurnoAlta(fecha,medico,medID,medEsp,obrasocial){
    $("#fechaST").val(fecha);
    $("#obrasocialST").html("<option>Selecione Una ObraSocial</option>"+ obrasocial);
    $("#medIDST").val(medID);
    $("#medicoST").val(medico);
    $("#especialidadST").val(medEsp);
    $('.clockpicker').clockpicker();
    $("#modalSobreTurnoAlta").modal('show');
  }
  function modalTurnoDetallesST(horario,medID,medico,fecha,paciente,pacienteID,idTurno,obrasocial,dni,telefono,monto,boton,pago,medEsp,email){
    $("#fechaDetST").val(fecha);
    $("#horarioDetST").val(horario);
    $("#medIDDetST").val(medID);
    $("#medicoDetST").val(medico);
    $("#especialidadDetST").val(medEsp);
    $("#pacNombreDetST").val(paciente);
    $("#pacIDST").val(pacienteID);
    $("#obrasocialDetST").val(obrasocial);
    $("#dniDetST").val(dni);
    $("#telefonoDetST").val(telefono);
    $("#montoDetST").val(monto);
    $("#emailDetST").val(email);
    $("#idTurnoST").val(idTurno);
    $("#pagoST").val(pago);
    $("#btnPagarST").removeClass();
    $("#btnPagarST").addClass(boton);
    $('.clockpicker').clockpicker();
    $("#modalDetallesST").modal('show');
  }
  function modalMedicoAlta(medEsp){
    $("#especialidad").html(medEsp);
    $("#modalMedicoAlta").modal('show');
  }
  function modalAltaPr(medico){
    $("#medico").html(medico);
    $("#modalPreciosAlta").modal('show');
  }
  function modalAltaDia(medico,medID){
    $("#medicoID").val(medID);
    $("#medico").val(medico);
    $("#modalDiaAlta").modal('show');
  }

  
  function modalEditMed(id,Nombre,telefono,medEsp,intervalo,diasHabiles,pacientes){
    $("#eventoEdit").datepicker('destroy');
    $("#medIDedit").val(id);
    $("#medNombreEdit").val(Nombre);
    $("#especialidadEdit").html(medEsp);
    $("#intervaloEdit").val(intervalo);
    $("#telefonoEdit").val(telefono);
    $("#pacientesEdit").html(pacientes);
    $("#eventoEdit").datepicker({
        showOtherMonths: true,
        selectOtherMonths: true,
        minDate: 0,
        beforeShowDay: function(date) {
          var day = date.getDay();
          var dias;
          var array = Array.from(diasHabiles);        
          if (!array[1]) {
            dias = [( day !=  0  && day != array[0])];
          }else{
            dias = [( day !=  0  && day != array[0] && day != array[1])];
          }
          if (!array[2]) {
            dias = [( day !=  0  && day != array[0] && day != array[1])];
          }else{
            dias = [( day !=  0  && day != array[0] && day != array[1] && day != array[2])];
          }
          if (!array[3]) {
            dias = [( day !=  0  && day != array[0] && day != array[1] && day != array[2])];
          }else{
            dias = [( day !=  0  && day != array[0] && day != array[1] && day != array[2] && day != array[3])];
          }
          if (!array[4]) {
            dias = [( day !=  0  && day != array[0] && day != array[1] && day != array[2] && day != array[3])];
          }else{
            dias = [( day !=  0  && day != array[0] && day != array[1] && day != array[2] && day != array[3] && day != array[4])];
          }
          if (!array[5]) {
            dias = [( day !=  0  && day != array[0] && day != array[1] && day != array[2] && day != array[3] && day != array[4])];
          }else{
            dias = [( day !=  0  && day != array[0] && day != array[1] && day != array[2] && day != array[3] && day != array[4] && day != array[5])];
          }
       return dias;
        }                               
    });
    $("#modalDetalles").modal('show');

  }
  function modalEditPac(id,Nombre,dni,obrasocial,telefono,email){

    $("#pacIDEdit").val(id);
    $("#pacNombreEdit").val(Nombre);
    $("#dniEdit").val(dni);
    $("#obrasocialEdit").val(obrasocial);
    $("#telefonoEdit").val(telefono);
    $("#emailEdit").val(email);
    $("#modalDetalles").modal('show');

  }
  function modalEditEsp(id,Nombre){

    $("#espIDedit").val(id);
    $("#tituloEdit").val(Nombre);
    $("#modalDetalles").modal('show');

  }
  function modalEditOb(id,Nombre){

    $("#obIDedit").val(id);
    $("#rsEdit").val(Nombre);
    $("#modalDetalles").modal('show');

  }
  function modalEditPr(idPrecio,medico,obID,monto){

    $("#idPrecioEdit").val(idPrecio);
    $("#medEdit").val(medico);
    $("#obrasocialEdit").val(obID);
    $("#montoEdit").val(monto);
    $("#modalDetalles").modal('show');

  }
  function modalEditDias(medico,medicoID,diasemana,horadesde,horahasta){
    $('#medicoDet').val(medico),
    $('#medicoIDDet').val(medicoID),
    $('#diasemanaDet').val(diasemana),
    $('#diaedit').val(diasemana),
    $('#horadesdeDet').val(horadesde),
    $('#horahastaDet').val(horahasta)  
    $("#modalDetalles").modal('show');
  }
  function modalDatos(tabla){
    $("#bodyDatos").html(tabla);
    $("#modalDatos").modal('show');
  }
