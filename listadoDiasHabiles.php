<?
  $titulo= "Dias Habiles";
  require "config/config.php";
  $objMedico= new Medico();
  $listadoMed= $objMedico->listarMedicos();
  $objDiaHabil= new diaHabil();
  
 include 'templates/encabezado.php'; 
?>
<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
    <h1 class="h2"><?=$titulo?></h1>
  </div> 
    <div class="accordion" id="accordionExample">
      <?foreach ($listadoMed as $key => $value) {?>  
    <div class="card">
      <div class="card-header" id="heading" class="card" data-toggle="collapse" data-target="#collapse<?=$value["id"];?>" aria-expanded="true" aria-controls="collapse">
      <h5 class="mb-0"><?=$value['medNombre'];?><input type="hidden" id="medID" value="<?=$value["id"];?>"></h5>
    </div>
      <div id="collapse<?=$value["id"];?>" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
        <div class="card-body">
          <?
          $listado= $objDiaHabil->listarDiasHabilesPorMedico($value["id"]);
          tablaDiasHabiles($listado,$value["medNombre"],$value["id"])
          ?>
        </div>
      </div>
    </div>
    <?}?>  
    </div>      
</main>
<? function tablaDiasHabiles($listado,$medNombre,$medID){?>
    <table id="tablaDiasHabiles" class="table table-striped table-sm">
      <thead>
        <tr>
          <th scope="col" class="text-center">Dia De La Semana</th>
          <th scope="col" class="text-center">Hora Desde</th>
          <th scope="col" class="text-center">Hora Hasta</th>
          <th scope="col" class="text-center"><img src="imagenes/add.png" onclick="modalAltaDia('<?=$medNombre?>',<?=$medID?>); return false"></th>     
        </tr>
      </thead>
      <tbody> 
        <?foreach( $listado as $value ){?>              
        <tr>
        <td id="<?=$value['diasemana'];?>" class="text-center"><?
                switch ($value['diasemana']) {
                  case '1':
                    echo "Lunes";
                    break;
                  case '2':
                    echo "Martes";
                    break;
                  case '3':
                    echo "Miercoles";
                    break;  
                  case '4':
                    echo "Jueves";
                    break;
                  case '5':
                    echo "Viernes";
                    break;
                  case '6':
                    echo "Sabado";
                    break;    
                }?></td>
        <td class="text-center"><?=($value['horadesde'] == 0) ? "No Asignado" : $value['horadesde'] ;?></td>  
        <td class="text-center"><?=($value['horahasta'] == 0) ? "No Asignado" : $value['horahasta'] ;?></td>         
        <td class="text-center"><button type="button" id="btnDetalle" class="btn btn-success" onclick="modalEditDias('<?=$medNombre;?>',<?=$value['medico']?>,<?=$value['diasemana'];?>,<?=$value['horadesde'];?>,<?=$value['horahasta'];?>); return false">Detalles</button></td>              
        </tr>
        <?
        }
        ?>
      </tbody>
    </table>
<?
}
?>

<div class="modal fade" id="modalDiaAlta" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="">Nuevo Dia Habil</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
           <div class="form-row">
              <div class="form-group">
                <input type="hidden" name="medicoID" id="medicoID">
                <label>Medico:</label>
                <input type="text" id="medico" class="form-control" autocomplete="off">
                <label>Dia Semana:</label>
                <select class="custom-select" id="diasemana">
                  <option value="1">Lunes</option>
                  <option value="2">Martes</option>
                  <option value="3">Miercoles</option>
                  <option value="4">Jueves</option>
                  <option value="5">Viernes</option>
                  <option value="6">Sabado</option>
                </select>
                <label>Hora Desde:</label>
                <select class="custom-select" id="horadesde">
                  <option value="09">09:00</option>
                  <? for($a=10;$a<=21;$a++){?>                     
                      <option value="<?=$a?>"><?=$a?>:00</option>
                  <?}?>
                </select>     
                <label>Hora Hasta:</label>
                <select class="custom-select" id="horahasta">
                  <option value="09">09:00</option>
                  <? for($a=10;$a<=21;$a++){?>                     
                      <option value="<?=$a?>"><?=$a?>:00</option>
                  <?}?>
                </select>
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
                <input type="hidden" id="medicoIDDet">
                <label>Medico:</label>        
                <input type="text" id="medicoDet" class="form-control" autocomplete="off">
                <label>Dia Semana:</label>
                <select class="custom-select" id="diasemanaDet">
                  <option value="1">Lunes</option>
                  <option value="2">Martes</option>
                  <option value="3">Miercoles</option>
                  <option value="4">Jueves</option>
                  <option value="5">Viernes</option>
                  <option value="6">Sabado</option>
                </select>
                <label>Hora Desde:</label>
                <select class="custom-select" id="horadesdeDet">
                  <option value="0">No Asignado</option>
                  <option value="09">09:00</option>
                  <? for($a=10;$a<=18;$a++){?>                     
                      <option value="<?=$a?>"><?=$a?>:00</option>
                  <?}?>
                </select>     
                <label>Hora Hasta:</label>
                <select class="custom-select" id="horahastaDet">
                    <option value="0">No Asignado</option>
                    <option value="09">09:00</option>
                  <? for($a=10;$a<=18;$a++){?>                     
                      <option value="<?=$a?>"><?=$a?>:00</option>
                  <?}?>
                </select>
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
  var diaHabil;
  $("#btnAgregar").click(function(){
    diaHabil = {
        medico:$('#medicoID').val(),
        diasemana:$('#diasemana').val(),
        diaedit:$('#dia').val(),
        horadesde:$('#horadesde').val(),
        horahasta:$('#horahasta').val()       
        };
        //alert(diaHabil.horadesde);
       $.post('altaDiaHabil.php', diaHabil, function(data, textStatus) {}, 
        "json");
        location.reload();
        location.reload();      
       $('#modalDiaAlta').modal('toggle');
      });

  $("#btnEditar").click(function(){
      diaHabil = {
        medico:$('#medicoIDDet').val(),
        diasemana:$('#diasemanaDet').val(),
        horadesde:$('#horadesdeDet').val(),
        horahasta:$('#horahastaDet').val()      
        };
        //alert(diaHabil.medico+" "+diaHabil.diasemana+" "+diaHabil.horadesde+" "+diaHabil.horahasta)
       $.post('editarDiaHabil.php', diaHabil, function(data, textStatus) {}, "json");            
       $('#modalDetalles').modal('toggle');
       location.reload();
        location.reload();
  });


  $("#btnBorrar").click(function(){
    diaHabil = {
        medico:$('#medicoID').val(),
        diaedit:$('#diaedit').val()       
        };
       $.post('bajaDiaHabil.php', diaHabil, function(data, textStatus) {}, "json");
       $('#modalDetalles').modal('toggle');
       location.reload();
        location.reload();
  });
</script>