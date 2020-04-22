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
    <div id="game">
        <div id="dataGame">
            <p id="otages">Otages : </p>
            <p id="soldats">Soldats: </p>
            <p id="argents">Argents : </p>
        </div>
        <br>
        <p id="precedent">precedent</p>
        <p id="suivant">suivant</p>
        <p>Message :</p>

        <span id="message1"></span>
        <span id="message2"></span>
        <span id="message3"></span>
        <span id="message4"></span>
        <span id="message5"></span>

        <br>
        <form id="choix" method="post" action="#">
            <ul class="actions">
                <li id="choix1Li">
                    <p class="button" id="choix1"></p>
                </li>
                <li id="choix2Li">
                    <p class="button" id="choix2"></p>
                </li>
            </ul>
        </form>
    </div>
    <form method="post" action="#">
        <ul class="actions">
            <li><input type="submit" value="Relancer la partie" class="primary" name="reset" /></li>
        </ul>
    </form>
<?php endif ?>

<script src="assets/js/app.js"></script>