<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>TaskNova</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />

    <!-- Styles / Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

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
<body class="font-sans antialiased bg-white text-gray-800 dark:bg-gray-900 dark:text-gray-200 transition-colors duration-300">

    <div class="min-h-screen flex flex-col px-4 py-6">
        <!-- Header -->
        <header class="w-full max-w-6xl mx-auto flex items-center justify-between mb-10">
            <h1 class="text-3xl font-bold">
                Welcome to <span class="text-red-600">TaskNova</span>
            </h1>
            <div class="flex items-center gap-4">
                <!-- Theme Toggle -->
                <button id="theme-toggle" class="p-2 rounded-full border border-gray-300 dark:border-gray-600 hover:bg-gray-200 dark:hover:bg-gray-700 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-700 dark:text-gray-300" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M10 2a.75.75 0 01.75.75v.5a.75.75 0 01-1.5 0v-.5A.75.75 0 0110 2zM4.22 4.22a.75.75 0 011.06 0l.354.354a.75.75 0 11-1.06 1.06l-.354-.354a.75.75 0 010-1.06zM2 10a.75.75 0 01.75-.75h.5a.75.75 0 010 1.5h-.5A.75.75 0 012 10zm2.22 5.78a.75.75 0 011.06-1.06l.354.354a.75.75 0 11-1.06 1.06l-.354-.354zM10 17.25a.75.75 0 01.75.75v.5a.75.75 0 01-1.5 0v-.5a.75.75 0 01.75-.75zm5.78-1.47a.75.75 0 10-1.06-1.06l-.354.354a.75.75 0 001.06 1.06l.354-.354zM17.25 10a.75.75 0 00-.75-.75h-.5a.75.75 0 000 1.5h.5a.75.75 0 00.75-.75zm-1.47-5.78a.75.75 0 00-1.06 1.06l.354.354a.75.75 0 101.06-1.06l-.354-.354zM10 5.5a4.5 4.5 0 100 9 4.5 4.5 0 000-9z" />
                    </svg>
                </button>

                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/dashboard') }}" class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700 transition">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="px-4 py-2 border border-red-600 text-red-600 rounded hover:bg-red-600 hover:text-white transition">Log in</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700 transition">Register</a>
                        @endif
                    @endauth
                @endif
            </div>
        </header>

        <!-- Hero Section -->
        <main class="text-center mb-16 max-w-3xl mx-auto">
            <h2 class="text-4xl font-extrabold mb-4">Simplify Your Workflow</h2>
            <p class="text-lg text-gray-600 dark:text-gray-400 mb-8">
                Organize your tasks, boost productivity, and collaborate efficiently — all in one sleek platform.
            </p>
            <img src="https://img.freepik.com/free-vector/project-management-concept-illustration_114360-6321.jpg" alt="Task Management Illustration" class="w-full max-w-md mx-auto rounded-xl shadow-lg">
        </main>

        <!-- Feature Cards -->
        <section class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 max-w-6xl mx-auto mb-16">
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6 text-center hover:shadow-xl transition">
                <h3 class="text-xl font-semibold mb-2 text-red-600">Smart Tasking</h3>
                <p class="text-gray-600 dark:text-gray-400">Create, assign, and prioritize tasks with intuitive controls.</p>
            </div>
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6 text-center hover:shadow-xl transition">
                <h3 class="text-xl font-semibold mb-2 text-red-600">Real-Time Insights</h3>
                <p class="text-gray-600 dark:text-gray-400">Get analytics and track your team's performance live.</p>
            </div>
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6 text-center hover:shadow-xl transition">
                <h3 class="text-xl font-semibold mb-2 text-red-600">Collaboration</h3>
                <p class="text-gray-600 dark:text-gray-400">Work seamlessly with teammates through shared taskboards.</p>
            </div>
        </section>

        <!-- Footer -->
        <footer class="text-sm text-gray-500 dark:text-gray-400 text-center">
            &copy; {{ date('Y') }} TaskNova. All rights reserved.
        </footer>
    </div>

</body>
</html>
