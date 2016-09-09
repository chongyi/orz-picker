<?php
/**
 * Application.php
 *
 * Creator:    chongyi
 * Created at: 2016/09/07 17:01
 */

namespace OrzPicker\Core;

use Illuminate\Container\Container;
use OrzPicker\Core\Commands\ProcessRun;

class Application extends Container
{
    protected $basePath;

    const APP_NAME    =<<<LOGO
   ___              ___ _      _             
  /___\_ __ ____   / _ (_) ___| | _____ _ __ 
 //  // '__|_  /  / /_)/ |/ __| |/ / _ \ '__|
/ \_//| |   / /  / ___/| | (__|   <  __/ |   
\___/ |_|  /___| \/    |_|\___|_|\_\___|_|   
-----------------Orz-Picker------------------

LOGO;

    const APP_VERSION = '0.0.1-alpha';

    /**
     * Application constructor.
     *
     * @param $basePath
     */
    public function __construct($basePath)
    {
        $this->setBasePath(rtrim($basePath, '\/'));
    }

    /**
     * @param $bootstraps
     */
    public function bootstrap($bootstraps)
    {
        foreach ($bootstraps as $bootstrap) {
            if (class_exists($bootstrap)) {
                $instance = new $bootstrap;
                $instance->bootstrap($this);
            }
        }
    }

    /**
     * @return string
     */
    public function getBasePath()
    {
        return $this->basePath;
    }

    /**
     * @param string $basePath
     *
     * @return Application
     */
    public function setBasePath($basePath)
    {
        $this->basePath = $basePath;

        return $this;
    }

    /**
     * @return string
     */
    public function version()
    {
        return self::APP_VERSION;
    }

    /**
     * @return string
     */
    public function name()
    {
        return self::APP_NAME;
    }
}