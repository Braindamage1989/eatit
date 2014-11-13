<?php
	require("../includes/layouts/inc_header.php");
	require("../includes/layouts/inc_nav.php");
	
	require("../includes/inc_connect.php");
	require("../includes/inc_functions.php");
	session_start();
	if($_SESSION['functie'] != 'Hoofd administratie'&&$_SESSION['functie'] != 'Financiële administratie'&&$_SESSION['functie'] != 'Personeelsadministratie'&&$_SESSION['functie'] != 'Chef de Cuisine') {
		redirect_to("medewerkers/index.php");
	}
?>
<?php
	
	$artikelcodes = "SELECT artikelnr, omschrijving FROM artikel";
	$result_ac = mysqli_query($con, $artikelcodes)
			or die("Error: ".mysqli_error($con));
	
	if(isset($_POST['inzien'])):		
		$query = "SELECT * FROM inkooporderregel WHERE inkooporderregelnr='". $_POST['inkooporderregelnr'] ."'";
		$result = mysqli_query($con, $query)
			or die("Error: ".mysqli_error($con));
			
		$query_prijs = "SELECT a.omschrijving, a.artikelprijs, i.aantal, i.inkooporderregelnr, i.inkoopordernr ";
		$query_prijs .= "FROM artikel as a, inkooporderregel as i ";
		$query_prijs .= "WHERE a.artikelnr=i.artikelnr ";
		$query_prijs .= "AND i.inkooporderregelnr='". $_POST['inkooporderregelnr'] ."'";
		$prijs_result = mysqli_query($con, $query_prijs)
			or die("Error: ".mysqli_error($con));
			
		while ($rij = mysqli_fetch_assoc($prijs_result)) :
			$rijtot = round($rij['artikelprijs'] * $rij['aantal'], 2);
		endwhile;
		
	endif;
			
	if(isset($_POST['opslaan'])):
		$query_opslaan = "UPDATE inkooporderregel SET inkoopordernr='". $_POST['inkoopordernr'] ."', 
					artikelnr='". $_POST['artikelnr'] ."', 
					aantal='". $_POST['aantal'] ."'
					 WHERE inkooporderregelnr='". $_POST['inkooporderregelnr'] ."'";
		mysqli_query($con, $query_opslaan)
			or die("Error: ".mysqli_error($con));
			
		$melding = "<b>Record met het inkooporderregelnummer ". $_POST['inkooporderregelnr'] ." is bijgewerkt.</b>";
		$terug = 1;
	endif;
	
	if(isset($melding)):
		echo $melding;
	endif;
?>
	<h1>Inkooporderregels</h1>
<form action="" method="post">
	<?php		
		while ($rij = mysqli_fetch_assoc($result)) :
	?>
	<table>
		<tr>
			<td>Inkooporderregelnummer</td>
			<td><input type="text" name="inkooporderregelnr" value="<?php echo $rij['inkooporderregelnr'] ?>" readonly="readonly" /></td>
		</tr>
		<tr>
			<td>Inkoopordernummer</td>
			<td><input type="text" name="inkoopordernr" readonly="readonly" value="<?php echo $rij['inkoopordernr'] ?>" /></td>
		</tr>
		<tr>
			<td>Artikelnummer</td>
			<td>
				<select name="artikelnr" readonly="readonly">
				<?php
					while ($rij_ac = mysqli_fetch_assoc($result_ac)) :
						if ($rij_ac['artikelnr'] == $rij['artikelnr']):
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
			<td><input type="text" name="aantal" readonly="readonly" value="<?php echo $rij['aantal'] ?>" /></td>
		</tr>
		<tr>
			<td>Inkooporderregel totaal</td>
			<td><?php echo number_format($rijtot, 2) ?></td>
		</tr>
	</table>
		
	<input type="hidden" name="inzien" value="<?php echo $rij['inkooporderregelnr']; ?>" />
	<input type="submit" name="opslaan" value="Opslaan" />
	
	<?php
			if(isset($terug)):
			?>
				</form>
				<form action="index.php" method="post">
				<input type="hidden" name="inkoopordernr" value="<?php echo $rij['inkoopordernr']; ?>" />
				<input type="submit" name="ophalen" value="Ga terug" />
				</form>
			<?php
			else:
			?>
				<input type="button" name="" value="Ga terug" onClick="history.go(-1);"/>
				</form>
	<?php
			endif;
		endwhile;
	?>
	<br />
	<b>Alleen velden met een * kunnen bewerkt worden</b>
<?php
	require("../includes/layouts/inc_footer.php");
?>