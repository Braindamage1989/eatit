<?php
	require("../includes/layouts/inc_header.php");
	require("../includes/layouts/inc_nav.php");
	
	include("../includes/inc_connect.php");
        include("../includes/inc_functions.php");
	session_start();
        
        if(isset($_SESSION['medewerkernr'])) {
            redirect_to("medewerkers/index.php");
        }
	
	if(isset($_POST['inloggen'])) :
		$melding = null;
		$query = "SELECT * FROM klant WHERE email='". $_POST['email'] ."' AND wachtwoord='". $_POST['wachtwoord'] ."'";
		$result = mysqli_query($con, $query)
			or die("Error: ".mysqli_error($con));
			
		$aantal_rijen = mysqli_num_rows($result);
		if ($aantal_rijen == 1) :
			while ($rij = mysqli_fetch_assoc($result)) :
				$_SESSION['klantnr'] = $rij['klantnr'];
			endwhile;
		elseif (empty($_POST['email']) && empty($_POST['wachtwoord'])) :
			$melding .= "<span class=\"melding\">Je hebt niets ingevoerd</span><br/><br/>";
		elseif ($aantal_rijen == 0) :
			$melding .= "<span class=\"melding\">De ingevoerde gegevens komen niet overeen</span><br/><br/>";
		endif;
	endif;
	
	if(isset($_SESSION['klantnr'])) :
		header('Location: bestelpagina.php');
	endif;
	
	if(isset($melding)) :
            echo $melding;
        elseif(isset($_SESSION['melding'])) :
            echo $_SESSION['melding'];
            $_SESSION['melding'] = null;
	endif;
  
?>
<h1>Inloggen</h1>
Om een bestelling te kunnen plaatsen moet je ingelogd zijn. <br />
Na het inloggen wordt je automatisch doorgestuurd naar het menuoverzicht. <br />
Als je nog geen account hebt, dan kun je jezelf <a href="registreer.php">hier</a> registeren. <br />
<form action="" method="post">
	<table>
		<tr>
			<td>E-mailadres</td>
			<td><input type="text" name="email" /></td>
		</tr>
		<tr>
			<td>Wachtwoord</td>
			<td><input type="password" name="wachtwoord" /></td>
		</tr>
		<tr>
			<td><input type="submit" name="inloggen" value="Inloggen" /></td>
			<td></td>
		</tr>
	</table>
</form>
<?php
	require("../includes/layouts/inc_footer.php");
?>