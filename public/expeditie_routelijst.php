<?php
	require("../includes/layouts/inc_header.php");
	require("../includes/layouts/inc_nav.php");
	
	require("../includes/inc_connect.php");
	require("../includes/inc_functions.php");
        
	session_start();
        
	if($_SESSION['functie'] != 'Hoofd expeditie'&&$_SESSION['functie'] != 'Chauffeur'&&$_SESSION['functie'] != 'Chef de Cuisine') {
		redirect_to("medewerkers/index.php");
	}
        
        $routenr = $_POST['routenr'];
	$query = 	"SELECT o.routenr, o.ordernr, k.adres, k.postcode FROM `order` AS o, klant AS k, routelijst AS r"
                . "     WHERE o.klantnr=k.klantnr AND o.routenr=r.routenr "
                . "     AND r.routenr={$routenr}";
        $query_result = mysqli_query($con, $query);
?>
<h1>Bezorgroute</h1>
        <table cellspacing = "10">
<?php
        foreach ($query_result AS $array) :
            //echo "<tr>";
            foreach ($array AS $sleutel => $waarde) :
                echo "<tr><td>$sleutel</td><td> = </td><td>$waarde</td></tr>";
            endforeach;
            echo "<td></td>";
            echo "<tr></tr><tr></tr>";
            //echo "<br />";
        endforeach;
?>
	</table>
<form action="expeditie.php" method="post">
    <input type="submit" name="expeditie" value="Ga terug">
</form>
<?php
	require("../includes/layouts/inc_footer.php");
?>