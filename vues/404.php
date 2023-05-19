<h1>Page introuvable</h1>

<article>
    La page n'existe pas
</article>

<article>
    <?php
    foreach ($pagesDisponiblesAUsager as $cle => $valeur) {
        if ($cle == "404") continue;
    ?>
        <a href="?commande=<?= $cle ?>"><?= $valeur["titre"] ?></a>
    <?php  } ?>
</article>