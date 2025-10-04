<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('通知') }}
        </h2>
    </x-slot>

    <div class="py-6 max-w-7xl mx-auto sm:px-6 lg:px-8">

        {{-- 期限切れ --}}
        <div class="mb-6">
            <h3 class="text-lg font-bold text-red-600 mb-2">賞味期限切れ</h3>
            @if($expiredItems->isEmpty())
                <p class="text-gray-500">期限切れの商品はありません。</p>
            @else
                <table class="w-full border">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="px-4 py-2">商品名</th>
                            <th class="px-4 py-2">賞味期限</th>
                            <th class="px-4 py-2">個数</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($expiredItems as $item)
                            <tr class="border-t">
                                <td class="px-4 py-2">{{ $item->item }}</td>
                                <td class="px-4 py-2 text-red-600">{{ $item->expiration_date }}</td>
                                <td class="px-4 py-2">{{ $item->quantity }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>

        {{-- 期限間近 --}}
        <div>
            <h3 class="text-lg font-bold text-yellow-600 mb-2">賞味期限が一週間以内</h3>
            @if($nearExpiredItems->isEmpty())
                <p class="text-gray-500">期限間近の商品はありません。</p>
            @else
                <table class="w-full border">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="px-4 py-2">商品名</th>
                            <th class="px-4 py-2">賞味期限</th>
                            <th class="px-4 py-2">個数</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($nearExpiredItems as $item)
                            <tr class="border-t">
                                <td class="px-4 py-2">{{ $item->item }}</td>
                                <td class="px-4 py-2 text-yellow-600">{{ $item->expiration_date }}</td>
                                <td class="px-4 py-2">{{ $item->quantity }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
</x-app-layout>
