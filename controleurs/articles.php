<?php

require  __DIR__ . "/../models/" . basename(__FILE__);

$id_usager = $_SESSION["id"];

if (empty($rechercher)) {
    $mySqlArticles = articles();
} else if (empty($mot_cle)) {
    $message_erreur = "Mot clé vide";
} else {
    $mySqlArticles = rechercher_articles($mot_cle);
}

//sécuriser les données entrée par les usagers
if (empty($mySqlArticles) == false) {
    $articles = [];
    foreach ($mySqlArticles as $cle => $valeur) {
        $articles[$cle]["id"] = $valeur["id"];
        $articles[$cle]["titre"] = htmlspecialchars($valeur["titre"]);
        $articles[$cle]["texte"] = htmlspecialchars($valeur["texte"]);
        $articles[$cle]["id_auteur"] = $valeur["id_auteur"];
        $articles[$cle]["auteur"] = htmlspecialchars($valeur["auteur"]);
    }
}
