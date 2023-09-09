<?php

// 4eme etape administrateur: Pourquoi crée un fichier setArticle.php ?
/*
On le sais notre admin s'est identifier dans le formulaire de connexion il se retrouve donc dans notre page administration.html.
En plus de lui proposer de crée une nouvelle categorie dans le formulaire (dans notre etape précedente php) on lui propose aussi de crée un nouvelle articles.
Voila pourquoi nous avons besoin du setArticle.php car on a besoin de recuperer les donnees (du nouvelle article)
que l'admin a founis. On pourra ensuite  stocker c'est données et l'afficher dynamiquement grace a notre getArticle.js

*/

session_start(); // Avoir un acces a la super variable globale $_SESSION
   

if ( // On verifie les condition avant de rentrer dans l'instruction de la if
    !empty($_SESSION['user'][0]) and
    !empty($_SESSION['user'][1]) and // On verifie si la cle est définis.(isset)
    isset ($_SESSION['user'][0]) and // On verifie si les valeurs de $session sont différente de vide (!empty)
    isset ($_SESSION['user'][1]) and // RAPPEL: $session[username][0] == idfromdatabase, $session[username][1] == session_id
                                    
    
    isset($_COOKIE['PHPSESSID']) and  // on verifie si la cle est definie et si elle sont différente de vide.
    !empty($_COOKIE['PHPSESSID']) and // RAPPEL: $cookie [phpsessid] est fournis par notre session start précedamment vu dans le login.php c'est un identifiant unique.("etiquette")
    $_SESSION['user'][1] === $_COOKIE['PHPSESSID'] and // On compare le session id et le cookie phpsessid ()

    !empty($_POST['titre']) and 
    !empty($_POST['description']) and // On verifie si les valeurs de POST(titre,description,categorie) sont différente de vide (!empty)
    !empty($_POST['categorie']) and

    isset($_POST['titre']) and  // On verifie si les clefs POST(titre,description,categorie) sont définis.(isset)
    isset($_POST['description']) and 
    isset($_POST['categorie'])
  
) {
    $date = (string) date('Y-m-d'); // affectation de la date a la variable $date au moment ou larticle a était crée.
    // Permet de recuperer la function replaceorsanitize
    require_once('../functions/replaceOrSanitize.php');

    // Appelle de la fonction est affectation aux variable titre description categorie -----> Go voir la fonction replaceOrSanitize si neccessaire
    $titre = (string) replaceOrSanitize($_POST['titre'], 75, 'N/A');
    $description = (string) replaceOrSanitize($_POST['description'], 65535, 'N/A');
    $categorie = (string) replaceOrSanitize($_POST['categorie'], 1, 'N/A');
    $idUser = $_SESSION['user'][0]; // Affection de $idfromdatabase a la variable $idUser

    // Permet de recuperer la function function.php. RAPPEL: Connexion a la BDD.
    require_once('../functions/function.php');
    // Appelle de la function sqlQuery. 
    //Requete SQL: Insere dans la colonne id,title,text,date,id_categorie,id_user de la table articles la valeur null(car l'id est AI) est les donnes fournis (nouvelle articles) par notre admin en premier argument
    sqlQuery("INSERT INTO `articles` (`id`, `title`, `text`, `date`,`id_categorie`,`id_user`) VALUES (NULL,(:title),(:description),(:date),(:categorie),(:idUser));",
    [':title' => $titre,':description' => $description,':date' => $date,':categorie' => $categorie,':idUser' => $idUser]); //Utilisation du DataMapper pour la protection contre les SQL Injections en deuxieme argument



// retourne au navigateur le code HTTP pour preparer une redirection
    http_response_code(302);
    // ajoute dans l'en-tete la destination
    header('Location: ./administration.html');
    // arrete l'execution du PHP
    exit();

} else { // si une des condition de la if est false on rentre donc dans l'instruction de la else
// retourne au navigateur le code HTTP pour preparer une redirection
    http_response_code(302);
    // ajoute dans l'en-tete la destination
    header('Location: ./index.html');
    // arrete l'execution du PHP
    exit();

    // PROCHAINE ETAPE 5 --------------> selectArticleForDelete.php (admin)

}

?>