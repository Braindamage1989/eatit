<?php
	require("../includes/layouts/inc_header.php");
	require("../includes/layouts/inc_nav.php");
	
	require("../includes/inc_connect.php");
	require("../includes/inc_functions.php");
	session_start();
	if($_SESSION['functie'] != 'Medewerker inkoop'&&$_SESSION['functie'] != 'Hoofd commerciele afdeling'&&$_SESSION['functie'] != 'Chef de Cuisine') {
		redirect_to("medewerkers/index.php");
	}
	
	$select_artikel = "SELECT * FROM artikel WHERE artikelnr=". $_POST['artikelnr'] ."";
	$result_artikel = mysqli_query($con, $select_artikel)
		or die("Fout bij select_artikel: ".mysqli_error($con));
	
	if(isset($_POST['terug'])):
		header('Location: inkoop.php');
	endif;
	
	if(isset($_POST['opslaan'])) :
		$update = "UPDATE artikel SET tv=". $_POST['tv'] .", ib=". $_POST['ib'] .", gr=". $_POST['gr'] .", bd=". $_POST['bd'] ." ";
		$update .= "WHERE artikelnr=". $_POST['artikelnr'] ."";
		mysqli_query($con, $update)
			or die("Fout bij insert_into: ".mysqli_error($con));
				
		echo "<b>Toevoegen aan database gelukt!</b>";
	endif;
?>
<h2>Voorraden van artikel bijwerken</h2>
<form action="" method="post">
	<table>
		<?php
			while ($rij = mysqli_fetch_assoc($result_artikel)) :
		?>
		<tr>
			<td>Artikelnummer</td>
			<td><input type="text" name="artikelnr" readonly="readonly" value="<?php echo $rij['artikelnr']; ?>" /></td>
			<td></td>
		</tr>
		<tr>
			<td>Technische voorraad</td>
			<td><input type="number" name="tv" min="0" value="<?php echo $rij['tv']; ?>" /></td>
			<td> (Actuele voorraad)</td>
		</tr>
		<tr>
			<td>In bestelling</td>
			<td><input type="number" name="ib" min="0" value="<?php echo $rij['ib']; ?>" /></td>
			<td></td>
		</tr>
		<tr>
			<td>Gereserveerd</td>
			<td><input type="number" name="gr" min="0" value="<?php echo $rij['gr']; ?>" /></td>
			<td></td>
		</tr>
		<tr>
			<td>Bedorven</td>
			<td><input type="number" name="bd" min="0" value="<?php echo $rij['bd']; ?>" /></td>
			<td></td>
		</tr>
		<?php
			endwhile;
		?>
	</table>
	<input type="submit" name="opslaan" value="Opslaan" />
	<input type="submit" name="terug" value="Ga terug"/>
</form>

<?php
	require("../includes/layouts/inc_footer.php");
?>