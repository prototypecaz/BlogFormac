<?php

// Deuxieme etape Pourquoi cree un fichier function.php ? 

/* On a crée le fichier function.php pour ce connecter dans un premier temps a la base de données et 
pour eviter la repétition du code car on ce connecte plusieurs fois a la bdd avec une requete de selection différente pour chaque fichier.(getcategorie.php et getarticle.php)*/

function sqlInsert(string $sql,array $mapper) {

    // Permet de recuperer le tableau associatif du fichier configuration.php pour la connexion a la bdd.
    require_once('./configuration.php');
    
    // Lancement de notre exception.
    
    try {// On teste la connexion a la base de donnee avec une class PDO qui nous permet une meilleur sécurité.
        $connexion = (object) new PDO( sprintf("mysql:host=%s;dbname=%s", $database['hostname'], $database['name']), $database['username'], $database['password'] );
    } catch (PDOException $exception) { // Attrape une erreur grace a la PDOException 
        var_dump($exception->getMessage()); // Affiche l'erreur si la PDOexception envoie une erreur
    } finally {
            $preparation = (object) $connexion->prepare($sql); // Notre requete sql (a voir dans fichier getcategorie.php et getarticles.php)
            // on l'execute
            if ($preparation->execute()) {
                
                /* si tout s'est bien passer (insertion des données) on se redirige
                 vers la page index.php qui affichera notre annuaire à jour */
                http_response_code(302);
                header('Location: ./index.html');
                exit();

            }
        }
    }

?>