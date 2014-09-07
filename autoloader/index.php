<?php

require_once('Core/autoloader.php');

\Core\Autoload::registerAutoloader();

// run autoload Core\Core()
$core = new Core\Core();
$core->index();

// run autoload Core\Files\FileONe()
$fileOne = new Core\Files\FileOne();
$fileOne->index();

// run autoload Core\Files\FileThree()
$fileThree = new Core\Files\FileThree();
$fileThree->index();

var_dump( 'it\'s index file' );