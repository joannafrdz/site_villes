<?php require('../inc_connexion.php'); ?>
<?php require('inc_identification_user.php'); ?>
<?php
$pays_id = [];
// Récupération variables
if (isset($_POST['submit_form']))
{
    $ville_nom = $_POST['ville_nom'];
    $ville_texte = $_POST['ville_texte'];
    $pays_id = $_POST['pays_id'];
    
    // vérification contenu des variables
    if ((empty($ville_nom)) OR empty($ville_texte))
    {
        $message = 'Vous devez saisir le nom d\'une ville et sa présentation.';
    }
    if (!isset($pays_id))
    {
        $message = 'Renseignez un pays.';
    }
    else
    {
        // La ville existe-t-elle dans la base ?
        // Requête SELECT avec count()
        $result = $mysqli->query('SELECT count(ville_id) FROM villes WHERE ville_nom = "' . $ville_nom .'"');
        $row = $result->fetch_array();

        // $row[0] contient la valeur retournée par le count() de MySQL
        if ($row[0] > 0)
        {
            $message = 'La ville est déjà enregistrée.';
        }
        else
        {
            // Réquête INSERT INTO
            if ($mysqli->query('INSERT INTO villes (ville_nom, ville_texte, pays_id) VALUES ("'.$ville_nom.'", "'.$ville_texte.'", "'.$pays_id.'")'))
            {
                echo $mysqli->insert_id; // retourne l'identifiant clef primaire
                
                if ($ville_id_insert = $mysqli->insert_id)
                {
                    $message = 'L\'ajout de la ville '. $ville_nom .' est effectué.<br><br>';
                    $message .= '<a href= "../ville.php?id=' . $ville_id_insert . '"> Consulter la page '. $ville_nom .' </a>';
                }
                // Si la requête est effectuée, elle retourne un booléen TRUE et donc le message pourra être affiché
                else
                {
                    $message = 'La ville n\'est pas enregistrée.';
                }
            }
        }
    } 
}

// Requête
$result = $mysqli->query('SELECT pays_id, pays_nom FROM pays');

// Tranformaton en array avec fetch_arra
while ($row = $result -> fetch_array())
{
    // Création du nouvel array pour affichage hors de la boucle
    $pays_liste[$row['pays_id']] = $row['pays_nom'];
}
?>

<!DOCTYPE HTML>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ajouter une ville</title>
    <link rel="stylesheet" href="../style.css" type="text/css" >
</head>

<body>
    <div id="wrapper">

        <header>
            <?php include('inc_nav-bar-admin.html'); ?>
        </header>

        <main>
            <div class="container">
                <h2>Ajouter une ville</h2>
                      
                        <form class="edit-form" method="post">
                            <label for="nom">Nom de la ville :</label>
                            <input type="text" class="input" id="nom" name="ville_nom" placeholder="ex : Paris"/>

                            <label for="description">Description de la ville :</label>
                            <textarea name="ville_texte" class="text" id="description" cols="32" row="8"/></textarea>

                            <div>
                                <ul class="list">
                                    <?php foreach($pays_liste as $pays_id => $pays_nom) : ?>
                                        <li><input type="radio" id="pays" name="pays_id" value="<?php echo $pays_id ?>"/> <?php echo $pays_nom ?></li>
                                    <?php endforeach ?>
                                </ul>
                            </div>
                            <button type="submit" class="btn" name="submit_form" value="valider"/>Valider</button>
                            <?php if (isset($message))  echo '<div class="succes">' .$message. '</div>' ?> 
                        </form>
            </div>
        </main>
    

        <footer>
        <?php require('../inc_footer.php'); ?>
        </footer>
    </div>
</body>
</html>
