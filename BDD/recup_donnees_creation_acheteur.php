<?php
session_start();

//Ouverture d'une connexion à la bdd
$objetPdo = new PDO('mysql:host=localhost;dbname=ece_market_place_bdd','root','');

//préparation de la requete d'insertion 
$pdoStat = $objetPdo->prepare('INSERT INTO acheteur(nom, prenom, pseudo, mail, mdp ) VALUES (:nom, :prenom, :pseudo, :mail, :mdp )');

//on lie chaque marque à une valeur
$pdoStat->bindValue('nom',$_POST['nom'], PDO::PARAM_STR);
$pdoStat->bindValue('prenom',$_POST['prenom'], PDO::PARAM_STR);
$pdoStat->bindValue('pseudo',$_POST['pseudo'], PDO::PARAM_STR);
$pdoStat->bindValue('mail',$_POST['mail'], PDO::PARAM_STR);
$pdoStat->bindValue('mdp',$_POST['mdp'], PDO::PARAM_STR);

//excecution de la requete preparee
$insertIsOk = $pdoStat->execute();



if($insertIsOk==1){
    
    $_SESSION["nom"]=$_POST['nom'];
    $_SESSION["prenom"]=$_POST['prenom'];
    $_SESSION["pseudo"]=$_POST['pseudo'];
    $_SESSION["mail"]=$_POST['mail'];
    $_SESSION["mdp"]=$_POST['mdp'];

    header('Location: ../PageAccueil_Acheteur.html');
}
else {
    echo 'Erreur de création de votre profil dans la base de données';
}
?>
