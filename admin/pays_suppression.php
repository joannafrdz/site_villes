<?php require('../inc_connexion.php'); ?>
<?php require('inc_identification_user.php'); ?>

<?php
// récup de la variable externe
$id = $_GET['id'];

// requête

if ($mysqli->query('DELETE FROM pays WHERE pays_id = ' . $id))
{
    $message = 'Le pays a bien été supprimé de la base.<br><br>
                <a href="./index.php">Accéder à la liste des pays</a>';
}
else
{
    $message = 'Erreur de la suppression';
}
?>

<!DOCTYPE HTML>
<html lang="fr">
<head>
	<meta charset="UTF-8">
    <title>Supprimer un pays</title>
    <link rel="stylesheet" type="text/css" href="style.css"/>
</head>
<body>
    <div id="wrapper">
        <header>
            <h1>Le site des villes</h1>
        </header>

        <main>
            <div>
                <?php echo $message ?>
            </div>
        </main>

        <footer>
        </footer>

</body>
</html>


