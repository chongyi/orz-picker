<?php
/**
 * Task.php
 *
 * Creator:    chongyi
 * Created at: 2016/09/08 15:56
 */

namespace OrzPicker\Core;


/**
 * Interface Task
 *
 * @package OrzPicker\Core
 */
interface Task
{
    /**
     * @param Poster $poster
     *
     * @return void
     */
    public function handle(Poster $poster);
}