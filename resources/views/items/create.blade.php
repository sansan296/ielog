<x-app-layout> 
  <x-slot name="header">
    <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
      {{ __('在庫追加') }}
    </h2>
  </x-slot>

  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900 dark:text-gray-100">

          {{--メッセージ（購入リストから遷移したときに表示） --}}
          @if (session('from_purchase'))
            <div class="mb-4 p-3 bg-blue-100 text-blue-800 rounded">
              購入リストから追加しています。内容を確認してください。
            </div>
          @endif

          <form method="POST" action="{{ route('items.store') }}">
            @csrf

            <!-- 商品名 -->
          <div class="mb-4">
            <label for="item" class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2">▼商品名</label>
            <input type="text" name="item" id="item" value="{{ old('item', $item ?? '') }}"
            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 dark:text-gray-300 dark:bg-gray-700 leading-tight focus:outline-none focus:shadow-outline">
              @error('item')
              <span class="text-red-500 text-xs italic">{{ $message }}</span>
             @enderror
          </div>

            <!-- 購入日 -->
          <div class="mb-4">
            <label for="purchase_date" class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2">▼購入日</label>
            <input type="date" name="purchase_date" id="purchase_date" value="{{ old('purchase_date', $purchase_date ?? '') }}"
              class="shadow appearance-none border rounded py-2 px-3 text-gray-700 dark:text-gray-300 dark:bg-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>

            <!-- 個数 -->
            <div class="mb-4">
              <label for="quantity" class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2">▼個数</label>
              <input type="number" name="quantity" id="quantity" value="{{ old('quantity', $quantity ?? 1) }}" min="1" required
              class="w-1/4 shadow appearance-none border rounded py-2 px-3 text-gray-700 dark:text-gray-300 dark:bg-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>


            <button 
              type="submit" 
              class="bg-[#4973B5] hover:bg-[#2C5BA5] text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
              追加する
            </button>
          </form>
        </div>
      </div>
    </div>
  </div>
</x-app-layout>
