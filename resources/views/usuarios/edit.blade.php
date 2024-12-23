@extends('layouts.app')

@section('content')
    <div class="container mx-auto py-8">
        <div class="max-w-3xl mx-auto bg-white p-6 rounded-lg shadow-lg">
            <h2 class="text-3xl font-bold text-gray-700 mb-6">Editar Usuario</h2>

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

            <!-- Formulario para editar usuario -->
            <form action="{{ route('usuarios.update', $user->id) }}" method="POST">
                @csrf
                @method('PUT')

                <!-- Campo: Nombre -->
                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-gray-700">Nombre</label>
                    <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}"
                        class="block w-full mt-1 rounded-lg border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500"
                        required>
                </div>

                <!-- Campo: Correo Electrónico -->
                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-700">Correo Electrónico</label>
                    <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}"
                        class="block w-full mt-1 rounded-lg border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500"
                        required>
                </div>

                <!-- Campo: Rol -->
                <div class="mb-4">
                    <label for="rol" class="block text-sm font-medium text-gray-700">Rol</label>
                    <select name="rol" id="rol"
                        class="block w-full mt-1 rounded-lg border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500"
                        required>
                        <option value="admin" {{ $user->rol === 'admin' ? 'selected' : '' }}>Administrador</option>
                        <option value="usuario" {{ $user->rol === 'usuario' ? 'selected' : '' }}>Usuario</option>
                        <option value="supervisor" {{ $user->rol === 'supervisor' ? 'selected' : '' }}>Supervisor</option>
                    </select>
                </div>

                <!-- Campo: Contraseña -->
                <div class="mb-4">
                    <label for="password" class="block text-sm font-medium text-gray-700">Contraseña (opcional)</label>
                    <input type="password" name="password" id="password"
                        class="block w-full mt-1 rounded-lg border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    <p class="text-sm text-gray-500 mt-1">Déjalo en blanco si no deseas cambiar la contraseña.</p>
                </div>

                <!-- Botones -->
                <div class="flex justify-end">
                    <a href="{{ route('usuarios.index') }}"
                        class="mr-4 text-gray-600 hover:text-gray-800 font-medium">Cancelar</a>
                    <button type="submit"
                        class="bg-blue-500 hover:bg-blue-600 text-white font-semibold px-6 py-2 rounded-lg shadow">
                        Guardar Cambios
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
