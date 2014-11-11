<?php
	require("../includes/layouts/inc_header.php");
	require("../includes/layouts/inc_nav.php");
	
	require("../includes/inc_connect.php");
	require("../includes/inc_functions.php");
	session_start();
	if($_SESSION['functie'] != 'Hoofd expeditie'&&$_SESSION['functie'] != 'Chauffeur'&&$_SESSION['functie'] != 'Chef de Cuisine') {
		redirect_to("medewerkers/index.php");
	}
?>
<?php
	$medewerkerid = $_SESSION['medewerkernr'];
	$query = 	"SELECT routenr, stop1, stop2, stop3, stop4, stop5, maximale_uitrijtijd, postcodegebied, medewerkernr
				FROM routelijst
				WHERE medewerkernr = {$medewerkerid}
				;";
	$query_result = mysqli_query($con, $query);
	if(mysqli_num_rows($query_result) !== 1) {
		die("U heeft op dit moment geen routelijst.");
	}
?>
	<h2>Route</h2>
	
	<table cellspacing = "10">
		<tr>
			<td>Routenummer</td><td>Stop 1</td><td>Stop 2</td><td>Stop 3</td><td>Stop 4</td><td>Stop 5</td><td>Maximale uitrijtijd</td><td>Postcodegebied</td><td>Medewerkernummer</td>
		</tr>
<?php
		while($query_row = mysqli_fetch_assoc($query_result)) {
?>		<tr>
			<td><?php echo $query_row['routenr']?></td>
			<td><?php echo $query_row['stop1']?></td>
			<td><?php echo $query_row['stop2']?></td>
			<td><?php echo $query_row['stop3']?></td>
			<td><?php echo $query_row['stop4']?></td>
			<td><?php echo $query_row['stop5']?></td>
			<td><?php echo $query_row['maximale_uitrijtijd']?></td>
			<td><?php echo $query_row['postcodegebied']?></td>
			<td><?php echo $query_row['medewerkernr']?></td>
		</tr>
<?php
		}
?>
	</table>

<?php
	require("../includes/layouts/inc_footer.php");
?>