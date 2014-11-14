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

	if(!isset($_POST['wijzig_status'])) {
		redirect_to("verkooporder.php");
	}
        
	$verkoopordernr = $_POST['ordernr'];

	$query = "SELECT * FROM `order`  WHERE ordernr = {$verkoopordernr};";
	$query_result = mysqli_query($con, $query);
	while($query_row = mysqli_fetch_assoc($query_result)) {
?>


<h1>Wijziging van verkooporder <?php echo $query_row['ordernr']; ?></h1>
<form action = "verkooporder_processing.php" method = "post">
	<table>
		<tr>
			<td>Verkoopordernummer: </td><td><input type = "text" readonly = "readonly" name = "ordernr" value = "<?php echo $query_row['ordernr']; ?>" /></td>
		</tr>
		<tr>
			<td>Klantnummer: </td><td><input type = "text" readonly = "readonly" name = "klantnr" value = "<?php echo $query_row['klantnr']; ?>" /></td>
		</tr>
		<tr>
			<td>Status: </td>
                        <td>
                            <select name = "status" />
				<option value = "1" <?php if ($query_row['status'] == 1): echo "selected=\"selected\""; endif; ?>>Besteld</option>
				<option value = "5" <?php if ($query_row['status'] == 5): echo "selected=\"selected\""; endif; ?>>Bereiden</option>
				<option value = "7" <?php if ($query_row['status'] == 7): echo "selected=\"selected\""; endif; ?>>Klaar</option>
                                <option value = "9" <?php if ($query_row['status'] == 9): echo "selected=\"selected\""; endif; ?>>Afgehandeld</option>
                            </select>
			</td>
                        
		</tr>
		<tr>
			<td>Betaald: </td>
                        <td>
                            <select name = "betaald" />
				<option value = "1" <?php if ($query_row['betaald'] == 1): echo "selected=\"selected\""; endif; ?>>Ok</option>
				<option value = "5" <?php if ($query_row['betaald'] == 5): echo "selected=\"selected\""; endif; ?>>Niet betaald</option>
				<option value = "9" <?php if ($query_row['betaald'] == 9): echo "selected=\"selected\""; endif; ?>>Betaald</option>
                            </select>
			</td>
                        <td><span class="melding">Deze optie gebruik je alleen als je van de administratie bent</span></td>
		</tr>
		<tr>
			<td>Ordertijd: </td><td><input type = "text" readonly = "readonly" name = "ordertijd" value = "<?php echo $query_row['ordertijd']; ?>" /></td>
		</tr>
		<tr>
                    <td><input type = "submit" name = "wijzig_status" value = "Wijzig" /></td>
		</tr>
	</table>
</form>
<?php } ?>
	<br/>
	<br/>
	<br/>
	<form action = "verkooporder.php" method = "post">
		<input type = "submit" name = "verkooporders" value = "Terug naar Verkooporders">
	</form>
<?php
	require("../includes/layouts/inc_footer.php");
?>