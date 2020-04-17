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
    
    <p id="otages">otages : <?= $game->otages() ?></p>
    <p id="soldats">soldats: <?= $game->soldats() ?></p>
    <p id="argents">argents : <?= $game->argents() ?></p>
    <br>
    <p>Message :</p>
    <?php foreach ($messages as $message) : ?>
        <p><?= $message['contenu'] ?></p>
    <?php endforeach; ?>
        <span id="message1"></span>

    <br>
    
   <?php if(!isset($choix1)) :
    $choix1 = 'Choix 1';
   endif;
   if(!isset($choix2)) :
    $choix2 = 'Choix 2';
   endif;?>

        <form id="choix" method="post" action="#">
            <ul class="actions">
                <input id="idhidden" type="hidden" value="<?= $account->id()?>">
                <li id="choix1Li"><p id="choix1"><?= $choix1 ?></p></li>
                <li id="choix2Li"><p id="choix2"><?= $choix2 ?></p></li>
            </ul>
        </form>

    <form method="post" action="#">
        <ul class="actions">
            <li><input type="submit" value="Relancer la partie" class="primary" name="reset" /></li>
        </ul>
    </form>
<?php } ?>

<script src="assets/js/message.js"></script>