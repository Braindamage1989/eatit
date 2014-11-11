<?php
	require("../includes/layouts/inc_header.php");
	require("../includes/layouts/inc_nav.php");
	
	require("../includes/inc_connect.php");
	require("../includes/inc_functions.php");
	session_start();
	if($_SESSION['functie'] != 'Medewerker verkoop'&&$_SESSION['functie'] != 'Chef de Cuisine') {
		redirect_to("medewerkers/index.php");
	}
?>
<h2>Verkoop</h2>

<form action = "keuken_verkooporder.php" method = "post">
	<table>
		<tr>
			<td> <input type = "submit" name = "verzend_order" value = "Geplaatste orders"</td>
		</tr>
	</table>
</form>

<br/>
<form action = "keuken_recept.php" method = "post">
	<table>
		<tr>
			<td> <input type = "submit" name = "verzend_recept" value = "Recepten"</td>
		</tr>
	</table>
</form>
<?php
	require("../includes/layouts/inc_footer.php");
?>