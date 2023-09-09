var but = document.querySelector("#newButton");


            fetchJson("./getCategories.php").then( // Renvoie un tableau associatif manipulable par javascript (format json)
            function(json) {
                
                json.forEach(element => {
                    let newButton = document.createElement("button")
                   
                    newButton.value = element.id
                    newButton.textContent=element.name
                    but.appendChild(newButton);
    
       
                });
                var button = document.querySelectorAll('button')
                var sectionButton = document.querySelector('#articleButton')
                button.forEach(element => {
                    element.onclick = function(){
                        
                sectionButton.innerHTML="";
                        fetch('./getArticleButton.php?button='+element.value)
                        .then(function(response){
                            response.json().then(function(article){
                            article.forEach(element => {
                                
                                let h2 = document.createElement('h2')
                                h2.textContent=element.title
                                sectionButton.appendChild(h2)
                            });

                            })
                        })
                    }
                });
            })


            
            
            
            
            
            
            
            
            
            //contact@super-boutique.com Aze00000000,
   //http://www.super-boutique.com/prestashop/admin825ime08p/index.php?controller=AdminLogin&token=e22bc14bf8394d1488608c959c89e25e
            