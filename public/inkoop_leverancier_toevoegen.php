<?php
	require("../includes/layouts/inc_header.php");
	require("../includes/layouts/inc_nav.php");
	
	require("../includes/inc_connect.php");
	require("../includes/inc_functions.php");
	session_start(); 
	if($_SESSION['functie'] != 'Medewerker inkoop'&&$_SESSION['functie'] != 'Hoofd commerciele afdeling'&&$_SESSION['functie'] != 'Chef de Cuisine') {
		redirect_to("medewerkers/index.php");
	}
?>
<?php
	if(isset($_POST['terug'])):
		header('Location: inkoop_leverancier_raadplegen.php');
	endif;
        

	
	if(isset($_POST['opslaan'])) :
            if(!empty($_POST['lev_naam'])&&!empty($_POST['lev_adres'])&&!empty($_POST['lev_postcode'])
                    &&!empty($_POST['lev_plaats'])&&!empty($_POST['lev_telefoonnr'])
                    &&!empty($_POST['lev_rekeningnr'])&&!empty($_POST['lev_soort'])) { 
		$insert_into = "INSERT INTO leveranciers (lev_naam, lev_adres, lev_postcode, lev_plaats, lev_telefoonnr, lev_rekeningnr, lev_soort) ";
		$insert_into .= "VALUES ('". $_POST['lev_naam'] ."', '". $_POST['lev_adres'] ."', '". $_POST['lev_postcode'] ."', '". $_POST['lev_plaats'] ."', '". $_POST['lev_telefoonnr'] ."', '". $_POST['lev_rekeningnr'] ."', '". $_POST['lev_soort'] ."')";
		mysqli_query($con, $insert_into)
				or die("Fout bij insert_into: ".mysqli_error($con));
				
		echo "<b>Toevoegen aan database gelukt!</b>";
            }else {echo "U dient alle tekstvelden in te vullen.";}
	endif;
?>
<h1>Toevoegen van leverancier</h1>
<form action="" method="post">
	<table>
		<tr>
			<td>Naam</td>
			<td><input type="text" name="lev_naam" /></td>
			<td></td>
		</tr>
		<tr>
			<td>Adres</td>
			<td><input type="text" name="lev_adres" /></td>
			<td></td>
		</tr>
		<tr>
			<td>Postcode</td>
			<td><input type="text" name="lev_postcode" /></td>
			<td></td>
		</tr>
		<tr>
			<td>Plaats</td>
                        <td><input type="text" name="lev_plaats" /></td>
			<td></td>
		</tr>
		<tr>
			<td>Telefoon nr.</td>
			<td><input type="number" name="lev_telefoonnr" /></td>
			<td></td>
		</tr>
                <tr>
			<td>Rekening nr.</td>
			<td><input type="number" name="lev_rekeningnr" /></td>
			<td></td>
                </tr>
                <tr>
			<td>Soort</td>
			<td><input type="text" name="lev_soort" /></td>
			<td></td>
                </tr>
	</table>
	<input type="submit" name="opslaan" value="Opslaan" />
	<input type="submit" name="terug" value="Ga terug" />
</form>

<?php
	require("../includes/layouts/inc_footer.php");
?>