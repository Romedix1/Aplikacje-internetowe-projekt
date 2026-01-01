<x-app-layout>
    <x-slot name="header">
        {{ $book->title }}
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="md:col-span-1">
                    <div class="bg-gray-800 border border-gray-700 shadow sm:rounded-lg p-6">
                        <div class="w-full h-64 bg-gray-700 rounded mb-6 flex items-center justify-center text-gray-500">Brak Okładki</div>

                        <h3 class="text-xl font-bold text-white mb-2">{{ $book->title }}</h3>
                        <p class="text-indigo-400 font-semibold mb-4">{{ $book->author->first_name }} {{ $book->author->last_name }}</p>

                        <div class="space-y-2 text-sm text-gray-300">
                            <p><span class="text-gray-500">Kategoria:</span> {{ $book->category->name }}</p>
                            <p><span class="text-gray-500">Wydawnictwo:</span> {{ $book->publisher->name }}</p>
                            <p><span class="text-gray-500">Rok wydania:</span> {{ $book->publication_year }}</p>
                            <p><span class="text-gray-500">ISBN:</span> {{ $book->isbn }}</p>
                        </div>
                    </div>
                </div>

                <div class="md:col-span-2 space-y-6">
                    <div class="bg-gray-800 border border-gray-700 shadow sm:rounded-lg p-6">
                        <h4 class="text-lg font-bold text-white mb-4">Opis</h4>
                        <p class="text-gray-300 leading-relaxed">{{ $book->description }}</p>
                    </div>

                    <div class="bg-gray-800 border border-gray-700 shadow sm:rounded-lg p-6">
                        <h4 class="text-lg font-bold text-white mb-4">Dostępne Egzemplarze</h4>

                        @if($book->copies->isEmpty())
                            <p class="text-yellow-500">Brak egzemplarzy w bibliotece.</p>
                        @else
                            <div class="overflow-x-auto">
                                <table class="min-w-full text-left text-sm text-gray-400">
                                    <thead class="bg-gray-700 text-gray-200 uppercase font-medium">
                                        <tr>
                                            <th class="px-4 py-3">Nr Inwentarzowy</th>
                                            <th class="px-4 py-3">Status</th>
                                            <th class="px-4 py-3">Akcja</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-700">
                                        @foreach($book->copies as $copy)
                                            <tr class="hover:bg-gray-750">
                                                <td class="px-4 py-3 font-mono text-white">{{ $copy->inventory_number }}</td>
                                                <td class="px-4 py-3">
                                                    @if($copy->status == 'available')
                                                        <span class="px-2 py-1 bg-green-900 text-green-200 rounded text-xs">Dostępna</span>
                                                    @elseif($copy->status == 'loaned')
                                                        <span class="px-2 py-1 bg-red-900 text-red-200 rounded text-xs">Wypożyczona</span>
                                                    @else
                                                        <span class="px-2 py-1 bg-gray-600 text-gray-300 rounded text-xs">{{ $copy->status }}</span>
                                                    @endif
                                                </td>
                                                <td class="px-4 py-3">
                                                    @if($copy->status == 'available')
                                                    <form method="POST" action="{{ route('loans.store') }}">
                                                            @csrf
                                                            <input type="hidden" name="book_copy_id" value="{{ $copy->id }}">
                                                            <button type="submit" class="bg-indigo-600 hover:bg-indigo-500 text-white font-bold py-2 px-4 rounded text-xs transition duration-200 shadow hover:shadow-lg">
                                                                Wypożycz
                                                            </button>
                                                        </form>
                                                    @else
                                                        <span class="text-gray-600 cursor-not-allowed">Niedostępna</span>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>