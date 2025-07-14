<?php
function db_connect(){
    $bdd = mysqli_connect('172.60.0.15', 'ETU004214', 'qO2254s1', 'db_s2_ETU004214');
    if (!$bdd) {
        die("Erreur de connexion à la base de données : " . mysqli_connect_error());
    }
    return $bdd;
}
