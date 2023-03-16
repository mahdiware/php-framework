<?php
use Application\Config\Os;
use Mahdiware\Mahdiware;
use Mahdiware\Env;


$minPhpVersion = '7.4';
if (version_compare(PHP_VERSION, $minPhpVersion, '<')) {
    $message = sprintf('Your PHP version must be %s or higher to run Mahdiware. Current version: %s', $minPhpVersion, PHP_VERSION);
    exit($message);
}

define('PATH', __DIR__);
chdir(PATH);

require PATH . DIRECTORY_SEPARATOR . 'Application/Config/Os.php';
require rtrim((new Os)->SystemPath, '\\/ ') . '/autoload.php';

//env class
(new Env(PATH . DIRECTORY_SEPARATOR . 'Application/'))->load();
//Head of framework
(new Mahdiware())->run();