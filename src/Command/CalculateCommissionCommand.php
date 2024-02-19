<?php

declare(strict_types=1);

namespace App\Command;

use App\Service\CommissionCalculator\CommissionCalculatorInterface;
use App\Service\CommissionCalculator\Transaction;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(name: 'app:calculate-commission', description: 'Calculates commission for already made transactions.')]
class CalculateCommissionCommand extends Command
{
    public function __construct(private CommissionCalculatorInterface $commissionCalculator)
    {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this->addArgument('filepath', InputArgument::REQUIRED, 'Path to the csv file with transactions');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $handle = fopen($input->getArgument('filepath'), 'rb');
        if (!$handle) {
            $output->writeln('<error>Invalid file path provided</error>');

            return self::FAILURE;
        }

        while (($line = fgets($handle)) !== false) {
            $transactionData = json_decode($line, true, 512, JSON_THROW_ON_ERROR);
            $transaction = new Transaction(
                $transactionData['bin'],
                $transactionData['amount'],
                $transactionData['currency']
            );

            $commission = $this->commissionCalculator->calculate($transaction);

            $output->writeln($commission);
        }

        return self::SUCCESS;
        //        foreach (explode("\n", file_get_contents($input->getArgument('filepath'))) as $row) {
        //            if (empty($row)) {
        //                break;
        //            }
        //            $p = explode(",", $row);
        //            $p2 = explode(':', $p[0]);
        //            $value[0] = trim($p2[1], '"');
        //            $p2 = explode(':', $p[1]);
        //            $value[1] = trim($p2[1], '"');
        //            $p2 = explode(':', $p[2]);
        //            $value[2] = trim($p2[1], '"}');
        // var_dump($value);exit();
        //            $binResults = file_get_contents('https://data.handyapi.com/bin/' . $value[0]);
        //            var_dump($binResults);
        //            if (!$binResults) {
        //                die('error!');
        //            }
        //            $r = json_decode($binResults);
        //            $isEu = $this->isEu($r->Country->A2);
        //
        //            $file_get_contents = file_get_contents('http://api.exchangeratesapi.io/latest?access_key=41a60f0624cb617b167f31f1a937e73b');
        //            var_dump($file_get_contents);
        //            $rate = json_decode($file_get_contents, true)['rates'][$value[2]];
        //            if ($value[2] == 'EUR' or $rate == 0) {
        //                $amntFixed = $value[1];
        //            }
        //            if ($value[2] != 'EUR' or $rate > 0) {
        //                $amntFixed = $value[1] / $rate;
        //            }
        //
        //            echo $amntFixed * ($isEu == 'yes' ? 0.01 : 0.02);
        //            print "\n";
        //        }
    }
}
