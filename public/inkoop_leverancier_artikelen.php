<?php
	session_start();
	
	require("../includes/layouts/inc_header.php");
	require("../includes/layouts/inc_nav.php");
	
	include("../includes/inc_connect.php");

	$query_overzicht = "SELECT DISTINCT l.lev_nr as lev_nr, a.soort as soort, a.artikelnr as artikelnr, a.omschrijving as omschrijving, a.artikelprijs as artikelprijs ";
        $query_overzicht .= "FROM artikel as a, leveranciers as l ";
        $query_overzicht .= "WHERE l.lev_soort=a.soort AND a.soort='". $_POST['soort'] ."'";
        
	$result_overzicht = mysqli_query($con, $query_overzicht)
		or die("Error: ".mysqli_error($con));
?>
<h1>Bestellen bij leverancier</h1>
<form action = "inkoop_leverancier_verwerk.php" method = "post">
	<table border="1px">
	<?php 
		while($row_overzicht = mysqli_fetch_assoc($result_overzicht)){
                    $lev_nr = $row_overzicht['lev_nr'];
	?> 
		<tr>
			<?php echo " <input type = \"hidden\" name = \"artikelnr[$row_overzicht[artikelnr]]\" value = $row_overzicht[artikelnr]>"?>
			<td> <?php echo "$row_overzicht[omschrijving]" ?></td>
			<td><?php echo "$row_overzicht[artikelprijs] euro";?> </td>
			<td>Aantal: </td><td> <?php echo "<input type = \"number\" min=\"0\" value=\"0\" name = \"artikelnr[". $row_overzicht['artikelnr'] ."]\">"?></td>
		</tr>
	<?php 
                $_SESSION['omschrijving'][$row_overzicht['artikelnr']] = $row_overzicht['omschrijving'];
		}
                
	?>
		
	</table>
        <input type="hidden" name="lev_nr" value="<?php echo $lev_nr; ?>" />
	<input type = "submit" name = "verzend" value = "Geef uw bestelling door">
</form>
<br/>
<br/>
<br/>
<form action = "inkoop.php" method = "post">
	<input type = "submit" name = "inkoop" value = "Terug naar Inkoop">
</form>
<?php
	require("../includes/layouts/inc_footer.php");
?>