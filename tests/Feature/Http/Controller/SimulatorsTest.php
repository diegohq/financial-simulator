<?php

namespace Tests\Feature\Http\Controller;

use App\Models\SelicHistory;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class SimulatorsTest extends TestCase
{
    use DatabaseMigrations;

    public function testRawSuccessfullyRequestUsingRawBaseTax()
    {
        $response = $this->postJson(
            '/api/simulators/raw', [
                'initial_amount' => 1000,
                'days' => 720,
                'annual_interest' => 0.1,
                'base_tax' => 'raw'
            ]
        );

        $response->assertStatus(200);

        $response->assertJson([
            'gross_amount' => 1210,
            'discounts' => 0,
            'final_amount' => 1210,
        ]);
    }

    public function testRawSuccessfullyRequestUsingSelic()
    {
        SelicHistory::factory()->create(['value' => 0.1]);

        $response = $this->postJson(
            '/api/simulators/raw', [
                'initial_amount' => 1000,
                'days' => 720,
                'annual_interest' => 1,
                'base_tax' => 'selic'
            ]
        );

        $response->assertStatus(200);

        $response->assertJson([
            'gross_amount' => 1210,
            'discounts' => 0,
            'final_amount' => 1210,
        ]);
    }

    public function testRawUnprocessableEntityRequest()
    {
        $response = $this->postJson(
            '/api/simulators/raw', [
                'initial_amount' => 1000,
                'days' => 720,
                'annual_interest' => 'not number'
            ]
        );

        $response->assertStatus(422);
    }

    public function testLciSuccessfullyRequestUsingRawBaseTax()
    {
        $response = $this->postJson(
            '/api/simulators/lci', [
                'initial_amount' => 1000,
                'days' => 360,
                'annual_interest' => 0.1,
                'base_tax' => 'raw'
            ]
        );

        $response->assertStatus(200);

        $response->assertJson([
            'gross_amount' => 1100,
            'discounts' => 0,
            'final_amount' => 1100,
        ]);
    }

    public function testLciSuccessfullyRequestUsingCdi()
    {
        SelicHistory::factory()->create(['value' => 0.101]);

        $response = $this->postJson(
            '/api/simulators/lci', [
                'initial_amount' => 1000,
                'days' => 360,
                'annual_interest' => 1,
                'base_tax' => 'cdi'
            ]
        );

        $response->assertStatus(200);

        $response->assertJson([
            'gross_amount' => 1100,
            'discounts' => 0,
            'final_amount' => 1100,
        ]);
    }

    public function testLciUnprocessableEntityRequest()
    {
        $response = $this->postJson(
            '/api/simulators/lci', [
                'initial_amount' => 1000,
                'days' => 360,
                'base_tax' => 'raw'
            ]
        );

        $response->assertStatus(422);
    }

    public function testLcaSuccessfullyRequestUsingRawBaseTax()
    {
        $response = $this->postJson(
            '/api/simulators/lca', [
                'initial_amount' => 1000,
                'days' => 360,
                'annual_interest' => 0.2,
                'base_tax' => 'raw'
            ]
        );

        $response->assertStatus(200);

        $response->assertJson([
            'gross_amount' => 1200,
            'discounts' => 0,
            'final_amount' => 1200,
        ]);
    }

    public function testLcaSuccessfullyRequestUsingSelic()
    {
        SelicHistory::factory()->create(['value' => 0.2]);

        $response = $this->postJson(
            '/api/simulators/lca', [
                'initial_amount' => 1000,
                'days' => 360,
                'annual_interest' => 0.9,
                'base_tax' => 'selic'
            ]
        );

        $response->assertStatus(200);

        $response->assertJson([
            'gross_amount' => 1180,
            'discounts' => 0,
            'final_amount' => 1180,
        ]);
    }

    public function testLcaUnprocessableEntityRequest()
    {
        $response = $this->postJson(
            '/api/simulators/lca', [
                'initial_amount' => 1000,
                'days' => 720,
                'annual_interest' => 0.15,
                'base_tax' => 'foo'
            ]
        );

        $response->assertStatus(422);
    }

    public function testCdbSuccessfullyRequestUsingRawBaseTax()
    {
        $response = $this->postJson(
            '/api/simulators/cdb', [
                'initial_amount' => 1000,
                'days' => 360,
                'annual_interest' => 0.1,
                'base_tax' => 'raw'
            ]
        );

        $response->assertStatus(200);

        $response->assertJson([
            'gross_amount' => 1100,
            'discounts' => 17.5,
            'final_amount' => 1082.5,
        ]);
    }

    public function testCdbSuccessfullyRequestUsingCdi()
    {
        SelicHistory::factory()->create(['value' => 0.101]);

        $response = $this->postJson(
            '/api/simulators/cdb', [
                'initial_amount' => 1000,
                'days' => 360,
                'annual_interest' => 1.1,
                'base_tax' => 'cdi'
            ]
        );

        $response->assertStatus(200);

        $response->assertJson([
            'gross_amount' => 1110,
            'discounts' => 19.25,
            'final_amount' => 1090.75,
        ]);
    }

    public function testCdbUnprocessableEntityRequest()
    {
        $response = $this->postJson(
            '/api/simulators/cdb', [
                'initial_amount' => 'not a number',
                'days' => 720,
                'annual_interest' => 0.15,
                'base_tax' => 'raw'
            ]
        );

        $response->assertStatus(422);
    }

    public function testLcSuccessfullyRequestUsingRawBaseTax()
    {
        $response = $this->postJson(
            '/api/simulators/lc', [
                'initial_amount' => 1000,
                'days' => 360,
                'annual_interest' => 0.15,
                'base_tax' => 'raw'
            ]
        );

        $response->assertStatus(200);

        $response->assertJson([
            'gross_amount' => 1150,
            'discounts' => 26.25,
            'final_amount' => 1123.75,
        ]);
    }

    public function testLcSuccessfullyRequestUsingSelic()
    {
        SelicHistory::factory()->create(['value' => 0.15]);

        $response = $this->postJson(
            '/api/simulators/lc', [
                'initial_amount' => 1000,
                'days' => 360,
                'annual_interest' => 1,
                'base_tax' => 'selic'
            ]
        );

        $response->assertStatus(200);

        $response->assertJson([
            'gross_amount' => 1150,
            'discounts' => 26.25,
            'final_amount' => 1123.75,
        ]);
    }

    public function testLcUnprocessableEntityRequest()
    {
        $response = $this->postJson(
            '/api/simulators/lc', [
                'days' => 720,
                'annual_interest' => 0.15
            ]
        );

        $response->assertStatus(422);
    }

}
