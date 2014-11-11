<?php
	require("../includes/layouts/inc_header.php");
	require("javascripts/nummers.js");
	require("../includes/layouts/inc_nav.php");
	
	require("../includes/inc_connect.php");
	require("../includes/inc_functions.php");
	
	session_start();
	
	if(!isset($_SESSION['klantnr'])) {
		redirect_to("index.php");
	}

	$query_overzicht = "SELECT * FROM recept WHERE weeknr=$weeknr";
	$result_overzicht = mysqli_query($con, $query_overzicht);
?>
<h1>Bestelpagina</h1>
<form action = "bestelpagina_processing.php" method = "post">
	Vink voor de gewenste maaltijd a.u.b. eerst de checkbox aan <br/>
	<table border="1px">
	<?php 
		while($row_overzicht = mysqli_fetch_array($result_overzicht)){
	?> 
		<tr>
			<td> <?php echo " <input type = \"checkbox\" name = \"receptnr[]\" value = $row_overzicht[receptnr]>"?></td>
			<td> <?php echo "$row_overzicht[omschrijving]" ?></td>
			<td><?php echo "$row_overzicht[verkoopprijs] euro";?> </td>
			<td>Aantal: </td><td> <?php echo "<input type = \"number\" maxlength=\"2\" min=\"1\" max=\"25\" onKeyPress=\"return numbersonly(this, event)\" name = $row_overzicht[receptnr]_aantal>"?></td>
			</tr>
	<?php 
		}
	?>
		
	</table>
	<input type = "submit" name = "verzend" value = "Geef uw bestelling door">
</form>
<?php
	require("../includes/layouts/inc_footer.php");
?>
