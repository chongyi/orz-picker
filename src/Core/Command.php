<?php
/**
 * Command.php
 *
 * Creator:    chongyi
 * Created at: 2016/09/07 17:32
 */

namespace OrzPicker\Core;

use Symfony\Component\Console\Command\Command as SymfonyCommand;

class Command extends SymfonyCommand
{
    /**
     * @var Application
     */
    protected $core;

    /**
     * Command constructor.
     *
     * @param Application $core
     */
    public function __construct(Application $core)
    {
        parent::__construct();

        $this->core = $core;
    }

    /**
     * @return Application
     */
    public function core()
    {
        return $this->core;
    }
}