<?php

namespace Tests\Unit\Services\Applications;

use App\Services\Applications\Application;
use App\Services\Applications\Lc;
use App\Services\CompoundInterest;
use App\Services\Discounts\Iof;
use App\Services\Discounts\Ir;
use Tests\TestCase;

class LcTest extends TestCase
{
    public function testLcCalcWhenIofIsZero()
    {
        $compoundInterest = \Mockery::mock(CompoundInterest::class);
        $compoundInterest->shouldReceive('calculate')
            ->with(1000, 360, 0.1)
            ->andReturn(1100);

        $ir = \Mockery::mock(Ir::class);
        $ir->shouldReceive('calculate')
            ->with(1000, 1100, 360)
            ->andReturn(20);

        $iof = \Mockery::mock(Iof::class);
        $iof->shouldReceive('calculate')
            ->with(1000, 1100, 360)
            ->andReturn(0);

        $service = new Lc($compoundInterest, $ir, $iof);

        $this->assertInstanceOf(
            Application::class,
            $service->calculate(1000, 360, 0.1)
        );

        $this->assertEquals(1100, $service->grossAmount());
        $this->assertEquals(20, $service->discounts());
        $this->assertEquals(1080, $service->finalAmount());
    }

    public function testLcCalcWhenIofNotIsZero()
    {
        $compoundInterest = \Mockery::mock(CompoundInterest::class);
        $compoundInterest->shouldReceive('calculate')
            ->with(1000, 20, 0.1)
            ->andReturn(1100);

        $ir = \Mockery::mock(Ir::class);
        $ir->shouldReceive('calculate')
            ->with(1000, 1100, 20)
            ->andReturn(22.5);

        $iof = \Mockery::mock(Iof::class);
        $iof->shouldReceive('calculate')
            ->with(1000, 1100, 20)
            ->andReturn(33);

        $service = new Lc($compoundInterest, $ir, $iof);

        $this->assertInstanceOf(
            Application::class,
            $service->calculate(1000, 20, 0.1)
        );

        $this->assertEquals(1100, $service->grossAmount());
        $this->assertEquals(55.5, $service->discounts());
        $this->assertEquals(1044.5, $service->finalAmount());
    }

}
