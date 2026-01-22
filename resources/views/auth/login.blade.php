<!DOCTYPE html>
<html lang="pl">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Logowanie - Biblioteka</title>
        <script src="https://cdn.tailwindcss.com"></script>
        <style>
            html.font-size-medium { font-size: 115% !important; }
            html.font-size-large { font-size: 130% !important; }

            .wcag-contrast,
            .wcag-contrast body,
            .wcag-contrast main,
            .wcag-contrast div:not(.fixed) {
                background-color: #000000 !important;
                color: #FFFF00 !important;
                border-color: #FFFF00 !important;
            }

            .wcag-contrast h1,
            .wcag-contrast label,
            .wcag-contrast p,
            .wcag-contrast li {
                color: #FFFF00 !important;
            }

            .wcag-contrast input {
                background-color: #000000 !important;
                color: #FFFF00 !important;
                border: 2px solid #FFFF00 !important;
            }

            .wcag-contrast button:not([onclick]) {
                background-color: #FFFF00 !important;
                color: #000000 !important;
                border: 2px solid #FFFF00 !important;
                font-weight: bold !important;
            }

            .wcag-contrast .bg-red-900\/50 {
                background-color: #000000 !important;
                border: 2px solid #FFFF00 !important;
            }
        </style>
    </head>
    <body class="bg-gray-900 flex items-center justify-center min-h-screen text-gray-100">
        <main class="w-full max-w-md bg-gray-800 p-8 rounded-lg shadow-xl border border-gray-700">
            <h1 class="text-2xl font-bold text-center mb-6 text-white">Zaloguj się do Biblioteki</h1>

            @if ($errors->any())
                <div class="mb-4 p-4 bg-red-900/50 text-red-200 rounded border border-red-800" role="alert">
                    <ul class="list-disc pl-5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="mb-4">
                    <label for="email" class="block text-gray-300 text-sm font-bold mb-2">Adres Email</label>
                    <input type="email" name="email" id="email" value="{{ old('email') }}" required autofocus class="shadow appearance-none border border-gray-600 rounded w-full py-2 px-3 bg-gray-700 text-white leading-tight focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent placeholder-gray-400">
                </div>

                <div class="mb-6">
                    <label for="password" class="block text-gray-300 text-sm font-bold mb-2">Hasło</label>
                    <input type="password" name="password" id="password" required class="shadow appearance-none border border-gray-600 rounded w-full py-2 px-3 bg-gray-700 text-white mb-3 leading-tight focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                </div>

                <div class="flex items-center justify-between mt-8">
                    <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-500 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline transition duration-200">Zaloguj się</button>
                </div>
            </form>

            <p class="mt-6 text-center text-xs text-gray-500">Dane testowe admina: admin@biblioteka.pl / haslo123</p>
            <p class="mt-6 text-center text-xs text-gray-500">Dane testowe użytkownika: user@biblioteka.pl / haslo123</p>
        </main>

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