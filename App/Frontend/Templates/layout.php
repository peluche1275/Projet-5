<!DOCTYPE html>
<html>

<head>
  <title>
    <?= isset($title) ? $title : 'Old Men Bandits' ?>
  </title>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta name="description" content="Old men bandits, le jeu narratif des boomerz">
  <meta name="keywords" content="Old men bandits, jeu, narratif">
  <link rel="stylesheet" href="assets/css/main.css" />
  <noscript>
    <link rel="stylesheet" href="assets/css/noscript.css" />
  </noscript>
</head>
<body>
  <div id="wrapper">
    <header id="header">
      <div class="content">
        <div class="inner">
          <h1><a href="/">Old men bandits</a></h1>
          <p>Le jeu narratif qui parle des Boomerz</p>
        </div>
      </div>
      <nav>
        <ul>
          <li><a href="/">Accueil</a></li>
          <?php if (!$user->isAuthenticated()) { ?>
            <li><a href="/login">Connexion</a></li>
            <li><a href="/inscription">Inscription</a></li>
          <?php } ?>
          <?php if ($user->isAuthenticated()) : ?>
            <li><a href="/jeu">Jeu</a></li>
            <li><a href="/leaderboard">Leaderboard</a></li>
            <li><a href="/moncompte">Mon compte</a></li>
            <li><a href="/deconnexion">Déconnexion</a></li>
          <?php endif ?>
        </ul>
        <?php if ($user->isAuthenticated()) : ?>

        <?php endif ?>
      </nav>
    </header>
    <div id="main">
      <section>
        <?php if ($user->hasFlash()) echo '<p style="text-align: center;">', $user->getFlash(), '</p>'; ?>
        <?= $content ?>
      </section>
    </div>

    <footer id="footer">
      <p class="copyright"> Dev : Nathan ALTOMARE - Design: <a href="https://html5up.net">HTML5 UP</a>.</p>
    </footer>
  </div>
  <!-- BG -->
  <div id="bg"></div>
  <script src="https://kit.fontawesome.com/1c9c468cda.js" crossorigin="anonymous"></script>
</body>

</html>