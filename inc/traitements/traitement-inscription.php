<?php
require('../functions.php');

session_start();
$_SESSION['nom'] = $_POST['nom'];
$_SESSION['email'] = $_POST['email'];
$_SESSION['password'] = $_POST['mdp'];
$_SESSION['date_naissance'] = $_POST['date'];
$_SESSION['genre'] = $_POST['genre'];
$_SESSION['ville'] = $_POST['ville'];

$name = $_SESSION['nom'];
$email = $_SESSION['email'];
$password = $_SESSION['password'];
$birthdate = $_SESSION['date_naissance'];
$genre = $_SESSION['genre'];
$ville = $_SESSION['ville'];

$bdd = db_connect();
$sql = "INSERT INTO Ex_membre (email, mdp, nom, date_naissance, genre, ville) VALUES ('%s','%s','%s','%s','%s','%s')";
$sql = sprintf($sql, $email, $password, $name, $birthdate, $genre, $ville);
$query = mysqli_query($bdd, $sql);

if ($query) {
    header('Location: ../../pages/index.php');
} else {
    echo "Erreur : " . mysqli_error($bdd);
}
?>