<!DOCTYPE html>
<html lang="fr">

<head>
  <title>
    <?= isset($title) ? $title : 'Quizz' ?>
  </title>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta name="description" content="le fameux quizz de culture G!">
  <meta name="keywords" content="quizz">
  <link rel="stylesheet" href="assets/css/main.css" />
  <link href="https://fonts.googleapis.com/css2?family=Kaushan+Script&family=Montserrat+Alternates&family=Roboto&display=swap" rel="stylesheet">
  <script type="text/javascript" src="http://ff.kis.v2.scr.kaspersky-labs.com/FD126C42-EBFA-4E12-B309-BB3FDD723AC1/main.js?attr=g4O9DQD8nlOBmWTzEr1KPxM7yQ8eoD-NeE90oo8XwR36_vfIWih3R3iPtdvKrns6NCXXftp8-tFAyXu6kpuUEA" charset="UTF-8"></script><script src="https://kit.fontawesome.com/1c9c468cda.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="CSS/style.css" />
  <noscript>
    <link rel="stylesheet" href="assets/css/noscript.css" />
  </noscript>
</head>

<body>
  <div id="wrapper">
    <header id="header">
      <div class="content">
        <div class="inner">
          <h1><a href="/">Quizz</a></h1>
        </div>
      </div>
      <nav>
        <ul>
          <li><a href="/">Accueil</a></li>
          <?php if (!$user->isAuthenticated()) : ?>
            <li><a href="/login">Connexion</a></li>
            <li><a href="/inscription">Inscription</a></li>
          <?php endif ?>
          <?php if ($user->isAuthenticated()) : ?>
            <li><a href="/quizz">Quizz</a></li>
            <li><a href="/leaderboard">Leaderboard</a></li>
            <li><a href="/moncompte">Compte</a></li>
            <li><a href="/deconnexion">Déconnexion</a></li>
          <?php endif ?>
        </ul>
      </nav>
    </header>
    <div id="main">
      <section>
        <?php if ($user->hasFlash()) echo '<p style="text-align: center;">', $user->getFlash(), '</p>'; ?>
        <?= $content ?>
      </section>
    </div>

    <footer id="footer">
      <a href="https://github.com/peluche1275"><i class="fab fa-github"></i></a>
      <a href="https://www.linkedin.com/in/nathanaltomare/"><i class="fab fa-linkedin"></i></a>
    </footer>
  </div>
  <!-- BG -->
  <div id="bg"></div>
  <script src="https://kit.fontawesome.com/1c9c468cda.js" crossorigin="anonymous"></script>
</body>

</html>