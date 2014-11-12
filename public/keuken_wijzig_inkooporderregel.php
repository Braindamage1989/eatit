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

<?php
	if(!isset($_POST['wijzig_inkooporderregel'])) {
		redirect_to("keuken_inkooporder.php");
	}
	$inkooporderregelnr = $_POST['wijzig_inkooporderregelnr'];
?>
<?php
	$artikelcodes = "SELECT artikelnr, omschrijving FROM artikel;";
	$result_ac = mysqli_query($con, $artikelcodes)
			or die("Error: ".mysqli_error($con));
?>
<?php
	$query = "SELECT * FROM inkooporderregel WHERE inkooporderregelnr = {$inkooporderregelnr};";
	$query_result = mysqli_query($con, $query);
	while($query_row = mysqli_fetch_assoc($query_result)) {
	
?>

<h1>Wijziging van inkooporderregel <?php echo $query_row['inkooporderregelnr']; ?></h1>

<form action = "keuken_wijzig_inkooporderregel_processing.php" method = "post">
	<table>
		<tr>
			<td>Inkooporderregelnummer: </td><td><input type = "text" readonly = "readonly" name = "inkooporderregelnr" value = "<?php echo $query_row['inkooporderregelnr']; ?>"</td>
		</tr>
		<tr>
			<td>Inkoopordernummer: </td><td><input type = "text" readonly = "readonly" name = "inkoopordernr" value = "<?php echo $query_row['inkoopordernr']; ?>"</td>
		</tr>
		<tr>
			<td>Artikelnummer: </td>
			<td>
				<select name="artikelnr">
				<?php
					while ($rij_ac = mysqli_fetch_assoc($result_ac)) :
						if ($rij_ac['artikelnr'] == $query_row['artikelnr']):
							echo "<option value='". $rij_ac['artikelnr'] ."' selected=\"selected\">". $rij_ac['artikelnr'] ." ". $rij_ac['omschrijving'] ."</option> \n";
						else:
							echo "<option value='". $rij_ac['artikelnr'] ."'>". $rij_ac['artikelnr'] ." ". $rij_ac['omschrijving'] ."</option> \n";
						endif;
					endwhile
				?>
				</select>
				
			</td>
		</tr>
		<tr>
			<td>Aantal</td>
			<td><input type="text" name="aantal" value="<?php echo $query_row['aantal'] ?>" /></td>
		</tr>
		<tr>
			<td><input type = "submit" name = "wijzig_inkooporderregelwaarde" value = "Wijzig"></td>
		</tr>
	</table>
	<?php } ?>
</form>
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