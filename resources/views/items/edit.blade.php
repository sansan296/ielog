<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-2xl text-gray-800 leading-tight text-center">
      {{ __('在庫編集') }}
    </h2>
  </x-slot>

  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900">
          <a href="{{ route('items.show', $item) }}" class="text-blue-500 hover:text-blue-700 mr-2">詳細に戻る</a>
          <form method="POST" action="{{ route('items.update', $item) }}">
            @csrf
            @method('PUT')
            <div class="mb-4">
              <label for="item" class="block text-gray-700 text-sm font-bold mb-2">▼商品名</label>
              <input type="text" name="item" id="item" value="{{ $item->item }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
              @error('item')
                <span class="text-red-500 text-xs italic">{{ $message }}</span>
              @enderror
            </div>
            <button type="submit" class="bg-[#4973B5] text-white rounded-lg hover:bg-[#2C5BA5] font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">変更</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</x-app-layout>