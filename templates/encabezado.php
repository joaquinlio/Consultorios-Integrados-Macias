<!doctype html>
<html lang="en">
  <head>
    <title><?=$titulo?></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/jquery-ui.min.css">
    <link rel="stylesheet" href="css/iconos.min.css">
    <link rel="stylesheet" href="css/bootstrap-clockpicker.css">
    <link href="css/dashboard.css" rel="stylesheet">
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/jquery-ui.min.js"></script>
    <script src="js/modalTurnos.js"></script>
    <script src="js/iconos.min.js"></script>
    <script src="js/bootstrap-clockpicker.js"></script>
    <script src="js/typeahead.min.js"></script>
    <!--Fullcalendar--> 
    <link href='css/fullcalendar.min.css' rel='stylesheet' />
    <link href='css/fullcalendar.print.min.css' rel='stylesheet' media='print' />
    <link href='css/scheduler.min.css' rel='stylesheet' />
    <script src='js/moment.min.js'></script>
    <script src='js/fullcalendar.min.js'></script>
    <script src='js/scheduler.min.js'></script>
    <script src="js/es.js"></script>
    <script>
     $.datepicker.regional['es'] = {
     closeText: 'Cerrar',
     prevText: '< Ant',
     nextText: 'Sig >',
     currentText: 'Hoy',
     monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
     monthNamesShort: ['Ene','Feb','Mar','Abr', 'May','Jun','Jul','Ago','Sep', 'Oct','Nov','Dic'],
     dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
     dayNamesShort: ['Dom','Lun','Mar','Mié','Juv','Vie','Sáb'],
     dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sá'],
     weekHeader: 'Sm',
     dateFormat: 'yy-mm-dd',
     firstDay: 1,
     isRTL: false,
     showMonthAfterYear: false,
     yearSuffix: ''
     };
     $.datepicker.setDefaults($.datepicker.regional['es']);
</script>
  </head>
<body>
    <nav class="navbar navbar-dark fixed-top bg-dark flex-md-nowrap p-0 shadow">
      <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="#"><h6>Integrados Macias CIM</h6></a>
      <ul class="nav nav-pills col-2">
          <li class="nav-item dropdown">
            <? if(isset($_SESSION['login'])){ ?>
            <img src="imagenes/iconUser.png" alt="">
           <button class="btn btn-outline-light" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false"><?=$_SESSION['login']?></button>
            <div class="dropdown-menu">
              <a class="dropdown-item" href="logout.php">Cerrar Sesion</a>          
            </div>
            <? }else{ ?>
            <a class="dropdown-item" href="formLogin.php">Ingresar</a>
            <?} ?>
          </li>
        </ul>  
    </nav>
<div class="container-fluid">
    <div class="row">
        <nav class="col-md-2 d-none d-md-block bg-light sidebar">
            <div class="sidebar-sticky">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link"  data-toggle="collapse" href="#collapseTurnos" role="button" aria-expanded="false" aria-controls="collapseTurnos">
                            <span data-feather="home"></span>
                            <i class="fas fa-file-medical fa-2x"></i>
                            Turnos <span class="sr-only">(current)</span>
                        </a>
                    </li>
                    <div class="collapse" id="collapseTurnos">
                        <div class="card card-body">
                            <a class="nav-link" href="listadoTurnosMed.php?fecha=<?=date("Y-m-d")?>">
                                <span data-feather="file"></span>
                                Todos Los medicos
                            </a>
                            <a class="nav-link" href="listadoTurnos.php?fecha=<?=date("Y-m-d")?>">
                                <span data-feather="file"></span>
                               Medicos Hoy
                            </a>                          
                        </div>
                    </div>
                   <?if ($_SESSION['login'] == 'admin') { ?>  
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="collapse" href="#collapseMedicos" role="button" aria-expanded="false" aria-controls="collapseMedicos">
                            <span data-feather="file"></span>
                            <i class="fas fa-user-md fa-2x"></i>
                        Medicos
                        </a>
                    </li>
                    <div class="collapse" id="collapseMedicos">
                        <div class="card card-body">
                            <a class="nav-link" href="listadoMedicos.php">
                                <span data-feather="file"></span>
                                Gestionar Medicos
                            </a>
                            <a class="nav-link" href="listadoDiasHabiles.php">
                                <span data-feather="file"></span>
                                Cambiar Dias Laborales
                            </a>
                            <a class="nav-link" href="listadoPrecios.php">
                                <span data-feather="file"></span>
                                Cambiar Tarifas
                            </a>
                            <a class="nav-link" href="listadoConsultorios.php">
                                <span data-feather="file"></span>
                                Horarios Consultorios
                            </a>

                        </div>
                    </div> 
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="collapse" href="#collapsePacientes" role="button" aria-expanded="false" aria-controls="collapsePacientes">
                            <span data-feather="file"></span>
                            <i class="fas fa-address-card fa-2x"></i>
                            Pacientes
                        </a>
                    </li>
                    <div class="collapse" id="collapsePacientes">
                        <div class="card card-body">
                            <a class="nav-link" href="listadoPacientes.php">
                                <span data-feather="file"></span>
                                Gestionar Pacientes
                            </a>                          
                        </div>
                    </div> 
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="collapse" href="#collapseEspecialidades" role="button" aria-expanded="false" aria-controls="collapseEspecialidades">
                            <span data-feather="shopping-cart"></span>
                            <i class="fas fa-microscope fa-2x"></i>
                            Especialidades
                        </a>
                    </li>
                    <div class="collapse" id="collapseEspecialidades">
                        <div class="card card-body">
                            <a class="nav-link" href="listadoEspecialidades.php">
                                <span data-feather="file"></span>
                                Gestionar Especialidades
                            </a>                          
                        </div>
                    </div> 
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="collapse" href="#collapseObraSociales" role="button" aria-expanded="false" aria-controls="collapseObraSociales">
                            <span data-feather="shopping-cart"></span>
                            <i class="fas fa-user-friends fa-2x"></i>
                            Obra Sociales
                        </a>
                    </li>
                    <div class="collapse" id="collapseObraSociales">
                        <div class="card card-body">
                            <a class="nav-link" href="listadoObrasociales.php">
                                <span data-feather="file"></span>
                                Gestionar Obra Sociales
                            </a>                          
                        </div>
                    </div>             
                </ul>
                <?} ?>
                <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
                    <span>Liquidaciones</span>
                    <a class="d-flex align-items-center text-muted" href="#">
                        <span data-feather="plus-circle"></span>
                    </a>
                </h6>
                <ul class="nav flex-column mb-2">
                    <li class="nav-item">
                        <a class="nav-link" href="listadoLiquidaciones.php?fecha=<?=date("Y-m-d")?>">
                        <span data-feather="file-text"></span>
                        <i class="fas fa-calculator fa-1x"></i>
                        Realizar Liquidacion
                        </a>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
</div>        
        