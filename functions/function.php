<?php

// Deuxieme etape Pourquoi cree un fichier function.php ? 

/* On a crée le fichier function.php pour ce connecter dans un premier temps a la base de données et 
pour eviter la repétition du code car on ce connecte plusieurs fois a la bdd avec une requete de selection différente pour chaque fichier.(getcategorie.php et getarticle.php)*/

function sqlQuery(string $sql,array $mapper) {
    // Permet de recuperer le tableau associatif du fichier configuration.php pour la connexion a la bdd.
    require_once(__DIR__.'/../configuration.php');
    
    // Lancement de notre exception.
    
    try {// On teste la connexion a la base de donnee avec une class PDO qui nous permet une meilleur sécurité.
        $connexion = (object) new PDO( sprintf("mysql:host=%s;dbname=%s", $database['hostname'], $database['name']), $database['username'], $database['password'] );
    } catch (PDOException $exception) { // Attrape une erreur grace a la PDOException 
        var_dump($exception->getMessage()); // Affiche l'erreur si la PDOexception envoie une erreur
    } finally {
        $preparation = (object) $connexion->prepare($sql); // Notre requete sql (a voir dans fichier getcategorie.php et getarticles.php)
            
        if ($preparation->execute($mapper)) { // Si la connexion c'est bien passer alors execute ce qui y'a dans l'instruction(if)
            if ($preparation->rowCount() > 0) { // Compte le nombre de ligne (si superieur a 0 alors go dans l'instruction)

                $test = $preparation->fetchAll(PDO::FETCH_ASSOC); //Renvoie un tableau associatif en fonction de la requete sql choisis
                echo json_encode($test); // Renvoie un tableau associatif compris par le javascript 
                

                /* Notre but dans cette fonction est de renvoyer la variable $test(tableau associatif en fonction de la requete) a nos fichier javascript (getcategorie et getarticle)
                ceux qui nous permettra de pouvoir afficher dans l'index.html dynamiquement nos article en fonction de la catégorie choisis*/

         
            // ----------------> Direction 3eme etape getCategories.php




            }
        }
    }

}

?>