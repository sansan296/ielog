<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
      {{ __('詳細') }}
    </h2>
  </x-slot>

  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900 dark:text-gray-100">
          <a href="{{ route('items.index') }}" class="text-blue-500 hover:text-blue-700 mr-2">一覧に戻る</a>
          <p class="text-gray-800 dark:text-gray-300 text-lg">{{ $item->item }}</p>
          <p class="text-gray-600 dark:text-gray-400 text-sm">追加した人: {{ $item->user->name }}</p>
          <div class="text-gray-600 dark:text-gray-400 text-sm">
            <p>追加日時: {{ $item->created_at->format('Y-m-d H:i') }}</p>
            <p>最終更新: {{ $item->updated_at->format('Y-m-d H:i') }}</p>
          </div>
          @if (auth()->id() == $item->user_id)
          <div class="flex mt-4">
            <a href="{{ route('items.edit', $item) }}" class="text-blue-500 hover:text-blue-700 mr-2">編集</a>
            <form action="{{ route('items.destroy', $item) }}" method="POST" onsubmit="return confirm('削除しますか？');">
              @csrf
              @method('DELETE')
              <button type="submit" class="text-red-500 hover:text-red-700">削除</button>
            </form>
          </div>
          @endif
        </div>

        <div class="mt-4">
            <p class="text-gray-600 dark:text-gray-400 ml-4">Memo {{ $item->memos->count() }}</p>
            <a href="{{ route('items.memos.create', $item) }}" class="text-blue-500 hover:text-blue-700 mr-2">メモを追加</a>
          </div>
          
          <div class="mt-4">
            @foreach ($item->memos as $memo)
            <p>{{ $memo->memo }} <span class="text-gray-600 dark:text-gray-400 text-sm">{{ $memo->user->name }} {{ $memo->created_at->format('Y-m-d H:i') }}</span></p>
            @endforeach
          </div>

      </div>
    </div>
  </div>
</x-app-layout>