<?php
/**
 * Process.php
 *
 * Creator:    chongyi
 * Created at: 2016/09/08 15:35
 */

namespace OrzPicker\Core;


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

            call_user_func([$taskInstance, 'handle'], $poster);
        }
    }

    /**
     * @param $task
     *
     * @return mixed
     */
    protected function buildTaskInstance($task)
    {
        return $this->app->make($task);
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