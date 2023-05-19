<form class="authentification" method="post">
    <span class="error"><?= $message_erreur ?? "" ?></span>

    <?php if (($action ?? "") === "inscrire") { ?>
        <input type="hidden" name="action" value="inscrire">
    <?php } else { ?>
        <input type="hidden" name="action" value="entrer">
    <?php } ?>

    <input type="hidden" name="commande" value="authentification">

    <fieldset>
        <label for="nom_usager">Nom usager</label>
        <input type="text" name="nom_usager" id="nom_usager" placeholder="nom d'usager" value="<?= $nom_usager ?? "" ?>">
    </fieldset>

    <fieldset>
        <label for="mot_de_passe">Mot de passe</label>
        <input type="password" name="mot_de_passe" id="mot_de_passe" placeholder="mot de passe">
    </fieldset>

    <fieldset>
        <button type="submit" name="soumetre" value="oui">Continuer</button>
    </fieldset>
    <?php if (($action ?? "") === "inscrire") { ?>
        <fieldset>Vous avez un compte?
            <a href="?commande=authentification&action=entrer">Entrer</a>
        </fieldset>
    <?php } else { ?>
        <fieldset>
            Vous n'avez pas de compte?
            <a href="?commande=authentification&action=inscrire">S'inscrire</a>
        </fieldset>
    <?php } ?>

</form>