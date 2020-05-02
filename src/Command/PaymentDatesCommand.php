<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use App\PaymentDatesCalculator;

class PaymentDatesCommand extends Command
{
    protected static $defaultName = 'payment-dates';

    protected function configure()
    {
        $this
        ->setDescription('Generate the CSV file containing the payment dates for the next X months (default 12).')
        ->addArgument('months', InputArgument::OPTIONAL, 'Number of months.');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        
        $months = $input->getArgument('months');
        if (is_null($months)) {
            $months = 12;
        }

        $calculator = new PaymentDatesCalculator($months);
        $csvOutput = $calculator->getCSV();
        $output->write($csvOutput);
        
        return 0;
    }
}
