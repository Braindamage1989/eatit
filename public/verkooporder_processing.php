<?php
require("../includes/layouts/inc_header.php");
require("../includes/layouts/inc_nav.php");
require("../includes/inc_connect.php");
require("../includes/inc_functions.php");

session_start();

if($_SESSION['functie'] != 'Medewerker verkoop' && $_SESSION['functie'] != 'Medewerker keuken' && $_SESSION['functie'] != 'Chef de Cuisine') {
    redirect_to("medewerkers/index.php");
}

if(!isset($_POST['wijzig_status'])) {
    redirect_to("verkooporder.php");
}

$status = $_POST['status'];
$ordernr = $_POST['ordernr'];
$query = "UPDATE `order` SET status = {$status} WHERE ordernr = {$ordernr};";
$query_result = mysqli_query($con, $query);

if($query_result) {
    $_SESSION['message'] = "Status gewijzigd.";
    redirect_to("verkooporder.php");
} 
else {
$_SESSION['message'] = "Er is iets fout gegaan met het wijzigen van de status.";
redirect_to("verkooporder.php");
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