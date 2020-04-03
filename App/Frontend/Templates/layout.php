<!DOCTYPE html>
<html>

<head>
  <title>
    <?= isset($title) ? $title : 'Super jeu' ?>
  </title>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="assets/css/main.css" />
  <noscript>
    <link rel="stylesheet" href="assets/css/noscript.css" /></noscript>

</head>

<body>
  <div id="wrapper">

    <header id="header">
      <!-- <div class="logo">
        <span class="icon fa-gem"></span>
      </div> -->
      <div class="content">
        <div class="inner">
          <h1><a href="/">Le Super jeu</a></h1>
          <p>Le super jeu trop bien qui a l'air trop cool</p>
        </div>
      </div>
      <nav>
        <ul>
          <li><a href="/">Accueil</a></li>
          <li><a href="/login">Connexion</a></li>
          <li><a href="/inscription">Inscription</a></li>
          <li><a href="/contact">Contact</a></li>
          <?php if ($user->isAuthenticated()) { ?>

          <?php } ?>
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

</body>

</html>