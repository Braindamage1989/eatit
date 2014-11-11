<?php
	error_reporting(E_ALL);
	ini_set("display_errors", 1);
?>

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
	if(!isset($_POST['wijzig_inkooporderwaarde'])) {
		redirect_to("keuken_inkooporder.php");
	}
	$inkoopordernr = $_POST['inkoopordernr'];
	$lev_nr = $_POST['lev_nr'];
	$orderdatum = $_POST['orderdatum'];
	$leverdatum = $_POST['leverdatum'];
	$status = $_POST['status'];
	$betaald = $_POST['betaald'];
?>

<?php
	$wijzig_query = "UPDATE inkooporder
					SET status = {$status}
					WHERE inkoopordernr = {$inkoopordernr};";
	$wijzig_result = mysqli_query($con, $wijzig_query);
	
	if($wijzig_result) {
		$_SESSION['message'] = "Status gewijzigd.";
		redirect_to("keuken_inkooporder.php");
	} else {
		$_SESSION['message'] = "Fout bij wijzigen van de status.";
		redirect_to("keuken_inkooporder.php");
	}
?>