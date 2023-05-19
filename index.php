<?php
session_start();

$_SESSION["id"] = $_SESSION["id"] ?? null;

// convertir toute "super global variable" en variable globale simple ($*****)
foreach ($_REQUEST as $cle => $valeur) {
    $$cle = $valeur;
}

//tableau de fichiers et type d'accés pour chaque valeur de la clé "commande".
$pagesDisponibles = ["articles" => ["titre" => "Article", "script" => "articles", "type-acces" => "tous"], "gerer-article" => ["titre" => "Gerer un article", "script" => "gerer-article", "type-acces" => "authentifie"], "404" => ["titre" => "Page non trouvé", "script" => "404", "type-acces" => "tous"], "authentification" => ["titre" => "S'authentifier", "script" => "authentification", "type-acces" => "non-authentifie"], "sortir" => ["titre" => "Sortir", "script" => "sortir", "type-acces" => "authentifie"]];


//$pagesDisponiblesAUsager: les pages accessibles, pour l'usager, pour les afficher sous forme de liens dans l'entete et dans la page 404 non trouvée
$pagesDisponiblesAUsager = [];
foreach ($pagesDisponibles as $cle => $value) {
    if ($value["type-acces"] ==  "tous" or ($value["type-acces"] ==  "non-authentifie" and empty($_SESSION["id"])) or ($value["type-acces"] ==  "authentifie" and empty($_SESSION["id"]) == false)) {
        $pagesDisponiblesAUsager[$cle] = $value;
    }
}


$commande = $commande ?? "articles";
if (array_key_exists($commande, $pagesDisponibles) == false) {
    $commande = "404";
}

//si l'usager est authentifié, et la page est pour les non-authentifiés
if ($pagesDisponibles[$commande]["type-acces"] ==  "non-authentifie" and empty($_SESSION["id"]) === false) {
    $commande = "articles";

    //si l'usager est non authentifié, et la page est protégée
} elseif ($pagesDisponibles[$commande]["type-acces"] ==  "authentifie" and empty($_SESSION["id"])) {
    $commande = "authentification";
    $message_erreur = "Vous devez connecter";
}


// les controleurs
if ($commande !== "404") require "controleurs/" . $pagesDisponibles[$commande]["script"] . ".php";


// les vues
require  "vues/commun/entete.php";

require  "vues/" . $pagesDisponibles[$commande]["script"] . ".php";

require  "vues/commun/footer.php";
