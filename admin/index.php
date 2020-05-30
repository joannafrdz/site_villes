<?php require('../inc_connexion.php'); ?>
<?php require('inc_identification_user.php'); ?>

<!DOCTYPE HTML>
<html lang="fr">
<head>
	<meta charset="UTF-8">
    <title>Administration</title>
    <link rel="stylesheet" type="text/css" href="../style.css"/>
</head>
<body>
    <div id="wrapper">
        <header>
            <?php require('inc_nav-bar-admin.html'); ?>
        </header>

        <main>
            <?php require('liste.php'); ?>
        </main>

        <footer>
            <?php require('../inc_footer.php'); ?>
        </footer>
</body>
</html>