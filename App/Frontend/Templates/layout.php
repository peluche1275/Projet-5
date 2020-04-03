<!DOCTYPE html>
<html>

<head>
  <title>
    <?= isset($title) ? $title : 'Super jeu' ?>
  </title>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <!-- <link rel="stylesheet" href="/assets/css/main.css" type="text/css" />
  <link rel="icon" href="/images/favicon.ico" /> -->

</head>

<body>
  <div id="wrapper">
    <header id="header">
      <h1><a href="/">Le Super jeue</a></h1>
      <nav class="links">
        <ul>
        <li><a href="/">Accueil</a></li>
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

    <footer></footer>
  </div>
</body>
</html>