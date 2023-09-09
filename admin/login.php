<?php

/*
1ere etape administrateur: Pourquoi crée un fichier login.php ?
Dans ce cas la on a besoin d'identifier l'administrateur (username,password) pour savoir
si il est bien inscrit dans notre BDD. 
Si c'est le cas on le redirigera a notre page HTML (administration.html) pour pouvoir stocker des donnes qu'il nous aura fournis (on verra ca dans les prochaines etapes),
 sinon il devra essayer de ce reconnecter. 
Rappel: Seul un administrateur peut avoir des droits c'est a dire ajouter modifier supprimer des article dans notre cas.
L'utilisateur n'a aucun droit il pourra seulement voir l'affichage de la page index.html il ne pourra donc
jamais avoir accés a la page administration.html celle ci est réservé a l'admin.

*/


// On verifie si les clefs POST(username,password) sont définis.(isset)
// On verifie si les valeurs de POST(username,password) sont différente de vide (!empty)
// Enfin on verifie le nombre de caractere fournis qui doit etre inferieur ou superieur a une certaine valeur(strlen inferieur ou = 25 , strlen superieur ou = 8)

// Si toute c'est conditions sont true alors on rentre dans l'instruction de la if sinon dans l'instruction de la else.
// RAPPEL: C'est données provienne du formulaire de connexion.(index.html admin)
if (
    isset($_POST['username']) and !empty($_POST['username']) and strlen($_POST['username']) <= 25 and
    isset($_POST['password']) and !empty($_POST['password']) and strlen($_POST['password']) >= 8
) {

    $username = (string) $_POST['username']; // Affectation de la valeur POSTusername a la variable $username
    $password = (string) $_POST['password']; // Affection de la valeur POSTpassword a la variable $password
                                            // RAPPEL: le $_POST renvoie toujours un tableau associatif.
     
    // Permet de recuperer le tableau associatif du fichier configuration.php pour la connexion a la bdd.                                       
    require_once('../configuration.php');


    try { // try : essaye l'instruction contenu c'est a dire la connexion a la bdd grace a notre tableau associatif,
        // fournir par le require_once(configuration.php) RAPPEL: try catch finally est une exception la try sera toujours suivi d'un catch et d'une finally.
// RAPPEL: on a choisis l'object PDO pour permettre de renforcer la sécurité.
        $connexion = (object) new PDO( sprintf("mysql:host=%s;dbname=%s", $database['hostname'], $database['name']), $database['username'], $database['password'] );
    
    } catch (PDOException $exception) {// catch : attrape les erreurs PDOException qui ensuite est affecter a la variable $exception

        var_dump($exception->getMessage()); // si la catch a attraper une erreur on demande d'afficher le message d'erreur que la PDOexception a renvoyer affecter a la variable $exeception

    } finally { // Si tous c'est bien passer on passe a l'instruction de la finally

        // Requete SQL : selectionne moi l'id et le password depuis la table 'users' ou username est egal a :username
        // RAPPEL: si 'username' = ':username' on s'attend a l'utilisation du datamapper.
        // Cette requete nous permet de verifier si il est bien inscrit dans la BDD.
        $preparation = (object) $connexion->prepare("SELECT `id`, `password` FROM `users` WHERE `username` = (:username)");
        
        //On l'execute et Utilisation du DataMapper pour la protection contre les SQL Injections
        if ( $preparation->execute( [':username' => $username] ) ) {
            
            if ($preparation->rowCount() > 0) { // si le nombre de ligne est superieur a 0 on passe a l'instruction.
                
                // on recupere les donnees sous format tableau associatif dans un tableau a indice donc 
                // un tableau multidimensionnel.
                $data = (array) $preparation->fetchAll(PDO::FETCH_ASSOC);
                
                $idFromDatabase = (string) $data[0]['id']; // Affectation de la valeur de la cle id a l'indice 0
                
                $passwordFromDatabase = (string) $data[0]['password'];// Affectation de la valeur de la cle password a l'indice 0

                // comparaison du mot de passe du formulaire au mot de passe de la base de donnees
                if (password_verify($password, $passwordFromDatabase)) {

                    // Attribue un identifiant unique de type cookie a un navigateur
                    session_start();
                    // Stockage du nom d'utilisateur (idfromdatabase) et de la valeur aleatoire du cookie(session_id) dans une super variable globale
                    $_SESSION['user'] = (array) array($idFromDatabase, session_id());

                    // retourne au navigateur le code HTTP pour preparer une redirection
                    http_response_code(302);
                    // ajoute dans l'en-tete la destination
                    header('Location: ./administration.html');
                    // arrete l'execution du PHP
                    exit();

                } else { // Si on une condition de la if nous renvoie false alors on rentre dans l'instruction de la else.

                    // retourne au navigateur le code HTTP pour preparer une redirection
                    http_response_code(302);
                    // ajoute dans l'en-tete la destination + utilisation du hash dans la prochaine etape
                    header('Location: ./index.html#password');
                    // arrete l'execution du PHP
                    exit();

                }

            } else {
                
                // retourne au navigateur le code HTTP pour preparer une redirection
                http_response_code(302);
                // ajoute dans l'en-tete la destination + utilisation du hash dans la prochaine etape
                header('Location: ./index.html#username');
                // arrete l'execution du PHP
                exit();

                //PROCHAINE ETAPE 2 -----------> login.js (admin)
            }

        }

    }

}

?>