<?php
	require("../includes/layouts/inc_header.php");
	require("../includes/layouts/inc_nav.php");
	
	require("../includes/inc_connect.php");
	require("../includes/inc_functions.php");
	session_start();
	if($_SESSION['functie'] != 'Medewerker inkoop'&&$_SESSION['functie'] != 'Hoofd commerciele afdeling'&&$_SESSION['functie'] != 'Chef de Cuisine') {
		redirect_to("medewerkers/index.php");
	}
	
	if(isset($_POST['terug'])):
		header('Location: inkoop.php');
	endif;
	
	$select_artikel = "SELECT * FROM artikel";
	$result_artikel = mysqli_query($con, $select_artikel)
		or die("Fout bij select_artikel: ".mysqli_error($con));
		
	$select_recept = "SELECT * FROM recept";
	$result_recept = mysqli_query($con, $select_recept)
		or die("Fout bij select_recept: ".mysqli_error($con));
	
	if(isset($_POST['opslaan'])) :
		$insert_into = "INSERT INTO artikelrecept (receptnr, artikelnr, aantal)";
		$insert_into .= "VALUES (". $_POST['receptnr'] .", ". $_POST['artikelnr'] .", ". $_POST['aantal'] .")";
		mysqli_query($con, $insert_into)
			or die("Fout bij insert_into: ".mysqli_error($con));
				
		echo "<b>Toevoegen aan database gelukt!</b>";
	endif;
?>
<h1>Toevoegen van artikel aan recept</h1>
<form action="" method="post">
	<table>
		<tr>
			<td>Artikelnummer</td>
			<td>
				<select name="artikelnr">
				<?php
					while ($rij = mysqli_fetch_assoc($result_artikel)) :
						echo "<option value='". $rij['artikelnr'] ."'>". $rij['artikelnr'] ." ". $rij['omschrijving'] ."</option> \n";
					endwhile
				?>
				</select>
			</td>
		</tr>
		<tr>
			<td>Receptnummer</td>
			<td>
				<select name="receptnr">
				<?php
					while ($rij = mysqli_fetch_assoc($result_recept)) :
						echo "<option value='". $rij['receptnr'] ."'>". $rij['receptnr'] ." ". $rij['omschrijving'] ."</option> \n";
					endwhile
				?>
				</select>
			</td>
		</tr>
		<tr>
			<td>Aantal nodig:</td>
			<td><input type="number" name="aantal" min="1" max="100" value="1"/></td>
		</tr>
	</table>
	<input type="submit" name="opslaan" value="Opslaan" />
	<input type="submit" name="terug" value="Ga terug"/>
</form>

<?php
	require("../includes/layouts/inc_footer.php");
?>