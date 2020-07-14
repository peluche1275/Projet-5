<?php foreach ($leaderboard as $score) : ?>
    <br>
    <div id="leaderboard">
        <img class="avatar" src="<?= $score['avatar'] ?>" alt="Votre Avatar">
        <p> <?= $score['pseudo'] ?></p>
        <p> <?= $score['bestscore'] ?> / 20</p>
    </div>
<?php endforeach ?>