<?php if (($action ?? "creer") === "supprimer") { ?>
    <span class="error"><?= $message_erreur ?? "" ?></span>
<?php } else { ?>

    <form class="gerer-article" method="post">

        <span class="error"><?= $message_erreur ?? "" ?></span>

        <?php if (($action ?? "creer") === "creer") { ?>
            <input type="hidden" name="action" value="creer">
        <?php } else { ?>
            <input type="hidden" name="id" value="<?= $id ?>">
            <input type="hidden" name="id_auteur" value="<?= $id_auteur ?>">
            <input type="hidden" name="action" value="modifier">
        <?php } ?>


        <input type="hidden" name="commande" value="gerer-article">

        <fieldset>
            <label for="titre">Titre</label>
            <input type="text" name="titre" id="titre" placeholder="Titre d'article" value="<?= $titre ?? "" ?>">
        </fieldset>

        <fieldset>
            <label for="texte">Texte</label>
            <textarea name="texte" id="texte" placeholder="Texte d'article" rows="10"><?= $texte ?? "" ?></textarea>
        </fieldset>

        <fieldset>
            <?php if (empty($action)) { ?>
                <button type="submit" name="soumetre_formulaire" value="créer">créer</button>
            <?php } else { ?>
                <button type="submit" name="soumetre_formulaire" value="enregistrer">enregistrer</button>
            <?php } ?>
        </fieldset>

    </form>
<?php } ?>