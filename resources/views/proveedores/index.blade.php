@extends('layouts.app')

@section('content')
<div class="container mx-auto py-6">
    <h2 class="text-3xl font-bold text-gray-800 mb-6 flex items-center">
        <i class="fas fa-truck mr-3 text-indigo-600"></i> Lista de Proveedores
    </h2>

    <!-- Tabla de proveedores -->
    <div class="overflow-x-auto bg-white shadow rounded-lg">
        <table class="min-w-full bg-white border-collapse">
            <thead class="bg-gray-200 text-gray-800">
                <tr>
                    <th class="px-6 py-3 border-b text-left text-sm font-semibold uppercase tracking-wider">RUC</th>
                    <th class="px-6 py-3 border-b text-left text-sm font-semibold uppercase tracking-wider">Nombre</th>
                    <th class="px-6 py-3 border-b text-center text-sm font-semibold uppercase tracking-wider">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($proveedores as $proveedor)
                    <tr class="hover:bg-gray-100 transition">
                        <td class="px-6 py-4 border-b text-gray-600">{{ $proveedor->id_ruc_proveedor }}</td>
                        <td class="px-6 py-4 border-b text-gray-600">{{ $proveedor->nombres }}</td>
                        <td class="px-6 py-4 border-b text-center">
                            <!-- Botones de acción -->
                            <a href="#"
                                class="inline-flex items-center bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition">
                                <i class="fas fa-edit mr-2"></i> Editar
                            </a>
                            <a href="#"
                                class="inline-flex items-center bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600 transition ml-2">
                                <i class="fas fa-trash-alt mr-2"></i> Eliminar
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="text-center py-6 text-gray-500">
                            <i class="fas fa-exclamation-circle text-xl mr-2"></i> No hay proveedores registrados.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Botón para añadir proveedor -->
    <div class="mt-6 text-right">
        <a href="#" class="bg-green-500 hover:bg-green-600 text-white px-6 py-3 rounded-lg shadow-md inline-flex items-center">
            <i class="fas fa-plus-circle mr-2"></i> Añadir Proveedor
        </a>
    </div>
</div>
@endsection
