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
        $items = Item::with('user')->latest()->get();

        $query = Item::query()->with('user');

        $items = Item::orderBy('expiration_date', 'asc')->get();

        // キーワードがあれば絞り込み
        if ($request->filled('keyword')) {
            $keyword = $request->input('keyword');
            $query->where('item', 'like', "%{$keyword}%");
        }

        $items = $query->paginate(10);

        return view('items.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('items.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $item = new Item();
        $item->item = $request->item;


        if($request->filled(['expiration_year', 'expiration_month', 'expiration_day',]))
        {
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


        $request->validate([
            'item' => 'required|max:255',
        ]);

        $request->user()->items()->create($request->only('item'));

        return redirect()->route('items.index');
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
        return view('items.edit', compact('item'));
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
