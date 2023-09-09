         
<?php
/* 5eme etape: Pourquoi crée un fichier selectarticlefordelete.php

On propose aussi dans l'administration.html le choix de pouvoir supprimer un article mais pour cela nous
avont besoin de lui afficher ces articles pour qu'il puissent ensuite faire le choix de les supprimer.
C'est donc dans cette etape qu'on va pouvoir selectionner les articles de notre bdd et lui afficher
dynamiquement grace a notre deleteArticle.js. Il pourra ensuite les supprimer grace a notre prochaine etape.



*/


session_start(); // Avoir un acces a la super variable globale $_SESSION

if (
    !empty($_SESSION['user'][0]) and // On verifie si les valeurs  sont différente de vide (!empty)
    !empty($_SESSION['user'][1]) and  
    isset ($_SESSION['user'][0]) and  // On verifie si la clef  est définis.(isset)
    isset ($_SESSION['user'][1]) and

    isset($_COOKIE['PHPSESSID']) and  // on verifie si les cles sont definie et si elle sont différente de vide.
    !empty($_COOKIE['PHPSESSID']) and // RAPPEL: $cookie [phpsessid] est fournis par notre session start précedamment vu dans le login.php c'est un identifiant unique.("etiquette")

    $_SESSION['user'][1] === $_COOKIE['PHPSESSID']  // On compare le session id et le cookie phpsessid ()
) {
$id = $_SESSION['user'][0]; // Affection de $idfromdatabase a la variable $id
// Permet de recuperer la function function.php. (connexion a la bdd + requete sql choisis)
require_once('../functions/function.php');

// Appelle de la fonction sqlQuery qui est composer de la requete sql en premiere argument(renvoie un tableau multidimensionnel) et le Data Mapper en deuxieme argument(renforce la securité)
// Requete SQL: Selectionne l'id et le titre depuis la table articles ou id_user == :id en premier argument, 
sqlQuery("SELECT `id`, `title` FROM `articles` WHERE `articles`.`id_user` = (:id);",[':id' => $id]);//Utilisation du DataMapper pour la protection contre les SQL Injections en deuxieme argument

// PROCHAINE ETAPE 6 -------------------> deleteArticle.php
}
?>

