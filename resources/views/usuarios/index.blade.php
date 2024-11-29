@extends('layouts.app')

@section('content')
<div class="container mx-auto py-6">
    <h2 class="text-2xl font-semibold mb-6">Usuarios</h2>

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

    <!-- Lista de Usuarios -->
    <table class="min-w-full bg-white border border-gray-300 shadow-md rounded-lg">
        <thead>
            <tr>
                <th class="py-2 px-4 text-left">Nombre</th>
                <th class="py-2 px-4 text-left">Correo Electrónico</th>
                <th class="py-2 px-4 text-left">Rol</th>
                <th class="py-2 px-4 text-left">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($usuarios as $usuario)
            <tr>
                <td class="py-2 px-4">{{ $usuario->name }}</td>
                <td class="py-2 px-4">{{ $usuario->email }}</td>
                <td class="py-2 px-4">{{ $usuario->rol }}</td>
                <td class="py-2 px-4">
                    <a href="{{ route('usuarios.edit', $usuario->id) }}" class="text-blue-500">Editar</a> |
                    <form action="{{ route('usuarios.destroy', $usuario->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-500">Eliminar</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <a href="{{ route('usuarios.create') }}" class="mt-4 bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">Crear Usuario</a>
</div>
@endsection
