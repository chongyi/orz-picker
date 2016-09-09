<?php
/**
 * Process.php
 *
 * Creator:    chongyi
 * Created at: 2016/09/08 15:35
 */

namespace OrzPicker\Core;

use Closure;

/**
 * Class Process
 *
 * @package OrzPicker\Core
 */
abstract class Process
{
    /**
     * @var array
     */
    protected $tasks = [];

    /**
     * @var Application
     */
    protected $app;

    /**
     * Process constructor.
     *
     * @param Application $app
     */
    public function __construct(Application $app)
    {
        $this->app = $app;
    }

    /**
     * Execute the process.
     */
    public function execute()
    {
        $poster = new Poster();

        foreach ($this->getTasks() as $task) {
            $taskInstance = $this->buildTaskInstance($task);

            call_user_func($taskInstance, $poster);
        }
    }

    /**
     * @param $task
     *
     * @return callable
     */
    protected function buildTaskInstance($task)
    {
        if ($task instanceof Closure) {
            return $task;
        }

        return [$this->app->make($task), 'handle'];
    }

    /**
     * @return array
     */
    final public function getTasks()
    {
        return array_merge($this->tasks, $this->tasks());
    }

    /**
     * @return array
     */
    abstract protected function tasks();
}