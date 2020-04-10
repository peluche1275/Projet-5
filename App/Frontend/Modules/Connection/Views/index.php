<?php if (!$user->isAuthenticated()) { ?>
    <p>Bienvenue sur la page d'accueil du jeu </br> Pour le moment il n'y a pas grand chose.</p>
<?php } ?>

<?php if ($user->isAuthenticated()) { ?>
    <p>Bienvenue <strong><?= $account->pseudo(); ?> </strong> sur le jeu. </p>
<?php } ?>