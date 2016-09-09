<?php
/**
 * orzpicker.php
 *
 * Creator:    chongyi
 * Created at: 2016/09/07 17:38
 */

$basePath = realpath(__DIR__ . '/../');

require $basePath . '/vendor/autoload.php';

$app = new \OrzPicker\Core\Application($basePath);
$app->bootstrap([
    \OrzPicker\Core\Bootstraps\CoreBuild::class,
    \OrzPicker\Core\Bootstraps\Catcher::class,
]);

$console = (new \OrzPicker\Core\Console($app))->resolveCommands([
    \OrzPicker\Core\Commands\ProcessRun::class,
]);

$console->run();