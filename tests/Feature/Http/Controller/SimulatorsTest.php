<?php

namespace Tests\Feature\Http\Controller;

use Tests\TestCase;

class SimulatorsTest extends TestCase
{
    public function testRawSuccessfullyRequest()
    {
        $response = $this->postJson(
            '/api/simulators/raw', [
                'initial_amount' => 1000,
                'days' => 720,
                'annual_interest' => 0.1
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

    public function testLciSuccessfullyRequest()
    {
        $response = $this->postJson(
            '/api/simulators/lci', [
                'initial_amount' => 1000,
                'days' => 360,
                'annual_interest' => 0.1
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
                'days' => 720,
            ]
        );

        $response->assertStatus(422);
    }

    public function testLcaSuccessfullyRequest()
    {
        $response = $this->postJson(
            '/api/simulators/lca', [
                'initial_amount' => 1000,
                'days' => 360,
                'annual_interest' => 0.2
            ]
        );

        $response->assertStatus(200);

        $response->assertJson([
            'gross_amount' => 1200,
            'discounts' => 0,
            'final_amount' => 1200,
        ]);
    }

    public function testLcaUnprocessableEntityRequest()
    {
        $response = $this->postJson(
            '/api/simulators/lca', [
                'initial_amount' => 1000,
                'days' => 720.1,
                'annual_interest' => 0.15
            ]
        );

        $response->assertStatus(422);
    }

    public function testCdbSuccessfullyRequest()
    {
        $response = $this->postJson(
            '/api/simulators/cdb', [
                'initial_amount' => 1000,
                'days' => 360,
                'annual_interest' => 0.1
            ]
        );

        $response->assertStatus(200);

        $response->assertJson([
            'gross_amount' => 1100,
            'discounts' => 17.5,
            'final_amount' => 1082.5,
        ]);
    }

    public function testCdbUnprocessableEntityRequest()
    {
        $response = $this->postJson(
            '/api/simulators/cdb', [
                'initial_amount' => 'not a number',
                'days' => 720,
                'annual_interest' => 0.15
            ]
        );

        $response->assertStatus(422);
    }

    public function testLcSuccessfullyRequest()
    {
        $response = $this->postJson(
            '/api/simulators/lc', [
                'initial_amount' => 1000,
                'days' => 360,
                'annual_interest' => 0.15
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
