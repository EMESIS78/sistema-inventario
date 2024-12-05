@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h2 class="text-3xl font-bold text-gray-800 mb-6 flex items-center">
        <i class="fas fa-warehouse mr-3 text-indigo-600"></i> Reporte Global de Inventario
    </h2>

    <div class="overflow-x-auto">
        <table class="w-full border-collapse border border-gray-300 shadow-md rounded-lg">
            <thead class="bg-indigo-600 text-white">
                <tr>
                    <th class="border border-gray-300 px-6 py-3 text-left">ID Producto</th>
                    <th class="border border-gray-300 px-6 py-3 text-left">Nombre</th>
                    <th class="border border-gray-300 px-6 py-3 text-left">Existencia Total</th>
                </tr>
            </thead>
            <tbody>
                @forelse($reporteGlobal as $item)
                    <tr class="hover:bg-gray-100 transition">
                        <td class="border border-gray-300 px-6 py-3 text-gray-700">{{ $item->id_producto }}</td>
                        <td class="border border-gray-300 px-6 py-3 text-gray-700">{{ $item->nombre }}</td>
                        <td class="border border-gray-300 px-6 py-3 text-gray-700">{{ $item->existencia }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="text-center py-6 text-gray-600">
                            <i class="fas fa-info-circle text-indigo-500 mr-2"></i> No hay datos disponibles.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-8 flex flex-wrap gap-4 justify-center">
        <!-- Botón para exportar a PDF -->
        <a href="{{ route('inventario.reporte_global_pdf') }}"
            class="flex items-center bg-red-500 text-white px-6 py-3 rounded-lg hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-500 transition">
            <i class="fas fa-file-pdf mr-2"></i> Exportar PDF
        </a>
        <!-- Botón para exportar a XLSX -->
        <a href="{{ route('inventario.reporte_global_xlsx') }}"
            class="flex items-center bg-blue-500 text-white px-6 py-3 rounded-lg hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 transition">
            <i class="fas fa-file-excel mr-2"></i> Exportar XLSX
        </a>
        <!-- Botón para volver al inventario -->
        <a href="{{ route('inventario.index') }}"
            class="flex items-center bg-gray-500 text-white px-6 py-3 rounded-lg hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-500 transition">
            <i class="fas fa-arrow-left mr-2"></i> Volver al Inventario
        </a>
    </div>
</div>
@endsection
