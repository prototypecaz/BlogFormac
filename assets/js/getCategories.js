// Quatrieme étape création de notre fichier JS

// Pourquoi crée un fichier JS getCategorie ?
// on crée un fichier JS pour pouvoir récupérer notre variable $test(donnée) qui se trouve dans notre function.php 
//pour ensuite crée nos options (affichage de nos categorie dans une balise select)

// Permet l'envoie d'une requete GET a destination d'un fichier PHP

if (document.location.href.includes("admin/administration.html")){
    
    var chemin = '../getCategories.php';
} else{
    
    var chemin = './getCategories.php';
}


fetch(chemin) 
// Quand on recoit une réponse
.then(function(response) {
    response.json().then( // Renvoie un tableau associatif manipulable par javascript (format json)
        function(json) {

           json.forEach(categorie => { // Pour chaque element dans le tableau 
                let option = document.createElement('option'); // crée moi la balise option en fonction du nombre d'element
                option.value=categorie.id; // Affecte a l'attribut valeur, la valeur de categorie.id (1,2,3,4...)
                option.innerText=categorie.name; // Affecte la valeur a l'interieur des balise option (message , professionnel...)
                document.querySelector('#select').appendChild(option);// Ajoute en enfant a la section la balise ou les balises option. (depend du nombre d'elements)
            });

        }
    )
}); // ------> Direction 5eme etape getArticles.php


