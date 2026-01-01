<x-app-layout>
    <x-slot name="header">
        Panel Pracownika - Aktywne Wypożyczenia
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="bg-green-900/50 border border-green-600 text-green-200 px-4 py-3 rounded relative mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg border border-gray-700">
                <div class="p-6 text-gray-100">
                    @if($activeLoans->isEmpty())
                        <div class="text-center py-10 text-gray-400">
                            Wszystkie książki są w bibliotece. Brak aktywnych wypożyczeń.
                        </div>
                    @else
                        <div class="overflow-x-auto">
                            <table class="min-w-full text-left text-sm text-gray-400">
                                <thead class="bg-gray-900 text-gray-200 uppercase font-bold tracking-wider">
                                    <tr>
                                        <th class="px-6 py-3">Nr Inv.</th>
                                        <th class="px-6 py-3">Tytuł</th>
                                        <th class="px-6 py-3">Czytelnik (Email)</th>
                                        <th class="px-6 py-3">Termin</th>
                                        <th class="px-6 py-3 text-right">Akcja</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-700 bg-gray-800">
                                    @foreach($activeLoans as $loan)
                                        <tr class="hover:bg-gray-750 transition">
                                            <td class="px-6 py-4 font-mono text-white">
                                                {{ $loan->bookCopy->inventory_number }}
                                            </td>
                                            <td class="px-6 py-4 font-medium">
                                                {{ $loan->bookCopy->book->title }}
                                            </td>
                                            <td class="px-6 py-4">
                                                <div class="text-white">{{ $loan->user->name }}</div>
                                                <div class="text-xs text-gray-500">{{ $loan->user->email }}</div>
                                            </td>
                                            <td class="px-6 py-4">
                                                @if(\Carbon\Carbon::parse($loan->due_at)->isPast())
                                                    <span class="text-red-500 font-bold">{{ \Carbon\Carbon::parse($loan->due_at)->format('d.m.Y') }} (PO TERMINIE)</span>
                                                @else
                                                    <span class="text-green-400">{{ \Carbon\Carbon::parse($loan->due_at)->format('d.m.Y') }}</span>
                                                @endif
                                            </td>
                                            <td class="px-6 py-4 text-right">
                                                <form method="POST" action="{{ route('loans.return', $loan->id) }}" onsubmit="return confirm('Czy na pewno potwierdzasz zwrot tej książki?');">
                                                    @csrf
                                                    <button type="submit" class="bg-indigo-600 hover:bg-indigo-500 text-white font-bold py-1 px-3 rounded text-xs transition border border-indigo-700">
                                                        Zatwierdź Zwrot
                                                    </button>
                                                </form>
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