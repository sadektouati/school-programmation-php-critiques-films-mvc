<form>
    <span class="error"><?= $message_erreur ?? "" ?></span>

    <input type="text" name="mot_cle" value="<?= $mot_cle ?? "" ?>">
    <button type="submit" name="rechercher" value="rechercher">rechercher</button>
</form>

<header>
    <?php if (empty($rechercher) === false) { ?>
        <a href="?">tous les articles</a>
    <?php }
    if (empty($_SESSION["id"]) == false) { ?>
        <a href="?commande=gerer-article&action=creer">Créer article</a>
    <?php } ?>
</header>

<?php
if (empty($articles) === false) {
    foreach ($articles as $article) { ?>
        <article>
            <header>
                <h1><?= $article["titre"] ?></h1>
            </header>
            <section><?= $article["texte"] ?></section>
            <footer>
                <span>Par: <?= $article["auteur"] ?></span>

                <?php if ($article["id_auteur"] == $id_usager) { ?>
                    <a href="?commande=gerer-article&action=modifier&id=<?= $article["id"] ?>&id_auteur=<?= $article["id_auteur"] ?>">modifier</a>
                    <a href="?commande=gerer-article&action=supprimer&id=<?= $article["id"] ?>&id_auteur=<?= $article["id_auteur"] ?>">supprimer</a>
                <?php } ?>
            </footer>
        </article>
    <?php    }
} else {
    if (empty($rechercher) === false) { ?>
        Aucun résultat
    <?php } else { ?>
        Il y a pas d'article,
        <a href="?commande=gerer-article&action=creer">Créer un</a>
<?php }
} ?>