
<?php
session_start();
if (!isset($_SESSION['user_login']))
{
	echo 'Vous n\'avez pas les droits d\'accès à cette page';
	echo '<br><a href="../index.php">Retour vers la site</a>';
	exit;
}
$user_login = $_SESSION['user_login'];

require('../inc_connexion.php');

$result = $mysqli->query('SELECT user_login FROM user WHERE user_login = "' . $user_login . '"');

$row = $result->fetch_array();

if (!isset($row['user_login']))
{
	echo 'Vous n\'avez pas les droits d\'accès à cette page';
	echo '<br><a href="../index.php">Retour vers la site</a>';
	exit;
}