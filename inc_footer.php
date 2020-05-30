<?php

    if (isset($result))
    // Libération des résultats
    $result->free();

    if (isset($mysqli))
    // Fermeture de la connexion
    $mysqli->close();
    
?>