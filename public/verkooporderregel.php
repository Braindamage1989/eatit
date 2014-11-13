<?php
	require("../includes/layouts/inc_header.php");
	require("../includes/layouts/inc_nav.php");
	
	require("../includes/inc_connect.php");
	require("../includes/inc_functions.php");
	
	session_start();
	
	if( $_SESSION['functie'] != 'Hoofd administratie'&&
            $_SESSION['functie'] != 'Financiele administratie'&&
            $_SESSION['functie'] != 'Personeelsadministratie'&&
            $_SESSION['functie'] != 'Medewerker verkoop' &&
            $_SESSION['functie'] != 'Medewerker keuken' &&
            $_SESSION['functie'] != 'Chef de Cuisine') {
		redirect_to("medewerkers/index.php");
	}
        
	$verkoopordernr = $_SESSION['verkooporder'];
	
	$regel_query = "SELECT * FROM orderregel og
					JOIN recept rc
					ON og.receptnr = rc.receptnr
					WHERE ordernr = {$verkoopordernr};";
	$regel_result = mysqli_query($con, $regel_query);
	
	$orderregelnr_query = "SELECT orderregelnr FROM orderregel;";
	$orderregelnr_result = mysqli_query($con, $orderregelnr_query);
?>
	<h1>Verkooporderregels</h1>
	<table>
		<tr>
			<td>Verkooporderregelnummer</td> <td>Verkoopordernummer</td> <td>Receptnummer</td> <td>Omschrijving</td> <td>Aantal</td>
		</tr>
		<?php
	while($regel_row = mysqli_fetch_assoc($regel_result)) { ?>
		<tr>
			<td> <?php echo "$regel_row[orderregelnr]" ?></td>
			<td> <?php echo "$regel_row[ordernr]";?> </td>
			<td> <?php echo "$regel_row[receptnr]";?> </td>
			<td> <?php echo "$regel_row[omschrijving]";?> </td>
			<td> <?php echo "$regel_row[aantal]";?> </td>
		</tr>
		<?php } ?>
	</table>
        <form action = "verkooporder.php" method = "post">
		<input type = "submit" name = "verkooporder" value = "Terug naar order inzien">
	</form>
<?php
	require("../includes/layouts/inc_footer.php");
?>