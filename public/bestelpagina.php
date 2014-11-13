<?php
	require("../includes/layouts/inc_header.php");
	require("javascripts/nummers.js");
	require("../includes/layouts/inc_nav.php");
	
	require("../includes/inc_connect.php");
	require("../includes/inc_functions.php");
	
	session_start();
	
	if(!isset($_SESSION['klantnr'])) {
		redirect_to("index.php");
	}

	$query_overzicht = "SELECT * FROM recept WHERE weeknr=$weeknr OR weeknr='';";
	$result_overzicht = mysqli_query($con, $query_overzicht);
        
        $klantnr = $_SESSION['klantnr'];
        $query_klantgegevens = "SELECT * FROM klant WHERE klantnr = {$klantnr};";
        $result_klantgegevens = mysqli_query($con, $query_klantgegevens);
        
?>
<h1>Bestelpagina</h1>
<?php
if (isset($_SESSION['melding'])):
            echo $_SESSION['melding'];
            $_SESSION['melding'] = null;
endif;
?>
<form action = "bestelpagina_processing.php" method = "post">
	Vink voor de gewenste maaltijd a.u.b. eerst de checkbox aan <br/>
	<table border="1px">
	<?php 
		while($row_overzicht = mysqli_fetch_array($result_overzicht)){
	?> 
		<tr>
                        <?php echo " <input type = \"hidden\" name = \"receptnr[$row_overzicht[receptnr]]\" />"?>
			<td> <?php echo "$row_overzicht[omschrijving]" ?></td>
			<td><?php echo "$row_overzicht[verkoopprijs] euro";?> </td>
			<td>Aantal: </td><td> <?php echo "<input type = \"number\" maxlength=\"2\" min=\"1\" max=\"25\" onKeyPress=\"return numbersonly(this, event)\" name = receptnr[$row_overzicht[receptnr]]>"?></td>
			</tr>
	<?php 
		}
	?>
		
	</table>
	<input type = "submit" name = "verzend" value = "Geef uw bestelling door">
</form>
<br/>
<br/>
<p>Kloppen onderstaande gegevens?</p>
<table>
    <?php while ($row_klantgegevens = mysqli_fetch_assoc($result_klantgegevens)) {
        ?>  <tr>
                <td>Naam:</td><td><?php echo $row_klantgegevens['voornaam'] . " " . $row_klantgegevens['achternaam'];?></td>
            </tr>
            <tr>
                <td>Adres:</td><td><?php echo $row_klantgegevens['adres']?></td>
            </tr>
            <tr>
                <td>Postcode:</td><td><?php echo $row_klantgegevens['postcode']?></td>
            </tr>
            <tr>
                <td>Plaats:</td><td><?php echo $row_klantgegevens['woonplaats']?></td>
            </tr>
            <tr>
                <td>Telefoonnummer:</td><td><?php echo $row_klantgegevens['telefoonnr']?></td>
            </tr>
            <tr>
                <td>Email:</td><td><?php echo $row_klantgegevens['email']?></td>
            </tr>     
        <?php } ?>
</table>
<p>Zo niet, klik dan <a href = "klantgegevens.php">hier</a> om uw gegevens te wijzigen.</p>
<?php
	require("../includes/layouts/inc_footer.php");
?>