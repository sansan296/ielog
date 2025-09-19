<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
      {{ __('冷蔵庫') }}
    </h2>
  </x-slot>

  
    <div class="py-4 max-w-7xl mx-auto sm:px-6 lg:px-8">
      
    <form method="GET" action="{{ route('items.index') }}" class="mb-6">
      <input type="text" name="keyword" value="{{ request('keyword') }}"
             placeholder="商品名"
             class="border rounded-lg px-3 py-2 w-1/3">
      <button type="submit"
              class="ml-2 px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600">
        検索
      </button>
    </form>
    
      <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-xl text-gray-900 w-1/3 p-4 dark:text-gray-100">
          @foreach ($items as $item)
          <div class="mb-4 p-4 bg-red-50 dark:bg-gray-700 rounded-lg">
            <p class="text-gray-800 dark:text-gray-300">{{ $item->item }}</p>
            <p class="text-gray-600 dark:text-gray-400 text-sm">追加した人: {{ $item->user->name }}</p>
            <a href="{{ route('items.show', $item) }}" class="text-blue-500 hover:text-blue-700">詳細</a>
          </div>
          @endforeach
        </div>
      </div>
    </div>
  </div>

  <div class="mt-6">
  {{ $items->appends(request()->query())->links() }}
</div>

</x-app-layout>