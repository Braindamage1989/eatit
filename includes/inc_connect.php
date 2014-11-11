<?php

$host = 'localhost';
$gebruiker = 'root';
$wachtwoord = '';
$database = 'eatit';

$con = mysqli_connect($host, $gebruiker, $wachtwoord, $database);

if (mysqli_connect_errno()):
  echo "Er is iets fout gegaan met het verbinden: " . mysqli_connect_error();
endif;

?>