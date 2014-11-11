<?php
	session_start();
	
	if (isset($_SESSION['medewerkernr'])):
		session_destroy();
		header('Location: medewerkers/index.php');
	elseif (isset($_SESSION['klantnr'])):
		session_destroy();
		header('Location: index.php');
	else: header('Location: index.php');
        endif;
?>