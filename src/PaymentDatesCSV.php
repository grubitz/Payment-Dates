<?php

namespace App;

use Iterator;

class PaymentDatesCSV implements Iterator
{
    private $array;
    private $position = 0;

    public function __construct(array $array)
    {
        $this->array = $array;
    }

    public function rewind()
    {
        $this->position = 0;
    }

    public function current()
    {
        if ($this->position === 0) {
            $rowData = ['Month', 'Pay date', 'Bonus date'];
        } else {
            $rowData = $this->formatRow($this->array[$this->position-1]);
        }
        
        return implode(',', $rowData) . "\n";
    }

    public function key()
    {
        return $this->position;
    }

    public function next()
    {
        ++$this->position;
    }

    public function valid()
    {
        return $this->position == 0 || isset($this->array[$this->position-1]);
    }

    private function formatRow(array $row): array
    {
        return [$row[0]->format('F'), $row[0]->format('Y-m-d'), $row[1]->format('Y-m-d')];
    }
}
