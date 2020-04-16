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

<?php


if ($partieLancer) { ?>
    <script src="assets/js/message.js"></script>
    <p>otages : <?= $game->otages() ?></p>
    <p>soldats: <?= $game->soldats() ?></p>
    <p>argents : <?= $game->argents() ?></p>
    <br>
    <p>Message :</p>
    <?php foreach ($messages as $message) : ?>
        <p><?= $message['contenu'] ?></p>
    <?php endforeach; ?>

    <br>
    
   <?php if(!isset($choix1)) :
    $choix1 = 'Choix 1';
   endif;
   if(!isset($choix2)) :
    $choix2 = 'Choix 2';
   endif;?>

        <form method="post" action="#">
            <ul class="actions">
                <li><input type="submit" value="<?= $choix1 ?>" class="primary" name="choix1" /></li>
                <li><input type="submit" value="<?= $choix2 ?>" class="primary" name="choix2" /></li>
            </ul>
        </form>

    <form method="post" action="#">
        <ul class="actions">
            <li><input type="submit" value="Relancer la partie" class="primary" name="reset" /></li>
        </ul>
    </form>
<?php } ?>