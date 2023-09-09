<?php 

// 3eme etape administrateur: Pourquoi crée un fichier setCategorie.php ?
/*
Maintenant que notre administrateur s'est identifier il se retrouve dans notre page administration.html
Dans la page administration.html on lui propose un formulaire pour pouvoir crée de nouvelle categorie.
Voila pourquoi nous avons besoin du setCategorie.php car on a besoin de recuperer les donnees (de la nouvelle categorie)
que l'admin a founis. On pourra ensuite la stocker et l'afficher dynamiquement grace a notre getCategorie.js.

*/





    session_start(); // Avoir un acces a la super variable globale $_SESSION

if (
    !empty($_SESSION['user'][0]) and
    !empty($_SESSION['user'][1]) and   // On verifie si la clef  est définis.(isset)
    isset ($_SESSION['user'][0]) and   // On verifie si les valeurs  sont différente de vide (!empty)
    isset ($_SESSION['user'][1]) and    // RAPPEL: $session[username][0] == idfromdatabase, $session[username][1] == session_id
                                        
                                    
    

    isset($_COOKIE['PHPSESSID']) and // on verifie si les cles sont definie et si elle sont différente de vide.
    !empty($_COOKIE['PHPSESSID']) and // RAPPEL: $cookie [phpsessid] est fournis par notre session start précedamment vu dans le login.php c'est un identifiant unique.("etiquette")
    $_SESSION['user'][1] === $_COOKIE['PHPSESSID'] and // On compare le session id et le cookie phpsessid ()

    !empty($_POST['creatCategorie']) and  // On verifie si la valeurs de $POST creatcategorie est différente de vide (!empty)
    isset($_POST['creatCategorie'])  // On verifie si la clef  est définis.(isset)
) {
    // Permet de recuperer la function replaceorsanitize
    require_once('../functions/replaceOrSanitize.php');
    // Appelle de la fonction est affectation a la variable $creatCategorie -----> Go voir la fonction replaceOrSanitize
    $creatCategorie = (string) replaceOrSanitize($_POST['creatCategorie'], 75, 'N/A');

    // Permet de recuperer la function function.php. RAPPEL: Connexion a la BDD.
    require_once('../functions/function.php');
    // Appelle de la function sqlQuery.
    //Requete SQL: Insere dans la colonne id et name de la table Categorie la valeur null(car l'id est AI) est les donnes fournis (nouvelle categorie) par notre admin affecter a la variable $creatCategorie.
    sqlQuery("INSERT INTO `categories` (`id`, `name`) VALUES (NULL,(:creatCategorie));",[':creatCategorie' => $creatCategorie]);//Utilisation du DataMapper pour la protection contre les SQL Injections en deuxieme argument
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

  // PROCHAINE ETAPE 4 ----------------> setArticles.php (admin)
}

?>