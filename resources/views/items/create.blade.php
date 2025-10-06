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
          <form method="POST" action="{{ route('items.store') }}">
            @csrf

            <!-- 商品名 -->
            <div class="mb-4">
              <label for="item" class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2">▼商品名</label>
              <input type="text" name="item" id="item" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 dark:text-gray-300 dark:bg-gray-700 leading-tight focus:outline-none focus:shadow-outline">
              @error('item')
              <span class="text-red-500 text-xs italic">{{ $message }}</span>
              @enderror
            </div>

            <!-- 賞味期限 -->
            <div class="mb-4">
              <label for="expiration date" class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2">▼賞味期限</label>
              <div class="flex apace-x-2">
                <input type="number" name="expiration_year" placeholder="年" min="2025" max="2100"
                 class="w-1/4 shadow appearance-none border rounded py-2 px-3 text-gray-700 dark:text-gray-300 dark:bg-gray-700 leading-tight focus:outline-none foucus:shadow-outline">

                 <input type="number" name="expiration_month" placeholder="月" min="1" max="12"
                 class="w-1/4 shadow appearance-none border rounded py-2 px-3 text-gray-700 dark:text-gray-300 dark:bg-gray-700 leading-tight focus:outline-none foucus:shadow-outline">

                 <input type="number" name="expiration_day" placeholder="日" min="1" max="31"
                 class="w-1/4 shadow appearance-none border rounded py-2 px-3 text-gray-700 dark:text-gray-300 dark:bg-gray-700 leading-tight focus:outline-none foucus:shadow-outline">
            </div>

            @error('expiration_year')
              <span class="text-red-500 text-xs italic">{{ $message }}</span>
            @enderror

            @error('expiration_month')
              <span class="text-red-500 text-xs italic">{{ $message }}</span>
            @enderror

            @error('expiration_day')
              <span class="text-red-500 text-xs italic">{{ $message }}</span>
            @enderror
            </div>


            <div class="mb-4">
              <label for="quantity" class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2">▼個数</label>
                <input type="number" name="quantity" id="quantity" value="1" min="1" required
                 class="w-1/4 shadow appearance-none border rounded py-2 px-3 text-gray-700 dark:text-gray-300 dark:bg-gray-700 leading-tight focus:outline-none foucus:shadow-outline">
            </div>


            <button type="submit" class="bg-[#4973B5] hover:bg-[#2C5BA5] text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">追加する</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</x-app-layout>