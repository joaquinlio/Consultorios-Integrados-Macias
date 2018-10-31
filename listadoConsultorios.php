<?
require "config/config.php";
require "autenticar.php";
require "listadoTurnosFunc.php";
$titulo = "Consultorios";
include 'templates/encabezado.php';
?>
<style>
.fc-title{
    font-size: 200%;
    font-weight: bold;
}
span{
    font-size: 150%;
    font-weight: bold;
}
</style>
<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h2><?=$titulo?></h2>    
  </div>
  <div class="accordion" id="accordionExample">
    <div class="card">
        <div class="card-header" id="headingOne" data-toggle="collapse" data-target="#consultorioLun" aria-expanded="true" aria-controls="consultorioLun">
        <h5 class="mb-0">Lunes</h5>
        </div>
        <div id="consultorioLun" class="collapsing" aria-labelledby="headingOne" data-parent="#accordionExample"></div>
    </div>
  </div>
  <div class="card">
        <div class="card-header" id="headingOne" data-toggle="collapse" data-target="#consultorioMar" aria-expanded="true" aria-controls="consultorioMar">
        <h5 class="mb-0">Martes</h5>
        </div>
        <div id="consultorioMar" class="collapsing" aria-labelledby="headingOne" data-parent="#accordionExample">
        </div>
    </div>
    <div class="card">
        <div class="card-header" id="headingOne"  data-toggle="collapse" data-target="#consultorioMie" aria-expanded="true" aria-controls="consultorioMie">
        <h5 class="mb-0">Miercoles
        </div>
        <div id="consultorioMie" class="collapsing" aria-labelledby="headingOne" data-parent="#accordionExample">
        </div>
    </div>
    <div class="card">
        <div class="card-header" id="headingOne" data-toggle="collapse" data-target="#consultorioJue" aria-expanded="true" aria-controls="consultorioJue">
        <h5 class="mb-0">Jueves</h5>
        </div>
        <div id="consultorioJue" class="collapsing" aria-labelledby="headingOne" data-parent="#accordionExample">
        </div>
    </div>
    <div class="card">
        <div class="card-header" id="headingOne" data-toggle="collapse" data-target="#consultorioVie" aria-expanded="true" aria-controls="consultorioVie">
        <h5 class="mb-0">Viernes</h5>
        </div>
        <div id="consultorioVie" class="collapsing" aria-labelledby="headingOne" data-parent="#accordionExample">
        </div>
    </div>
    <div class="card">
        <div class="card-header" id="headingOne" data-toggle="collapse" data-target="#consultorioSab" aria-expanded="true" aria-controls="consultorioSab">
        <h5 class="mb-0">Sabado</h5>
        </div>
        <div id="consultorioSab" class="collapsing" aria-labelledby="headingOne" data-parent="#accordionExample">
        </div>
    </div>
</main>
<div class="modal fade" id="horarioNuevo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="">Nuevo Horario</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-row">
                    <input type="hidden" id="diasemana">
                    <input type="hidden" id="medID">
                    <label>Consultorio:</label>
                    <select name="consultorio" id="consultorio" class="custom-select">
                    <option value="1">Consultorio1</option>
                    <option value="2">Consultorio2</option>
                    <option value="3">Consultorio3</option>
                    <option value="4">Consultorio4</option>
                    </select>
                    <label>Medico</label>
                    <input class="form-control" type="text" id="BuscarMed" name="BuscarMed" autocomplete="off" placeholder="Buscar Medico">
                    <label>Hora Desde:</label>
                        <input type="text" name="horadesde" id="horadesde" class="form-control">
                        <label>Hora Hasta:</label>
                        <input type="text" name="horahasta" id="horahasta" class="form-control">
                </div>
                <div class="modal-footer">
                    <button type="button" id="btnAgregar" class="btn btn-outline-success">Agregar Horario</button>
                    <button type="button" id="btnCancelar" class="btn btn-outline-secondary" data-dismiss="modal">Cancelar</button>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="horarioEdit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="">Editar Horario</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <div class="form-row">
                    <input type="hidden" id="diasemanaEdit">
                    <input type="hidden" id="medIDEdit">
              <label>Consultorio:</label>
                <select name="consultorioEdit" id="consultorioEdit" class="custom-select">
                    <option value="1">Consultorio1</option>
                    <option value="2">Consultorio2</option>
                    <option value="3">Consultorio3</option>
                    <option value="4">Consultorio4</option>
                </select>
            <label>Medico</label>
                <input type="text" name="medNombre" id="medNombre" class="form-control">
                <label>Hora Desde:</label>
                <input type="text" name="horadesdeEdit" id="horadesdeEdit" class="form-control">
                <label>Hora Hasta:</label>
                <input type="text" name="horahastaEdit" id="horahastaEdit" class="form-control"> 
        </div>
        <div class="modal-footer">
        <button type="button" id="btnEditar" class="btn btn-outline-success">Editar Horario</button>
          <button type="button" id="btnBorrar" class="btn btn btn-outline-danger">Borrar Horario</button>
          <button type="button" id="btnCancelar" class="btn btn-outline-secondary" data-dismiss="modal">Cancelar</button>
        </div>
      </div>
    </div>
  </div>
</div>    
<script>
    $( document ).ready(function() {
        $("#btnAgregar").click(function(){
        consultorios = {
        medico:$('#medID').val(),
        consultorio:$('#consultorio').val(),
        diasemana:$('#diasemana').val(),  
        };
        //alert(consultorios.medico+" "+ consultorios.consultorio+" "+ consultorios.diasemana);
        $.post('agregarHorario.php', consultorios, function(data, textStatus) {},"json"); 
        $('#horarioNuevo').modal('toggle');
        location.reload();  location.reload();
        });
        $("#btnEditar").click(function(){
        consultorios = {
        medico:$('#medIDEdit').val(),
        consultorio:$('#consultorioEdit').val(),
        diasemana:$('#diasemanaEdit').val(),  
        };
        $.post('agregarHorario.php', consultorios, function(data, textStatus) {},"json");
        $('#horarioEdit').modal('toggle');
        location.reload();  location.reload();
        });
        $("#btnBorrar").click(function(){
        consultorios = {
        medico:$('#medIDEdit').val(),
        consultorio:0,
        diasemana:$('#diasemanaEdit').val(),  
        };
        $.post('agregarHorario.php', consultorios, function(data, textStatus) {},"json");
        $('#horarioEdit').modal('toggle');
        location.reload();  location.reload();
        });
        $('#BuscarMed').typeahead({
        hint: true,
        highlight: true,
        minLength: 1, 
        source: function(query, result)
        {
        $.ajax({
            url:"medicosJson.php",
            method:"POST",
            data:{query:query},
            dataType:"json",
            success:function(data)
            {
            result($.map(data, function(item){
            return item;
            }));
            }
        })
        }
        });
        $("#BuscarMed").keypress(function (e) {
            if (e.which == 13) {
            medico = {
                query:$('#BuscarMed').val(),
                diasemana:$('#diasemana').val()
            };
            $.post('medJsonCon.php', medico, function(data, textStatus){
                //alert(data.horadesde+ " " + data.horahasta);
                $('#medID').val(data.id);
                $('#horahasta').val(data.horahasta);
                $('#horadesde').val(data.horadesde);
            },"json");
            }
        });
        $('#medNombre').typeahead({
        hint: true,
        highlight: true,
        minLength: 1, 
        source: function(query, result)
        {
        $.ajax({
            url:"medicosJson.php",
            method:"POST",
            data:{query:query},
            dataType:"json",
            success:function(data)
            {
            result($.map(data, function(item){
            return item;
            }));
            }
        })
        }
        });
        $("#medNombre").keypress(function (e) {
            if (e.which == 13) {
            medico = {
                query:$('#medNombre').val(),
                diasemana:$('#diasemanaEdit').val()
            };
            $.post('medJsonCon.php', medico, function(data, textStatus){
                //alert(data.horadesde+ " " + data.horahasta);
                $('#medIDEdit').val(data.id);
                $('#horahastaEdit').val(data.horahasta);
                $('#horadesdeEdit').val(data.horadesde);
            },"json");
            }
        });
    $('#consultorioLun').fullCalendar({
        schedulerLicenseKey: 'CC-Attribution-NonCommercial-NoDerivatives',
        defaultView: 'agendaDay', 
        height: 'auto',
        defaultDate: '2018-04-07',
        slotDuration: '00:60:00',
        minTime: "09:00:00",
        maxTime: "22:00:00",
        header: {
            left: '',
            center: '',
            right: ''
        },
        allDaySlot: false,
        resources: [
            { id: '1', title: 'Consultorio 1'},
            { id: '2', title: 'Consultorio 2'},
            { id: '3', title: 'Consultorio 3'},
            { id: '4', title: 'Consultorio 4'}
        ],
        events:<?obtenerConsultorios(1);?>,
        dayClick: function(date, jsEvent, view, resource) {
            dia = 1;
            hora = date.format().substr(-8,2)
            $('#consultorio').val(resource.id);
            $('#diasemana').val(dia);
            $('#horarioNuevo').modal();
        },
        eventClick:function(calEvent,jsEvent,view){
            dia= 1;
            horadesde =  calEvent.start._i.substr(-2,2)
            horahasta =  calEvent.end._i.substr(-2,2)
            $('#consultorioEdit').val(calEvent.resourceId);
            $('#horadesdeEdit').val(horadesde);
            $('#horahastaEdit').val(horahasta);
            $('#medNombre').val(calEvent.title);
            $('#medIDEdit').val(calEvent.id);
            $('#diasemanaEdit').val(dia);
            $('#horarioEdit').modal();
            }
        });
        
        $('#consultorioMar').fullCalendar({
    schedulerLicenseKey: 'CC-Attribution-NonCommercial-NoDerivatives',
        defaultView: 'agendaDay', height: 'auto',
        defaultDate: '2018-04-07',
        slotDuration: '01:00:00',
        minTime: "09:00:00",
        maxTime: "22:00:00",
        header: {
            left: '',
            center: '',
            right: ''
        },
        allDaySlot: false,
        resources: [
            { id: '1', title: 'Consultorio 1'},
            { id: '2', title: 'Consultorio 2'},
            { id: '3', title: 'Consultorio 3'},
            { id: '4', title: 'Consultorio 4'}
        ],
        events:<?obtenerConsultorios(2);?>,
        dayClick: function(date, jsEvent, view, resource) {
            dia = 2;
            hora = date.format().substr(-8,2)
            $('#consultorio').val(resource.id);
            $('#diasemana').val(dia);
            $('#horarioNuevo').modal();
        },
        eventClick:function(calEvent,jsEvent,view){
            dia= 2;
            horadesde =  calEvent.start._i.substr(-2,2)
            horahasta =  calEvent.end._i.substr(-2,2)
            $('#consultorioEdit').val(calEvent.resourceId);
            $('#horadesdeEdit').val(horadesde);
            $('#horahastaEdit').val(horahasta);
            $('#medNombre').val(calEvent.title);
            $('#medIDEdit').val(calEvent.id);
            $('#diasemanaEdit').val(dia);
            $('#horarioEdit').modal();
            }
        });
        $('#consultorioMie').fullCalendar({
    schedulerLicenseKey: 'CC-Attribution-NonCommercial-NoDerivatives',
        defaultView: 'agendaDay', height: 'auto',
        defaultDate: '2018-04-07',
        slotDuration: '01:00:00',
        minTime: "09:00:00",
        maxTime: "22:00:00",
        header: {
            left: '',
            center: '',
            right: ''
        },
        allDaySlot: false,
        resources: [
            { id: '1', title: 'Consultorio 1'},
            { id: '2', title: 'Consultorio 2'},
            { id: '3', title: 'Consultorio 3'},
            { id: '4', title: 'Consultorio 4'}
        ],
        events:<?obtenerConsultorios(3);?>,
        dayClick: function(date, jsEvent, view, resource) {
            dia = 3;
            hora = date.format().substr(-8,2)
            $('#consultorio').val(resource.id);
            $('#diasemana').val(dia);
            $('#horarioNuevo').modal();
        },
        eventClick:function(calEvent,jsEvent,view){
            dia= 3;
            horadesde =  calEvent.start._i.substr(-2,2)
            horahasta =  calEvent.end._i.substr(-2,2)
            $('#consultorioEdit').val(calEvent.resourceId);
            $('#horadesdeEdit').val(horadesde);
            $('#horahastaEdit').val(horahasta);
            $('#medNombre').val(calEvent.title);
            $('#medIDEdit').val(calEvent.id);
            $('#diasemanaEdit').val(dia);
            $('#horarioEdit').modal();
            }
        });
        $('#consultorioJue').fullCalendar({
    schedulerLicenseKey: 'CC-Attribution-NonCommercial-NoDerivatives',
        defaultView: 'agendaDay', height: 'auto',
        defaultDate: '2018-04-07',
        slotDuration: '01:00:00',
        minTime: "09:00:00",
        maxTime: "22:00:00",
        header: {
            left: '',
            center: '',
            right: ''
        },
        allDaySlot: false,
        resources: [
            { id: '1', title: 'Consultorio 1'},
            { id: '2', title: 'Consultorio 2'},
            { id: '3', title: 'Consultorio 3'},
            { id: '4', title: 'Consultorio 4'}
        ],
        events:<?obtenerConsultorios(4);?>,
        dayClick: function(date, jsEvent, view, resource) {
            dia = 4;
            hora = date.format().substr(-8,2)
            $('#consultorio').val(resource.id);
            $('#diasemana').val(dia);
            $('#horarioNuevo').modal();
        },
        eventClick:function(calEvent,jsEvent,view){
            dia= 4;
            horadesde =  calEvent.start._i.substr(-2,2)
            horahasta =  calEvent.end._i.substr(-2,2)
            $('#consultorioEdit').val(calEvent.resourceId);
            $('#horadesdeEdit').val(horadesde);
            $('#horahastaEdit').val(horahasta);
            $('#medNombre').val(calEvent.title);
            $('#medIDEdit').val(calEvent.id);
            $('#diasemanaEdit').val(dia);
            $('#horarioEdit').modal();
            }
        });
        $('#consultorioVie').fullCalendar({
    schedulerLicenseKey: 'CC-Attribution-NonCommercial-NoDerivatives',
        defaultView: 'agendaDay', height: 'auto',
        defaultDate: '2018-04-07',
        slotDuration: '01:00:00',
        minTime: "09:00:00",
        maxTime: "22:00:00",
        header: {
            left: '',
            center: '',
            right: ''
        },
        allDaySlot: false,
        resources: [
            { id: '1', title: 'Consultorio 1'},
            { id: '2', title: 'Consultorio 2'},
            { id: '3', title: 'Consultorio 3'},
            { id: '4', title: 'Consultorio 4'}
        ],
        events:<?obtenerConsultorios(5);?>,
        dayClick: function(date, jsEvent, view, resource) {
            dia = 5;
            hora = date.format().substr(-8,2)
            $('#consultorio').val(resource.id);
            $('#diasemana').val(dia);
            $('#horarioNuevo').modal();
        },
        eventClick:function(calEvent,jsEvent,view){
            dia= 5;
            horadesde =  calEvent.start._i.substr(-2,2)
            horahasta =  calEvent.end._i.substr(-2,2)
            $('#consultorioEdit').val(calEvent.resourceId);
            $('#horadesdeEdit').val(horadesde);
            $('#horahastaEdit').val(horahasta);
            $('#medNombre').val(calEvent.title);
            $('#medIDEdit').val(calEvent.id);
            $('#diasemanaEdit').val(dia);
            $('#horarioEdit').modal();
            }
        });
        $('#consultorioSab').fullCalendar({
    schedulerLicenseKey: 'CC-Attribution-NonCommercial-NoDerivatives',
        defaultView: 'agendaDay', height: 'auto',
        defaultDate: '2018-04-07',
        slotDuration: '01:00:00',
        minTime: "09:00:00",
        maxTime: "22:00:00",
        header: {
            left: '',
            center: '',
            right: ''
        },
        allDaySlot: false,
        resources: [
            { id: '1', title: 'Consultorio 1'},
            { id: '2', title: 'Consultorio 2'},
            { id: '3', title: 'Consultorio 3'},
            { id: '4', title: 'Consultorio 4'}
        ],
        events:<?obtenerConsultorios(6);?>,
        dayClick: function(date, jsEvent, view, resource) {
            dia = 6;
            hora = date.format().substr(-8,2)
            $('#consultorio').val(resource.id);
            $('#diasemana').val(dia);
            $('#horarioNuevo').modal();
        },
        eventClick:function(calEvent,jsEvent,view){
            dia= 6;
            horadesde =  calEvent.start._i.substr(-2,2)
            horahasta =  calEvent.end._i.substr(-2,2)
            $('#consultorioEdit').val(calEvent.resourceId);
            $('#horadesdeEdit').val(horadesde);
            $('#horahastaEdit').val(horahasta);
            $('#medNombre').val(calEvent.title);
            $('#medIDEdit').val(calEvent.id);
            $('#diasemanaEdit').val(dia);
            $('#horarioEdit').modal();
            }
        });
});
</script>