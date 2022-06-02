<?php

namespace Tests\Feature\Http\Controller;

use App\Models\SelicHistory;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class SelicHistoriesTest extends TestCase
{
    use DatabaseMigrations;

    public function testListsOnIndexRequest()
    {
        Sanctum::actingAs(
            User::factory()->create()
        );

        SelicHistory::factory(5)->create();

        $response = $this->getJson('/api/selic-histories/');
        $response->assertStatus(200);

        $content = $response->json();

        $this->assertArrayHasKey('data', $content);
        $this->assertCount(5, $content['data']);
    }

    public function testUnauthenticatedWhenTokenIsNotInformedOnIndexRequest()
    {
        $this->getJson('/api/selic-histories/')
            ->assertStatus(401);
    }

    public function testShowOnShowRequest()
    {
        Sanctum::actingAs(
            User::factory()->create()
        );

        $selicHistory = SelicHistory::factory()->create();

        $response = $this->getJson(
            '/api/selic-histories/'. $selicHistory->id
        );
        $response->assertStatus(200);

        $content = $response->json();

        $this->assertArrayHasKey('data', $content);
        $this->assertEquals(
            [
                'id' => $content['data']['id'],
                'announced_at' => $content['data']['announced_at'],
                'value' => $content['data']['value'],
            ],
            $content['data']
        );
    }

    public function testUnauthenticatedWhenTokenIsNotInformedOnShowRequest()
    {
        $selicHistory = SelicHistory::factory()->create();

        $this->getJson('/api/selic-histories/'. $selicHistory->id)
            ->assertStatus(401);
    }

    public function testSaveOnStoreRequest()
    {
        Sanctum::actingAs(
            User::factory()->create()
        );

        $response = $this->postJson(
            '/api/selic-histories/',
            $raw = SelicHistory::factory()->raw()
        );
        $response->assertStatus(201);

        $content = $response->json();

        $this->assertArrayHasKey('data', $content);
        $this->assertEquals(
            [
                'announced_at' => $raw['announced_at'] .'T00:00:00.000000Z',
                'value' => $raw['value'],
            ],
            [
                'announced_at' => $content['data']['announced_at'],
                'value' => $content['data']['value'],
            ]
        );
        $this->assertDatabaseHas(
            'selic_histories',
            [
                'announced_at' => $raw['announced_at'] .' 00:00:00',
                'value' => $raw['value'],
            ]
        );
    }

    public function testUnauthenticatedWhenTokenIsNotInformedOnStoreRequest()
    {
        $this->postJson(
            '/api/selic-histories/',
            SelicHistory::factory()->raw()
        )->assertStatus(401);
    }

    public function testUpdateOnUpdateRequest()
    {
        Sanctum::actingAs(
            User::factory()->create()
        );

        $selicHistory = SelicHistory::factory()->create();

        $response = $this->putJson(
            '/api/selic-histories/'. $selicHistory->id,
            $raw = SelicHistory::factory()->raw()
        );
        $response->assertStatus(200);

        $content = $response->json();

        $this->assertArrayHasKey('data', $content);
        $this->assertEquals(
            [
                'announced_at' => $raw['announced_at'] .'T00:00:00.000000Z',
                'value' => $raw['value'],
            ],
            [
                'announced_at' => $content['data']['announced_at'],
                'value' => $content['data']['value'],
            ]
        );
        $this->assertDatabaseHas(
            'selic_histories',
            [
                'id' => $selicHistory->id,
                'announced_at' => $raw['announced_at'] .' 00:00:00',
                'value' => $raw['value'],
            ]
        );
    }

    public function testUnauthenticatedWhenTokenIsNotInformedOnUpdateRequest()
    {
        $selicHistory = SelicHistory::factory()->create();

        $this->putJson(
            '/api/selic-histories/'. $selicHistory->id,
            SelicHistory::factory()->raw()
        )->assertStatus(401);
    }

    public function testDeleteOnDestroyRequest()
    {
        Sanctum::actingAs(
            User::factory()->create()
        );

        $selicHistory = SelicHistory::factory()->create();

        $this->deleteJson('/api/selic-histories/'. $selicHistory->id)
            ->assertStatus(204);

        $this->assertSoftDeleted(
            'selic_histories',
            [
                'id' => $selicHistory->id
            ]
        );
    }

    public function testUnauthenticatedWhenTokenIsNotInformedOnDestroyRequest()
    {
        $selicHistory = SelicHistory::factory()->create();

        $this->deleteJson('/api/selic-histories/'. $selicHistory->id)
            ->assertStatus(401);
    }
}
