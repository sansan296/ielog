<?php

use App\Http\Controllers\MemoController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ItemController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RecipeController;
use App\Http\Controllers\PurchaseListController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    $today = \Carbon\Carbon::today();

    $expiredItems = \App\Models\Item::where('user_id', auth()->id())
        ->whereDate('expiration_date', '<', $today)
        ->get();

    $nearExpiredItems = \App\Models\Item::where('user_id', auth()->id())
        ->whereDate('expiration_date', '>=', $today)
        ->whereDate('expiration_date', '<=', $today->copy()->addWeek())
        ->get();

    return view('dashboard', compact('expiredItems', 'nearExpiredItems'));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/recipes', [RecipeController::class, 'index'])->name('recipes.index');


Route::middleware('auth')->group(function () {
    Route::get('items', [ItemController::class, 'index'])->name('items.index');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('items', ItemController::class);
    Route::resource('items.memos', MemoController::class);
});

Route::get('/items',[ItemController::class, 'index'])->name('items.index');

Route::get('/purchase-lists', [PurchaseListController::class, 'index'])->name('purchase_lists.index');
Route::post('/purchase-lists', [PurchaseListController::class, 'store'])->name('purchase_lists.store');
Route::delete('/purchase-lists/{purchaseList}', [PurchaseListController::class, 'destroy'])->name('purchase_lists.destroy');

require __DIR__.'/auth.php';
