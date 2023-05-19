<?php

require __DIR__ . "/../basededonnees/connexion.php";


function gerer_article($id, $titre, $texte, $idUsager)
{
    $connexion = connectDB();
    //une autre mesure de sécurité pour empecher l'empersonification -- le select ... from usager where id = $idUsager
    $requete = "insert into article (id, titre, texte, id_auteur) select ?, ?, ?, ? from usager where usager.id=? on duplicate key update titre = ?, texte = ?";

    if ($reqPrep = mysqli_prepare($connexion, $requete)) {
        mysqli_stmt_bind_param($reqPrep, "issiiss", $id, $titre, $texte, $idUsager, $idUsager, $titre, $texte);

        try {
            mysqli_stmt_execute($reqPrep);
        } catch (mysqli_sql_exception $e) {
            // ne fait rien
        }
        return (mysqli_affected_rows($connexion) > 0);
    }
}
