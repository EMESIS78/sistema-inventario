@extends('layouts.app')

@section('content')
    <div class="container mx-auto py-8">
        <div class="max-w-3xl mx-auto bg-white p-6 rounded-lg shadow-lg">
            <h2 class="text-3xl font-bold text-gray-700 mb-6">Crear Usuario</h2>

            <!-- Mostrar errores de validación -->
            @if ($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
                    <strong class="font-bold">¡Error!</strong>
                    <ul class="mt-2">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('usuarios.store') }}" method="POST">
                @csrf
                <!-- Campo: Nombre -->
                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-gray-700">Nombre</label>
                    <input type="text" id="name" name="name"
                        class="block w-full mt-1 rounded-lg border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500"
                        value="{{ old('name') }}" required>
                </div>

                <!-- Campo: Correo Electrónico -->
                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-700">Correo Electrónico</label>
                    <input type="email" id="email" name="email"
                        class="block w-full mt-1 rounded-lg border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500"
                        value="{{ old('email') }}" required>
                </div>

                <!-- Campo: Contraseña -->
                <div class="mb-4">
                    <label for="password" class="block text-sm font-medium text-gray-700">Contraseña</label>
                    <input type="password" id="password" name="password"
                        class="block w-full mt-1 rounded-lg border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500"
                        required>
                </div>

                <!-- Campo: Confirmar Contraseña -->
                <div class="mb-4">
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirmar
                        Contraseña</label>
                    <input type="password" id="password_confirmation" name="password_confirmation"
                        class="block w-full mt-1 rounded-lg border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500"
                        required>
                </div>

                <!-- Campo: Rol -->
                <div class="mb-4">
                    <label for="rol" class="block text-sm font-medium text-gray-700">Rol</label>
                    <select name="rol" id="rol"
                        class="block w-full mt-1 rounded-lg border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500">
                        <option value="admin" {{ old('rol') == 'admin' ? 'selected' : '' }}>Admin</option>
                        <option value="supervisor" {{ old('rol') == 'supervisor' ? 'selected' : '' }}>Supervisor</option>
                        <option value="usuario" {{ old('rol') == 'usuario' ? 'selected' : '' }}>Almacenero</option>
                    </select>
                </div>

                <!-- Botón de envío -->
                <button type="submit"
                    class="w-full bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded-lg shadow">
                    Crear Usuario
                </button>
            </form>
        </div>
    </div>
@endsection
