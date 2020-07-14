<?php if (!$user->isAuthenticated()) : ?>
    <h2>Testez vos connaissances !</h2>
    <p>Ce site est un quizz de culture générale !</p>
<?php endif ?>

<?php if ($user->isAuthenticated()) : ?>
    <p>Bienvenue <strong><?= $account->pseudo(); ?> </strong></br>
        Tu peux aller répondre au quizz en cliquant sur l'onglet <a href="/quizz">quizz.</a></br>
        Voir le classement des joueurs dans le <a href="/leaderboard">Leaderboard.</a></br>
        Voir ton compte dans <a href="/moncompte">"Mon compte"</a>
    </p>
<?php endif ?>