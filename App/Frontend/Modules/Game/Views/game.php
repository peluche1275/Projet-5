<p> Page du jeu de <?= $account->pseudo() ?> </p>

<?php if ($partieLancer == false) {
?>
    <form method="post" action="#">
        <ul class="actions">
            <li><input type="submit" value="Commencer la partie" class="primary" name="start" /></li>
        </ul>
    </form>
<?php
}
?>

<?php if ($partieLancer) { ?>

    <p>otages : <?= $game->otages() ?></p>
    <p>soldats: <?= $game->soldats() ?></p>
    <p>argents : <?= $game->argents() ?></p>
    <br>
    <p>Message :</p>
    <?php foreach ($messages as $message) { ?>
        <p><?= $message['contenu'] ?></p>
    <?php } ?>

    <br>
    <?php if ($choix == false) { ?>
        <form method="post" action="#">
            <ul class="actions">
                <li><input type="submit" value="Suivant" class="primary" name="next" /></li>
            </ul>
        </form>
    <?php } ?>

    <?php if ($choix) { ?>
        <form method="post" action="#">
            <ul class="actions">
                <li><input type="submit" value="Choix 1" class="primary" name="Choix1" /></li>
                <li><input type="submit" value="Choix 2" class="primary" name="Choix2" /></li>
            </ul>
        </form>
    <?php } ?>

    <form method="post" action="#">
        <ul class="actions">
            <li><input type="submit" value="Relancer la partie" class="primary" name="reset" /></li>
        </ul>
    </form>
<?php } ?>