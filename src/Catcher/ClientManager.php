<?php
/**
 * ClientManager.php
 *
 * Creator:    chongyi
 * Created at: 2016/09/05 14:06
 */

namespace OrzPicker\Catcher;

use Illuminate\Contracts\Container\Container;

/**
 * Class ClientManager
 *
 * @package OrzPicker\Catcher
 */
class ClientManager
{
    /**
     * @var ClientManager
     */
    protected static $instance;

    /**
     * @var Container
     */
    protected $container;

    /**
     * @return ClientManager
     */
    public static function getInstance()
    {
        if (is_null(static::$instance)) {
            static::$instance = new static();
        }

        return static::$instance;
    }

    public function setContainer(Container $container)
    {
        $this->container = $container;

        return $this;
    }

    public function registerClientHandle($name, $client)
    {
        $this->container->bind($name, $client);
    }

    public function client($name = null)
    {
        if (is_null($name)) {
            $name = $this->defaultClient();
        }

        return $this->container->make($name);
    }

    public function defaultClient()
    {
        return 'guzzle';
    }

    /**
     * is triggered when invoking inaccessible methods in a static context.
     *
     * @param $name      string
     * @param $arguments array
     *
     * @return mixed
     * @link http://php.net/manual/en/language.oop5.overloading.php#language.oop5.overloading.methods
     */
    public static function __callStatic($name, $arguments)
    {
        $instance = static::getInstance();

        return call_user_func_array([$instance->client(), $name], $arguments);
    }


}