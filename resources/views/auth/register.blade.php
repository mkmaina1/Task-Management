<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register - TaskNova</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body {
            margin: 0;
            font-family: 'Figtree', sans-serif;
            background-color: #f9fafb;
        }

        .container {
            display: flex;
            height: 100vh;
            overflow: hidden;
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
            padding: 2rem;
            background: white;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.08);
            border-radius: 1rem;
        }

        .logo-title {
            font-size: 2rem;
            font-weight: bold;
            color: #e3342f;
            margin-bottom: 1.5rem;
            text-align: center;
        }

        @media (max-width: 768px) {
            .container {
                flex-direction: column;
            }

            .half-image,
            .form-section {
                width: 100%;
                height: 50vh;
            }
        }
    </style>
</head>
<body>
<div class="container">
    <div class="half-image"></div>

    <div class="form-section">
        <div class="panel">
            <div class="logo-title">TaskNova</div>

            <!-- Registration Form -->
            <form method="POST" action="{{ route('register') }}" class="space-y-4">
                @csrf

                <!-- Name -->
                <div>
                    <x-input-label for="name" :value="__('Name')" />
                    <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                <!-- Email -->
                <div>
                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Password -->
                <div>
                    <x-input-label for="password" :value="__('Password')" />
                    <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Confirm Password -->
                <div>
                    <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
                    <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>

                <!-- Actions -->
                <div class="flex items-center justify-between">
                    <a class="text-sm text-indigo-600 hover:underline transition" href="{{ route('login') }}">
                        {{ __('Already registered?') }}
                    </a>

                    <x-primary-button class="ml-4">
                        {{ __('Register') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>
