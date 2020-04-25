<h2 class="major"> Leaderboard</h2>
<?php foreach ($leaderboard as $score) : ?>
    <div id="leaderboard">
        <img class="avatar" src="<?= $score['avatar'] ?>" alt="Votre Avatar">
        <p> <?= $score['pseudo'] ?></p>
        <p> <?= $score['bestscore'] ?> points</p>
    </div>
<?php endforeach ?>