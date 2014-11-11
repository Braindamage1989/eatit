<?php
	require("../includes/layouts/inc_header.php");
	require("../includes/layouts/inc_nav.php");
	
	require("../includes/inc_connect.php");
	require("../includes/inc_functions.php");
	
	session_start();
	
	if($_SESSION['functie'] != 'Medewerker keuken'&&$_SESSION['functie'] != 'Chef de Cuisine') {
		redirect_to("medewerkers/index.php");
	}

	$inkoop_query =	"SELECT * FROM inkooporder io
					JOIN inkooporderregel ir
					ON ir.inkoopordernr = io.inkoopordernr
					ORDER BY io.leverdatum;";
	$inkoop_result = mysqli_query($con, $inkoop_query);
	
	$ordernr_query = "SELECT inkoopordernr FROM inkooporder;";
	$ordernr_result = mysqli_query($con, $ordernr_query);
	
?>	
	<h1>Inkooporders</h1>
<?php
	if(isset($_SESSION['melding'])) {
		echo $_SESSION['melding'];
		$_SESSION['melding'] = null;
	}
?>
	<form action = "keuken_inkooporderregel.php" method = "post">
	<table>
		<tr>
			<td></td><td>Inkoopordernummer</td> <td>Leveranciersnummer</td> <td>Orderdatum</td> <td>Leverdatum</td> <td>Status</td> <td>Betaald</td>
		</tr>
		<?php
	while($inkoop_row = mysqli_fetch_assoc($inkoop_result)) { ?>
		 <tr>
			<td> <?php echo " <input type = \"radio\" name = \"inkooporder\" value = $inkoop_row[inkoopordernr]>"?></td>
			<td> <?php echo "$inkoop_row[inkoopordernr]" ?></td>
			<td> <?php echo "$inkoop_row[lev_nr]";?> </td>
			<td> <?php echo "$inkoop_row[orderdatum]";?> </td>
			<td> <?php echo "$inkoop_row[leverdatum]";?> </td>
			<td> <?php echo "$inkoop_row[status]";?> </td>
			<td> <?php echo "$inkoop_row[betaald]";?> </td>
			</tr>
	<?php } ?>
	</table>
	<input type = "submit" name = "verzend_inkooporderregel" value = "Toon inkooporderregel">
	</form>
	
	<br/>
	<form action = "keuken_wijzig_inkooporder.php" method = "post">
		Wijzig status van inkooporder:<br/>
		<?php echo "<select name = wijzig_inkoopordernr>";
		while($ordernr_row = mysqli_fetch_assoc($ordernr_result)){
			echo " <option value = \".$ordernr_row[inkoopordernr].\"> $ordernr_row[inkoopordernr]</option>";
		} echo "</select>"; 
		?> 
		<input type = "submit" name = "wijzig_inkooporder" value = "Wijzig">
	</form>
	<br/>
	<br/>
	<br/>
	<form action = "keuken.php" method = "post">
		<input type = "submit" name = "keuken" value = "Terug naar Keuken">
	</form>
<?php
	require("../includes/layouts/inc_footer.php");
?>