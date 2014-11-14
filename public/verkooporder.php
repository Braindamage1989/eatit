<?php
	require("../includes/layouts/inc_header.php");
	require("../includes/layouts/inc_nav.php");
	
	require("../includes/inc_connect.php");
	require("../includes/inc_functions.php");
	
	session_start();
	
	$melding = null;
	
	if( $_SESSION['functie'] != 'Hoofd administratie'&&
            $_SESSION['functie'] != 'Financiele administratie'&&
            $_SESSION['functie'] != 'Personeelsadministratie'&&
            $_SESSION['functie'] != 'Medewerker verkoop' &&
            $_SESSION['functie'] != 'Medewerker keuken' &&
            $_SESSION['functie'] != 'Chef de Cuisine') {
		redirect_to("medewerkers/index.php");
	}

	/*$verkoop_query =	"SELECT * FROM `order` od
				JOIN orderregel og
				ON od.ordernr = og.ordernr
				JOIN recept rc
				ON rc.receptnr = og.receptnr
				WHERE od.status=1";*/
        $verkoop_query =	"SELECT DISTINCT ordernr, status, ordertijd FROM `order`
				WHERE status BETWEEN 1 AND 7";
	$verkoop_result = mysqli_query($con, $verkoop_query);
	
	$ordernr_query = "SELECT ordernr FROM `order` WHERE status BETWEEN 1 AND 7;";
	$ordernr_result = mysqli_query($con, $ordernr_query);
	
        if(isset($_POST['verzend_verkooporderregel'])):
            if (empty($_POST['verkooporder'])) :
                    $melding .= "<span class=\"melding\">Je hebt geen verkooporder geselecteerd.<br /></span>";
            else: 
                    $_SESSION['verkooporder'] = $_POST['verkooporder'];
                    redirect_to("verkooporderregel.php");
            endif;
        endif;
        
        if(isset($melding)) :
            echo $melding;
        endif;
?>	
	<h1>Verkooporders</h1>
	<form action = "" method = "post">
	<table>
		<tr>
			<td></td><td>Ordernummer</td> <td>Status</td> <td>Ordertijd</td>
		</tr>
		<?php
	while($verkoop_row = mysqli_fetch_assoc($verkoop_result)) { ?>
		 <tr>
		 	<td> <?php echo " <input type = \"radio\" name = \"verkooporder\" value = $verkoop_row[ordernr]>"?></td>
			<td> <?php echo "$verkoop_row[ordernr]" ?></td>
			<td> <?php echo "$verkoop_row[status]" ?></td>
			<td> <?php echo "$verkoop_row[ordertijd]" ?></td>
		</tr>
	<?php } ?>
	</table>
	<input type = "submit" name = "verzend_verkooporderregel" value = "Toon Orderregel">
	</form>
	<br/>
	<form action = "wijzig_verkooporder.php" method = "post">
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
        <form action="index.php" method="post">
            <input type="submit" name="terug" value="Ga terug">
        </form>
<?php
	require("../includes/layouts/inc_footer.php");
?>