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
	
        $query_iko = "INSERT INTO inkooporder (lev_nr, orderdatum, leverdatum, status, betaald) ";
        $query_iko .= "VALUES (". $_POST['lev_nr'] .", NOW(), DATE_ADD(NOW(), INTERVAL 1 DAY), 1, 1) ";
        mysqli_query($con, $query_iko)
            or die("Fout bij inkooporder ".mysqli_error($con));
        
        
        $ikonr = mysqli_insert_id($con);
        
	foreach ($_POST['artikelnr'] as $sleutel => $waarde) :
                $queryikor = "INSERT INTO inkooporderregel (inkoopordernr, artikelnr, aantal) ";
                $queryikor .= "VALUES (". $ikonr .", ". $sleutel .", ". $waarde .") ";
                mysqli_query($con, $queryikor)
                    or die("Fout bij inkooporderregel: ".mysqli_error($con));
                
		$query = "UPDATE artikel SET ib=". $waarde ." WHERE artikelnr=". $sleutel ."";
		mysqli_query($con, $query)
                    or die("Error: ".mysqli_error($con));
                
		$melding .= "<span class=\"groenmelding\">Het artikel met artikelnummer $sleutel is besteld</span><br />";
	endforeach;

	if(isset($melding)):
		echo $melding;
                ?> <a href="inkoop.php">Ga terug</a> <?php
	endif;

	require("../includes/layouts/inc_footer.php");
?>