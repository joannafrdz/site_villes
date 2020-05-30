<?php require('../inc_connexion.php'); ?>

<?php
// Requête villes
$result = $mysqli->query('SELECT ville_id, ville_nom FROM villes');

// Tranformaton en array avec fetch_array
while ($row = $result -> fetch_array())
{
    // Création du nouvel array pour affichage hors de la boucle
    $villes[$row['ville_id']] = $row['ville_nom'];
}

// --------------------------------------------------------
// Requête pays
$result = $mysqli->query('SELECT pays_id, pays_nom FROM pays');

// Tranformaton en array avec fetch_array
while ($row = $result -> fetch_array())
{
    // Création du nouvel array pour affichage hors de la boucle
    $pays[$row['pays_id']] = $row['pays_nom'];
}
?>
<div class="container">

    <div class="villes">
        <h2>Liste villes</h2>
        <ul class="list">
            <?php foreach($villes as $id => $ville) : ?>
            <li>
                <a href="../ville.php?id=<?php echo $id ?>"> <?php echo $ville ?></a>
                <a href="edition.php?id=<?php echo $id ?>">[ éditer ]</a>
                <a href="suppression.php?id=<?php echo $id ?>">[ supprimer ]</a>
            </li>
            <?php endforeach ?>
        </ul> 
        <a href="ajout.php"><button class="btn">Ajouter une ville</button></a>
    </div>

    <div class="pays">
    <h2>Liste pays</h2>
        <ul class="list">
            <?php foreach($pays as $id => $pay) : ?>
            <li>
                <a href="../pays.php?id=<?php echo $id ?>"> <?php echo $pay ?></a>
                <a href="pays_edition.php?id=<?php echo $id ?>">[ éditer ]</a>
                <a href="pays_suppression.php?id=<?php echo $id ?>">[ supprimer ]</a>
            </li>
            <?php endforeach ?>
        </ul>    
        <a href="pays_ajout.php"><button class="btn">Ajouter un pays</button></a>
    </div>

</div>