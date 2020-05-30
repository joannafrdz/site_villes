<?php require('inc_connexion.php'); ?>
<?php require('inc_stat.php'); ?>

<?php
// récupération de la variable externe
$id = $_GET['id'];

// requête
$result = $mysqli->query('SELECT ville_id, ville_nom, ville_texte, pays_id FROM villes WHERE ville_id = ' . $id);

// création du nouvel array
$row = $result->fetch_array();

// affichage
$nom = $row['ville_nom'];
$texte = $row['ville_texte'];
$ville_pays_id = $row['pays_id'];

// requête 
$result = $mysqli->query('SELECT pays_id, pays_nom FROM pays WHERE pays_id = ' . $ville_pays_id);
$row = $result->fetch_array();
$pays_nom = $row['pays_nom'];
?>

<!DOCTYPE HTML>
<html lang="fr">
<head>
<meta charset="UTF-8">
    <title><?php echo $nom ?></title>
    <link rel="stylesheet" href="style.css" type="text/css" >
</head>

<body>
    <div id="wrapper">
        <header>
            <?php require('inc_nav-bar.html'); ?>
        </header>

        <main> 
            <div class="description_ville">
                <h2><?php echo $nom ?></h2>  
                <p>Capitale : <?php echo '<strong>' . $pays_nom . '</strong>' ?><p><br />
                <p><?php echo $texte ?></p>
            </div>
        </main>

        <footer>
            <?php require('inc_footer.php'); ?>
        </footer>

    </div>        
</body>
</html>


