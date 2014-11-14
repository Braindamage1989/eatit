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
		header('Location: inkoop.php');
	endif;
        
        $query = "SELECT DISTINCT soort FROM artikel;";
        $query_result = mysqli_query($con, $query);
	
	if(isset($_POST['opslaan'])) :
            if(!empty($_POST['omschrijving'])&&!empty($_POST['artikelprijs'])&&!empty($_POST['soort'])) { 
		$insert_into = "INSERT INTO artikel (omschrijving, artikelprijs, soort, tv, ib)";
                
		$insert_into .= "VALUES ('". $_POST['omschrijving'] ."', ". $_POST['artikelprijs'] .", '". $_POST['soort'] ."', ". $_POST['tv'] .", ". $_POST['ib'] .")";
		mysqli_query($con, $insert_into)
				or die("Fout bij insert_into: ".mysqli_error($con));
				
		echo "<span class=\"groenmelding\">Toevoegen aan database gelukt!</span>";
            }else {echo "<span class=\"melding\">U dient alle tekstvelden in te vullen.</span>";}
	endif;
?>
<h1>Artikel toevoegen</h1>
<form action="" method="post">
	<table>
		<tr>
			<td>Omschrijving</td>
			<td><input type="text" name="omschrijving" /></td>
			<td></td>
		</tr>
		<tr>
			<td>Artikelprijs</td>
			<td><input type="text" name="artikelprijs" /></td>
			<td> (Invullen als 0.00)</td>
		</tr>
		<tr>
			<td>Soort</td>
                        <td><select name="soort">
                            <?php   
                                while ($query_row = mysqli_fetch_assoc($query_result)) :
                                echo "<option value=\"". $query_row['soort'] ."\">". $query_row['soort'] ."</option>"; 
                                endwhile;
                            ?>
                            </select>
                        </td>
			<td></td>
		</tr>
		<tr>
			<td>Voorraad</td>
			<td><input type="number" name="tv" min="0" value="0"/></td>
			<td></td>
		</tr>
		<tr>
			<td>In bestelling</td>
			<td><input type="number" name="ib" min="0" value="0"/></td>
			<td></td>
		</tr>
	</table>
	<input type="submit" name="opslaan" value="Opslaan" />
	<input type="submit" name="terug" value="Ga terug" />
</form>

<?php
	require("../includes/layouts/inc_footer.php");
?>