<?php
/**
 * Client.php
 *
 * Creator:    chongyi
 * Created at: 2016/09/05 14:08
 */

namespace OrzPicker\Catcher;

use Closure;

/**
 * Interface Client
 *
 * @package OrzPicker\Catcher
 */
interface Client
{
    /**
     * @param $uri
     *
     * @return self
     */
    public function setBaseUri($uri);

    /**
     * @param Closure $generator
     *
     * @return self
     */
    public function setCatcherGenerator(Closure $generator);

    /**
     * @param Closure $callback
     *
     * @return self
     */
    public function success(Closure $callback);

    /**
     * @param Closure $callback
     *
     * @return self
     */
    public function fail(Closure $callback);

    /**
     * @param int $limit
     *
     * @return self
     */
    public function setConcurrency($limit);

    /**
     * @return void
     */
    public function send();
}