<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Item;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ItemSearchTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function 検索キーワードに一致するアイテムを表示()
    {
        $user = User::factory()->create();

        $apple = Item::factory()->create([
            'item' => '牛肉',
            'user_id' => $user->id,
        ]);
        $banana = Item::factory()->create([
            'item' => 'パイナップル',
            'user_id' => $user->id,
        ]);

        // 「牛肉」で検索
        $response = $this->get('/items?keyword=牛肉');

        $response->assertStatus(200);
        $response->assertSee('牛肉');
        $response->assertDontSee('パイナップル');
    }

    /** @test */
    public function 検索キーワードが空なら全件表示()
    {
        $user = User::factory()->create();

        $apple = Item::factory()->create(['item' => '牛肉', 'user_id' => $user->id]);
        $banana = Item::factory()->create(['item' => 'パイナップル', 'user_id' => $user->id]);

        // 検索なし
        $response = $this->get('/items');

        $response->assertStatus(200);
        $response->assertSee('牛肉');
        $response->assertSee('パイナップル');
    }
}
