<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Carbon\Carbon;

class TestCase extends KernelTestCase
{
    protected function setUp(): void
    {
        $knownDate = Carbon::create(966, 04, 14);
        Carbon::setTestNow($knownDate);
    }

    protected function tearDown(): void
    {
        Carbon::setTestNow();
    }
}
