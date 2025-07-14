<?php
function db_connect(){
    $bdd = mysqli_connect('localhost', 'root', '', 's2_ETU004214');
    if (!$bdd) {
        die("Erreur de connexion à la base de données : " . mysqli_connect_error());
    }
    return $bdd;
}

function get_objets_emprunts() {
    $bdd = db_connect();
    $sql = "SELECT id_objet, nom_objet, nom_categorie, date_emprunt FROM vue_objets_emprunts";
    $result = mysqli_query($bdd, $sql);
    $objets = [];
    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $objets[] = $row;
        }
    } 
    return $objets;
}

function get_objets_disponibles() {
    $bdd = db_connect();
    $sql = "SELECT id_objet, nom_objet, nom_categorie FROM vue_objets_disponibles";
    $result = mysqli_query($bdd, $sql);
    $objets = [];
    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $objets[] = $row;
        }
    }
    return $objets;
}


