<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="../stylesheets/style_org.css" />
	</head>
	<body>
		<div id="wrapper">
	 
	  <nav role="navigation" id="access">
	    <ul id="menu">
			<li class="active"><a href="../medewerkers/index.php">Home</a></li><!-- whitespace
	                --><li><a href="../public/bestelpagina.php">Bestellen</a></li><!-- whitespace
	                --><li><a href="../public/menukaart.php">Gerechten</a></li><!-- whitespace
	                --><li><a href="../uitloggen.php">Uitloggen</a></li>
		</ul>
		</nav>
	</div>
	<div id="body">
		<div id="l_kolom">
			&nbsp;
		</div>
		<div id="m_kolom">
<?php	
	include("../../includes/inc_connect.php");
	include("../../includes/inc_functions.php");
	session_start();
	
	$melding = null;
	
	if(isset($_POST['inloggen'])) :
		$query = "SELECT * FROM medewerkers WHERE email = '". $_POST['email'] ."' AND wachtwoord='". $_POST['wachtwoord'] ."'";
		$result = mysqli_query($con, $query)
			or die("Error: ".mysqli_error($con));
		
		$medewerkernr_query = "SELECT medewerkernr, functie FROM medewerkers;";
		$medewerkernr_result = mysqli_query($con, $medewerkernr_query);
			
		$aantal_rijen = mysqli_num_rows($result);
		if ($aantal_rijen == 1) :
			while ($rij = mysqli_fetch_assoc($result)) :
				$_SESSION['medewerkernr'] = $rij['medewerkernr'];
				$_SESSION['functie'] = $rij['functie'];
			endwhile;
		elseif (empty($_POST['email']) && empty($_POST['wachtwoord'])) :
			$melding .= "<b>Je hebt niets ingevoerd</b><br/><br/>";
		elseif ($aantal_rijen == 0) :
			$melding .= "<b>De ingevoerde gegevens komen niet overeen</b><br/><br/>";
		endif;
	endif;
	
	if(isset($_SESSION['medewerkernr'])) :
		
			switch($_SESSION['functie']) {
				case 'Chef de Cuisine':
					redirect_to("../keuken.php");
				break;
				
				case 'Medewerker keuken':
					redirect_to("../keuken.php");
				break;
				
				case 'Hoofd administratie':
					redirect_to("../administratie.php");
				break;
				
				case 'Financiele administratie':
					redirect_to("../administratie.php");
				break;
				
				case 'Personeelsadministratie':
					redirect_to("../administratie.php");
				break;
				case 'Hoofd expeditie':
					redirect_to("../expeditie.php");
				break;
				
				case 'Chauffeur':
					redirect_to("../expeditie.php");
				break;
				
				case 'Hoofd commerciele afdeling':
					redirect_to("../inkoop.php");
				break;
				
				case 'Medewerker inkoop':
					redirect_to("../inkoop.php");
				break;
				
				case 'Medewerker verkoop':
					redirect_to("../verkoop.php");
				break;
				default: $melding = "U bent niet gemachtigd om in te loggen.";
			}
	endif;
	echo $melding;
?>
<h1>Medewerkers inlog</h1>
Vul hier uw e-mailadres en wachtwoord in.

<form action="" method="post">
	<table>
		<tr>
			<td>E-mail: </td>
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
				</div>
				<div id="r_kolom">
					&nbsp;
				</div>
		</div>
	<div id="footer">
		<img id="img_1" src="../../public/images/logo.png" alt="logo" />
		<a href="https://twitter.com/">
		<img id="img_2" src="../../public/images/twitter.png" alt="twitter" />
		</a>
		<a href="https://www.facebook.com/">
		<img id="img_2" src="../../public/images/facebook.png" alt="Facebook" />
		</a>
	</div>
	</body>
</html>
