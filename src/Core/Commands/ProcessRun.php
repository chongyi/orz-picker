<?php
/**
 * ProcessRun.php
 *
 * Creator:    chongyi
 * Created at: 2016/09/07 17:20
 */

namespace OrzPicker\Core\Commands;


use OrzPicker\Core\Command;
use OrzPicker\Core\Process;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ProcessRun extends Command
{
    /**
     * Configures the current command.
     */
    protected function configure()
    {
        $this->setName('process:run')
             ->setDescription('Run the process, and execute tasks which is the process included.')
             ->addArgument('process', InputArgument::REQUIRED, "The catcher process's class full-name.");
    }

    /**
     * Executes the current command.
     *
     * @param InputInterface  $input  An InputInterface instance
     * @param OutputInterface $output An OutputInterface instance
     *
     * @return null|int null or 0 if everything went fine, or an error code
     *
     * @see setCode()
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $className = $input->getArgument('process');

        $process = new $className($this->core());
        $process->execute();

        return null;
    }


}