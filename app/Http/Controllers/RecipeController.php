<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Item;

class RecipeController extends Controller
{
    public function index()
    {
        // 在庫テーブルから食材名を取得
        $ingredients = Item::pluck('item')->implode(',');

        if (empty($ingredients)) {
            return view('recipes.index', ['recipes' => [], 'message' => '在庫がありません。']);
        }

        // Spoonacular APIへリクエスト
        $response = Http::get('https://api.spoonacular.com/recipes/findByIngredients', [
            'ingredients' => $ingredients,
            'number' => 5, // 表示するレシピ数
            'ranking' => 2, // 使用食材の一致度順
            'apiKey' => env('SPOONACULAR_API_KEY'),
        ]);

        // エラーハンドリング
        if ($response->failed()) {
            return view('recipes.index', [
                'recipes' => [],
                'message' => 'レシピを取得できませんでした。',
            ]);
        }

        $recipes = $response->json();

        return view('recipes.index', compact('recipes'));
    }
}
