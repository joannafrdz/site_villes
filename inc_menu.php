
<?php
$result = $mysqli->query('SELECT pays.pays_id, pays_nom FROM pays INNER JOIN villes WHERE villes.pays_id = pays.pays_id GROUP BY pays_nom ORDER BY pays_nom');

while ($row = $result->fetch_array())
{
    $pays_liste[$row['pays_id']] = $row['pays_nom'];
}
?>
<!-- Affichage -->
<div class="liste_pays">
    <h3>Cliquez sur un pays pour voir les villes associées :</h3>

    <ul class="list">
        <?php foreach($pays_liste as $id => $pays) : ?>
            <li>
                <a href="pays.php?id=<?php echo $id ?>"> <?php echo $pays ?></a>
            </li>
        <?php endforeach ?>
    </ul>
</div>