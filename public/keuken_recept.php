<?php
	require("../includes/layouts/inc_header.php");
	require("../includes/layouts/inc_nav.php");
	
	require("../includes/inc_connect.php");
	require("../includes/inc_functions.php");
	
	session_start();
	
	if($_SESSION['functie'] != 'Medewerker keuken'&&$_SESSION['functie'] != 'Chef de Cuisine'){
		redirect_to("medewerkers/index.php");
	}
	$recept_query =	"SELECT *
					FROM recept;";
	$recept_result = mysqli_query($con, $recept_query);
	
	if (isset($_SESSION['melding'])) :
		echo $_SESSION['melding'];
		$_SESSION['melding'] = null;
	endif;
?>
	<h1>Recepten</h1>
	<form action = "keuken_artikel.php" method = "post">
	<table>
		<tr>
			<td></td><td>Receptnr</td> <td>Omschrijving recept</td> <!--<td>Artikelnr</td> <td>Omschrijving artikel</td> -->
		</tr>
		<?php
	while($recept_row = mysqli_fetch_assoc($recept_result)) { ?>
		 <tr>
		 	<td> <?php echo " <input type = \"radio\" name = \"receptnr\" value = $recept_row[receptnr]>"?></td>
			<td> <?php echo "$recept_row[receptnr]" ?></td>
			<td> <?php echo "$recept_row[omschrijving]" ?></td>
			<!--<td> <?php echo "$recept_row[artikelnr]" ?></td>
			<td> <?php echo "$recept_row[artikelomschrijving]" ?></td> -->
			</tr>
	<?php } ?>
	</table>
	<input type = "submit" name = "verzend_recept" value = "Toon artikelen">
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