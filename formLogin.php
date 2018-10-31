<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Inicio De Sesion</title>
	   <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/jquery-ui.min.css">
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery-ui.min.js"></script>
    <link href="css/signin.css" rel="stylesheet">
  </head>
<style>
  body{
  background-image: url(imagenes/fondo.jpg) ;
  background-size: 100% 100%;
  background-attachment: fixed; 
}
</style>
  <body class="text-center">
    <form class="form-signin" action="login.php" method="post">
      <h1 class="display-3">Integrados Macias</h1>
      <h1 class="h3 mb-3 font-weight-normal">Iniciar Sesion</h1>
      <input type="text" id="usuLogin" name="usuLogin" class="form-control" placeholder="Nombre De Usuario" required autofocus autocomplete="off">
      <input type="password" id="usuClave" name="usuClave" class="form-control" placeholder="Contraseña" required autocomplete="off">
      <? 
		if (isset($_GET["error"])) {
		?>
    <h5 class="mb-3 font-weight-normal">Usuario y/o clave incorrectos</h5>
		<?
		}
		?>
      <button class="btn btn-lg btn-primary btn-block" type="submit">Iniciar Sesion</button>
      <p class="mt-5 mb-3 text-muted">&copy; Joaquin Lio 2018-2019</p>
    </form>
  </body>
</html>

