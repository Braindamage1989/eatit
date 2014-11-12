<?php
	require("../includes/layouts/inc_header.php");
	require("../includes/layouts/inc_nav.php");
	
	require("../includes/inc_connect.php");
	require("../includes/inc_functions.php");
	session_start();
	if($_SESSION['functie'] != 'Medewerker inkoop'&&$_SESSION['functie'] != 'Hoofd commerciële afdeling'&&$_SESSION['functie'] != 'Chef de Cuisine') {
		redirect_to("medewerkers/index.php");
	}
?>

<?php
	$lev_query = "SELECT * FROM leveranciers;";
	$lev_result = mysqli_query($con, $lev_query)
		or die("Fout bij select_leveranciers: ".mysqli_error($con));
?>	
	<h2>Leveranciers</h2>
	<form action = "inkoop_leverancier_wijzigen.php" method = "post">
	<table>
		<tr>
			<td></td><td>Levnr</td> <td>Naam</td> <td>Adres</td> <td>Postcode</td> <td>Plaats</td> <td>Telefoonnr</td> <td>Rekeningnr</td> <td>Soort</td>
		</tr>
		<?php
	while($lev_row = mysqli_fetch_assoc($lev_result)) { ?>
		 <tr>
		 	<td> <?php echo " <input type = \"radio\" name = \"lev_nr\" value = $lev_row[lev_nr]>"?></td>
			<td> <?php echo "$lev_row[lev_nr]" ?></td>
			<td> <?php echo "$lev_row[lev_naam]" ?></td>
			<td> <?php echo "$lev_row[lev_adres]" ?></td>
			<td> <?php echo "$lev_row[lev_postcode]" ?></td>
			<td> <?php echo "$lev_row[lev_plaats]" ?></td>
			<td> <?php echo "$lev_row[lev_telefoonnr]" ?></td>
			<td> <?php echo "$lev_row[lev_rekeningnr]" ?></td>
			<td> <?php echo "$lev_row[lev_soort]" ?></td>
			</tr>
	<?php } ?>
	</table>
	<input type = "submit" name = "verzend_recept" value = "Bewerk gegevens">
	</form>
	<br/>
        <br/>
        <a href="inkoop_leverancier_toevoegen.php">Leverancier toevoegen</a><br/>
<?php
	if(isset($_POST['Leverancier toevoegen'])):
	header('Location: inkoop_leverancier_toevoegen.php');
	endif;
?>
	<br/>
	<br/>
<?php
?>
	<form action = "inkoop.php" method = "post">
		<input type = "submit" name = "verkoop" value = "Terug naar Inkoop">
	</form>
	
<br />
<?php
	if(isset($_POST['terug'])):
		header('Location: inkoop.php');
	endif;
?>