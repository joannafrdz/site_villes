<?php require('inc_connexion.php'); ?>
<?php require('inc_stat.php'); ?>

<!DOCTYPE HTML>
<html lang="fr">
<head>
	<meta charset="UTF-8">
    <title>Le site des villes</title>
    <link rel="stylesheet" type="text/css" href="style.css"/>
</head>

<body>
    <div id="wrapper">
        <header>
        <?php require('inc_nav-bar.html'); ?>
        </header>

        <main>
        <?php require('inc_resultat.php'); ?>
        <?php require('inc_menu.php'); ?>
        </main>

        <footer>
        <?php require('inc_footer.php'); ?>
        </footer>
    </div>
</body>
</html>



