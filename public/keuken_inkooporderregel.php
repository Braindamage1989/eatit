<?php
	require("../includes/layouts/inc_header.php");
	require("../includes/layouts/inc_nav.php");
	
	require("../includes/inc_connect.php");
	require("../includes/inc_functions.php");
	
	session_start();
	
	$melding = null;
	
	if($_SESSION['functie'] != 'Medewerker keuken'&&$_SESSION['functie'] != 'Chef de Cuisine') {
		redirect_to("medewerkers/index.php");
	}
	
	if(!isset($_POST['verzend_inkooporderregel'])) {
		redirect_to("keuken_inkooporder.php");
	}
	
	if(empty($_POST['inkooporder'])) :
		$melding .= "<span class=\"melding\">Je hebt geen inkooporder geselecteerd.</span>";
		$_SESSION['melding'] = $melding;
		redirect_to("keuken_inkooporder.php");
	endif;
		
	$inkoopordernr = $_POST['inkooporder'];
	
	$regel_query = "SELECT * FROM inkooporderregel ir
					JOIN artikel ar
					ON ir.artikelnr = ar.artikelnr
					WHERE inkoopordernr = {$inkoopordernr};";
	$regel_result = mysqli_query($con, $regel_query);
	
	$orderregelnr_query = "SELECT inkooporderregelnr FROM inkooporderregel;";
	$orderregelnr_result = mysqli_query($con, $orderregelnr_query);
?>
	<h1>Inkooporderregels</h1>
	<table>
		<tr>
			<td>Inkooporderregelnummer</td> <td>Inkoopordernummer</td> <td>Artikelnummer</td> <td>Omschrijving</td> <td>Aantal</td>
		</tr>
		<?php
	while($regel_row = mysqli_fetch_assoc($regel_result)) { ?>
		<tr>
			<td> <?php echo "$regel_row[inkooporderregelnr]" ?></td>
			<td> <?php echo "$regel_row[inkoopordernr]";?> </td>
			<td> <?php echo "$regel_row[artikelnr]";?> </td>
			<td> <?php echo "$regel_row[omschrijving]";?> </td>
			<td> <?php echo "$regel_row[aantal]";?> </td>
		</tr>
		<?php } ?>
	</table>
	
	<br/>
	<br/>
	<br/>
	<form action = "keuken_inkooporder.php" method = "post">
		<input type = "submit" name = "keuken" value = "Terug naar Inkooporders">
	</form>
	<br/>
	<form action = "keuken.php" method = "post">
		<input type = "submit" name = "keuken" value = "Terug naar Keuken">
	</form>
<?php
	require("../includes/layouts/inc_footer.php");
?>