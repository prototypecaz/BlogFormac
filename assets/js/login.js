/*

2eme etape administrateur: Pourquoi crée un fichier login.js
Precedamment on a pu voir qu'on va utiliser un "hash" plus precisemment on parle de 
document.location.hash. 
Location est un object qui renvoie des informations concernant l'url. Dans cette etape on veux savoir
si il localise les hash inscrit precedament dans l'url.

*/






var hash = document.location.hash; // permet de localiser un hash (#)

var text; // Permettra d'afficher nos message d'erreur
switch (true) { // 
    case (hash === "#username"): // Premiere cas: si hash localise '#username'
        text = "Nom d'utilisateur invalide."; // affectation de la valeur a la variable
        break; //arrete 
    case (hash === "#password"): // Deuxieme cas: si hash localise '#password'
        text = "Mot de passe invalide."; // affectation de la valeur a la variable
        break; // arrete 
    default: // si aucune des condtions precedente est vrai alors 
        text = ""; // affectation de la valeur(vide) a la variable
}
document.querySelector('#erreurs').innerText = text; // affichage du message d'erreur dans la balise #erreurs

// PROCHAINE ETAPE 3 -------------> setCategorie.php