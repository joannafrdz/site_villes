<?php

// contient le connexion à la bdd
$mysqli = new mysqli('localhost', 'root', '', 'projet_villes_site');
$mysqli->set_charset("utf8"); // forcer le passage en UTF_8