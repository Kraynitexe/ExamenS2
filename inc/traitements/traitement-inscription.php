<?php
session_start();
$_SESSION['nom']=$_POST['Nom'];
$_SESSION['email']=$_POST['email'];
$_SESSION['password']=$_POST['password'];
$_SESSION['date']=$_POST['date'];
$_SESSION['genre']=$_POST['genre'];
$_SESSION['ville']=$_POST['ville'];

$name=$_SESSION['nom'];
$email=$_SESSION['email'];
$password=$_SESSION['password'];
$birthdate=$_SESSION['date'];
$genre=$_SESSION['genre'];
$ville=$_SESSION['ville'];

db_connect();
$sql= "INSERT INTO member (email, mdp, nom, date_naissance) VALUES ('%s','%s','%s','%s,'%s','%s')";
$sql= sprintf($sql,$email,$password,$name,$birthdate, $genre, $ville);
$query = mysqli_query($bdd, $sql);

if ($query) {
    header('Location: ../../pages/index.php');
} else {
    echo "Erreur : " . mysqli_error($bdd);
}
?>