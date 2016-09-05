<?php
/**
 * ClientManager.php
 *
 * Creator:    chongyi
 * Created at: 2016/09/05 14:06
 */

namespace OrzPicker\Catcher;

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
     * @return ClientManager
     */
    public static function getInstance()
    {
        if (is_null(static::$instance)) {
            static::$instance = new static();
        }

        return static::$instance;
    }
}