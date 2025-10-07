<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
public function index(Request $request) 
{
    $query = Item::query()->with('user');

    //キーワードがある場合
    if ($keyword = $request->input('keyword')) {
        $query->where('item', 'like', "%{$keyword}%");
    }

    //並び順（賞味期限が切れている順,近い順）
    $items = $query
        ->orderByRaw("CASE 
            WHEN expiration_date IS NULL THEN 3
            WHEN expiration_date < NOW() THEN 1
            WHEN expiration_date < NOW() + INTERVAL 7 DAY THEN 2
            ELSE 3 END")
        ->orderBy('expiration_date', 'asc')
        ->paginate(12);

    // 合計個数（現在ページの分ではなく全検索結果の合計）
    $totalQuantity = (clone $query)->sum('quantity');

    // Bladeに渡す
    return view('items.index', compact('items', 'totalQuantity'));
}



    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $item = $request->input('item');
        $quantity = $request->input('quantity', 1);
        $purchase_date = $request->input('purchase_date');

        return view('items.create', compact('item', 'quantity', 'purchase_date'));
    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) 
    {
    $validated = $request->validate([
        'item' => 'required|max:255',
        'quantity' => 'required|integer|min:1',
        'expiration_year' => 'nullable|integer',
        'expiration_month' => 'nullable|integer',
        'expiration_day' => 'nullable|integer',
    ]);

    $item = new Item();
    $item->item = $validated['item'];
    $item->quantity = $validated['quantity'] ?? 1; // 入力が無ければ1

    if ($request->filled(['expiration_year', 'expiration_month', 'expiration_day'])) {
        $item->expiration_date = Carbon::createFromDate(
            $request->expiration_year,
            $request->expiration_month,
            $request->expiration_day,
        );
    } else {
        $item->expiration_date = null;
    }

    $item->user_id = auth()->id();
    $item->save();

    return redirect()->route('items.index')->with('success', '在庫を追加しました');
    }



    /**
     * Display the specified resource.
     */
    public function show(Item $item)
    {
        $item->load('memos');
        return view('items.show', compact('item'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Item $item)
    {
        if (!empty($item->expiration_date)) {
            $expiration = [
                'year' => date('Y', strtotime($item->expiration_date)),
                'month' => date('m', strtotime($item->expiration_date)),
                'day' => date('d', strtotime($item->expiration_date)),
            ];
        } else {
            $expiration = ['year' => '', 'month' => '', 'day' => ''];
        }

        $quantity = $item->quantity ?? 0;

        return view('items.edit', compact('item', 'expiration', 'quantity'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Item $item)
    {
        $request->validate([
            'item' => 'required|max:255',
        ]);

        $item->update($request->only('item'));

        return redirect()->route('items.show', $item);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Item $item)
    {
        $item->delete();

        return redirect()->route('items.index');
    }
}
