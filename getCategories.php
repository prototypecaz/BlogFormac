<?php

/* Troisieme etape Pourquoi crée un fichier getCategories.php ?
On a crée un fichier getCategorie.php qui nous permettra de renvoyer l'id et le nom de la catégorie qui nous servira dans le getCategorie.js
En fonction de son choix on sera capable de lui afficher l'article liée a cette catégorie. 
*/


// Recupere le fichier function.php (connexion a la bdd + requete sql choisis)
require_once('./functions/function.php');


// Appelle de la fonction qui en argument envoie la requete sql.

sqlQuery("SELECT * FROM `categories`",[]); // Selectionne moi tout depuis la table catégorie.
// Renvoie le nom et l'id de la table categories sous forme d'un tableau multidimensionnel qu'on manipulera dans la prochaine etape (getCategorie.js) 


// ----------------------------------> Direction 4eme etape getCategories.js