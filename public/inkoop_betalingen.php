<?php
	require("../includes/layouts/inc_header.php");
	require("../includes/layouts/inc_nav.php");
	
	require("../includes/inc_connect.php");
	require("../includes/inc_functions.php");
	session_start();
	if($_SESSION['functie'] != 'Medewerker inkoop'&&$_SESSION['functie'] != 'Hoofd commerciele afdeling'&&$_SESSION['functie'] != 'Chef de Cuisine') {
		redirect_to("medewerkers/index.php");
	}
	$melding = null;

	$query = "SELECT * FROM inkooporder ORDER BY orderdatum, betaald;";
	$query_result = mysqli_query($con, $query);
	
	if(isset($_POST['verzend'])) {
		$query2 = "SELECT * FROM inkooporder WHERE inkoopordernr = ".$_POST['inkooporder'];
		$query2_result = mysqli_query($con, $query2);
		while($query2_row = mysqli_fetch_assoc($query2_result)) {
			switch($query2_row['betaald']) {
				case'1': $melding= "OK";
				break;
				case'5': $melding= "Nog niet betaald";
				break;
				case'9': $melding= "Betaald";
				break;
			}
		}
	}
?>
	<h1>Controleer betalingen</h1>
	<?php echo $melding; ?>
		<form action = "" method = "post">
			<select name = "inkooporder">
<?php
	while ($query_row = mysqli_fetch_assoc($query_result)) {
?>		<option value = "<?php echo $query_row['inkoopordernr'];?>"><?php echo $query_row['inkoopordernr'];?></option>
        <?php } ?>
		</select>
		<input type = "submit" value="Controleer" name="verzend">
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