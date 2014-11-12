<?php
	require("../includes/layouts/inc_header.php");
	require("../includes/layouts/inc_nav.php");
	
	session_start();
	
	require("../includes/inc_connect.php");
	
	$melding = null;
	
	// Array met medewerkers
	$chauffeurs = array(12,13,14,15,16,17);
	
	if ($_POST['bevestigen'] == 'Ja'):		
		// Kijken hoeveel artikelen een recept verbruikt
		$select_artikelrecept = "SELECT * FROM artikelrecept WHERE ";
		
		$aantal_bestellingen = count($_SESSION['bestelling']);
		$tel = 1;
		
		foreach ($_SESSION['bestelling'] as $sleutel => $waarde):
			if ($aantal_bestellingen > $tel):
				$select_artikelrecept .= "receptnr=". $sleutel ." OR ";
				$tel++;
			else:
				$select_artikelrecept .= "receptnr=". $sleutel ."";
			endif;
		endforeach;
		
		$artikelrecept_result = mysqli_query($con, $select_artikelrecept)
                    or die("Fout bij select_artikelrecept: ".mysqli_error($con));
		
		// Het aantal te verbruiken artikellen berekenen
		while ($rijen = mysqli_fetch_assoc($artikelrecept_result)):
                    foreach ($_SESSION['bestelling'] as $sleutel => $waarde) :
			if ($sleutel == $rijen['receptnr']):
                            $select_aantal = "SELECT * FROM artikel WHERE tv>". $waarde * $rijen['aantal'] ." AND artikelnr=". $rijen['artikelnr'] ."";
                                    
                            $result_aantal = mysqli_query($con, $select_aantal);
                            $num_aantal = mysqli_num_rows($result_aantal);
                            
                                if ($num_aantal == 0) :
                                    $melding .= "<span class=\"melding\">De bestelling met receptnummer $sleutel is niet voldoende op voorraad.<br /></span>";
                                    unset ($_SESSION['bestelling'][$sleutel]);
                                else:
                                    $update_aantal = "UPDATE artikel SET gr=gr + ". $waarde * $rijen['aantal'] .", tv=tv - ". $waarde * $rijen['aantal'] ." WHERE artikelnr=". $rijen['artikelnr'] ."";
                                    mysqli_query($con, $update_aantal);
                                endif;
			endif;
                    endforeach;
		endwhile;
		
                if (!empty($_SESSION['bestelling'])) :
                    // bepalen van postcode van klant
                    $select_postcode = "SELECT postcode FROM klant WHERE klantnr=". $_SESSION['klantnr'] ."";
                    $result_postcode = mysqli_query($con, $select_postcode)
                        or die("Fout bij select_postcode: ".mysqli_error($con));

                    while ($rij = mysqli_fetch_row($result_postcode)):
                        $postcode = $rij[0];
                    endwhile;

                    // postcode geschikt maken voor postcodegebied routelijst
                    $postcode = str_replace (' ', '', $postcode);
                    $postcodegebied = preg_replace('([a-zA-Z]{2})', '', $postcode);

                    // Kijken of postcode gebied al bestaat
                    $check_adres = "SELECT * FROM routelijst WHERE postcodegebied='". $postcodegebied ."' ORDER BY routenr LIMIT 1";
                    $result_check_adres = mysqli_query($con, $check_adres)
                        or die("Fout bij check_adres: ".mysqli_error($con));

                    // bepalen of er medewerkers vrij zijn
                    $select_medewerker = "SELECT medewerkernr, maximale_uitrijtijd FROM routelijst WHERE maximale_uitrijtijd>DATE_SUB(NOW(), INTERVAL 3 HOUR) AND maximale_uitrijtijd>NOW() ORDER BY maximale_uitrijtijd ASC LIMIT 6";
                    $result_medewerker = mysqli_query($con, $select_medewerker)
                                    or die("Fout bij select_medewerker: ".mysqli_error($con));

                    $bezet = array();

                    //zijn alle medewerkers vrij, kies eerst een willekeurig. Anders een die nog niet bezet is voor de laatste 3 uur
                    if (mysqli_num_rows($result_medewerker) == 0) :
                            $ran_chauffeur = rand(0, 5);
                            $chauffeur = $chauffeurs[$ran_chauffeur];
                    elseif (mysqli_num_rows($result_medewerker) > 0) :
                            while ($medewerker = mysqli_fetch_assoc($result_medewerker)) :
                                    $bezet[] .= $medewerker['medewerkernr'];
                            endwhile;

                            // array met onbezette medewerkers maken
                            $onbezet = array_diff($chauffeurs, $bezet);
                            $onbezet = array_values($onbezet);

                            $aantal_onbezet = count($onbezet);
                            $aantal_onbezet--;

                            //kiezen niet bezette medewerker
                            $rand_chauffer = rand (0, $aantal_onbezet);
                            $chauffeur = $onbezet[$rand_chauffer];
                    endif;

                    // Kijken of de besteling nog binnen de maximale uitrijtijd valt
                    $check_tijd = "SELECT maximale_uitrijtijd FROM routelijst WHERE maximale_uitrijtijd>DATE_ADD(NOW(), INTERVAL 10 MINUTE) AND postcodegebied=". $postcodegebied ." ORDER BY maximale_uitrijtijd";
                    $result_check_tijd = mysqli_query($con, $check_tijd)
                        or die("Fout bij select_tijd: ".mysqli_error($con));

                    // Is er een medewerker gevonden, is een rit vol of is de bestelling niet optijd, begin dan een nieuwe route
                    if (mysqli_num_rows($result_check_adres) == 0 || mysqli_num_rows($result_check_tijd) == 0) :
                            $insert_rit = "INSERT INTO routelijst (postcodegebied, maximale_uitrijtijd, medewerkernr) VALUES (". $postcodegebied .", DATE_ADD(NOW(), INTERVAL 45 MINUTE), ". $chauffeur .")";
                            mysqli_query($con, $insert_rit)
                                or die("Fout bij insert_rit: ".mysqli_error($con));

                        $routenr = mysqli_insert_id($con);

                    else:

                        $select_route = "SELECT routenr FROM routelijst WHERE postcodegebied=". $postcodegebied ."";
                        $result_route = mysqli_query($con, $select_route)
                            or die("Fout bij select_route: ".mysqli_error($con));

                        while ($rij = mysqli_fetch_assoc($result_route)):
                            $routenr = $rij['routenr'];
                        endwhile;

                    endif;

                        $insert_order = "INSERT INTO `order` (klantnr, status, betaald, ordertijd, routenr) ";
                        $insert_order .= "VALUES ('". $_SESSION['klantnr'] ."','1', '1', NOW(), ". $routenr .")";

                        mysqli_query($con, $insert_order)
                            or die("Fout bij insert_order: ".mysqli_error($con));

                        // bepalen van ordernummer laatst ingevoerde order
                        $ordernr = mysqli_insert_id($con);

                        // toevoegen van orderregels
                        foreach ($_SESSION['bestelling'] as $sleutel => $waarde):
                                $insert_orderregel = "INSERT INTO orderregel (ordernr, receptnr, aantal) ";
                                $insert_orderregel .= "VALUES (". $ordernr .", ". $sleutel .", ". $waarde .")";
                                mysqli_query($con, $insert_orderregel)
                                    or die("Fout bij insert_orderregel: ".mysqli_error($con));
                                $melding .= "<span class=\"groenmelding\">De bestelling met receptnummer $sleutel is doorgegeven aan de keuken.<br /></span>";
                        endforeach;
                    endif;
                    
                $_SESSION['bestelling'] = null;
	endif;
	
	echo $melding;

	require("../includes/layouts/inc_footer.php");
?>