@extends('layouts.app')

@section('content')
    <div class="container mx-auto py-6">
        <!-- Título -->
        <h2 class="text-3xl font-bold mb-6 flex items-center text-gray-800">
            <i class="fas fa-clipboard-list mr-3 text-indigo-600"></i> Detalles de Salida #{{ $salida->id_salida }}
        </h2>

        <!-- Detalles generales de la salida -->
        <div class="bg-white p-6 rounded-lg shadow-md mb-6">
            <p class="text-lg font-semibold mb-3">
                <i class="fas fa-warehouse mr-2 text-indigo-600"></i> <strong>Almacén:</strong>
                <span class="text-gray-700">{{ $salida->almacen_nombre }}</span>
            </p>
            <p class="text-lg font-semibold mb-3">
                <i class="fas fa-sticky-note mr-2 text-indigo-600"></i> <strong>Motivo:</strong>
                <span class="text-gray-700">{{ $salida->motivo }}</span>
            </p>
            <p class="text-lg font-semibold mb-3">
                <i class="fas fa-user mr-2 text-indigo-600"></i> <strong>Usuario:</strong>
                <span class="text-gray-700">{{ $salida->usuario_nombre }}</span>
            </p>
            <p class="text-lg font-semibold">
                <i class="fas fa-calendar-alt mr-2 text-indigo-600"></i> <strong>Fecha:</strong>
                <span class="text-gray-700">{{ \Carbon\Carbon::parse($salida->created_at)->format('d-m-Y') }}</span>
            </p>
        </div>

        <!-- Tabla de productos -->
        <h3 class="text-2xl font-bold mb-4 flex items-center text-gray-800">
            <i class="fas fa-boxes mr-2 text-green-500"></i> Productos
        </h3>
        <div class="overflow-x-auto bg-white p-4 rounded-lg shadow-md">
            <table class="table-auto w-full text-sm text-left text-gray-600 border-collapse">
                <thead class="bg-gray-100 text-gray-800">
                    <tr>
                        <th class="border border-gray-300 px-6 py-3">Producto</th>
                        <th class="border border-gray-300 px-6 py-3">Cantidad</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($detalles as $detalle)
                        <tr class="hover:bg-gray-100">
                            <td class="border border-gray-300 px-6 py-4">{{ $detalle->producto }}</td>
                            <td class="border border-gray-300 px-6 py-4">{{ $detalle->cantidad }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="2" class="text-center py-4 text-gray-500">
                                No hay productos registrados para esta salida.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
