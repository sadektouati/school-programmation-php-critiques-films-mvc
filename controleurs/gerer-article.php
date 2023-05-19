<?php

if (empty($soumetre_formulaire) == false) {

    if (empty($action) or empty($titre) or empty($texte)) {
        $message_erreur = "titre, texte, action sont requis pour continuer";
    } else {
        if ($action === "modifier") {

            if (empty($id) or empty($id_auteur)) {
                $message_erreur = "Id et id_auteur sont requis pour continuer";
            } else if ($id_auteur != $_SESSION["id"]) {
                $message_erreur = "Vous n'etes pas autorisé a modifier cet article";
            } else {
                require  __DIR__ . "/../models/" . basename(__FILE__);

                $gererArticle = mettre_a_jour_article($id, $titre, $texte, $id_auteur);

                if (empty($gererArticle)) {
                    $message_erreur = "On ne peut pas mettre a jour votre article";
                } else {
                    header("location: ?commande=articles");
                    exit;
                }
            }
        } else {
            require  __DIR__ . "/../models/" . basename(__FILE__);

            $gererArticle = inserer_article($titre, $texte, $_SESSION["id"]);

            if (empty($gererArticle)) {
                $message_erreur = "On ne peux pas  créer votre article";
            } else {
                header("location: ?commande=articles");
                exit;
            }
        }
    }
} else if (empty($action) == false) {

    if ($action !== "creer") {

        if (empty($id) or empty($id_auteur)) {
            $message_erreur = "Id et id_auteur sont requis pour continuer";
        } else if ($id_auteur != $_SESSION["id"]) {
            $message_erreur = "Vous n'etes pas autorisé a modifier/supprimer cet article";
        } else {

            require  __DIR__ . "/../models/" . basename(__FILE__);

            if ($action === "supprimer") {
                $supprimerArticle = supprimer_article($id, $id_auteur);

                if (empty($supprimerArticle)) {
                    $message_erreur = "Article non existant ou vous n'etes pas autorisé a le supprimer";
                } else {
                    header("location: ?commande=articles");
                }
            } else {

                $mofifierArticle = article($id, $id_auteur);
                if (empty($mofifierArticle)) {
                    $message_erreur = "Article non existant ou vous n'etes pas autorisé a le modifier";
                } else {
                    //$id_auteur = $mofifierArticle["id_auteur"];
                    $titre = htmlspecialchars($mofifierArticle["titre"]);
                    $texte = htmlspecialchars($mofifierArticle["texte"]);
                }
            }
        }
    }
}
