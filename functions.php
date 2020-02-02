<?php

define('CF_THEME_DIR', dirname(__FILE__) . DIRECTORY_SEPARATOR);
define('CF_THEME_URL', get_template_directory_uri() . DIRECTORY_SEPARATOR);

require_once CF_THEME_DIR . 'vendor/autoload.php';

$CF_Config = new \CF\Core\Config();

$CF_Theme = new \CF\CrowdFavorite();
$CF_Theme->init();
