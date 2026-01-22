<!DOCTYPE html>
<html lang="pl">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Biblioteka</title>
        <script src="https://cdn.tailwindcss.com"></script>
        <style>
            html.font-size-medium { font-size: 115% !important; }
            html.font-size-large { font-size: 130% !important; }

            .wcag-contrast, .wcag-contrast body, .wcag-contrast div:not(.fixed), .wcag-contrast nav, .wcag-contrast header, .wcag-contrast main {
                background-color: #000000 !important;
                color: #FFFF00 !important;
                border-color: #FFFF00 !important;
            }

            .wcag-contrast a {
                color: #00FFFF !important;
                text-decoration: underline !important;
            }

            .wcag-contrast span, .wcag-contrast label {
                color: #FFFF00 !important;
            }

            .wcag-contrast button:not([onclick]) {
                background-color: #FFFF00 !important;
                color: #000000 !important;
                border: 2px solid #FFFF00 !important;
            }

            .fixed.bottom-5 { border: 2px solid #374151; }
        </style>
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

        <div class="fixed bottom-5 right-5 z-50 flex flex-col gap-2 p-2 bg-white dark:bg-gray-800 rounded-lg shadow-lg border border-gray-200 dark:border-gray-700">
            <button onclick="toggleContrast()" class="p-2 bg-gray-200 dark:bg-gray-700 hover:bg-gray-300 text-gray-900 dark:text-gray-100 rounded text-sm font-bold border border-gray-400" title="Wysoki Kontrast">
                Kontrast
            </button>

            <div class="flex gap-1">
                <button onclick="changeFontSize('normal')" class="flex-1 p-2 bg-gray-200 dark:bg-gray-700 hover:bg-gray-300 text-gray-900 dark:text-gray-100 rounded text-xs font-bold border border-gray-400" title="Normalna czcionka">A</button>
                <button onclick="changeFontSize('medium')" class="flex-1 p-2 bg-gray-200 dark:bg-gray-700 hover:bg-gray-300 text-gray-900 dark:text-gray-100 rounded text-sm font-bold border border-gray-400" title="Średnia czcionka">A+</button>
                <button onclick="changeFontSize('large')" class="flex-1 p-2 bg-gray-200 dark:bg-gray-700 hover:bg-gray-300 text-gray-900 dark:text-gray-100 rounded text-lg font-bold border border-gray-400" title="Duża czcionka">A++</button>
            </div>
        </div>

        <script>
            function toggleContrast() {
                const html = document.documentElement;
                html.classList.toggle('wcag-contrast');
                if (html.classList.contains('wcag-contrast')) {
                    localStorage.setItem('contrast', 'high');
                } else {
                    localStorage.removeItem('contrast');
                }
            }

            function changeFontSize(size) {
                const html = document.documentElement;
                html.classList.remove('font-size-medium', 'font-size-large');
                if (size === 'medium') {
                    html.classList.add('font-size-medium');
                    localStorage.setItem('fontSize', 'medium');
                } else if (size === 'large') {
                    html.classList.add('font-size-large');
                    localStorage.setItem('fontSize', 'large');
                } else {
                    localStorage.removeItem('fontSize');
                }
            }

            (function() {
                if (localStorage.getItem('contrast') === 'high') document.documentElement.classList.add('wcag-contrast');
                const savedSize = localStorage.getItem('fontSize');
                if (savedSize) document.documentElement.classList.add('font-size-' + savedSize);
            })();
        </script>

    </body>
</html>