<!DOCTYPE html>
<html lang="pl">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Biblioteka</title>
        <script src="https://cdn.tailwindcss.com"></script>
    </head>
    <body class="bg-gray-900 text-gray-100 font-sans antialiased">
        <div class="min-h-screen">
            <nav class="bg-gray-800 border-b border-gray-700">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex justify-between h-16">
                        <div class="flex">
                            <div class="shrink-0 flex items-center">
                                <a href="{{ route('books.index') }}" class="font-bold text-xl text-indigo-400 hover:text-indigo-300 transition">Biblioteka</a>
                            </div>

                            <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                                <a href="{{ route('books.index') }}" class="inline-flex items-center px-1 pt-1 border-b-2 {{ request()->routeIs('books.index') ? 'border-indigo-500 text-white' : 'border-transparent text-gray-400 hover:text-gray-200 hover:border-gray-300' }} text-sm font-medium transition duration-150 ease-in-out">Katalog</a>

                                <a href="{{ route('loans.index') }}" class="inline-flex items-center px-1 pt-1 border-b-2 {{ request()->routeIs('loans.index') ? 'border-indigo-500 text-white' : 'border-transparent text-gray-400 hover:text-gray-200 hover:border-gray-300' }} text-sm font-medium transition duration-150 ease-in-out">Moje Książki</a>

                                @if(Auth::user()->role === 'admin' || Auth::user()->role === 'librarian')
                                    <a href="{{ route('staff.loans') }}" class="inline-flex items-center px-1 pt-1 border-b-2 {{ request()->routeIs('staff.loans') ? 'border-red-500 text-white' : 'border-transparent text-red-400 hover:text-red-200' }} text-sm font-bold transition duration-150 ease-in-out ml-4">Panel Pracownika</a>
                                @endif
                            </div>
                        </div>

                        <div class="flex items-center">
                            <div class="mr-4 text-sm text-gray-400">
                                Zalogowany: <span class="font-bold text-gray-200">{{ Auth::user()->name }}</span>
                            </div>

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="text-sm text-red-400 hover:text-red-300 underline transition">Wyloguj</button>
                            </form>
                        </div>
                    </div>
                </div>
            </nav>

            @if (isset($header))
                <header class="bg-gray-800 shadow border-b border-gray-700">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        <div class="text-white text-xl font-semibold">
                            {{ $header }}
                        </div>
                    </div>
                </header>
            @endif

            <main>
                {{ $slot }}
            </main>
        </div>

    </body>
</html>