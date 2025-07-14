<?php
require('../functions.php');
session_start();
$_SESSION['email']=$_POST['email'];
$_SESSION['password']=$_POST['mdp'];

$email=$_SESSION['email'];
$username=$_SESSION['password'];

db_connect(); 
$sql= "INSERT INTO member (email,username) VALUES ('%s','%s')";
$sql=sprintf($sql,$email,$username);

$query = mysqli_query($bdd, $sql);
    if ($query) {
        header('Location: ../../pages/liste.php');
    } else {
        echo "Erreur : " . mysqli_error($bdd);
    }
?>