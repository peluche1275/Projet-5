<!DOCTYPE html>
<html lang="fr">

<head>
  <title>
    <?= isset($title) ? $title : 'Old Men Bandits' ?>
  </title>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta name="description" content="le fameux quizz de culture G!">
  <meta name="keywords" content="quizz">
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
          <h1><a href="/">Quizz</a></h1>
          <p>Quizz qui porte sur la culture</p>
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
      <p class="copyright"> Dev : Nathan ALTOMARE - Design: <a href="https://html5up.net">HTML5 UP</a>.</p>
    </footer>
  </div>
  <!-- BG -->
  <div id="bg"></div>
  <script src="https://kit.fontawesome.com/1c9c468cda.js" crossorigin="anonymous"></script>
</body>

</html>