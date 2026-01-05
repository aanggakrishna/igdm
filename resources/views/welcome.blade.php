<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ingetin - Simple Automation</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
</head>
<body class="antialiased font-sans bg-gray-900 text-white min-h-screen flex flex-col items-center justify-center relative">
    
    <!-- Abstract Background -->
    <div class="absolute inset-0 bg-[url('https://laravel.com/assets/img/welcome/background.svg')] bg-cover bg-center opacity-20 z-0"></div>

    <div class="z-10 text-center max-w-xl mx-auto px-4">
        <!-- Logo/Header -->
        <h1 class="text-5xl font-bold mb-4 bg-clip-text text-transparent bg-gradient-to-r from-blue-400 to-purple-600">
            Ingetin App
        </h1>
        <p class="text-gray-400 text-lg mb-8">
            Manage your automations easily. Secure, Simple, and Reliable.
        </p>

        <!-- Auth Links -->
        <div class="flex flex-col sm:flex-row gap-4 justify-center mb-12">
            @if (Route::has('login'))
                @auth
                    <a href="{{ url('/dashboard') }}" class="px-6 py-3 bg-blue-600 hover:bg-blue-500 rounded-lg font-semibold transition shadow-lg shadow-blue-500/30">
                        Go to Dashboard
                    </a>
                @else
                    <a href="{{ route('login') }}" class="px-6 py-3 bg-white text-gray-900 hover:bg-gray-100 rounded-lg font-semibold transition">
                        Log in
                    </a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="px-6 py-3 border border-gray-600 hover:border-white rounded-lg font-semibold transition">
                            Register
                        </a>
                    @endif
                @endauth
            @endif
        </div>

        <!-- Footer / Legal -->
        <footer class="text-sm text-gray-500 mt-12 pt-8 border-t border-gray-800">
            <p>&copy; {{ date('Y') }} Ingetin App. All rights reserved.</p>
            <div class="mt-4 flex gap-6 justify-center">
                <a href="{{ route('privacy') }}" class="hover:text-white transition">Kebijakan Privasi</a>
                <a href="{{ route('terms') }}" class="hover:text-white transition">Syarat & Ketentuan</a>
            </div>
        </footer>
    </div>

</body>
</html>
