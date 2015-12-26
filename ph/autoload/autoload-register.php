<?php

require_once "ClassLoader.php";

spl_autoload_register('\ph\autoload\ClassLoader::loadFromNamespace');
