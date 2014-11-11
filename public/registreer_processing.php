<?php
	include("../includes/inc_connect.php");
	include("../includes/inc_functions.php");
	session_start();
?>

<?php
	if(!isset($_POST['registreer'])) {
		redirect_to("registreer.php");
	}
	
	$email = $_POST['email'];
	$wachtwoord = $_POST['wachtwoord'];
	$voornaam = $_POST['voornaam'];
	$achternaam = $_POST['achternaam'];
	$adres = $_POST['adres'];
	$postcode = $_POST['postcode'];
	$plaats = $_POST['plaats'];
	$telefoonnummer = $_POST['telefoonnummer'];
	
	$melding = null;
	/*
		if(empty($email)) :
			$melding .= "Vul een geldig emailadres in.<br />";
		endif;
		if(strlen($_POST['tv']) > 60) :
			$melding .= "Emailadres mag maximaal 8 tekens zijn.<br />";
		endif;
		
		if(empty($wachtwoord)) :
			$melding .= "Voer een wachtwoord in.<br />";
		endif;
		if(strlen($_POST['ib']) > 40) :
			$melding .= "Wachtwoord mag maximaal 40 tekens zijn.<br />";
		endif;
	
		if(empty($voornaam)) :
			$melding .= "Vul uw voornaam in.<br />";
		endif;
		if(strlen($voornaam) > 50) :
			$melding .= "Voornaam mag maximaal 50 tekens zijn.<br />";
		endif;
		
		if(empty($achternaam)) :
			$melding .= "Vul uw achternaam in.<br />";
		endif;
		if(strlen($achternaam) > 50) :
			$melding .= "Achternaam mag maximaal 50 tekens zijn.<br />";
		endif;
		
		if(empty($adres)) :
			$melding .= "Vul uw adres in.<br />";
		endif;
		if(strlen($achternaam) > 50) :
			$melding .= "Adres mag maximaal 50 tekens zijn.<br />";
		endif;
		
		if(empty($postcode)) :
			$melding .= "Vul uw postcode in.<br />";
		endif;
		if(strlen($postcode) > 7) :
			$melding .= "Postcode mag maximaal 7 tekens zijn.<br />";
		endif;
		
		if(empty($plaats)) :
			$melding .= "Vul uw plaats in.<br />";
		endif;
		if(strlen($plaats) > 40) :
			$melding .= "Plaats mag maximaal 40 tekens zijn.<br />";
		endif;
		
		if(!is_numeric($telefoonnummer)) :
			$melding .= "Telefoonnummer mag niet leeg zijn en mag alleen bestaan uit cijfers.<br />";
		endif;
		if(strlen($plaats) > 10) :
			$melding .= "Telefoonnummer mag maximaal 10 tekens zijn.<br />";
		endif;
		
	if(!empty($_POST['fout'])) {
			
			
		}*/

if($melding == null) {
		
	$query = 	"INSERT INTO klant (voornaam, achternaam, adres, postcode, woonplaats, telefoonnr, email, wachtwoord)
				VALUES ('{$voornaam}', '{$achternaam}', '{$adres}', '{$postcode}', '{$plaats}', '{$telefoonnummer}', '{$email}', '{$wachtwoord}');";
	$query_result = mysqli_query($con, $query);
	
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