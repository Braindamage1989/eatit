<?php
	require("../includes/layouts/inc_header.php");
	require("../includes/layouts/inc_nav.php");
	
	require("../includes/inc_connect.php");
	require("../includes/inc_functions.php");
	session_start();
?>

<h1>Maak een nieuw account aan</h1>

<?php
	if(isset($_SESSION['errors']) || isset($_SESSION['melding'])) {
	echo $_SESSION["errors"] . "<br/><br/>";
	echo $_SESSION["melding"] . "<br/>";
	$_SESSION['melding'] = null;
	$_SESSION['errors'] = null;
	}
?>

<form action = "registreer_processing.php" method = "post">
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
			<td><input type = "submit" name = "registreer" value = "Registreer"</td><td></td>
		</tr>
	</table>
</form>
<?php
	require("../includes/layouts/inc_footer.php");
?>