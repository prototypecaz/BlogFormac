<?php
// retourne si $data est vide sa taille de caractere et si la condtion est true alors filtre les donnees.
function replaceOrSanitize(string $data, int $length, string $value) {
    return (!empty($data) and strlen($data) <= $length) ? filter_var($data, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH) : $value;
}

?>