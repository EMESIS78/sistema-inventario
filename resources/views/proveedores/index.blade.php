@extends('layouts.app')

@section('content')
<div class="container mx-auto py-6">
    <h2 class="text-2xl font-semibold mb-6">Lista de Proveedores</h2>

    <table class="min-w-full bg-white border mt-6">
        <thead>
            <tr>
                <th class="border px-4 py-2">RUC</th>
                <th class="border px-4 py-2">Nombre</th>
                <th class="border px-4 py-2">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse($proveedores as $proveedor)
                <tr>
                    <td class="border px-4 py-2">{{ $proveedor->id_ruc_proveedor }}</td>
                    <td class="border px-4 py-2">{{ $proveedor->nombres }}</td>
                    <td class="border px-4 py-2">
                        <!-- Aquí se pueden agregar botones de acción (editar/eliminar) -->
                        <a href="#" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Editar</a>
                        <a href="#" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">Eliminar</a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" class="text-center py-4">No hay proveedores registrados.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
