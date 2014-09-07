An example autoload file without "require" or "include" in the file where we use another file.

For example:
In index.php we don't use "require" or "include" for load file Core/Core.php, 
this file will be load with spl_autoload_register() that will run another function 
that will be require needed file (in this case it will be Core/Core.php). 
Function spl_autoload_register()  will be run in \Core\Autoload::registerAutoloader()

file index.php
==============

<?php

require_once('Core/autoloader.php');

\Core\Autoload::registerAutoloader();

// run autoload Core\Core()
$core = new Core\Core();
$core->index();
