<?php require('../inc_connexion.php'); ?>
<?php require('inc_identification_user.php'); ?>

<!DOCTYPE HTML>
<html lang="fr">
<head>
	<meta charset="UTF-8">
    <title>Editer un pays</title>
    <link rel="stylesheet" type="text/css" href="style.css"/>
</head>
<body>
    <div id="wrapper">
        <header>
            <h1>Le site des villes</h1>
        </header>

        <main>
        <a href="../index.php">Retour au site</a> - <a href="./index.php">Accueil administration</a>
            <?php
            // Partie 1 : gestion de la saisie et enregistrement
            // --------------------------------------------------

            // récupération des variables
            if (isset($_POST['submit_form']))
            {
                $pays_nom = $_POST['pays_nom'];
                $pays_id = $_POST['pays_id'];
            
            // vérification du contenu des variables
                if (empty($pays_nom))
                {
                    $message = 'Vous devez saisir de nom d\'un pays';
                }
                else
                {
                    // Requête UPDATE
                    if ($mysqli->query('UPDATE pays SET pays_nom = "'.$pays_nom.'" WHERE pays_id = '.$pays_id))
                    {
                        $message = 'La mise à jour du pays '. $pays_nom .' est effectuée.';
                    }
                    else
                    {
                        $message = 'La mise à jour du '. $pays_nom .' n\'est pas effectuée.';
                    }
                }
            }

            // Partie 2 : Récupération des info de la base et affichage du formulaire
            // ----------------------------------------------------------------------

            // récupération des variables
            $id = $_GET['id'];

            // requête SELECT
            $result = $mysqli->query('SELECT pays_id, pays_nom FROM pays WHERE pays_id = ' . $id);

            // création du nouvel array
            $row = $result->fetch_array();

            // variable destinées à l'affichage
            $nom = $row['pays_nom'];

            ?>
            <div>
                <h2>Editer un pays</h2>

                <?php if (isset($message)) echo $message ?>

                <form method="post">
                    <p>Nom du pays : <input type="text" name="pays_nom" value="<?php echo $nom ?>"/></p>
                    <p><input type="hidden" name="pays_id" value="<?php echo $id ?>"/></p>
                    <p><input type="submit" name="submit_form" value="valider"/></p>
                </form>
            </div>
        </main>

        <footer>
        </footer>
</body>
</html>