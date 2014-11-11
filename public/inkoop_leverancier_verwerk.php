<?php
	require("../includes/layouts/inc_header.php");
	require("../includes/layouts/inc_nav.php");
	
	require("../includes/inc_connect.php");
        require("../includes/inc_functions.php");
	
	$melding = null;
        if(!isset($_POST['verzend'])) {
            redirect_to("inkoop.php");
        }
        if(!isset($_POST['artikelnr'])) {
            $melding = "U heeft geen artikelnummer geselecteerd.";
        }

	foreach ($_POST['artikelnr'] as $sleutel => $waarde) :
	if (empty($_POST['artikelnr'][$sleutel])) :
		unset ($_POST['artikelnr'][$sleutel]);
	endif;
	endforeach;
	
	foreach ($_POST['artikelnr'] as $sleutel => $waarde) :
		$query = "UPDATE artikel SET ib=". $waarde ." WHERE artikelnr=". $sleutel ."";
		mysqli_query($con, $query)
			or die("Error: ".mysqli_error($con));
		$melding .= "<span class=\"melding\">Het artikel met artikelnummer $sleutel is besteld</span><br />";
	endforeach;

	if(isset($melding)):
		echo $melding;
                ?> <a href="inkoop.php">Ga terug</a> <?php
	endif;

	require("../includes/layouts/inc_footer.php");
?>