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
	$totaal = 0;

	$status = array(1 => 'Besteld', 3 => 'Wachten op levering', 5 => 'Geleverd');
	$betaald = array(1 => 'Ok', 5 => 'Niet betaald', 9 => 'Betaald');
	
	if(isset($_POST['ophalen'])):
		$ophalen = "SELECT * FROM inkooporder WHERE inkoopordernr='". $_POST['inkoopordernr'] ."'";
		$ophalen_result = mysqli_query($con, $ophalen)
			or die("Error: ".mysqli_error($con));
			
		$ophalen_iorderegel = "SELECT * FROM inkooporderregel WHERE inkoopordernr='". $_POST['inkoopordernr'] ."'";
		$ophalen_ior_result = mysqli_query($con, $ophalen_iorderegel)
			or die("Error: ".mysqli_error($con));
			
		$query_prijs = "SELECT a.omschrijving, a.artikelprijs, i.aantal, i.inkooporderregelnr, i.inkoopordernr ";
		$query_prijs .= "FROM artikel as a, inkooporderregel as i ";
		$query_prijs .= "WHERE a.artikelnr=i.artikelnr ";
		$query_prijs .= "AND i.inkoopordernr='". $_POST['inkoopordernr'] ."'";
		$prijs_result = mysqli_query($con, $query_prijs)
			or die("Error: ".mysqli_error($con));
			
		while ($rij = mysqli_fetch_assoc($prijs_result)) :
			$rijtot[] = round($rij['artikelprijs'] * $rij['aantal'], 2);
		endwhile;
		
		foreach ($rijtot as $sleutel => $waarde) :
			$totaal += $waarde;
		endforeach;
	
	endif;
	
	if(isset($_POST['opslaan'])):
		$query = "UPDATE inkooporder SET lev_nr='". $_POST['lev_nr'] ."', 
					orderdatum='". $_POST['orderdatum'] ."', 
					leverdatum='". $_POST['leverdatum'] ."', 
					status='". $_POST['status'] ."', 
					betaald='". $_POST['betaald'] ."' 
					WHERE inkoopordernr='". $_POST['inkoopordernr'] ."'";
		$result = mysqli_query($con, $query)
			or die("Error: ".mysqli_error($con));
		$melding = "<span class=\"groenmelding\">Record met het inkoopordernummer ". $_POST['inkoopordernr'] ." is bijgewerkt.</span>";
	endif;
	
	$query_prijs = "SELECT a.omschrijving, a.artikelprijs, i.aantal, i.inkooporderregelnr, i.inkoopordernr ";
	$query_prijs .= "FROM artikel as a, inkooporderregel as i ";
	$query_prijs .= "WHERE a.artikelnr=i.artikelnr";
	$query_prijs .= "AND i.inkoopordernr='". $_POST['inkoopordernr'] ."'";
	
	if(isset($_POST['terug'])):
		header('Location: administratie.php');
	endif;
	
	if(isset($melding)):
		echo $melding;
	endif;
?>
	<h1>Inkooporders</h1>
	<form action="" method="post">
		<?php
			while ($rij = mysqli_fetch_assoc($ophalen_result)) :
		?>
		<table class>
			<tr>
				<td>Inkoopordernummer</td>
				<td><input type="text" name="inkoopordernr" readonly="readonly" value="<?php echo $rij['inkoopordernr'] ?>" /></td>
			</tr>
			<tr>
				<td>Leveranciersnummer</td>
				<td><input type="text" name="lev_nr" readonly="readonly" value="<?php echo $rij['lev_nr'] ?>" /></td>
			</tr>
			<tr>
				<td>Orderdatum</td>
				<td><input type="text" name="orderdatum" readonly="readonly" value="<?php echo $rij['orderdatum'] ?>" /></td>
			<tr>
				<td>Leverdatum</td>
				<td><input type="text" name="leverdatum" readonly="readonly" value="<?php echo $rij['leverdatum'] ?>" /></td>
			</tr>
			<tr>
				<td>Status</td>
				<td>
					<select name="status" readonly="readonly">
					<?php
						foreach ($status as $sleutel => $waarde) :
							if ($rij['status'] == $sleutel):
								echo "<option value='". $sleutel ."' selected=\"selected\">". $waarde ."</option> \n";
							else:
								echo "<option value='". $sleutel ."'>". $waarde ."</option> \n";
							endif;
						endforeach;
					?>
					</select>
				</td>
			</tr>
			<tr>
				<td>Betaald *</td>
				<td>
					<select name="betaald">
					<?php
						foreach ($betaald as $sleutel => $waarde) :
							if ($rij['betaald'] == $sleutel):
								echo "<option value='". $sleutel ."' selected=\"selected\">". $waarde ."</option> \n";
							else:
								echo "<option value='". $sleutel ."'>". $waarde ."</option> \n";
							endif;
						endforeach;
					?>
					</select>
				</td>
			</tr>
			<tr>
				<td>Totaal bedrag</td>
				<td><?php echo number_format($totaal, 2); ?></td>
			</tr>
		</table>
			
		<input type="hidden" name="ophalen" value="1" />
		<input type="submit" name="opslaan" value="Opslaan" />
		<input type="submit" name="terug" value="Ga terug" />
		<?php
			endwhile;
		?>
	</form>
	
	<br />
	<b>Alleen velden met een * kunnen bewerkt worden</b>
	<br /><br />
	
	<form action="administratie_inkooporderregel.php" method="post">
		Inkooporderregel inzien:
			<select name="inkooporderregelnr">
				<?php
					while ($rij = mysqli_fetch_assoc($ophalen_ior_result)) :
							echo "<option value='". $rij['inkooporderregelnr'] ."'>". $rij['inkooporderregelnr'] ."</option> \n";
					endwhile;
				?>
			</select>
			<input type="submit" name="inzien" value="Inzien" />
	</form>
<?php
	require("../includes/layouts/inc_footer.php");
?>