<?php
	include("../includes/inc_connect.php");
	session_start();
?>
<?php
	function redirect_to($new_location) {
		header("Location: " . $new_location);
		exit;
	}
?>

<?php
	if(!isset($_POST['wijzig_inkooporderregelwaarde'])) {
		redirect_to("keuken_inkooporder.php");
	}
	$inkooporderregelnr = $_POST['inkooporderregelnr'];
	$inkoopordernr = $_POST['inkoopordernr'];
	$artikelnr = $_POST['artikelnr'];
	$aantal = $_POST['aantal'];
?>

<?php
	$wijzig_query = "UPDATE inkooporderregel
					SET artikelnr = {$artikelnr},
					aantal = {$aantal}
					WHERE inkooporderregelnr = {$inkooporderregelnr};";
	$wijzig_result = mysqli_query($con, $wijzig_query);
	
	if($wijzig_result) {
		$_SESSION['message'] = "Inkooporderregel gewijzigd.";
		redirect_to("keuken_inkooporder.php");
	} else {
		$_SESSION['message'] = "Fout bij wijzigen van de inkooporderregel.";
		redirect_to("keuken_inkooporder.php");
	}
?>