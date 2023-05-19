<?php

require __DIR__ . "/../basededonnees/connexion.php";

function articles()
{
    $connexion = connectDB();

    $requete = "select article.id, titre, texte, id_auteur, nom_usager as auteur from article join usager on id_auteur=usager.id order by id desc";

    $resultat = mysqli_query($connexion,  $requete);
    return $resultat;
}


function rechercher_articles($motCle)
{
    $connexion = connectDB();
    $requete = "select article.id, titre, texte, id_auteur, nom_usager as auteur from article join usager on id_auteur=usager.id where titre like ? or texte like ? order by id desc";
    $motCle = "%" . $motCle . "%";
    if ($reqPrep = mysqli_prepare($connexion, $requete)) {
        mysqli_stmt_bind_param($reqPrep, "ss", $motCle, $motCle);

        try {
            mysqli_stmt_execute($reqPrep);
            $resultats = mysqli_stmt_get_result($reqPrep);
        } catch (mysqli_sql_exception $e) {
            // ne fait rien
        }

        return mysqli_fetch_all($resultats, MYSQLI_ASSOC);
    } else {
        return false;
    }
}
