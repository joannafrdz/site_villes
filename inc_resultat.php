<?php require('inc_connexion.php');

$villes = [];

// Formulaire de recherche où l’utilisateur entre une ville
if (isset($_GET['recherche']) && !empty($_GET['recherche']))
{
    $result = $mysqli->query('SELECT ville_id, ville_nom FROM villes WHERE ville_nom LIKE "%' .$_GET['recherche']. '%"');
    while ($row = $result->fetch_array())
    {
        $villes[$row['ville_id']] = $row['ville_nom'];
    }
}
?>

<div class="search-form">
    <form class="input-fields-search" method="get" action="index.php">
        <input type="text" class="input" name="recherche" placeholder="Chercher une ville">
        <button type="submit" class="btn" name="submit-form"/>Go</button>
    </form>

<?php
// affichage des villes trouvées
if (isset($_GET['recherche']))
{
    if (count($villes)) { echo '<div class="succes">Villes correspondantes :' ?>

        <?php foreach($villes as $id => $ville) : ?>
            <a href="ville.php?id=<?php echo $id ?>"><?php echo $ville ?></a></div>
        <?php endforeach ?>

        <?php } else echo '<div class="erreur">Pas de villes associées</div>';
} ?>
</div>

<?php
// requête insertion bdd
if (isset($_GET['submit-form']))
{
    $result = $mysqli->query('SELECT ville_id FROM villes');
    while ($row = $result->fetch_array())
    {
        $ville_id = $row['ville_id'];
    }
    if ($ville_id)
    {
        foreach($villes as $ville_id => $ville)
        {
            $result = $mysqli->query('INSERT INTO user_searchs(web_user_id, ville_id) VALUES ("'.$web_user_id.'", "'.$ville_id.'")');
        }
    } 
}
?>


<?php
// récup des villes dans user_searchs
$result = $mysqli->query('SELECT ville_nom, user_searchs.ville_id FROM villes INNER JOIN user_searchs WHERE villes.ville_id = user_searchs.ville_id');
while  ($row = $result->fetch_array())
{
    $previous[$row['ville_id']] = $row['ville_nom'];
}
if (isset($previous)) {
?>

<div class="previous">
    <h3>Recherches précédentes :</h3>
        <ul class="list">
            <?php foreach($previous as $id => $ville) : ?>
            <li> <a  href="ville.php?id=<?php echo $id ?>"><?php echo $ville ?></a> </li>
            <?php endforeach ?>
        </ul>
</div>

<?php } ?>