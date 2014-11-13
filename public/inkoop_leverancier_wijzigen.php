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
	$query = "SELECT * FROM leveranciers WHERE lev_nr = ". $_POST['lev_nr'] ."";
	$query_result = mysqli_query($con, $query)
		or die("Fout bij select_leveranciers: ".mysqli_error($con));
	while($query_row = mysqli_fetch_assoc($query_result)) {
        
	
	if(isset($_POST['wijzig'])) :
		$update = "UPDATE leveranciers SET lev_nr='". $_POST['lev_nr'] ."', lev_naam='". $_POST['lev_naam'] ."', lev_adres='". $_POST['lev_adres'] ."', lev_postcode='". $_POST['lev_postcode'] ."', lev_plaats='". $_POST['lev_plaats'] ."', lev_telefoonnr='". $_POST['lev_telefoonnr'] ."', lev_rekeningnr='". $_POST['lev_rekeningnr'] ."', lev_soort='". $_POST['lev_soort'] ."' ";
		$update .= "WHERE lev_nr=". $_POST['lev_nr'] ."";
		mysqli_query($con, $update)
			or die("Fout bij insert_into: ".mysqli_error($con));
				
		echo "<b>Wijziging gelukt!</b>";
	endif;
?>


Wijziging van leverancier <?php echo $query_row['lev_nr']; ?></h2>
<form action = "" method = "post">
	<table>
		<tr>
			<td>lev_nr: </td><td><input type = "text" name = "lev_nr" value = "<?php echo $query_row['lev_nr']; ?>"</td>
		</tr>
		<tr>
			<td>Naam: </td><td><input type = "text" name = "lev_naam" value = "<?php echo $query_row['lev_naam']; ?>"</td>
		</tr>
		<tr>
                        <td>Adres: </td><td><input type = "text" name = "lev_adres" value = "<?php echo $query_row['lev_adres']; ?>"</td>
		</tr>
		<tr>
			<td>Postcode: </td><td><input type = "text" name = "lev_postcode" value = "<?php echo $query_row['lev_postcode']; ?>"</td>
		</tr>
		<tr>
			<td>Plaats: </td><td><input type = "text" name = "lev_plaats" value = "<?php echo $query_row['lev_plaats']; ?>"</td>
		<tr>
                <tr>
			<td>Telefoon nr.: </td><td><input type = "text" name = "lev_telefoonnr" value = "<?php echo $query_row['lev_telefoonnr']; ?>"</td>
		<tr>  
                <tr>
			<td>Rekening nr.: </td><td><input type = "text" name = "lev_rekeningnr" value = "<?php echo $query_row['lev_rekeningnr']; ?>"</td>
		<tr>  
                <tr>
			<td>Soort: </td><td><input type = "text" name = "lev_soort" value = "<?php echo $query_row['lev_soort']; ?>"</td>
		<tr>    
			<td><input type = "submit" name = "wijzig" value = "Wijzig"</td>
		</tr>
	</table>
</form>
<?php } ?>
	<br/>
	<br/>
	<br/>
	<br/>
        <form action = "inkoop_leverancier_raadplegen.php" method = "post">
		<input type = "submit" name = "inkoop_leverancier_raadplegen.php" value = "Terug naar leveranciers pagina">
	</form>

<?php
	require("../includes/layouts/inc_footer.php");
?>