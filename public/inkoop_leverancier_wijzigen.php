<?php
	require("../includes/layouts/inc_header.php");
	require("../includes/layouts/inc_nav.php");
	
	require("../includes/inc_connect.php");
	require("../includes/inc_functions.php");
	session_start();
	if($_SESSION['functie'] != 'Medewerker inkoop'&&$_SESSION['functie'] != 'Hoofd commerciële afdeling'&&$_SESSION['functie'] != 'Chef de Cuisine') {
		redirect_to("medewerkers/index.php");
	}
?>

<?php
	$select_artikel = "SELECT * FROM leveranciers WHERE lev_nr=". $_POST['lev_nr'] ."";
	$result_artikel = mysqli_query($con, $select_artikel)
		or die("Fout bij select_leveranciers: ".mysqli_error($con));
	
	if(isset($_POST['terug'])):
		header('Location: inkoop.php');
	endif;
	
	if(isset($_POST['opslaan'])) :
		$update = "UPDATE leveranciers SET lev_nr=". $_POST['lev_nr'] .", lev_naam=". $_POST['lev_naam'] .", lev_adres=". $_POST['lev_adres'] .", lev_postcode=". $_POST['lev_postcode'] .", lev_plaats=". $_POST['lev_plaats'] .", lev_telefoonnr=". $_POST['lev_telefoonnr'] .", lev_rekeningnr=". $_POST['lev_rekeningnr'] .", lev_soort=". $_POST['lev_soort'] ." ";
		$update .= "WHERE artikelnr=". $_POST['artikelnr'] ."";
		mysqli_query($con, $update)
			or die("Fout bij insert_into: ".mysqli_error($con));
				
		echo "<b>Toevoegen aan database gelukt!</b>";
	endif;
?>





