<?php
	session_start();
	
	require("../includes/layouts/inc_header.php");
	require("../includes/layouts/inc_nav.php");
	
	include("../includes/inc_connect.php");

	$query_overzicht = "SELECT * FROM artikel WHERE soort = '". $_POST['soort'] ."'";
	$result_overzicht = mysqli_query($con, $query_overzicht)
		or die("Error: ".mysqli_error($con));
?>

<form action = "inkoop_leverancier_verwerk.php" method = "post">
	Vink voor de gewenste maaltijd a.u.b. eerst de checkbox aan <br/>
	<table border="1px">
	<?php 
		while($row_overzicht = mysqli_fetch_assoc($result_overzicht)){
	?> 
		<tr>
			<td> <?php echo " <input type = \"checkbox\" name = \"artikelnr[$row_overzicht[artikelnr]]\" value = $row_overzicht[artikelnr]>"?></td>
			<td> <?php echo "$row_overzicht[omschrijving]" ?></td>
			<td><?php echo "$row_overzicht[artikelprijs] euro";?> </td>
			<td>Aantal: </td><td> <?php echo "<input type = \"number\" min=\"0\" value=\"0\" name = \"artikelnr[". $row_overzicht['artikelnr'] ."]\">"?></td>
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