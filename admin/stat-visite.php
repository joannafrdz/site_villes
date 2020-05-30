<?php require('../inc_connexion.php'); ?>
<?php require('inc_identification_user.php'); ?>

<?php
    $result = $mysqli->query('SELECT stat_id, web_user_id, web_user_visit FROM user_stat ORDER BY web_user_visit DESC');
    while ($row = $result->fetch_array())
    {
        $stats[$row['web_user_id']] = $row['web_user_visit'];
    }

    // $web_user_id = $row['web_user_id'];
    // $web_user_visit = $row['web_user_visit'];

    // calcul par MySQL du nombre total de visites
    $result = $mysqli->query('SELECT SUM(web_user_visit) AS total_visites FROM user_stat');
    $row = $result->fetch_array();
    $total_visites = $row['total_visites'];
    $result->free();

    // calcul par MYSQL du nombre total de visiteurs
    $result = $mysqli->query('SELECT COUNT(web_user_id) AS total_visiteurs FROM user_stat');
    $row = $result->fetch_array();
    $total_visiteurs = $row['total_visiteurs'];
    $result->free();
?>

<!DOCTYPE HTML>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Statistiques</title>
    <link rel="stylesheet" href="../style.css" type="text/css" >
</head>
<body>
    <div id="wrapper">
        <header>
            <?php include('inc_nav-bar-admin.html'); ?>
        </header>
        <main>
            
            
            <table>
            <caption><h2>Statistiques des visites</h2></caption>   
                <tr>
                    <th scope="col">Identifiant visiteur</th>
                    <th scope="col">Nombre de visite</th>
                </tr>
                <?php foreach($stats as $web_user_id => $web_user_visit) : ?>
                <tr>
                    <td><?php echo $web_user_id ?></td>
                    <td><?php echo $web_user_visit ?></td>
                </tr>
                <?php endforeach ?>
            </table>
            <br />
            <table>
                <tr>
                    <th scope="col">Total visiteurs</th>
                    <th scope="col">Total visites</th>
                </tr>
                <tr>
                    <td><?php echo $total_visiteurs ?></td>
                    <td><?php echo $total_visites ?></td>
                </tr>
            </table>
        </main>
    </div>
</body>
</html>