<?php

namespace App\Tests;

use App\PaymentDatesCalculator;
use Carbon\Carbon;

class PaymentDatesCalculatorTest extends TestCase
{
    public function testGetDates()
    {
        $calculator = new PaymentDatesCalculator();
        $dates = $calculator->getDates();

        $expectedDates = [
            ['0966-04-30', '0966-05-13'],
            ['0966-05-30', '0966-06-10'],
            ['0966-06-30', '0966-07-10'],
            ['0966-07-31', '0966-08-12'],
            ['0966-08-29', '0966-09-10'],
            ['0966-09-30', '0966-10-10'],
            ['0966-10-31', '0966-11-10'],
            ['0966-11-28', '0966-12-10'],
            ['0966-12-31', '0967-01-13'],
            ['0967-01-30', '0967-02-10'],
            ['0967-02-27', '0967-03-10'],
            ['0967-03-31', '0967-04-10'],
        ];

        foreach ($expectedDates as $index => $expectedPair) {
            $this->assertEquals($expectedPair[0], $dates[$index][0]->format('Y-m-d'));
            $this->assertEquals($expectedPair[1], $dates[$index][1]->format('Y-m-d'));
        }
    }

    public function testGetCSV()
    {
        $calculator = new PaymentDatesCalculator();
        $csv = $calculator->getCSV();

        $this->assertSame("Month,Pay date,Bonus date\n", $csv->current());
        $csv->next();
        $this->assertSame("April,0966-04-30,0966-05-13\n", $csv->current());
    }
}
