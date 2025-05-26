<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>TaskNova</title>

    <!-- Fonts -->
    <link href="https://fonts.bunny.net/css?family=figtree:400,600,700&display=swap" rel="stylesheet" />

    <!-- Styles / Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

   <style>
    body {
        background: 
            linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)), 
            url('https://images.unsplash.com/photo-1504384308090-c894fdcc538d?auto=format&fit=crop&w=1400&q=80') 
            no-repeat center center fixed;
        background-size: cover;
        background-blend-mode: darken;
    }

    .glass {
        background-color: rgba(255, 255, 255, 0.15);
        backdrop-filter: blur(10px);
        -webkit-backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.2);
    }

    .dark .glass {
        background-color: rgba(30, 30, 30, 0.3);
        border-color: rgba(255, 255, 255, 0.1);
    }
</style>


    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const themeToggle = document.getElementById('theme-toggle');
            const html = document.documentElement;
            const storedTheme = localStorage.getItem('theme');

            if (storedTheme) {
                html.classList.toggle('dark', storedTheme === 'dark');
            }

            themeToggle?.addEventListener('click', () => {
                const isDark = html.classList.toggle('dark');
                localStorage.setItem('theme', isDark ? 'dark' : 'light');
            });
        });
    </script>
</head>
<body class="font-sans antialiased text-gray-800 dark:text-gray-200 transition-colors duration-300">

    <div class="min-h-screen flex flex-col px-4 py-6 bg-black/40">
        <!-- Header -->
        <header class="w-full max-w-6xl mx-auto flex items-center justify-between mb-10 text-white">
            <h1 class="text-3xl font-bold">
                Welcome to <span class="text-red-500">TaskNova</span>
            </h1>
            <div class="flex items-center gap-4">
                <!-- Theme Toggle -->
                <button id="theme-toggle" class="p-2 rounded-full border border-gray-300 dark:border-gray-600 hover:bg-gray-200 dark:hover:bg-gray-700 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white dark:text-gray-300" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M10 2a.75.75 0 01.75.75v.5a.75.75 0 01-1.5 0v-.5A.75.75 0 0110 2zM4.22 4.22a.75.75 0 011.06 0l.354.354a.75.75 0 11-1.06 1.06l-.354-.354a.75.75 0 010-1.06zM2 10a.75.75 0 01.75-.75h.5a.75.75 0 010 1.5h-.5A.75.75 0 012 10zm2.22 5.78a.75.75 0 011.06-1.06l.354.354a.75.75 0 11-1.06 1.06l-.354-.354zM10 17.25a.75.75 0 01.75.75v.5a.75.75 0 01-1.5 0v-.5a.75.75 0 01.75-.75zm5.78-1.47a.75.75 0 10-1.06-1.06l-.354.354a.75.75 0 001.06 1.06l.354-.354zM17.25 10a.75.75 0 00-.75-.75h-.5a.75.75 0 000 1.5h.5a.75.75 0 00.75-.75zm-1.47-5.78a.75.75 0 00-1.06 1.06l.354.354a.75.75 0 101.06-1.06l-.354-.354zM10 5.5a4.5 4.5 0 100 9 4.5 4.5 0 000-9z" />
                    </svg>
                </button>

                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/dashboard') }}" class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700 transition">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="px-4 py-2 border border-red-600 text-red-600 bg-white/80 rounded hover:bg-red-600 hover:text-white transition">Log in</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700 transition">Register</a>
                        @endif
                    @endauth
                @endif
            </div>
        </header>

       <!-- Hero Section -->
        <main class="max-w-3xl mx-auto glass p-6 rounded-lg shadow-xl text-center text-white drop-shadow mb-12">
            <h2 class="text-4xl font-extrabold mb-4">Simplify Your Workflow</h2>
            <p class="text-lg text-gray-100 mb-8">
                Organize tasks, boost productivity, and collaborate — all in one sleek platform.
            </p>
        </main>

        <!-- Centered Feature Cards -->
        <section class="flex-1 flex flex-col items-center justify-center px-4">
            <div class="flex flex-wrap justify-center gap-6">
                <div class="glass text-white w-full sm:w-[300px] p-6 rounded-lg shadow-xl text-center">
                    <h3 class="text-xl font-semibold mb-2 text-red-300">Smart Tasking</h3>
                    <p>Create, assign, and prioritize tasks with intuitive controls.</p>
                </div>
                <div class="glass text-white w-full sm:w-[300px] p-6 rounded-lg shadow-xl text-center">
                    <h3 class="text-xl font-semibold mb-2 text-red-300">Real-Time Insights</h3>
                    <p>Track your progress and team productivity live with ease.</p>
                </div>
                <div class="glass text-white w-full sm:w-[300px] p-6 rounded-lg shadow-xl text-center">
                    <h3 class="text-xl font-semibold mb-2 text-red-300">Collaboration</h3>
                    <p>Stay aligned and in sync with team through shared boards.</p>
                </div>
            </div>
        </section>

        <!-- Footer -->
        <footer class="text-sm text-gray-200 text-center mt-auto py-6">
            &copy; {{ date('Y') }} TaskNova. All rights reserved.
        </footer>
    </div>

</body>
</html>
