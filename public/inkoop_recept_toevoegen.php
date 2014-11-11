<?php
ini_set('display_errors', 1); 
error_reporting(E_ALL);
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
        
        $weeknr_query = "SELECT MAX(weeknr) AS weeknr FROM recept;";
        $weeknr_result = mysqli_query($con, $weeknr_query);
        while($weeknr_row = mysqli_fetch_assoc($weeknr_result)) {
            $weeknr = $weeknr_row['weeknr'];
        }
	
	if(isset($_POST['opslaan'])) :
            if(!empty($_POST['omschrijving'])||!empty($_POST['verkoopprijs'])||!empty($_POST['verkoopprijs'])||!empty($_POST['categorie'])) {
		$insert_into = "INSERT INTO recept (omschrijving, verkoopprijs, weeknr, categorie)";
		$insert_into .= "VALUES ('". $_POST['omschrijving'] ."', ". $_POST['verkoopprijs'] .", ". $_POST['weeknr'] .", '". $_POST['categorie'] ."')";
		mysqli_query($con, $insert_into)
				or die("Fout bij insert_into: ".mysqli_error($con));
				
		echo "<b>Toevoegen aan database gelukt!</b>";
            }else {echo "U dient alle tekstvelden in te voeren.";}
	endif;
?>
<h2>Recept toevoegen</h2>
<form action="" method="post">
	<table>
		<tr>
			<td>Omschrijving</td>
			<td><input type="text" name="omschrijving" /></td>
			<td></td>
		</tr>
		<tr>
			<td>Verkoopprijs</td>
			<td><input type="text" name="verkoopprijs" /></td>
			<td> (Invullen als 0.00)</td>
		</tr>
		<tr>
			<td>Weeknr</td>
			<td><input type="number" name="weeknr" min="1" max="53" value="1"/></td>
			<td></td>
		</tr>
		<tr>
			<td>Categorie</td>
			<td><input type="text" name="categorie"/></td>
			<td></td>
		</tr>
	</table>
	<input type="submit" name="opslaan" value="Opslaan" />
	<input type="submit" name="terug" value="Ga terug"/>
</form>

<?php
	require("../includes/layouts/inc_footer.php");
?>