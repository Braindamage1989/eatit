<?php
	require("../includes/layouts/inc_header.php");
	require("../includes/layouts/inc_nav.php");
	
	require("../includes/inc_connect.php");
	require("../includes/inc_functions.php");
        
	session_start();
        
	if($_SESSION['functie'] != 'Chef de Cuisine') {
		redirect_to("medewerkers/index.php");
	}
?>
        <h1>Directie</h1>
        <a href="inkoop.php">Afdeling Inkoop</a><br />
        <a href="verkoop.php">Afdeling Verkoop</a><br />
        <a href="expeditie.php">Afdeling Expeditie</a><br />
        <a href="keuken.php">Afdeling Keuken</a><br />
        <a href="administratie.php">Afdeling Administratie</a><br/>
<?php
	require("../includes/layouts/inc_footer.php");
?>