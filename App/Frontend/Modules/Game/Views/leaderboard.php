<?php ?>
<p>Leaderboard</p>

<?php foreach($leaderboard as $score) :?>
    <p> <?= $score['pseudo'] ?> - <?= $score['bestscore'] ?> points </p>
<?php endforeach; ?>