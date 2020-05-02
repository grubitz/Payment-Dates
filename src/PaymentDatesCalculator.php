<?php

namespace App;

use Carbon\Carbon;

class PaymentDatesCalculator
{
    private $months;

    public function __construct(int $months = 12)
    {
        $this->months = $months;
    }

    public function getCSV(): PaymentDatesCSV
    {
        return new PaymentDatesCSV($this->getDates());
    }

    public function getDates(): array
    {
        $dateTime = new Carbon();
        $dates = [];

        for ($i=0; $i<$this->months; $i++) {
            $dateTime->addMonth();
            $payDay = new Carbon('last weekday ' . $dateTime->format('F Y'));

            $bonusDay = new Carbon($dateTime->format('Y-m-10'));
            if ($bonusDay->isWeekend()) {
                $bonusDay->modify('next Tuesday');
            }
            $dates[] = [$payDay, $bonusDay];
        }
        
        return $dates;
    }
}
