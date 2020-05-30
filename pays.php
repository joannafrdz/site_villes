<?php require('inc_connexion.php'); ?>

<?php
// récup var ext
$pays_id = $_GET['id'];
// q
$result = $mysqli->query('SELECT pays.pays_nom, ville_nom, ville_id FROM pays INNER JOIN villes WHERE villes.pays_id = pays.pays_id AND pays.pays_id = ' . $pays_id);
    while ($row = $result->fetch_array())
    {
        $pays_nom = $row['pays_nom'];
        $villes[$row['ville_id']] = $row['ville_nom'];
    }

$result = $mysqli->query('SELECT pays_id, pays_nom FROM pays WHERE pays_id = ' . $pays_id);
$row = $result->fetch_array();
$pays_nom = $row['pays_nom'];

?>

<!DOCTYPE HTML>
<html lang="fr">
<head>
<meta charset="UTF-8">
    <title><?php echo $pays_nom ?></title>
    <link rel="stylesheet" href="style.css" type="text/css" >
</head>

<body>
    <div id="wrapper">
        <header>
            <?php include('inc_nav-bar.html'); ?>
        </header>

        <main>
            <?php
                if (isset($row['pays_nom']))
                {
                    echo '<h2>Liste des villes pour ' .$pays_nom. '</h2>';
                }
            ?>

            <?php if (isset($villes)) { foreach($villes as $id => $ville) ?>
                
                <ul class="list">
                    <li>
                        <p><a href="ville.php?id=<?php echo $id ?>"><?php echo $ville ?></a></p>
                    </li>
                </ul>
            <?php
            } else echo 'Il n\'y a pas de villes associées à ce pays';
            ?>
        </main>

        <footer>
            <?php require('inc_footer.php'); ?>
        </footer>

    </div>        
</body>
</html>

