<?php

use App\Frontend\FrontendApplication;
use App\Frontend\Modules\Game\GameController;

require __DIR__ . '/../../lib/Framework/SplClassLoader.php';

$FramLoader = new SplClassLoader('Framework', __DIR__ . '/../../lib');
$FramLoader->register();

$appLoader = new SplClassLoader('App', __DIR__ . '/../..');
$appLoader->register();

$entityLoader = new SplClassLoader('Entity', __DIR__ . '/../../lib/vendors');
$entityLoader->register();

$app = new FrontendApplication();
$GC = new GameController($app, 'game', 'gameAjax');
$GC->execute();
