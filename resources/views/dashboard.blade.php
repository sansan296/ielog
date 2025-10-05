<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('通知') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8 space-y-8">

            {{-- 期限切れ --}}
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-lg font-bold mb-4  text-red-600 dark:text-red-400">
                        賞味期限切れの商品
                    </h3>
                    @if($expiredItems->isEmpty())
                        <p class="text-gray-500 dark:text-gray-400">期限切れの商品はありません。</p>
                    @else
                        <table class="w-full border-collapse">
                            <thead>
                                <tr class="bg-gray-100 dark:bg-gray-700">
                                    <th class="px-4 py-2 text-center">商品名</th>
                                    <th class="px-4 py-2 text-center">賞味期限</th>
                                    <th class="px-4 py-2 text-center">個数</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($expiredItems as $item)
                                    <tr class="border-b border-gray-200 dark:border-gray-600">
                                   
                                        <td class="px-4 py-2 text-center text-red-500 dark:text-red-400">
                                            {{ $item->item }}
                                        </td>

        
                                        <td class="px-4 py-2 text-center text-red-500 dark:text-red-400">
                                            {{ $item->expiration_date }}
                                        </td>

        
                                    <td class="px-4 py-2 text-center text-red-500 dark:text-red-400">
                                            {{ $item->quantity }}
                                    </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    @endif
                </div>
            </div>

            {{-- 期限間近 --}}
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-lg font-bold mb-4  text-yellow-600 dark:text-yellow-400">
                        期限が1週間以内の商品
                    </h3>
                    @if($nearExpiredItems->isEmpty())
                        <p class="text-center text-gray-500 dark:text-gray-400">期限間近の商品はありません。</p>
                    @else
                        <table class="w-full border-collapse">
                            <thead>
                                <tr class="bg-gray-100 dark:bg-gray-700">
                                    <th class="px-4 py-2 text-center">商品名</th>
                                    <th class="px-4 py-2 text-center">賞味期限</th>
                                    <th class="px-4 py-2 text-center">個数</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($nearExpiredItems as $item)
                                    <tr class="border-b border-gray-200 dark:border-gray-600">
                                        <td class="px-4 py-2 text-center">{{ $item->item }}</td>
                                        <td class="px-4 py-2 text-center text-yellow-500 dark:text-yellow-300">
                                            {{ $item->expiration_date }}
                                        </td>
                                        <td class="px-4 py-2 text-center">{{ $item->quantity }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
