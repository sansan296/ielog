<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
      {{ __('在庫一覧') }}
    </h2>
  </x-slot>

  <div class="py-4 max-w-7xl mx-auto sm:px-6 lg:px-8">
    
    <!-- 検索フォーム -->
    <form method="GET" action="{{ route('items.index') }}" class="mb-6">
      <input type="text" name="keyword" value="{{ request('keyword') }}"
             placeholder="商品名"
             class="border rounded-lg px-3 py-2 w-1/3">
      <button type="submit"
              class="ml-2 px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600">
        検索
      </button>
    </form>

    <!-- 一覧 -->
    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
      
      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach ($items as $item)
          <div class="p-4 bg-red-50 dark:bg-gray-700 rounded-lg shadow">
            <p class="text-gray-800 dark:text-gray-300">{{ $item->item }}</p><p>
            <p class="text-gray-600 dark:text-gray-400 text-sm">登録者: {{ $item->user->name }}</p>
            
            <p class="text-gray-600 dark:text-gray-400 text-sm">
              賞味期限: 
              @if ($item->expiration_date)
                @if ($item->expiration_date->isPast())
                  <span class="text-red-500 font-bold">
                    {{ $item->expiration_date->format('Y年m月d日') }}（期限切れ）
                  </span>
                @else
                  {{ $item->expiration_date->format('Y年m月d日') }}
                  （あと {{ now()->diffInDays($item->expiration_date) }} 日）
                @endif
              @else
                なし
              @endif
            </p>
            
            <a href="{{ route('items.show', $item) }}" class="text-blue-500 hover:text-blue-700">詳細</a>
          </div>
        @endforeach
      </div>
    </div>
  </div>

  <div class="mt-6">
    {{ $items->appends(request()->query())->links() }}
  </div>
</x-app-layout>
