<?php

namespace Tests\Unit\Services\Applications;

use App\Models\SelicHistory;
use App\Services\Applications\AnnualInterest;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class AnnualInterestTest extends TestCase
{
    use DatabaseMigrations;

    public function testAnnualInterestInformedAndReturns()
    {
        $service = new AnnualInterest();

        $this->assertEquals(
            12,
            $service->interest(12)
        );
    }

    public function testAnnualInterestNotInformedAndCurrentSelicReturns()
    {
        SelicHistory::factory()->create([
            'announced_at' => '2022-04-01',
            'value' => 0.08
        ]);

        SelicHistory::factory()->create([
            'announced_at' => '2022-03-01',
            'value' => 0.1
        ]);

        $service = new AnnualInterest();

        $this->assertEquals(
            0.08,
            $service->interest()
        );
    }
}
