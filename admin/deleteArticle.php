
<?php

/*
6eme etape administrateur: Pourquoi crée un fichier deleteArticle.php ?
Comme dit precedamment on propose a l'administrateur de selectionner un titre d'article pour pouvoir 
supprimer tout sont contenu. Mais dans l'etape précedente on a simplement afficher les titres.
Voila donc pourquoi on a crée le fichier deleteArticle.php pour supprimer dans notre bdd l'article choisis
par l'admin.

*/

session_start(); // Avoir un acces a la super variable globale $_SESSION

if (
    !empty($_SESSION['user'][0]) and // On verifie si les valeurs  sont différente de vide (!empty)
    !empty($_SESSION['user'][1]) and
    isset ($_SESSION['user'][0]) and // On verifie si la clef  est définis.(isset)
    isset ($_SESSION['user'][1]) and

    isset($_COOKIE['PHPSESSID']) and // on verifie si les cles sont definie et si elle sont différente de vide.
    !empty($_COOKIE['PHPSESSID']) and
    $_SESSION['user'][1] === $_COOKIE['PHPSESSID'] and // On compare le session id et le cookie phpsessid ()

    !empty($_POST['deleteArticle']) and // On verifie si la valeurs de $POST deleteArticle est différente de vide (!empty)
    isset($_POST['deleteArticle'])  // On verifie si la clef  est définis.(isset)
) {
    $id = $_SESSION['user'][0]; // Affection de $idfromdatabase a la variable $idUser
    
    // affectation de la supervariable $_post
    // RAPPEL: $post[deletearticle] provient du formulaire c'est le choix que l'admin nous a envoyer.
    $deleteArticle = filter_var($_POST['deleteArticle'], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
   
    // Permet de recuperer la function function.php. RAPPEL: Connexion a la BDD.
    require_once('../functions/function.php');  
    // Appelle de la function sqlQuery.
    // Requete SQL: Supprime depuis la table articles ou l'id de article = :deletearticle et id_user de la table article vaut l'id de l'admin ( en gros il peux supprimer que c'est article que lui a crée.)                           
    sqlQuery("DELETE FROM `articles` WHERE `articles`.`id` = (:delete_Article) AND `articles`.`id_user` = $id;",[':delete_Article' => $deleteArticle]);//Utilisation du DataMapper pour la protection contre les SQL Injections en deuxieme argument
    // retourne au navigateur le code HTTP pour preparer une redirection
    http_response_code(302);
    // ajoute dans l'en-tete la destination
    header('Location: ./administration.html');
    // arrete l'execution du PHP
    exit();

} else {
  // retourne au navigateur le code HTTP pour preparer une redirection
    http_response_code(302);
    // ajoute dans l'en-tete la destination
    header('Location: ./index.html');
     // arrete l'execution du PHP
    exit();
    
    // PROCHAINE ETAPE ----------> DAVID !
}

?>