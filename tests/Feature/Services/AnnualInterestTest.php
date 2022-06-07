<?php

namespace Tests\Feature\Services;

use App\Models\SelicHistory;
use App\Services\Applications\AnnualInterest;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;
use Tests\TestCase;

class AnnualInterestTest extends TestCase
{
    use DatabaseMigrations;

    public function testRawBaseTax()
    {
        $service = new AnnualInterest();

        $this->assertEquals(
            12,
            $service->interest(12, 'raw')
        );
    }

    public function testSelicBaseTax()
    {
        SelicHistory::factory()->create([
            'announced_at' => '2022-04-01',
            'value' => 0.1
        ]);

        SelicHistory::factory()->create([
            'announced_at' => '2022-03-01',
            'value' => 0.08
        ]);

        $service = new AnnualInterest();

        $this->assertEquals(
            0.11,
            $service->interest(1.1, 'selic')
        );
    }

    public function testCdiBaseTax()
    {
        SelicHistory::factory()->create([
            'announced_at' => '2022-04-01',
            'value' => 0.1275
        ]);

        SelicHistory::factory()->create([
            'announced_at' => '2022-03-01',
            'value' => 0.08
        ]);

        $service = new AnnualInterest();

        $this->assertEquals(
            0.13915,
            $service->interest(1.1, 'cdi')
        );
    }

    public function testInvalidBaseTax()
    {
        SelicHistory::factory()->create([
            'announced_at' => '2022-04-01',
            'value' => 0.1275
        ]);

        $this->expectException(UnprocessableEntityHttpException::class);

        $service = new AnnualInterest();

        $service->interest(1.1, 'foo');
    }
}
