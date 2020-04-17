<?php

// DEFINITION OF THE DEFAULT APPLICATION //

const DEFAULT_APP = 'Frontend';

if (!isset($_GET['app']) || !file_exists(__DIR__.'/../App/'.$_GET['app'])) $_GET['app'] = DEFAULT_APP;

// CLASS LOADS //

require __DIR__.'/../lib/Framework/SplClassLoader.php';

$OCFramLoader = new SplClassLoader('Framework', __DIR__.'/../lib');
$OCFramLoader->register();

$appLoader = new SplClassLoader('App', __DIR__.'/..');
$appLoader->register();

$entityLoader = new SplClassLoader('Entity', __DIR__.'/../lib/vendors');
$entityLoader->register();

// $modelLoader = new SplClassLoader('Model', __DIR__.'/../lib/vendors');
// $modelLoader->register();

// $formBuilderLoader = new SplClassLoader('FormBuilder', __DIR__.'/../lib/vendors');
// $formBuilderLoader->register();

// APPLICATION LAUNCH //

$appClass = 'App\\'.$_GET['app'].'\\'.$_GET['app'].'Application';
$app = new $appClass;
$app->run();