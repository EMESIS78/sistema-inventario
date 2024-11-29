@extends('layouts.app')

@section('content')
<div class="container mx-auto py-6">
    <h2 class="text-2xl font-semibold mb-6">Crear Usuario</h2>

    <form action="{{ route('usuarios.store') }}" method="POST">
        @csrf
        <div class="mb-4">
            <label for="name" class="block text-sm font-medium text-gray-700">Nombre</label>
            <input type="text" id="name" name="name" class="block w-full mt-1 rounded border-gray-300 shadow-sm" required>
        </div>

        <div class="mb-4">
            <label for="email" class="block text-sm font-medium text-gray-700">Correo Electrónico</label>
            <input type="email" id="email" name="email" class="block w-full mt-1 rounded border-gray-300 shadow-sm" required>
        </div>

        <div class="mb-4">
            <label for="password" class="block text-sm font-medium text-gray-700">Contraseña</label>
            <input type="password" id="password" name="password" class="block w-full mt-1 rounded border-gray-300 shadow-sm" required>
        </div>

        <div class="mb-4">
            <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirmar Contraseña</label>
            <input type="password" id="password_confirmation" name="password_confirmation" class="block w-full mt-1 rounded border-gray-300 shadow-sm" required>
        </div>

        <div class="mb-4">
            <label for="rol" class="block text-sm font-medium text-gray-700">Rol</label>
            <select name="rol" id="rol" class="block w-full mt-1 rounded border-gray-300 shadow-sm">
                <option value="admin">Admin</option>
                <option value="supervisor">Supervisor</option>
                <option value="usuario" selected>Almacenero</option>
            </select>
        </div>

        <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">Crear Usuario</button>
    </form>
</div>
@endsection
