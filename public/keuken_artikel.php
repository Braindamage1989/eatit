<?php
	require("../includes/layouts/inc_header.php");
	require("../includes/layouts/inc_nav.php");
	
	require("../includes/inc_connect.php");
	require("../includes/inc_functions.php");
	
	session_start();
	
	$melding = null;
	
	if($_SESSION['functie'] != 'Medewerker keuken'&&$_SESSION['functie'] != 'Chef de Cuisine'){
		redirect_to("medewerkers/index.php");
	}
	
	if (empty($_POST['receptnr'])) :
		$melding .= "<span class=\"melding\">Je hebt geen recept geselecteerd.</span><br />";
		$_SESSION['melding'] = $melding;
		redirect_to("keuken_recept.php");
	endif;
?>
<?php
	if(!isset($_POST['verzend_recept'])) {
		redirect_to("keuken_recept.php");
	}
	$receptnr = $_POST['receptnr'];
	
	$query = 	"SELECT ak.artikelnr, ak.omschrijving as artikelomschrijving FROM artikel ak
				JOIN artikelrecept ar
				ON ak.artikelnr = ar.artikelnr
				JOIN recept rc
				ON rc.receptnr = ar.receptnr
				WHERE rc.receptnr = {$receptnr};";
	$query_result = mysqli_query($con, $query);
?>
<h1>Artikelen</h1>
<table>
	<tr><td>Artikelnummer</td> <td>Omschrijving</td></tr>
	<?php while($query_row = mysqli_fetch_assoc($query_result)) { ?>
	<tr><td><?php echo $query_row['artikelnr']?></td> <td><?php echo $query_row['artikelomschrijving']?></td></tr>
	<?php } ?>
</table>
	<br/>
	<br/>
	<br/>
	<form action = "keuken_recept.php" method = "post">
		<input type = "submit" name = "keuken" value = "Terug naar Recepten">
	</form>
	<br/>

	<form action = "keuken.php" method = "post">
		<input type = "submit" name = "keuken" value = "Terug naar Keuken">
	</form>
<?php
	require("../includes/layouts/inc_footer.php");
?>