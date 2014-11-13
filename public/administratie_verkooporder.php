<?php
ini_set('display_errors', 1); 
error_reporting(E_ALL);
	require("../includes/layouts/inc_header.php");
	require("../includes/layouts/inc_nav.php");
	
	require("../includes/inc_connect.php");
	require("../includes/inc_functions.php");
	session_start();
	if($_SESSION['functie'] != 'Hoofd administratie'&&$_SESSION['functie'] != 'Financiele administratie'&&$_SESSION['functie'] != 'Personeelsadministratie'&&$_SESSION['functie'] != 'Chef de Cuisine') {
		redirect_to("medewerkers/index.php");
	}
?>

<?php
	$verkoop_query =	"SELECT * FROM `order` od
						JOIN orderregel og
						ON od.ordernr = og.ordernr
						JOIN recept rc
						ON rc.receptnr = og.receptnr
						;";
	$verkoop_result = mysqli_query($con, $verkoop_query);
	
	$ordernr_query = "SELECT ordernr FROM `order`;";
	$ordernr_result = mysqli_query($con, $ordernr_query);
?>	
	<h1>Verkooporders</h1>
        <?php if(isset($_SESSION['message'])){
        echo $_SESSION['message'];
        $_SESSION["message"] = null;
        } ?>
	<table>
		<tr>
			<td>Ordernummer</td> <td>Receptnummer</td> <td>Omschrijving</td> <td>Status</td> <td>Ordertijd</td>
		</tr>
		<?php
	while($verkoop_row = mysqli_fetch_assoc($verkoop_result)) { ?>
		 <tr>
			<td> <?php echo "$verkoop_row[ordernr]" ?></td>
			<td> <?php echo "$verkoop_row[status]" ?></td>
			<td> <?php echo "$verkoop_row[ordertijd]" ?></td>
			</tr>
	<?php } ?>
	</table>
	
	<br/>
	<form action = "administratie_wijzig_verkooporder.php" method = "post">
		Wijzig status van verkooporder:<br/>
		<?php echo "<select name = ordernr>";
		while($ordernr_row = mysqli_fetch_assoc($ordernr_result)){
			echo " <option value = $ordernr_row[ordernr]> $ordernr_row[ordernr]</option>";
		} echo "</select>"; 
		?> 
		<input type = "submit" name = "wijzig_status" value = "Wijzig">
	</form>
	<br/>
	<br/>
	<br/>

	<form action = "administratie.php" method = "post">
		<input type = "submit" name = "verkoop" value = "Terug naar Administratie">
	</form>

<?php
	require("../includes/layouts/inc_footer.php");
?>