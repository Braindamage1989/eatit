<?php
	include("../includes/inc_connect.php");
	include("../includes/inc_functions.php");
	session_start();
        
	if(!isset($_POST['registreer'])) {
		redirect_to("registreer.php");
	}
	
	$email = trim($_POST['email']);
	$wachtwoord = trim($_POST['wachtwoord']);
	$voornaam = ucfirst(trim($_POST['voornaam']));
	$achternaam = ucfirst(trim($_POST['achternaam']));
	$adres = ucfirst(trim($_POST['adres']));
	$postcode = trim($_POST['postcode']);
	$plaats = $_POST['plaats'];
	$telefoonnummer = $_POST['telefoonnummer'];
	
	$melding = null;
	
		if(empty($email)) :
			$melding .= "Vul een geldig emailadres in.<br />";
		endif;
		
		if(empty($wachtwoord)) :
			$melding .= "Voer een wachtwoord in.<br />";
		endif;
	
		if(empty($voornaam)) :
			$melding .= "Vul uw voornaam in.<br />";
		endif;
		
		if(empty($achternaam)) :
			$melding .= "Vul uw achternaam in.<br />";
		endif;
		
		if(empty($adres)) :
			$melding .= "Vul uw adres in.<br />";
		endif;
		
		if(empty($postcode)) :
			$melding .= "Vul uw postcode in.<br />";
		endif;
		
		if(empty($plaats)) :
			$melding .= "Vul uw plaats in.<br />";
		endif;
		
		if(!is_numeric($telefoonnummer)) :
			$melding .= "Telefoonnummer mag niet leeg zijn en mag alleen bestaan uit cijfers.<br />";
		endif;

if($melding == null) {
		
	$query = 	"INSERT INTO klant (voornaam, achternaam, adres, postcode, woonplaats, telefoonnr, email, wachtwoord)
				VALUES ('{$voornaam}', '{$achternaam}', '{$adres}', '{$postcode}', '{$plaats}', '{$telefoonnummer}', '{$email}', '{$wachtwoord}');";
	$query_result = mysqli_query($con, $query);
	$_SESSION['melding'] = "<span class=\"groenmelding\">Het registeren is gelukt! Je kan nu inloggen.</span>";
        
        
	if ($query_result) {
			$_SESSION['message'] = "Registratie voltooid!";
			redirect_to("index.php");
		} else {
			$_SESSION['message'] = "Er is iets mis gegaan met de registratie.";
			redirect_to("registreer.php");
		}
} else {
	$_SESSION['melding'] = $melding;
	$_SESSION["errors"] = "<span class=\"melding\">Verbeter alstublieft de volgende fouten:</span>";
	redirect_to("registreer.php");
}
?>