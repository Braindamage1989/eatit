<?php
	require("../includes/layouts/inc_header.php");
	require("../includes/layouts/inc_nav.php");
	
	require("../includes/inc_connect.php");
	require("../includes/inc_functions.php");
	session_start();
	if($_SESSION['functie'] != 'Medewerker verkoop'&&$_SESSION['functie'] != 'Medewerker keuken'&&$_SESSION['functie'] != 'Chef de Cuisine') {
		redirect_to("medewerkers/index.php");
	}
?>

<?php
	if(!isset($_POST['wijzig_status'])) {
		redirect_to("verkooporder.php");
	}
	$verkoopordernr = $_POST['ordernr'];
?>


<?php
	$query = "SELECT * FROM `order`  WHERE ordernr = {$verkoopordernr};";
	$query_result = mysqli_query($con, $query);
	while($query_row = mysqli_fetch_assoc($query_result)) {
	
?>


<h2>Wijziging van verkooporder <?php echo $query_row['ordernr']; ?></h2>
<form action = "keuken_verkooporder_processing.php" method = "post">
	<table>
		<tr>
			<td>Verkoopordernummer: </td><td><input type = "text" readonly = "readonly" name = "ordernr" value = "<?php echo $query_row['ordernr']; ?>"</td>
		</tr>
		<tr>
			<td>Klantnummer: </td><td><input type = "text" readonly = "readonly" name = "klantnr" value = "<?php echo $query_row['klantnr']; ?>"</td>
		</tr>
		<tr>
			<td>Status: </td><td>
				<select name = "status"> 
				<option value = "1">Besteld</option>
				<option value = "3">Bereiden</option>
				<option value = "5" SELECTED>Klaar</option>
			</td>
		</tr>
		<tr>
			<td>Betaald: </td><td><input type = "text" readonly = "readonly" name = "betaald" value = "<?php echo $query_row['betaald']; ?>"</td>
		</tr>
		<tr>
			<td>Ordertijd: </td><td><input type = "text" readonly = "readonly" name = "ordertijd" value = "<?php echo $query_row['ordertijd']; ?>"</td>
		</tr>
		<tr>
			<td><input type = "submit" name = "wijzig_status" value = "Wijzig"</td>
		</tr>
	</table>
</form>
<?php } ?>
	<br/>
	<br/>
	<br/>
	<form action = "verkooporder.php" method = "post">
		<input type = "submit" name = "verkooporders" value = "Terug naar Verkooporders">
	</form>
	<br/>
		<?php
	if($_SESSION['functie'] == 'Medewerker verkoop') {
?>
	<form action = "verkoop.php" method = "post">
		<input type = "submit" name = "verkoop" value = "Terug naar Verkoop">
	</form>
<?php
	}else { ?>
	<form action = "keuken.php" method = "post">
		<input type = "submit" name = "keuken" value = "Terug naar Keuken">
	</form>
<?php
	}
?>
<?php
	require("../includes/layouts/inc_footer.php");
?>