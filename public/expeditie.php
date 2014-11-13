<?php
	require("../includes/layouts/inc_header.php");
	require("../includes/layouts/inc_nav.php");
	
	require("../includes/inc_connect.php");
	require("../includes/inc_functions.php");
        
	session_start();
        
	if($_SESSION['functie'] != 'Hoofd expeditie'&&$_SESSION['functie'] != 'Chauffeur'&&$_SESSION['functie'] != 'Chef de Cuisine') {
		redirect_to("medewerkers/index.php");
	}
        
	$medewerkerid = $_SESSION['medewerkernr'];
	$query = 	"SELECT DISTINCT o.routenr, r.maximale_uitrijtijd FROM `order` AS o, klant AS k, routelijst AS r"
                . "     WHERE o.klantnr=k.klantnr AND o.routenr=r.routenr "
                . "     AND r.medewerkernr={$medewerkerid}";
	$query_result = mysqli_query($con, $query);
        
	if(mysqli_num_rows($query_result) == 0) {
		echo "U heeft op dit moment geen routelijst.";
	} else {
?>
	<h1>Route selecteren</h1>
                <form action="expeditie_routelijst.php" method="post">
                        <select name="routenr">
                                <?php
                                        while ($rij = mysqli_fetch_assoc($query_result)) :
                                                echo "<option value='". $rij['routenr'] ."'>". $rij['routenr'] ." - ". $rij['maximale_uitrijtijd'] ."</option> \n";
                                        endwhile
                                ?>
                        </select>
                    <input type="submit" name="ophalen" value="Route selecteren" />
                </form>
<?php
        }
	require("../includes/layouts/inc_footer.php");
?>
