<x-app-layout>
    <x-slot name="header">
        {{ __('Katalog Książek') }}
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($books as $book)
                    <article class="bg-gray-800 border border-gray-700 overflow-hidden shadow-lg sm:rounded-lg p-6 hover:bg-gray-750 transition duration-300">
                        <h3 class="text-xl font-bold text-white mb-2 tracking-wide">{{ $book->title }}</h3>
                        <p class="text-sm text-gray-400 mb-4">Autor: <span class="font-medium text-gray-200">{{ $book->author->first_name }} {{ $book->author->last_name }}</span></p>

                        <div class="flex justify-between items-center mt-6">
                            <span class="px-3 py-1 bg-blue-900/50 text-blue-200 text-xs font-semibold rounded-full border border-blue-800">
                                {{ $book->category->name }}
                            </span>
                            <a href="#" class="text-indigo-400 hover:text-indigo-300 font-bold text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 rounded px-2 transition">Szczegóły <span class="sr-only">książki {{ $book->title }}</span></a>
                        </div>
                    </article>
                @endforeach

            </div>

            <div class="mt-8 text-gray-400">
                {{ $books->links() }} 
            </div>
        </div>
    </div>
</x-app-layout>