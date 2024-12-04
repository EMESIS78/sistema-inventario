@extends('layouts.app')

@section('content')
<div class="container mx-auto py-6">
    <h2 class="text-2xl font-semibold mb-6">Editar Usuario</h2>

    <!-- Mostrar errores de validación -->
    @if ($errors->any())
        <div class="alert alert-danger bg-red-200 text-red-700 p-4 rounded mb-4">
            <ul>
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

        <!-- Nombre -->
        <div class="mb-4">
            <label for="name" class="block text-sm font-medium text-gray-700">Nombre</label>
            <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}"
                class="block w-full mt-1 border border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500" required>
        </div>

        <!-- Correo Electrónico -->
        <div class="mb-4">
            <label for="email" class="block text-sm font-medium text-gray-700">Correo Electrónico</label>
            <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}"
                class="block w-full mt-1 border border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500" required>
        </div>

        <!-- Rol -->
        <div class="mb-4">
            <label for="rol" class="block text-sm font-medium text-gray-700">Rol</label>
            <select name="rol" id="rol"
                class="block w-full mt-1 border border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500" required>
                <option value="admin" {{ $user->rol === 'admin' ? 'selected' : '' }}>Administrador</option>
                <option value="usuario" {{ $user->rol === 'usuario' ? 'selected' : '' }}>Usuario</option>
                <option value="supervisor" {{ $user->rol === 'supervisor' ? 'selected' : '' }}>Supervisor</option>
            </select>
        </div>

        <!-- Contraseña (opcional) -->
        <div class="mb-4">
            <label for="password" class="block text-sm font-medium text-gray-700">Contraseña (opcional)</label>
            <input type="password" name="password" id="password"
                class="block w-full mt-1 border border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
            <p class="text-sm text-gray-500 mt-1">Déjalo en blanco si no deseas cambiar la contraseña.</p>
        </div>

        <!-- Botones -->
        <div class="flex justify-end">
            <a href="{{ route('usuarios.index') }}" class="mr-4 text-gray-600 hover:text-gray-800">Cancelar</a>
            <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">Guardar Cambios</button>
        </div>
    </form>
</div>
@endsection
