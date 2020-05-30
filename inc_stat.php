<?php

if (isset($_COOKIE['visite'])) // le cookie existe
{
    // valeur cookie
    $cookie_value = $_COOKIE['visite'];
    $cookie_value = unserialize($cookie_value);
    
    $web_user_id = $cookie_value['web_user_id'];
    $web_user_visit = $cookie_value['web_user_visit'];

    // màj nombre de visites
    $cookie_value['web_user_visit'] ++;

    // serialisation pour enregistrer les données dans le cookie
    $stat_data = serialize($cookie_value);

    // mise à jour dans la bdd du nombre de visite pour cet utilisateur
    $mysqli->query('UPDATE user_stat SET web_user_visit = '. $web_user_visit .' WHERE web_user_id = "'. $web_user_id .'"');
}
else // le cookie n'existe pas
{
    $web_user_id = uniqid();
    $nombre_visite = 1;
    $user_stat['web_user_id'] = $web_user_id;
    $user_stat['web_user_visit'] = $nombre_visite;

    // serialisation pour enregistrer les données dans le cookie
    $stat_data = serialize($user_stat);

    // ajout dans la base du nombre de visite pour cet utilisateur
    $mysqli->query('INSERT INTO user_stat (web_user_id, web_user_visit) VALUES ("'.$web_user_id.'", '. $nombre_visite .')');
}

// envoie cookie
setcookie('visite', $stat_data, time()+259200);
?>

<?php
print_r($_COOKIE);
?>
<hr>
<a href="delete_cookie.php">Suppression du cookie</a>