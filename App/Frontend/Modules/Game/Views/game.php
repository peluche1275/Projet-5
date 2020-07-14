<?php !isset($_SESSION['id']) ?>
<?php
$_SESSION['id'] = $account->id();
?>

<?php if ($partieLancer == false) :
?>
    <form method="post" action="#">
        <ul class="actions">
            <li><input type="submit" value="Commencer la partie" class="primary" name="start" /></li>
        </ul>
    </form>
<?php endif ?>

<?php if ($partieLancer) : ?>
    <div id="game">
        <br>
        <div class="lineGame">
            <i id="precedent" class="fas fa-backward"></i>
            <i id="suivant" class="fas fa-forward"></i>
        </div>

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
    <script src="assets/js/app.js"></script>
<?php endif ?>