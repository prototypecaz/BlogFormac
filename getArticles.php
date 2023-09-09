<?php
/* Cinquieme etape Pourquoi crée un fichier getArticles.php ?
On a crée un fichier getArticles.php qui nous permettra de renvoyer le titre le text et la date sous forme d'un tableau associatif depuis la table
articles. En fonctions de la valeur(1,2,3) de la categorie choisis on pourra ensuite manipuler ce tableau pour pouvoir l'afficher dans l'index.html grace au getArticle.js 

*/

// Recupere le fichier function.php (connexion a la bdd + requete sql choisis)
require_once('./functions/function.php');

// Appelle de la fonction sqlQuery qui est composer de la requete sql en premiere argument(renvoie un tableau multidimensionnel) et le Data Mapper en deuxieme argument(renforce la securité)

sqlQuery("SELECT `title`,`text`,`date` FROM `articles` WHERE `articles`.`id_categorie` = (:id_categorie)",[':id_categorie' => $_GET['id_categorie']]); 
// ----> direction 6eme etape getArticles.js

?>

