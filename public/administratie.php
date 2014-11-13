<?php
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
	$query = "SELECT * FROM inkooporder";
	$result = mysqli_query($con, $query)
			or die("Error: ".mysqli_error($con));			
?>
<h1>Administratie</h1>
Wijzig inkooporders <br/>
Selecteer een inkoopordernummer: <br />
<form action="administratie_inkooporder.php" method="post">
	<select name="inkoopordernr">
		<?php
			while ($rij = mysqli_fetch_assoc($result)) :
				echo "<option value=\"". $rij['inkoopordernr'] ."\">". $rij['inkoopordernr'] ."</option>"; 
			endwhile;
		?>
	</select>
	<input type="submit" name="ophalen" value="Gegevens ophalen">
</form>
<br/>
Wijzig verkooporderstatus <br/>
<form action = "verkooporder.php" method = "post">
	<table>
		<tr>
			<td> <input type = "submit" name = "verzend_order" value = "Geplaatste orders"</td>
		</tr>
	</table>
</form>
<?php
	require("../includes/layouts/inc_footer.php");
?>