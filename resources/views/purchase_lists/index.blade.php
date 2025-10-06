<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight text-center">
      購入するものリスト
    </h2>
  </x-slot>

  <div class="py-8 max-w-4xl mx-auto px-4">

    <!-- 登録フォーム -->
    <form method="POST" action="{{ route('purchase_lists.store') }}" class="mb-6 bg-white dark:bg-gray-800 p-4 rounded-lg shadow">
      @csrf
      <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-4">
        <input type="text" name="item" placeholder="商品名" required
               class="border rounded-lg px-3 py-2 w-full">
        <input type="number" name="quantity" placeholder="個数（任意）" min="1"
               class="border rounded-lg px-3 py-2 w-full">
        <input type="date" name="purchase_date"
               class="border rounded-lg px-3 py-2 w-full">
      </div>
      <div class="text-center">
        <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
          追加
        </button>
      </div>
    </form>

    <!-- リスト一覧 -->
    <div class="bg-white dark:bg-gray-800 p-4 rounded-lg shadow">
      @if($lists->isEmpty())
        <p class="text-center text-gray-500 dark:text-gray-400">購入予定のものはありません。</p>
      @else
        <table class="w-full text-center">
          <thead>
            <tr class="border-b">
              <th>商品名</th>
              <th>個数</th>
              <th>購入日</th>
              <th>操作</th>
            </tr>
          </thead>
          <tbody>
            @foreach($lists as $list)
              <tr class="border-b">
                <td class="py-2">{{ $list->item }}</td>
                <td>{{ $list->quantity ?? '-' }}</td>
                <td>{{ $list->purchase_date ? \Carbon\Carbon::parse($list->purchase_date)->format('Y年m月d日') : '-' }}</td>
                <td>
                  <div class="flex justify-center space-x-2">
                    <a href="{{ route('items.create', ['item' => $list->item, 'quantity' => $list->quantity]) }}"
                       class="px-3 py-1 bg-green-500 text-white rounded hover:bg-green-600">
                      在庫へ追加
                    </a>
                    <form method="POST" action="{{ route('purchase_lists.destroy', $list) }}">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="px-3 py-1 bg-red-500 text-white rounded hover:bg-red-600">
                        削除
                      </button>
                    </form>
                  </div>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      @endif
    </div>
  </div>
</x-app-layout>
