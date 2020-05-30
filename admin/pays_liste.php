<?php require('../inc_connexion.php'); ?>

<?php

// Requête
$result = $mysqli->query('SELECT pays_id, pays_nom FROM pays');

// Tranformaton en array avec fetch_array
while ($row = $result -> fetch_array())
{
    // Création du nouvel array pour affichage hors de la boucle
    $pays[$row['pays_id']] = $row['pays_nom'];
}
?>
<!DOCTYPE HTML>
<html lang="fr">
<head>
	<meta charset="UTF-8">
    <title>Liste des pays</title>
    <link rel="stylesheet" type="text/css" href="style.css"/>
</head>
<body>
    <div id="wrapper">
        <header>
            <h2>Liste des pays</h2>
        </header>

        <main>
            <div>
                <ul>
                    <?php foreach($pays as $id => $pay) : ?>
                    <li>
                        <a href="../pays.php?id=<?php echo $id ?>"> <?php echo $pay ?></a>
                        <a href="pays_edition.php?id=<?php echo $id ?>">[ éditer ]</a>
                        <a href="pays_suppression.php?id=<?php echo $id ?>">[ supprimer ]</a>
                    </li>
                    <?php endforeach ?>
                    <li><a href="pays_ajout.php">Ajouter un pays</a></li>
                </ul> 
            </div>
        </main>
        