<?php
	require("../includes/layouts/inc_header.php");
	require("../includes/layouts/inc_nav.php");
	
	require("../includes/inc_connect.php");
	require("../includes/inc_functions.php");
	session_start();
	if($_SESSION['functie'] != 'Medewerker keuken'&&$_SESSION['functie'] != 'Chef de Cuisine') {
		redirect_to("medewerkers/index.php");
	}
	if(!isset($_POST['verzend_artikel'])) {
		redirect_to("keuken.php");
	}
		
	$select_artikel = "SELECT * FROM artikel";
	$result_artikel = mysqli_query($con, $select_artikel)
		or die("Fout bij select_artikel: ".mysqli_error($con));
		
	if(isset($_POST['terug'])):
		header('Location: keuken.php');
	endif;
?>
	<h2>Voorraden van artikel bijwerken</h2>
	<form action="keuken_artikel_voorraad.php" method="post">
		<select name="artikelnr">
			<?php
				while ($rij = mysqli_fetch_assoc($result_artikel)) :
					echo "<option value='". $rij['artikelnr'] ."'>". $rij['artikelnr'] ." ". $rij['omschrijving'] ."</option> \n";
				endwhile
			?>
		</select>
	<input type="submit" name="ophalen" value="Voorraad bewerken" />
	<input type="submit" name="terug" value="Ga terug"/>
	</form>
<?php
	require("../includes/layouts/inc_footer.php");
?>
