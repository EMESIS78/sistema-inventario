<x-guest-layout>
    <div class="min-h-screen flex flex-col items-center justify-center bg-gradient-to-r from-blue-500 to-indigo-600">
        <div class="w-full max-w-md bg-white shadow-lg rounded-lg p-6">
            <!-- Ícono Heroicon -->
            <div class="flex justify-center mb-6">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-blue-500" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M12 11c2.8 0 5-2.2 5-5s-2.2-5-5-5-5 2.2-5 5 2.2 5 5 5zm0 2c-4 0-7 2-7 6v3h14v-3c0-4-3-6-7-6z" />
                </svg>
            </div>

            <!-- Título -->
            <h2 class="text-2xl font-bold text-center text-gray-700">Iniciar Sesión</h2>
            <p class="text-sm text-center text-gray-500 mb-4">Bienvenido de nuevo, por favor ingresa tus credenciales
            </p>

            <!-- Validación de errores -->
            <x-validation-errors class="mb-4" />

            @if (session('status'))
                <div class="mb-4 font-medium text-sm text-green-600">
                    {{ session('status') }}
                </div>
            @endif

            <!-- Formulario -->
            <form method="POST" action="{{ route('login') }}" class="space-y-4">
                @csrf

                <!-- Email -->
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-600">Correo Electrónico</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 12h-4M8 12h-.01m4-8H6a2 2 0 00-2 2v12a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-4z" />
                            </svg>
                        </span>
                        <x-input id="email"
                            class="block w-full pl-10 mt-1 rounded-lg border-gray-300 focus:ring-indigo-500 focus:border-indigo-500"
                            type="email" name="email" :value="old('email')" required autofocus
                            autocomplete="username" />
                    </div>
                </div>

                <!-- Password -->
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-600">Contraseña</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 11c0-.944-.508-1.812-1.4-2.33-.735-.44-1.748-.67-2.845-.67H5a2 2 0 00-2 2v8a2 2 0 002 2h14a2 2 0 002-2v-6a2 2 0 00-2-2h-7z" />
                            </svg>
                        </span>
                        <x-input id="password"
                            class="block w-full pl-10 mt-1 rounded-lg border-gray-300 focus:ring-indigo-500 focus:border-indigo-500"
                            type="password" name="password" required autocomplete="current-password" />
                    </div>
                </div>

                <!-- Remember me -->
                <div class="flex items-center">
                    <x-checkbox id="remember_me" name="remember" />
                    <label for="remember_me" class="ml-2 text-sm text-gray-600">Recuérdame</label>
                </div>

                <!-- Botones -->
                <div class="flex items-center justify-between">
                    <x-button class="bg-indigo-500 hover:bg-indigo-600 text-white font-semibold rounded-lg">
                        Ingresar
                    </x-button>
                </div>
            </form>
        </div>

    </div>
</x-guest-layout>
