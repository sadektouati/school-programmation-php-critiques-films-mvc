<?php

require __DIR__ . "/../basededonnees/connexion.php";


function creer_usager($nomUsager, $motDePasse)
{
    $connexion = connectDB();
    $requete = "insert into usager (nom_usager, mot_de_passe) values (?, ?)";

    if ($reqPrep = mysqli_prepare($connexion, $requete)) {
        mysqli_stmt_bind_param($reqPrep, "ss", $nomUsager, $motDePasse);

        try {
            mysqli_stmt_execute($reqPrep);
        } catch (mysqli_sql_exception $e) {
            // ne fait rien
        }

        if (mysqli_affected_rows($connexion) > 0) {
            return authentifier_usager($nomUsager);
        } else {
            return false;
        }
    }
}


function authentifier_usager($nomUsager)
{
    $connexion = connectDB();
    $requete = "select id, mot_de_passe from usager where nom_usager = ?";

    if ($reqPrep = mysqli_prepare($connexion, $requete)) {
        mysqli_stmt_bind_param($reqPrep, "s", $nomUsager);

        try {
            mysqli_stmt_execute($reqPrep);
            $resultats = mysqli_stmt_get_result($reqPrep);
        } catch (mysqli_sql_exception $e) {
            // ne fait rien
        }

        return mysqli_fetch_assoc($resultats);
    }
}
