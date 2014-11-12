<?php
	require("../includes/layouts/inc_header.php");
	require("../includes/layouts/inc_nav.php");
	
	require("../includes/inc_connect.php");
	require("../includes/inc_functions.php");

	session_start();

	if(!isset($_SESSION['klantnr'])) {
		redirect_to("index.php");
	}
	if(!isset($_POST['verzend'])) {
		redirect_to("bestelpagina.php");
	}
	
	$melding = null;
        
        if(empty($_POST['receptnr'])) {
            redirect_to("bestelpagina.php");
        }
	
	foreach ($_POST as $sleutel => $waarde) :
            if ($waarde == null):
                unset($_POST[$sleutel]);
            endif;
            if ($sleutel == 'verzend'):
                 unset($_POST[$sleutel]);
            endif;
        endforeach;
	
        // bepalen waar array in post vandaan komt en waarvoor deze gebruikt word, geen nut is verwijderen of unsetten
        
	print_r($_POST);
	
	include("../includes/inc_connect.php");

	$aantal_rijen = count ($_POST['receptnr']);
	$teller = 1;
	$query = "SELECT receptnr, omschrijving, verkoopprijs AS 'prijs' FROM recept WHERE ";
	
	foreach ($_POST['receptnr'] as $sleutel => $waarde) :
		if ($aantal_rijen != $teller) :
			$query .= "receptnr='$waarde' OR ";
			$recept[$waarde] = $_POST[''. $waarde .'_aantal'];
		else:
			$query .= "receptnr='$waarde'";
			$recept[$waarde] = $_POST[''. $waarde .'_aantal'];
		endif;
		$aantal[$waarde] = $_POST[''. $waarde .'_aantal'];
		$teller++;
	endforeach;
	
	$_SESSION['bestelling'] = $recept;
	$result = mysqli_query($con, $query)
		or die("Error: ".mysqli_error($con));
			
	$tot = 0;		
?>
	<table>
<?php
	foreach ($result as $array) :
		foreach ($array as $sleutel => $waarde) :
			echo "<tr>\n";
			if ($sleutel == 'receptnr'):
				$receptnr = $waarde;
			elseif ($sleutel == 'prijs'):
				$subtot = $waarde * $aantal[$receptnr];
			endif;
			echo "<td>". ucfirst($sleutel). "</td>\n";
			echo "<td>$waarde</td>\n";
			echo "</tr>\n";
		endforeach;
		echo "<tr>\n";
		echo "<td>Aantal</td>\n";
		echo "<td>". $aantal[$receptnr] ."</td>\n";
		echo "</tr>\n";
		echo "<tr>\n";
		echo "<td>Subtotaal</td>\n";
		echo "<td>". number_format($subtot, 2) ."</td>\n";
		echo "</tr>\n";
		echo "<tr><td>&nbsp;</td></tr>\n";
		$tot += $subtot;
	endforeach;
?>
		<tr>
			<td>Totaal</td>
			<td><?php echo number_format($tot, 2); ?></td>
		</tr>
	</table>
	<br />
	
	Klopt uw bestelling?
        <br/>
	<form action="bestelpagina_bevestig.php" method="post">
		<input type="submit" name="bevestigen" value="Ja" />
        </form> <br/>
        <form action="bestelpagina.php" method="post">
		<input type="submit" name="bevestigen" value="Nee" />
        </form>
<?php
	require("../includes/layouts/inc_footer.php");
?>
