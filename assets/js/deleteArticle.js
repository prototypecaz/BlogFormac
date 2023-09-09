// 6 eme etape: Pourquoi avoir crée un deleteArticle.js ?
/*
Dans l'étape precedent on a demander a notre selecarticlefordelete.php de nous afficher les titre
d'articles. Il est temps de manipuler ces donnees et de les afficher dynamiquement.
*/ 



// Permet l'envoi d'une requete GET a destination d'un fichier PHP
fetch('./selectArticleForDelete.php') 
// Quand on recoit une réponse
.then(function(response) {
    response.json().then( // Renvoie un tableau associatif manipulable par javascript (format json)
        function(articles) {
            articles.forEach(article => { // Pour chaque element dans le tableau 
                let option = document.createElement('option'); // crée moi la balise option en fonction du nombre d'element
           option.value=article.id; // Affecte a l'attribut valeur, la valeur de article.id (1,2,3,4...)
           option.innerText=article.title; // Affecte la valeur a l'interieur des balise option (message , professionnel...)
            document.querySelector('#deleteArticle').appendChild(option);// Ajoute en enfant a la section #deleteArticle la balise ou les balises option. (depend du nombre d'elements)
            });

        }
    )
}); // ------> Direction 5eme etape getArticles.php
