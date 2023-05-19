<?php

require __DIR__ . "/../basededonnees/connexion.php";


function inserer_article($titre, $texte, $idUsager)
{
    $connexion = connectDB();
    //une autre mesure de sécurité pour empecher l'empersonification -- le select ... from usager where usager.id = ?
    $requete = "insert into article (titre, texte, id_auteur) select ?, ?, ? from usager where usager.id=?";

    if ($reqPrep = mysqli_prepare($connexion, $requete)) {
        mysqli_stmt_bind_param($reqPrep, "ssii", $titre, $texte, $idUsager, $idUsager);

        try {
            mysqli_stmt_execute($reqPrep);
        } catch (mysqli_sql_exception $e) {
            // ne fait rien
        }
        return (mysqli_affected_rows($connexion) > 0);
    }
}

function mettre_a_jour_article($id, $titre, $texte, $idUsager)
{
    $connexion = connectDB();
    //une autre mesure de sécurité pour empecher l'empersonification -- id_auteur=?
    $requete = "update article set titre = ?, texte = ? where id=? and id_auteur=?";

    if ($reqPrep = mysqli_prepare($connexion, $requete)) {
        mysqli_stmt_bind_param($reqPrep, "ssii", $titre, $texte, $idUsager, $id);

        try {
            mysqli_stmt_execute($reqPrep);
        } catch (mysqli_sql_exception $e) {
            // ne fait rien
        }
        return (mysqli_affected_rows($connexion) > 0);
    }
}


function article($id, $idUsager)
{
    $connexion = connectDB();
    //une autre mesure de sécurité pour empecher l'empersonification -- id_auteur=?
    $requete = "select id, titre, texte, id_auteur from article where id = ? and id_auteur = ?";

    if ($reqPrep = mysqli_prepare($connexion, $requete)) {
        mysqli_stmt_bind_param($reqPrep, "ii", $id, $idUsager);

        try {
            mysqli_stmt_execute($reqPrep);
            $resultats = mysqli_stmt_get_result($reqPrep);
        } catch (mysqli_sql_exception $e) {
            // ne fait rien
        }
        return mysqli_fetch_assoc($resultats);
    }
}

function supprimer_article($id, $idUsager)
{
    $connexion = connectDB();
    //une autre mesure de sécurité pour empecher l'empersonification -- id_auteur=?
    $requete = "delete from article where id = ? and id_auteur = ?";

    if ($reqPrep = mysqli_prepare($connexion, $requete)) {
        mysqli_stmt_bind_param($reqPrep, "ii", $id, $idUsager);

        try {
            mysqli_stmt_execute($reqPrep);
        } catch (mysqli_sql_exception $e) {
            // ne fait rien
        }
        return (mysqli_affected_rows($connexion) > 0);
    }
}
