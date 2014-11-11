<?php
	require("../includes/layouts/inc_header.php");
	require("../includes/layouts/inc_nav.php");
	
	require("../includes/inc_connect.php");
	require("../includes/inc_functions.php");
	session_start();
	if($_SESSION['functie'] != 'Medewerker inkoop'&&$_SESSION['functie'] != 'Hoofd commerciele afdeling'&&$_SESSION['functie'] != 'Chef de Cuisine') {
		redirect_to("medewerkers/index.php");
	}
?>
	<h2>Inkoop</h2>
	<a href="inkoop_artikel_toevoegen.php">Artikel toevoegen</a><br />
	<a href="inkoop_recept_toevoegen.php">Recept toevoegen</a><br />
	<a href="inkoop_recept_artikel.php">Toevoegen van artikel aan recept</a><br />
	<a href="inkoop_artikel_voorraad_selecteer.php">Voorraden van artikel bijwerken</a><br />
	<a href="inkoop_bestellen_leverancier.php">Bestellen bij leverancier</a><br/>
	<a href="inkoop_betalingen.php">Controleer betalingen</a><br/>
<?php
	require("../includes/layouts/inc_footer.php");
?>