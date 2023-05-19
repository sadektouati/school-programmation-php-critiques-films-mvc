<?php

//si on a besoin de traiter de l'information qui provien de l'usager
if (empty($action) == false and empty($soumetre) == false) {

    if (empty($nom_usager) or empty($mot_de_passe)) {
        $message_erreur = "Nom d'usager et mot de passe obligatoires";
    } else {
        require  __DIR__ . "/../models/" . basename(__FILE__);

        if ($action === "inscrire") {
            $mot_de_passe_scurise = password_hash($mot_de_passe, PASSWORD_DEFAULT);
            $usagerCree = creer_usager($nom_usager, $mot_de_passe_scurise);

            if ($usagerCree == false) {
                $message_erreur = "On n'a pas pu créé le compte";
            } else {
                $creation = authentifier_usager($nom_usager);
                if (empty($creation)) {
                    $message_erreur = "On n'a probleme unconnu";
                } else {
                    //j'ai pas besoin de verifier le mot de passe
                    $_SESSION["id"] = $creation["id"];
                    header("location: ?commande=articles");
                }
                exit;
            }
        } else {
            $authentifier = authentifier_usager($nom_usager);

            if (empty($authentifier)) {
                $message_erreur = "Nom usager ou mot de passe incorrect!";
            } else {
                if (password_verify($mot_de_passe, $authentifier["mot_de_passe"]) === false) {

                    $message_erreur = "Nom usager ou mot de passe incorrect!";
                } else {
                    $_SESSION["id"] = $authentifier["id"];
                    header("location: ?commande=articles");
                }
                exit;
            }
        }
    }
}
