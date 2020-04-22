<p> Page du jeu de <?= $account->pseudo() ?> </p>

<?php 
$_SESSION['id'] = $account->id();
?>

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

<?php if ($partieLancer) : ?>
<div id="dataGame">
    <p id="otages">Otages : <?= $game->otages() ?></p>
    <p id="soldats">Soldats: <?= $game->soldats() ?></p>
    <p id="argents">Argents : <?= $game->argents() ?></p>
</div>
    <br>
   <?php if($game->progression()>=6) : ?>
    <p class="pagination">O</p>
    <?php endif ?>
    <p>Message :</p>
<div id="phpmessages">
    <?php
    foreach ($messages as $message) : 
        ?>
        <p><?= $message['contenu'] ?></p>
    <?php endforeach; ?>
</div>
    <span id="message1"></span>
    <span id="message2"></span>
    <span id="message3"></span>
    <span id="message4"></span>
    <span id="message5"></span>

    <br>
    
   <?php if(!isset($choix1)) :
    $choix1 = 'Choix 1';
   endif;
   if(!isset($choix2)) :
    $choix2 = 'Choix 2';
   endif;?>

        <form id="choix" method="post" action="#">
            <ul class="actions">
                <li id="choix1Li"><p class="button" id="choix1"><?= $choix1 ?></p></li>
                <li id="choix2Li"><p class="button" id="choix2"><?= $choix2 ?></p></li>
            </ul>
        </form>

    <form method="post" action="#">
        <ul class="actions">
            <li><input type="submit" value="Relancer la partie" class="primary" name="reset" /></li>
        </ul>
    </form>
<?php endif ?>

<script src="assets/js/message.js"></script>