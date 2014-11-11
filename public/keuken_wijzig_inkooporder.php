<?php
	require("../includes/layouts/inc_header.php");
	require("../includes/layouts/inc_nav.php");
	
	require("../includes/inc_connect.php");
	require("../includes/inc_functions.php");
	
	session_start();
	
	$melding = null;
	
	if($_SESSION['functie'] != 'Medewerker keuken' && $_SESSION['functie'] != 'Chef de Cuisine') {
		redirect_to("medewerkers/index.php");
	}

	if(!isset($_POST['wijzig_inkooporder'])) {
		redirect_to("keuken_inkooporder.php");
	}
	
	if(empty($_POST['wijzig_inkoopordernr'])) :
		$melding .= "<span class=\"melding\">Je hebt geen inkooporder geselecteerd.</span>";
		$_SESSION['melding'] = $melding;
		redirect_to("keuken_inkooporder.php");
	endif;
	
	$inkoopordernr = $_POST['wijzig_inkoopordernr'];

	$query = "SELECT * FROM inkooporder WHERE inkoopordernr = {$inkoopordernr};";
	$query_result = mysqli_query($con, $query);
	while($query_row = mysqli_fetch_assoc($query_result)) {	
?>


<h1>Wijziging van inkooporder <?php echo $query_row['inkoopordernr']; ?></h1>
<form action = "keuken_wijzig_inkooporder_processing.php" method = "post">
	<table>
		<tr>
			<td>Inkoopordernummer: </td><td><input type = "text" readonly = "readonly" name = "inkoopordernr" value = "<?php echo $query_row['inkoopordernr']; ?>"</td>
		</tr>
		<tr>
			<td>Leveranciersnummer: </td><td><input type = "text" readonly = "readonly" name = "lev_nr" value = "<?php echo $query_row['lev_nr']; ?>"</td>
		</tr>
		<tr>
			<td>Orderdatum: </td><td><input type = "text" readonly = "readonly" name = "orderdatum" value = "<?php echo $query_row['orderdatum']; ?>"</td>
		</tr>
		<tr>
			<td>Leverdatum: </td><td><input type = "text" readonly = "readonly" name = "leverdatum" value = "<?php echo $query_row['leverdatum']; ?>"</td>
		</tr>
		<tr>
			<td>Status: </td><td>
				<select name = "status"> 
				<option value = "1">Besteld</option>
				<option value = "3">Wachten op levering</option>
				<option value = "5">Geleverd</option>
			</td>
		</tr>
		<tr>
			<td>Betaald: </td><td><input type = "text" readonly = "readonly" name = "betaald" value = "<?php echo $query_row['betaald']; ?>"</td>
		</tr>
		<tr>
			<td><input type = "submit" name = "wijzig_inkooporderwaarde" value = "Wijzig"</td>
		</tr>
	</table>
</form>
<?php } ?>
	<br/>
	<br/>
	<br/>
	<form action = "keuken_inkooporder.php" method = "post">
		<input type = "submit" name = "keuken" value = "Terug naar Inkooporders">
	</form>
	<br/>
	<form action = "keuken.php" method = "post">
		<input type = "submit" name = "keuken" value = "Terug naar Keuken">
	</form>
<?php
	require("../includes/layouts/inc_footer.php");
?>