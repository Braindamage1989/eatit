<?php
	require("../includes/layouts/inc_header.php");
	require("javascripts/nummers.js");
	require("../includes/layouts/inc_nav.php");
	
	require("../includes/inc_connect.php");
	require("../includes/inc_functions.php");
	
	session_start();
	
	$melding = null;
        $fout = null;
	
	if($_SESSION['functie'] != 'Medewerker keuken' && $_SESSION['functie'] != 'Chef de Cuisine') {
		redirect_to("medewerkers/index.php");
	}
	
	$select_artikel = "SELECT * FROM artikel WHERE artikelnr=". $_POST['artikelnr'] ."";
	$result_artikel = mysqli_query($con, $select_artikel)
		or die("Fout bij select_artikel: ".mysqli_error($con));
	
	if(isset($_POST['terug'])):
		header('Location: keuken.php');
	endif;
	
	if(isset($_POST['opslaan'])) :
		if ($_POST['tv'] == '') :
			$melding .= "<span class=\"melding\">Je hebt geen technische voorraad ingevuld.<br /></span>";
			$fout = 1;
		endif;
		
		if ($_POST['ib'] == '') :
			$melding .= "<span class=\"melding\">Je hebt geen in bestelling ingevuld.<br /></span>";
			$fout = 1;
		endif;
		
		if ($_POST['gr'] == '') :
			$melding .= "<span class=\"melding\">Je hebt geen gereserveerd ingevuld.<br /></span>";
			$fout = 1;
		endif;
		
		if ($_POST['bd'] == '') :
			$melding .= "<span class=\"melding\">Je hebt geen bedorven ingevuld.<br /></span>";
			$fout = 1;
		endif;
		
		if ($fout != 1)	:
			$update = "UPDATE artikel SET tv=". $_POST['tv'] .", ib=". $_POST['ib'] .", gr=". $_POST['gr'] .", bd=". $_POST['bd'] ." ";
			$update .= "WHERE artikelnr=". $_POST['artikelnr'] ."";
			mysqli_query($con, $update)
				or die("Fout bij insert_into: ".mysqli_error($con));
				
			$melding .= "<span class=\"groenmelding\">Toevoegen aan database gelukt!</span>";
		endif;
	endif;
	
	if(isset($melding)) :
		echo $melding;
	endif;
?>
<h1>Voorraden van artikel bijwerken</h1>
<form action="" method="post">
	<table>
		<?php
			while ($rij = mysqli_fetch_assoc($result_artikel)) :
		?>
		<tr>
			<td>Artikelnummer</td>
			<td><input type="text" min="0" max="99" name="artikelnr" readonly="readonly" value="<?php echo $rij['artikelnr']; ?>" /></td>
			<td></td>
		</tr>
		<tr>
			<td>Technische voorraad</td>
			<td><input type="number" min="0" max="99" name="tv" onKeyPress="return numbersonly(this, event)" value="<?php if(isset($_POST['opslaan'])) : echo $_POST['tv']; else: echo $rij['tv']; endif; ?>" /></td>
			<td>(Actuele voorraad)</td>
		</tr>
		<tr>
			<td>In bestelling</td>
			<td><input type="number" min="0" max="99" name="ib" onKeyPress="return numbersonly(this, event)" value="<?php if(isset($_POST['opslaan'])) : echo $_POST['ib']; else: echo $rij['ib']; endif; ?>" /></td>
			<td></td>
		</tr>
		<tr>
			<td>Gereserveerd</td>
			<td><input type="number" min="0" max="99" name="gr" onKeyPress="return numbersonly(this, event)" value="<?php if(isset($_POST['opslaan'])) : echo $_POST['gr']; else: echo $rij['gr']; endif; ?>" /></td>
			<td></td>
		</tr>
		<tr>
			<td>Bedorven</td>
			<td><input type="number" min="0" max="99" name="bd" onKeyPress="return numbersonly(this, event)" value="<?php if(isset($_POST['opslaan'])) : echo $_POST['bd']; else: echo $rij['bd']; endif; ?>" /></td>
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