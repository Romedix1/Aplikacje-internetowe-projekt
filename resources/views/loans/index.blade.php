<x-app-layout>
    <x-slot name="header">
        Moje Wypożyczenia
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg border border-gray-700">
                <div class="p-6 text-gray-100">
                    @if($loans->isEmpty())
                        <div class="text-center py-10">
                            <p class="text-gray-400 text-lg mb-4">Nie masz obecnie żadnych wypożyczonych książek</p>
                            <a href="{{ route('books.index') }}" class="inline-block bg-indigo-600 hover:bg-indigo-500 text-white font-bold py-2 px-4 rounded transition">Przejdź do katalogu</a>
                        </div>
                    @else
                        <div class="overflow-x-auto">
                            <table class="min-w-full text-left text-sm text-gray-400">
                                <thead class="bg-gray-900 text-gray-200 uppercase font-bold tracking-wider">
                                    <tr>
                                        <th class="px-6 py-3">Tytuł Książki</th>
                                        <th class="px-6 py-3">Nr Egzemplarza</th>
                                        <th class="px-6 py-3">Data Wypożyczenia</th>
                                        <th class="px-6 py-3">Termin Zwrotu</th>
                                        <th class="px-6 py-3">Status</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-700 bg-gray-800">
                                    @foreach($loans as $loan)
                                        <tr class="hover:bg-gray-750 transition">
                                            <td class="px-6 py-4 font-medium text-white">
                                                <a href="{{ route('books.show', $loan->bookCopy->book->id) }}" class="hover:underline hover:text-indigo-400">
                                                    {{ $loan->bookCopy->book->title }}
                                                </a>
                                            </td>
                                            <td class="px-6 py-4 font-mono">
                                                {{ $loan->bookCopy->inventory_number }}
                                            </td>
                                            <td class="px-6 py-4">
                                                {{ \Carbon\Carbon::parse($loan->loaned_at)->format('d.m.Y') }}
                                            </td>
                                            <td class="px-6 py-4 font-bold">
                                                @if(\Carbon\Carbon::parse($loan->due_at)->isPast())
                                                    <span class="text-red-500">
                                                        {{ \Carbon\Carbon::parse($loan->due_at)->format('d.m.Y') }} (Po terminie!)
                                                    </span>
                                                @else
                                                    <span class="text-green-400">
                                                        {{ \Carbon\Carbon::parse($loan->due_at)->format('d.m.Y') }}
                                                    </span>
                                                @endif
                                            </td>
                                            <td class="px-6 py-4">
                                                <span class="px-2 py-1 bg-blue-900/50 text-blue-200 rounded text-xs border border-blue-800">Wypożyczona</span>
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
</x-app-layout>