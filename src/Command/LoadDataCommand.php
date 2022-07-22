<?php

namespace App\Command;

use App\Factory\AccountFactory;
use App\Factory\TeamFactory;
use Exception;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

/**
 *
 */
class LoadDataCommand extends Command
{
    protected static $defaultName = 'load-data';

    /**
     *
     */
    protected function configure(): void
    {
        $this
            ->setDescription('Generate test data')
            ->addOption('accounts', null, InputOption::VALUE_REQUIRED, 'Number of generated accounts')
            ->addOption('teams', null, InputOption::VALUE_REQUIRED, 'Number of generated teams');
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     *
     * @return int
     * @throws Exception
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $accounts = (int)$input->getOption('accounts');
        $teams = (int)$input->getOption('teams');
        $averageAccounts = ceil($accounts / $teams);
        $createdAccounts = 0;
        for ($number = 1; $number <= $teams; $number++) {
            $currentAccounts = ($number !== $teams) ? random_int(
                ceil($averageAccounts / 2),
                $averageAccounts
            ) : $accounts - $createdAccounts;
            $createdAccounts += $currentAccounts;
            TeamFactory::createOne(['accounts' => AccountFactory::new()->many($currentAccounts)]);
        }

        return self::SUCCESS;
    }
}
