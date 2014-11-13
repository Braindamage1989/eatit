<?php
	require("../includes/layouts/inc_header.php");
	require("../includes/layouts/inc_nav.php");
	
	require("../includes/inc_connect.php");
	require("../includes/inc_functions.php");
	session_start();
	if($_SESSION['functie'] != 'Hoofd administratie'&&$_SESSION['functie'] != 'Financiele administratie'&&$_SESSION['functie'] != 'Personeelsadministratie'&&$_SESSION['functie'] != 'Chef de Cuisine') {
		redirect_to("medewerkers/index.php");
	}
	
	if(!isset($_POST['wijzig_status'])) {
		redirect_to("administratie_verkooporder.php");
	}
	
	$status = $_POST['status'];
        $betaald = $_POST['betaald'];
	$ordernr = $_POST['ordernr'];
        $query = "UPDATE `order` SET status = {$status}, betaald = {$betaald} WHERE ordernr = {$ordernr};";
	$query_result = mysqli_query($con, $query);
	
	if($query_result) {
		$_SESSION['message'] = "<span class=\"groenmelding\">Status gewijzigd. <br/></span>";
		redirect_to("administratie_verkooporder.php");
	} else {
		$_SESSION['message'] = "<span class=\"melding\">Er is iets fout gegaan met het wijzigen van de status. <br/></span>";
		redirect_to("administratie_verkooporder.php");
	}
?>
	<br/>
	<br/>
	<br/>
	<form action = "administratie_verkooporder.php" method = "post">
		<input type = "submit" name = "verkooporders" value = "Terug naar Verkooporders">
	</form>
	<br/>

	<form action = "administratie.php" method = "post">
		<input type = "submit" name = "verkoop" value = "Terug naar Administratie">
	</form>

<?php
	require("../includes/layouts/inc_footer.php");
?>
