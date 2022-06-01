<?php

namespace Tests\Unit\Services\Applications;

use App\Services\Applications\Application;
use App\Services\Applications\Raw;
use App\Services\CompoundInterest;
use Tests\TestCase;

class RawTest extends TestCase
{
    public function testRawCalc()
    {
        $compoundInterest = \Mockery::mock(CompoundInterest::class);
        $compoundInterest->shouldReceive('calculate')
            ->with(1000, 360, 0.1)
            ->andReturn(1100);

        $service = new Raw($compoundInterest);

        $this->assertInstanceOf(
            Application::class,
            $service->calculate(1000, 360, 0.1)
        );

        $this->assertEquals(1100, $service->grossAmount());
        $this->assertEquals(0, $service->discounts());
        $this->assertEquals(1100, $service->finalAmount());
    }
}
