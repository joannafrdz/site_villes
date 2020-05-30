<?php
require('../inc_connexion.php'); 
// FR@3m:We8!
session_start();
if (isset($_SESSION['user_login']))
header('location:./index.php');
?>

<?php
// récupération des variables
if (isset($_POST['submit_form']))
{
    $user_input_login = $_POST['user_input_login'];
    $user_input_password = $_POST['user_input_password'];

    // vérification des variables vides
    if ((empty($user_input_login)) || empty($user_input_password))
    {
        $message = 'Vous devez saisir les informations demandées';
    }
    else
    {
        // Les login correspond t-il à une valeur existante dans la base ?
        // On pose la requête avec la clause WHERE portant sur le login
        $result = $mysqli->query('SELECT user_login, user_password FROM user WHERE user_login = "' . $user_input_login . '"');

        $row = $result->fetch_array();

        if (!isset($row['user_login']))
        {
            // La requête ne retourne aucun résult pour ce login
            $message = 'Erreur d\'identification. Vous n\'avez pas accès à cette page';
        }
        else
        {
            // La requête retourne un result, le login existe dans la base.
            // On vérifie avec la fonction crypt que le mot de passe saisi correspond à celui de la base
            $user_login = $row['user_login'];
            $user_password = $row['user_password'];
            if (crypt($user_input_password, $user_password) != $user_password)
            {
                $message = 'Erreur d\'identification.' ; 
            }
            else
            {
                //l'uilisateur est reconnu. Création d'une variable de session 'user_login' puis redirection de l'user vers la page d'accueil de l'admin
                // avec la fonction header à laquelle o passe en argument 'location:admin.php'. La variable de session 'user_login sera ainsi transmise à a page admin.php
                session_start();
                $_SESSION['user_login'] = $user_login;
                header('location:./index.php');
            }
        }
    }
}
?>

<!DOCTYPE HTML>
<html lang="fr">
<head>
	<meta charset="UTF-8">
    <title>Le site des villes</title>
    <link rel="stylesheet" type="text/css" href="../style.css"/>
</head>

<body>
    <div id="wrapper">
        <header>
            <?php // include('../inc_nav-bar.html'); ?>
        </header>

        <main>
            <div class="login-form">
                <form class="input-fields" method="post">
                    <p>Identification :</p>
                    <input type="text" class="input" name="user_input_login" placeholder="Login">
                    <input type="password" class="input" name="user_input_password" placeholder="Password">
                    <button type="submit" class="btn" name="submit_form"/>Connexion</button>
                    <?php
                    if (isset($message)) echo '<div class="erreur">' .$message. '</div>';
                    ?>
                </form>
            </div>
        </main>
        
    </div>
</body>
</html>

