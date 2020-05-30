<?php require('../inc_connexion.php'); ?>
<?php require('inc_identification_user.php'); ?>

<?php
    // Récupération des variables
    if (isset($_POST['submit_form']))
    {
        $pays_nom = $_POST['pays_nom'];

        // vérification du contenu des variables
        if (empty($pays_nom))
        {
            $message = 'Vous devez saisir le nom d\'un pays.';
        }
        else
        {
            // La ville existe-t-elle dans la base ?
            // Requête SELECT avec count()
            $result = $mysqli->query('SELECT count(pays_id) FROM pays WHERE pays_nom = "' . $pays_nom .'"');
            $row = $result->fetch_array();
            // $row[0] contient la valeur retournée par le count() de MySQL

            if ($row[0] > 0)
            {
                $message = 'Le pays est déjà enregistrée.<br />';
            }
            else
            {
                // Réquête INSERT INTO
                if ($mysqli->query('INSERT INTO pays (pays_nom) VALUES ("'.$pays_nom.'")'))
                {
                    echo $mysqli->insert_id; // retourne l'idenifiant clef primaire
                    
                    if ($pays_id_insert = $mysqli->insert_id)
                    {
    
                    $message = 'L\'ajout du pays '. $pays_nom .' est effectué';
                    $message .= '<a href= "../pays.php?id=' . $pays_id_insert . '"> Consulter la page '. $pays_nom .' </a>';
                    
                    }
                    // Si la requête est effectuée, elle retourne un booléen TRUE et donc le message pourra être affiché
                    // $message = '<p>L\'ajout de la ville '. $ville_nom .' est effectué.</p>';
                    else
                    {
                        $message = 'Le pays n\'est pas enregistrée.';
                    }
                }
            }
        } 
    }
?>

<!DOCTYPE HTML>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ajouter un pays</title>
    <link rel="stylesheet" href="style.css" type="text/css" >
</head>

<body>
    <div id="wrapper">
        <header>
            <h1>Le site des villes</h1>
                <h2>Ajouter un pays</h2>
            
        </header>

        <main>
            <form method="post">
                <input type="text" name="pays_nom" placeholder="Nom du pays"/>
                <button type="submit" name="submit_form" value="valider"/>Valider</button>
            </form>

            <?php if (isset($message))  echo '<br />' . $message ?>
        </main>
    

        <footer>
        <?php require('../inc_footer.php'); ?>
        </footer>
    </div>
</body>
</html>
