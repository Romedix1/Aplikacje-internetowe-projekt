<!DOCTYPE html>
<html lang="pl">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Logowanie - Biblioteka</title>
        <script src="https://cdn.tailwindcss.com"></script>
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
        </main>
    </body>
</html>