<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Campsite;

class CampsiteApiTest extends TestCase
{
    use RefreshDatabase; // テストDBを自動初期化

    /** @test */
    public function キャンプ場一覧API_空配列を返す()
    {
        $response = $this->getJson('/api/campsites');
        $response->assertStatus(200)
                 ->assertJson(['data' => []]);
    }

    /** @test */
    public function キャンプ場一覧API_データあり()
    {
        $campsite = Campsite::factory()->create(['name' => 'Test Campsite']);
        $response = $this->getJson('/api/campsites');
        $response->assertStatus(200)
                 ->assertJsonFragment(['name' => 'Test Campsite']);
    }

    /** @test */
    public function キャンプ場作成API()
    {
        $postData = [
            'name' => '新しいキャンプ場',
            'address' => 'テスト住所',
            'description' => '説明',
            'facilities' => 'トイレ、炊事場',
            'price' => 1500,
            'image_url' => 'http://example.com/camp.jpg',
            'latitude' => 35.0,
            'longitude' => 139.0,
        ];

        $response = $this->postJson('/api/campsites', $postData);
        $response->assertStatus(201)
                 ->assertJsonFragment(['name' => '新しいキャンプ場']);
        $this->assertDatabaseHas('campsites', ['name' => '新しいキャンプ場']);
    }
}

