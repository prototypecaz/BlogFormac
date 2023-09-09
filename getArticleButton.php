<?php

require_once('./functions/function.php');

sqlQuery("SELECT `title`,`text`,`date` FROM `articles` WHERE `articles`.`id_categorie` = (:id_categorie)",[':id_categorie' => $_GET['button']]); 







?>