<a class="navbar-brand" href="#">Consultorio</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
<div class="collapse navbar-collapse" id="navbarTogglerDemo02">
  <div class="navbar-nav mr-auto mt-2 mt-lg-0 ml-auto text-center">
    <a class="nav-item nav-link" href="listadoTurnos.php?fecha=<?=date("Y-m-d")?>">Turnos</a>
    <a class="nav-item nav-link" href="listadoLiquidaciones.php?fecha=<?=date("Y-m-d")?>">Liquidaciones</a>
    <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle" href="listadoPacientes.php" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      Consultas
      </a>
      <div class="dropdown-menu" aria-labelledby="navbarDropdown">
        <a class="dropdown-item" href="listadoPacientes.php">Pacientes</a>                   
        <a class="dropdown-item" href="listadoMedicos.php">Medicos</a>
        <a class="dropdown-item" href="listadoDiasHabiles.php">Editar Dias Medicos</a> 
        <a class="dropdown-item" href="listadoEspecialidades.php">Especialidades</a>
        <a class="dropdown-item" href="formAltaPaciente.php">Configuraciones</a> 
      </div>
    </li>
      <? if(isset($_SESSION['login'])){ ?>
      <a class="nav-item nav-link" href="logout.php">Salir</a></li>
      <? }else{ ?>
      <a class="nav-item nav-link" href="formLogin.php">Ingresar</a></li>
      <? } ?>
  </div>
</div>