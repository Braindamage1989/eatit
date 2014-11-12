<?php
	require("../includes/layouts/inc_header.php");
	require("../includes/layouts/inc_nav.php");
	
	include("../includes/inc_connect.php");
	include("../includes/inc_functions.php");
?>
<?php
	$query_categorie = "SELECT distinct categorie FROM recept WHERE weeknr=$weeknr OR weeknr='';";
	$result_categorie = mysqli_query($con, $query_categorie);
?>
<h1>Menukaart</h1>
	<table cellspacing="10">
			<?php
	while($row_categorie = mysqli_fetch_assoc($result_categorie)) {
		?> <tr>
			<td><h3> <?php echo "$row_categorie[categorie]" ?></h3></td>
		</tr> <tr>  <?php
		
	$query_overzicht = "SELECT * FROM recept WHERE categorie = '$row_categorie[categorie]' AND weeknr IN ('$weeknr', '');";
	$result_overzicht = mysqli_query($con, $query_overzicht);
	
	while($row_overzicht = mysqli_fetch_array($result_overzicht)){
		?> <tr>
			<td> <?php echo "$row_overzicht[omschrijving]" ?></td>
			<td> - </td>
			<td><?php echo "$row_overzicht[verkoopprijs] euro";?> </td>
		</tr>
	<?php }
	}?>
		
	</table>
	
<?php
	require("../includes/layouts/inc_footer.php");
?>
