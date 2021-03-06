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
        
        $categorie_query = "SELECT DISTINCT categorie FROM recept;";
        $categorie_result = mysqli_query($con, $categorie_query);
        
        $weeknr_query = "SELECT MAX(weeknr) AS weeknr FROM recept;";
        $weeknr_result = mysqli_query($con, $weeknr_query);
        while($weeknr_row = mysqli_fetch_assoc($weeknr_result)) {
            $weeknr = $weeknr_row['weeknr'];
        }
	
	if(isset($_POST['opslaan'])) :
            if(!empty($_POST['omschrijving'])&&!empty($_POST['weeknr'])&&!empty($_POST['verkoopprijs'])&&!empty($_POST['categorie'])) {
		$insert_into = "INSERT INTO recept (omschrijving, verkoopprijs, weeknr, categorie)";
		$insert_into .= "VALUES ('". $_POST['omschrijving'] ."', ". $_POST['verkoopprijs'] .", ". $_POST['weeknr'] .", '". $_POST['categorie'] ."')";
		mysqli_query($con, $insert_into)
				or die("Fout bij insert_into: ".mysqli_error($con));
				
		echo "<span class=\"groenmelding\">Toevoegen aan database gelukt!</span>";
            }else {echo "<span class=\"melding\">U dient alle tekstvelden in te voeren.</span>";}
	endif;
?>
<h1>Recept toevoegen</h1>
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
                            <td><select name="categorie">
                                <?php   
                                while ($categorie_row = mysqli_fetch_assoc($categorie_result)) :
                                echo "<option value=\"". $categorie_row['categorie'] ."\">". $categorie_row['categorie'] ."</option>"; 
                                endwhile;
                                ?>
                            </select</td>
			<td></td>
		</tr>
	</table>
	<input type="submit" name="opslaan" value="Opslaan" />
	<input type="submit" name="terug" value="Ga terug"/>
</form>

<?php
	require("../includes/layouts/inc_footer.php");
?>