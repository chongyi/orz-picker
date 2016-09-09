<?php
/**
 * CoreBuild.php
 *
 * Creator:    chongyi
 * Created at: 2016/09/08 16:04
 */

namespace OrzPicker\Core\Bootstraps;


use OrzPicker\Core\Application;

class CoreBuild
{
    public function bootstrap(Application $application)
    {
        $application->instance(Application::class, $application);
    }
}