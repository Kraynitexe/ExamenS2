<?php
require('../functions.php');
session_start();
$_SESSION['email']=$_POST['email'];
$_SESSION['password']=$_POST['mdp'];

$email=$_SESSION['email'];
$username=$_SESSION['password'];

$bdd = db_connect(); 
$sql= "SELECT * FROM Ex_membre WHERE email='%s' AND mdp='%s'";
$sql=sprintf($sql,$email,$username);

$query = mysqli_query($bdd, $sql);
    if ($query) {
        header('Location: ../../pages/liste.php');
    } else {
        echo "Erreur : information ivalide" . mysqli_error($bdd);
    }
?>