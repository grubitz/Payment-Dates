<?php

namespace App\Tests\Command;

use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Component\Console\Tester\CommandTester;
use App\Tests\TestCase;

class PaymentDatesCommandTest extends TestCase
{
    public function testExecute()
    {
        $kernel = static::createKernel();
        $application = new Application($kernel);

        $command = $application->find('payment-dates');
        $commandTester = new CommandTester($command);
        $commandTester->execute([]);

        $output = $commandTester->getDisplay();

        $expectedString = "Month,Pay date,Bonus date\n";
        $expectedString .= "April,0966-04-30,0966-05-13\n";
        $expectedString .= "May,0966-05-30,0966-06-10\n";
        $expectedString .= "June,0966-06-30,0966-07-10\n";
        $expectedString .= "July,0966-07-31,0966-08-12\n";
        $expectedString .= "August,0966-08-29,0966-09-10\n";
        $expectedString .= "September,0966-09-30,0966-10-10\n";
        $expectedString .= "October,0966-10-31,0966-11-10\n";
        $expectedString .= "November,0966-11-28,0966-12-10\n";
        $expectedString .= "December,0966-12-31,0967-01-13\n";
        $expectedString .= "January,0967-01-30,0967-02-10\n";
        $expectedString .= "February,0967-02-27,0967-03-10\n";
        $expectedString .= "March,0967-03-31,0967-04-10\n";
        
        $this->assertEquals($expectedString, $output);
    }
}
