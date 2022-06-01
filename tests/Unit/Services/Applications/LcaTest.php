<?php

namespace Tests\Unit\Services\Applications;

use App\Services\Applications\Application;
use App\Services\Applications\Lca;
use App\Services\CompoundInterest;
use App\Services\Discounts\Iof;
use Tests\TestCase;

class LcaTest extends TestCase
{
    public function testLcaCalcWhenIofIsZero()
    {
        $compoundInterest = \Mockery::mock(CompoundInterest::class);
        $compoundInterest->shouldReceive('calculate')
            ->with(1000, 360, 0.1)
            ->andReturn(1100);

        $iof = \Mockery::mock(Iof::class);
        $iof->shouldReceive('calculate')
            ->with(1000, 1100, 360)
            ->andReturn(0);

        $service = new Lca($compoundInterest, $iof);

        $this->assertInstanceOf(
            Application::class,
            $service->calculate(1000, 360, 0.1)
        );

        $this->assertEquals(1100, $service->grossAmount());
        $this->assertEquals(0, $service->discounts());
        $this->assertEquals(1100, $service->finalAmount());
    }

    public function testLcaCalcWhenIofNotIsZero()
    {
        $compoundInterest = \Mockery::mock(CompoundInterest::class);
        $compoundInterest->shouldReceive('calculate')
            ->with(1000, 20, 0.1)
            ->andReturn(1100);

        $iof = \Mockery::mock(Iof::class);
        $iof->shouldReceive('calculate')
            ->with(1000, 1100, 20)
            ->andReturn(33);

        $service = new Lca($compoundInterest, $iof);

        $this->assertInstanceOf(
            Application::class,
            $service->calculate(1000, 20, 0.1)
        );

        $this->assertEquals(1100, $service->grossAmount());
        $this->assertEquals(33, $service->discounts());
        $this->assertEquals(1067, $service->finalAmount());
    }

}
