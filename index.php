<?php

require_once "./ph/autoload/autoload-register.php";
\ph\logging\Logger::initialize();

$app = new \ph\Application();
$app->run();
