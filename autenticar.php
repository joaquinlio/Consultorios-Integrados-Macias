<?
	if (!isset($_SESSION['login'])) {
		header("location:formLogin.php?error=2");
	}
	/*if ($_SESSION['login'] != 'admin') {
		//echo "no sos admin";
		 //header('location: listadoTurnos.php?fecha='.date("Y-m-d"));
	}*/
 ?>