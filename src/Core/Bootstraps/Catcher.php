<?php
/**
 * Catcher.php
 *
 * Creator:    chongyi
 * Created at: 2016/09/08 16:13
 */

namespace OrzPicker\Core\Bootstraps;


use OrzPicker\Catcher\Client;
use OrzPicker\Catcher\ClientManager;
use OrzPicker\Catcher\Clients\GuzzleClient;
use OrzPicker\Core\Application;

class Catcher
{
    public function bootstrap(Application $application)
    {
        $application->singleton('client', function () {
            $instance = ClientManager::getInstance();
            $instance->registerClientHandle('guzzle', function ($app) {
                return new GuzzleClient($app);
            });
        });

        $application->bind(Client::class, GuzzleClient::class);
    }
}