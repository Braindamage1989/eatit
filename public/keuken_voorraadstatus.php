<?php
	require("../includes/layouts/inc_header.php");
	require("../includes/layouts/inc_nav.php");
	
	require("../includes/inc_connect.php");
	require("../includes/inc_functions.php");
	session_start();
	if($_SESSION['functie'] != 'Medewerker keuken'&&$_SESSION['functie'] != 'Chef de Cuisine') {
		redirect_to("medewerkers/index.php");
	}
	if(!isset($_POST['verzend_voorraad'])) {
		redirect_to("keuken.php");
	}
	$limiet = 10;
	$query = "SELECT * FROM artikel WHERE tv <= {$limiet};";
	$query_result = mysqli_query($con, $query);
?>
<h1>Voorraadstatus</h1>
<table>
<?php
        if(mysqli_num_rows($query_result) == 0) {
            echo "Alle artikelen zijn nog op voorraad.";
        }
	while($query_row = mysqli_fetch_assoc($query_result)) {
?>
	<tr><td>Artikelnr <?php echo $query_row['artikelnr'] . " heeft een voorraad van " . $query_row['tv']. " en moet worden bijbesteld." ?></td></tr>
<?php
	}
?>
</table>
<br/>
	<br/>
	<br/>
	<form action = "keuken.php" method = "post">
		<input type = "submit" name = "keuken" value = "Terug naar Keuken">
	</form>
<?php
	require("../includes/layouts/inc_footer.php");
?>