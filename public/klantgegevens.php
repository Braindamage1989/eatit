<?php
	require("../includes/layouts/inc_header.php");
	require("javascripts/nummers.js");
	require("../includes/layouts/inc_nav.php");
	
	require("../includes/inc_connect.php");
	require("../includes/inc_functions.php");
	
	session_start();
	
	if(!isset($_SESSION['klantnr'])) {
		redirect_to("index.php");
	}
        
        $klantnr = $_SESSION['klantnr'];
        $query_klantgegevens = "SELECT * FROM klant WHERE klantnr = {$klantnr};";
        $result_klantgegevens = mysqli_query($con, $query_klantgegevens);
        
        if(isset($_POST['wijzig'])) {
            $voornaam = $_POST['voornaam'];
            $achternaam = $_POST['achternaam'];
            $adres = $_POST['adres'];
            $postcode = $_POST['postcode'];
            $telefoonnr = $_POST['telefoonnummer'];
            $email = $_POST['email'];
            $wachtwoord = $_POST['wachtwoord'];
            
            $query_wijzig =     "UPDATE klant SET voornaam = '$voornaam', achternaam = '$achternaam', adres = '$adres',
                                postcode = '$postcode', telefoonnr = $telefoonnr, email = '$email', wachtwoord = '$wachtwoord'
                                WHERE klantnr = $klantnr;";
            $result_wijzig = mysqli_query($con, $query_wijzig);
            
            if($result_wijzig) {
                $melding = "<span class=\"groenmelding\">Uw gegevens zijn gewijzigd. <br/></span>";
            } else { $melding = "<span class=\"melding\">Er is iets fout gegaan met het wijzigen van uw gegevens. <br/></span>"; }
        }
?>
<h1>Wijzig klantgegevens</h1>
<?php if(isset($melding)){
    echo $melding;
}?>
<form action ="" method="post">
    <table>
		<tr>
			<td>E-mail adres: </td>	<td><input type = "text" name = "email" value="<?php $_POST['email']?>"></td><td>*</td>
		</tr>
		<tr>
			<td>Wachtwoord: </td>	<td><input type = "password" name = "wachtwoord"></td><td>*</td>
		</tr>
		<tr>
			<td>Voornaam: </td>	<td><input type = "text" maxlength="32" name = "voornaam" value="<?php $_POST['email']?>"></td><td>*</td>
		</tr>
		<tr>
			<td>Achternaam: </td>	<td><input type = "text" maxlength="32" name = "achternaam" value="<?php $_POST['email']?>"></td><td>*</td>
		</tr>
		<tr>
			<td>Adres: </td>	<td><input type = "text" name = "adres" value="<?php $_POST['email']?>"></td><td>*</td>
		</tr>
		<tr>
			<td>Postcode: </td>	<td><input type = "text" maxlength="7" name = "postcode" value="<?php $_POST['email']?>"></td><td>* Een postcode moet ingevoerd volgens deze volgorde: 1234 AB</td>
		</tr>
		<tr>
			<td>Plaats: </td>	<td><input type = "text" name = "plaats" value="Groningen" readonly="readonly" ></td><td>*</td>
		</tr>
		<tr>
			<td>Telefoonnumer: </td>	<td><input type = "text" maxlength="10" name = "telefoonnummer" value="<?php $_POST['email']?>"></td><td>*</td>
		</tr>
		<tr>
			<td><input type = "submit" name = "wijzig" value = "Wijzig"</td><td></td>
		</tr>
	</table>
</form>
<br/>
<br/>
<br/>
<form action="bestelpagina.php" method="post">
    <input type ="submit" name="terug" value="Terug naar de bestelpagina">
</form>

<?php
	require("../includes/layouts/inc_footer.php");
?>