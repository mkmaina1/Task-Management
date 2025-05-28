<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - TaskNova</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            margin: 0;
            font-family: 'Figtree', sans-serif;
            overflow: hidden;
        }

        .container {
            display: flex;
            height: 100vh;
            transition: all 0.6s ease-in-out;
        }

        .half-image {
    position: relative;
    width: 50%;
    background: url('https://images.unsplash.com/photo-1504384308090-c894fdcc538d?auto=format&fit=crop&w=1400&q=80') no-repeat center center;
    background-size: cover;
    transition: transform 0.6s ease-in-out;
}

.half-image::before {
    content: "";
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5); /* adjust darkness here */
    z-index: 1;
}

        .form-section {
            width: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #f9fafb;
            transition: transform 0.6s ease-in-out;
            position: relative;
             z-index: 2;
        }

        .panel {
            max-width: 420px;
            width: 100%;
            padding: 2.5rem;
            background: white;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            border-radius: 1rem;
            transition: all 0.4s ease-in-out;
        }

        .brand {
            font-size: 2rem;
            font-weight: 700;
            color: #e11d48; /* red-600 */
            text-align: center;
            margin-bottom: 1.5rem;
            font-family: 'Figtree', sans-serif;
        }

        .switch {
            position: absolute;
            bottom: 20px;
            right: 30px;
            font-size: 0.9rem;
        }


    </style>

    <script>
        function toggleMode() {
            document.querySelector('.container').classList.toggle('register-mode');
        }
    </script>
</head>
<body>
<div class="container">
    <div class="half-image"></div>

    <div class="form-section">
        <div class="panel">
            <div class="brand">TaskNova</div>

            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email Address -->
                <div>
                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Password -->
                <div class="mt-4">
                    <x-input-label for="password" :value="__('Password')" />
                    <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Remember Me -->
                <div class="block mt-4">
                    <label for="remember_me" class="inline-flex items-center">
                        <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-red-600 shadow-sm focus:ring-red-500" name="remember">
                        <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                    </label>
                </div>

                <div class="flex items-center justify-between mt-4">
                    @if (Route::has('password.request'))
                        <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                            {{ __('Forgot your password?') }}
                        </a>
                    @endif

                    <x-primary-button class="mr-3">
                        {{ __('Log in') }}
                    </x-primary-button>
                </div>
            </form>

            <div class="switch">
                <span>New here?
                    <a href="{{ route('register') }}" onclick="toggleMode(); return false;" class="text-red-600 hover:underline">
                        Register
                    </a>
                </span>
            </div>
        </div>
    </div>
</div>
</body>
</html>
