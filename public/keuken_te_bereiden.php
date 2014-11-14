<?php
	require("../includes/layouts/inc_header.php");
	require("../includes/layouts/inc_nav.php");
	
	require("../includes/inc_connect.php");
	require("../includes/inc_functions.php");
	session_start();
	if($_SESSION['functie'] !== 'Medewerker keuken'&&$_SESSION['functie'] !== 'Chef de Cuisine') {
		redirect_to("medewerkers/index.php");
	}
?> 

<?php
	
	$ordernr_query = "SELECT ordernr FROM `order` WHERE status = 1 ORDER BY ordertijd;";
	$ordernr_result = mysqli_query($con, $ordernr_query);
?>	
	<h1>Te bereiden maaltijden</h1>
	<table cellspacing = "10">
		
		<?php
	while($ordernr_row = mysqli_fetch_assoc($ordernr_result)) {
		$verkoop_query =	"SELECT * FROM `order` od
                                        JOIN orderregel og
                                        ON od.ordernr = og.ordernr
                                        JOIN recept rc
                                        ON rc.receptnr = og.receptnr
                                        WHERE od.status = 1 AND od.ordernr = $ordernr_row[ordernr] order by ordertijd
                                        ;";
	$verkoop_result = mysqli_query($con, $verkoop_query);
		?> 
		<tr> <td><h4>Ordernummer: </h4></td><td><h4><?php echo $ordernr_row['ordernr'] ?></h4></td></tr>
		<tr>
			<td>Receptnummer</td> <td>Omschrijving</td> <td>Status</td> <td>Ordertijd</td>
		</tr>
		
		<?php
	while($verkoop_row = mysqli_fetch_assoc($verkoop_result)) { ?>
		 <tr>
			<td> <?php echo "$verkoop_row[receptnr]" ?></td>
			<td> <?php echo "$verkoop_row[omschrijving]" ?></td>
			<td> <?php echo "$verkoop_row[status]" ?></td>
			<td> <?php echo "$verkoop_row[ordertijd]" ?></td>
			</tr>
	<?php }} ?>
	</table>
	
	<form action = "keuken.php" method = "post">
		<input type = "submit" name = "keuken" value = "Terug naar Keuken">
	</form>
<?php
	require("../includes/layouts/inc_footer.php");
?>