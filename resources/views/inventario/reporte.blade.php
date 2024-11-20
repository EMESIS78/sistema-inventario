@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h2 class="text-2xl font-semibold mb-6">Reporte de Inventario</h2>

    <table class="w-full border-collapse border border-gray-300">
        <thead>
            <tr class="bg-gray-100">
                <th class="border border-gray-300 px-4 py-2">ID Producto</th>
                <th class="border border-gray-300 px-4 py-2">Nombre</th>
                <th class="border border-gray-300 px-4 py-2">Marca</th>
                <th class="border border-gray-300 px-4 py-2">Ubicación</th>
                <th class="border border-gray-300 px-4 py-2">Stock</th>
                <th class="border border-gray-300 px-4 py-2">Almacén</th>
            </tr>
        </thead>
        <tbody>
            @forelse($reporte as $item)
                <tr>
                    <td class="border border-gray-300 px-4 py-2">{{ $item->id_producto }}</td>
                    <td class="border border-gray-300 px-4 py-2">{{ $item->nombre }}</td>
                    <td class="border border-gray-300 px-4 py-2">{{ $item->marca }}</td>
                    <td class="border border-gray-300 px-4 py-2">{{ $item->ubicacion }}</td>
                    <td class="border border-gray-300 px-4 py-2">{{ $item->stock }}</td>
                    <td class="border border-gray-300 px-4 py-2">{{ $item->nombre_almacen }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center py-4">No hay datos disponibles.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="mt-6 flex gap-4">
        <!-- Botón para exportar a PDF -->
        <a href="{{ route('inventario.reporte_pdf') }}" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">
            Exportar PDF
        </a>
        <!-- Botón para exportar a XLSX -->
        <a href="{{ route('inventario.reporte_xlsx') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
            Exportar XLSX
        </a>
        <!-- Botón para volver al inventario -->
        <a href="{{ route('inventario.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">
            Volver al Inventario
        </a>
    </div>
</div>
@endsection
