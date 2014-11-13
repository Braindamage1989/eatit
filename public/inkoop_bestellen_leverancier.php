<?php
	require("../includes/layouts/inc_header.php");
	require("../includes/layouts/inc_nav.php");
	
	session_start();
	
	require("../includes/inc_connect.php");

	$query = "SELECT * FROM leveranciers";
	$result = mysqli_query($con, $query)
			or die("Error: ".mysqli_error($con));			
?>
<h1>Bestellen bij leverancier</h1>
Selecteer soort leverancier: <br />
<form action="inkoop_leverancier_artikelen.php" method="post">
	<select name="soort">
		<?php
			while ($rij = mysqli_fetch_assoc($result)) :
				echo "<option value=\"". $rij['lev_soort'] ."\">". $rij['lev_soort'] ." - ". $rij['lev_naam'] ."</option>"; 
			endwhile;
		?>
	</select>
	<input type="submit" name="ophalen" value="Gegevens ophalen" />
</form>
<form action = "inkoop.php" method = "post">
	<input type = "submit" name = "inkoop" value = "Terug naar Inkoop">
</form>
<?php
	require("../includes/layouts/inc_footer.php");
?>