<?php require('../inc_connexion.php'); ?>
<?php require('inc_identification_user.php'); ?>


<!DOCTYPE HTML>
<html lang="fr">
<head>
	<meta charset="UTF-8">
    <title>Editer une ville</title>
    <link rel="stylesheet" type="text/css" href="../style.css"/>
</head>
<body>
    <div id="wrapper">
        <header>
            <?php include('inc_nav-bar-admin.html'); ?>
        </header>

        <main>
            <?php
            // Partie 1 : gestion de la saisie et enregistrement
            // --------------------------------------------------

            // récupération des variables
            if (isset($_POST['submit_form']))
            {
                $ville_nom = $_POST['ville_nom'];
                $ville_texte = $_POST['ville_texte'];
                $ville_id = $_POST['ville_id'];
                $pays_id = $_POST['pays_id'];
            
            // vérification du contenu des variables
                if ((empty($ville_nom)) OR empty($ville_texte))
                {
                    $message = '<div class="erreur">Vous devez saisir de nom d\'une ville et sa présentation.</div>';
                }
                else
                {
                    // Requête UPDATE
                    if ($mysqli->query('UPDATE villes SET ville_nom = "'.$ville_nom.'", ville_texte = "'.$ville_texte.'", pays_id = "'.$pays_id.'" WHERE ville_id = '.$ville_id))
                    {
                        $message = '<div class="succes">La mise à jour de la ville '. $ville_nom .' est effectuée.</div>';
                    }
                    else
                    {
                        $message = '<div class="erreur">La mise à jour de la ville '. $ville_nom .' n\'est pas effectuée.</div>';
                    }
                }
            }

            // Partie 2 : Récupération des info de la base et affichage du formulaire
            // ----------------------------------------------------------------------

            // récup de variables
            $id = $_GET['id'];

            // requête SELECT
            $result = $mysqli->query('SELECT ville_id, ville_nom, ville_texte, pays_id FROM villes WHERE ville_id = ' . $id);

            // création du nouvel array
            $row = $result->fetch_array();

            // variable destinées à l'affichage
            $nom = $row['ville_nom'];
            $texte = $row['ville_texte'];
            $ville_pays_id = $row['pays_id'];

            // Requête
            $result = $mysqli->query('SELECT pays_id, pays_nom FROM pays');

            // Tranformaton en array avec fetch_array
            while ($row = $result -> fetch_array())
            {
                // Création du nouvel array pour affichage hors de la boucle
                $pays_liste[$row['pays_id']] = $row['pays_nom'];
            }

            ?>

            <div class="container">
                <h2>Editer une ville</h2>

                <form class="edit-form" method="post">

                    <label for="nom">Nom de la ville :</label>
                        <input type="text" class="input" id="nom" name="ville_nom" value="<?php echo $nom ?>"/>
                    
                    <label for="presentation">Texte de présentation</label>
                        <textarea name="ville_texte" class="text" id="presentation" cols="32" row="8"/><?php echo $texte ?></textarea>
                    
                    <label for="robot"></label>
                        <input type="hidden" id="robot" name="ville_id" value="<?php echo $id ?>"/>
                    
                    <div>
                        <ul class="list">
                            <?php foreach($pays_liste as $pays_id => $pays_nom) : ?>
                            <?php if ($ville_pays_id == $pays_id) : ?>

                            <li><input checked="checked" type="radio" name="pays_id" value="<?php echo $pays_id ?>" /> <?php echo $pays_nom ?></li>
                            
                            <?php else : ?>

                            <li><input type="radio" name="pays_id" value="<?php echo $pays_id ?>"/> <?php echo $pays_nom ?></li>
                            
                            <?php endif ?>
                            <?php endforeach ?>
                        </ul>
                    </div>

                    <button type="submit" class="btn" name="submit_form" value="valider"/>Valider</button>
                    <?php if (isset($message)) echo '<div class="succes">' .$message. '</div>' ?>
                </form>
            </div>
        </main>

        <footer>
        </footer>
</body>
</html>