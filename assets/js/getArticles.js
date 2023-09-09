// 6 eme etape: Pourquoi avoir crée un fichier getArticles.js
/*
On a cree un fichier getArticles.js pour recuperer notre categorie afin de pouvoir afficher nos articles dynamiquement liée a cette categorie dans l'index.html
*/ 


let select = document.querySelector('select') // Recupere la balise select 

select.onchange= function () { // Au click du select lancement de la fonction anonyme
  var section = document.querySelector('#articles');
  section.innerHTML="";
// Permet l'envoi d'une requete GET a destination d'un fichier PHP avec les valeurs des champs
fetch('./getArticles.php?id_categorie='+this.value)

.then(function(response) { // Quand on recoit une reponse.
    response.json().then( //  Renvoie un tableau associatif manipulable par javascript (format json)
        function(contacts) {
           // Manipulation du DOM (creation(createElement), personnalisation(style, textContent), affectation des balise html en enfants de la section (appendchild))
          contacts.forEach(element => {
            let div= document.createElement('div');
            div.style.border = "1px solid black"
            div.style.marginTop="10px"
            section.appendChild(div);
            let titre = document.createElement('h2');
            titre.textContent = element.title;
            div.appendChild(titre);
            let description = document.createElement('p')
            description.textContent = element.text;
            div.appendChild(description);
            let date = document.createElement('p')
            date.textContent = element.date;
            div.appendChild(date);
          });
        }
    ).catch(function(error) { 
      let article = document.createElement('article');
      article.innerText = "Aucun articles";
      section.appendChild(article);
    })
});


};
// --------------------> Direction 7eme etape Dossier Admin