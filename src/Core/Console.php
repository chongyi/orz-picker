<?php
/**
 * Console.php
 *
 * Creator:    chongyi
 * Created at: 2016/09/08 15:25
 */

namespace OrzPicker\Core;

use Symfony\Component\Console\Application as ConsoleApplication;
use Symfony\Component\Console\Input\ArgvInput;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\ConsoleOutput;
use Symfony\Component\Console\Output\OutputInterface;

class Console extends ConsoleApplication
{
    protected $coreApplication;

    /**
     * Console constructor.
     *
     * @param Application $application
     */
    public function __construct(Application $application)
    {
        parent::__construct($application->name(), $application->version());

        $this->coreApplication = $application;
    }

    /**
     * @return Application
     */
    public function core()
    {
        return $this->coreApplication;
    }

    /**
     * @param $commands
     *
     * @return self
     */
    public function resolveCommands($commands)
    {
        foreach ($commands as $command) {
            $this->add($this->core()->make($command));
        }

        return $this;
    }

    public function run(InputInterface $input = null, OutputInterface $output = null)
    {
        $input  = new ArgvInput();
        $output = new ConsoleOutput();

        $this->coreApplication->instance('input', $input);
        $this->coreApplication->instance('output', $output);
        $this->coreApplication->alias('input', InputInterface::class);
        $this->coreApplication->alias('output', OutputInterface::class);

        return parent::run($input, $output);
    }


}