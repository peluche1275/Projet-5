<!-- USER NOT CONNECTED -->

<?php if (!$user->isAuthenticated()) : ?>
    <h2>Arrête les Boomerz </br> La bande de braqueurs du 3ème age</h2>
    <p>Old men bandits est un jeu narratif où il faut tenter d'atteindre le meilleur score en prenant les bons choix ! </p>
<?php endif ?>

<!-- USER CONNECTED -->

<?php if ($user->isAuthenticated()) : ?>
    <p>Bienvenue <strong><?= $account->pseudo(); ?> </strong> sur Old men bandits. </br>
        Tu peux aller jouer au jeu en cliquant sur l'onglet <a href="/jeu">Jeu.</a></br>
        Voir le classement des joueurs dans le <a href="/leaderboard">Leaderboard.</a></br>
        Voir ton compte dans <a href="/moncompte">"Mon compte"</a>
    </p>
<?php endif ?>