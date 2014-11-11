<?php
	require("../includes/layouts/inc_header.php");
	require("../includes/layouts/inc_nav.php");
	
	require("../includes/inc_connect.php");
	require("../includes/inc_functions.php");
	
	session_start();
	
	if($_SESSION['functie'] != 'Medewerker keuken'&&$_SESSION['functie'] != 'Chef de Cuisine') {
		redirect_to("medewerkers/index.php");
	}
?>

<h1>Keuken</h1>
<form action = "keuken_te_bereiden.php" method = "post">
	<table>
		<tr>
			<td> <input type = "submit" name = "verzend_bereiden" value = "Te bereiden maaltijden"</td>
		</tr>
	</table>
</form>
<br/>
<form action = "keuken_inkooporder.php" method = "post">
	<table>
		<tr>
			<td> <input type = "submit" name = "verzend_inkooporder" value = "Inkooporders" /></td>
		</tr>
	</table>
</form>
<br/>

<form action = "keuken_verkooporder.php" method = "post">
	<table>
		<tr>
			<td> <input type = "submit" name = "verzend_verkooporder" value = "Verkooporders" /></td>
		</tr>
	</table>
</form>
<br/>
<form action = "keuken_recept.php" method = "post">
	<table>
		<tr>
			<td> <input type = "submit" name = "verzend_recept" value = "Recepten" /></td>
		</tr>
	</table>
</form>
<br/>
<form action = "keuken_voorraadstatus.php" method = "post">
	<table>
		<tr>
			<td> <input type = "submit" name = "verzend_voorraad" value = "Voorraadstatus" /></td>
		</tr>
	</table>
</form>
<br/>
<form action = "keuken_artikel_voorraad_selecteer.php" method = "post">
	<table>
		<tr>
			<td> <input type = "submit" name = "verzend_artikel" value = "Voorraden van artikel bijwerken"</td>
		</tr>
	</table>
</form>

<?php
	require("../includes/layouts/inc_footer.php");
?>