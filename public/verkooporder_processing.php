<?php
require("../includes/layouts/inc_header.php");
require("../includes/layouts/inc_nav.php");
require("../includes/inc_connect.php");
require("../includes/inc_functions.php");

session_start();

if($_SESSION['functie'] != 'Medewerker verkoop' && $_SESSION['functie'] != 'Medewerker keuken' && $_SESSION['functie'] != 'Chef de Cuisine') {
    redirect_to("medewerkers/index.php");
}

$aantal_array = array();

$status = $_POST['status'];
$ordernr = $_POST['ordernr'];
$query = "UPDATE `order` SET status = {$status} WHERE ordernr = {$ordernr};";
$query_result = mysqli_query($con, $query);

if ($_POST['status'] == 5) :
    $select_orderregel = "SELECT receptnr, aantal FROM orderregel WHERE ordernr=". $ordernr ."";
    $orderregel_result = mysqli_query($con, $select_orderregel);

    while ($rijen = mysqli_fetch_assoc($orderregel_result)) :
        $aantal_array[$rijen['receptnr']] = $rijen['aantal'];
    endwhile;

    foreach ($aantal_array as $receptnr => $aantal) :
        $select_artikelrecept = "SELECT * FROM artikelrecept WHERE receptnr=". $receptnr ."";
        $artikelrecept_result = mysqli_query($con, $select_artikelrecept);

        while ($rijen = mysqli_fetch_assoc($artikelrecept_result)) :
            $gereserveerd = $aantal * $rijen['aantal'];
            $update_aantal = "UPDATE artikel SET gr=gr - ". $gereserveerd ." WHERE artikelnr=". $rijen['artikelnr'] ."";
            mysqli_query($con, $update_aantal);
        endwhile;

    endforeach;
endif;

if($query_result) {
    echo "<span class=\"groenmelding\"> Status gewijzigd. </span>";
} 
else {
    echo "<span class=\"melding\">Er is iets fout gegaan met het wijzigen van de status.</span>";
}

?>

<br/>
<br/>
<br/>

<form action = "verkooporder.php" method = "post">
<input type = "submit" name = "verkooporders" value = "Terug naar Verkooporders">
</form>
<br/>
<?php
if($_SESSION['functie'] == 'Medewerker verkoop') {
?>
    <form action = "verkoop.php" method = "post">
    <input type = "submit" name = "verkoop" value = "Terug naar Verkoop">
    </form>
<?php
}
else { 
?>
    <form action = "keuken.php" method = "post">
    <input type = "submit" name = "keuken" value = "Terug naar Keuken">
    </form>
<?php
}
require("../includes/layouts/inc_footer.php");
?>