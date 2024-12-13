@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-6">
        <h2 class="text-3xl font-bold text-gray-800 mb-6 flex items-center">
            <i class="fas fa-file-alt mr-3 text-indigo-600"></i> Kardex Valorado
        </h2>

        <!-- Filtro por fechas -->
        <form method="GET" action="{{ route('inventario.kardexvalorado') }}"
            class="mb-6 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 items-end">
            <div>
                <label for="fecha_inicio" class="block text-sm font-medium text-gray-700">Fecha Inicio</label>
                <input type="date" name="fecha_inicio" id="fecha_inicio" value="{{ $fechaInicio ?? '' }}"
                    class="block w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
            </div>
            <div>
                <label for="fecha_fin" class="block text-sm font-medium text-gray-700">Fecha Fin</label>
                <input type="date" name="fecha_fin" id="fecha_fin" value="{{ $fechaFin ?? '' }}"
                    class="block w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
            </div>
            <div>
                <button type="submit"
                    class="mt-2 w-full bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 focus:ring-2 focus:ring-blue-500 transition">
                    <i class="fas fa-filter mr-2"></i> Filtrar
                </button>
            </div>
            <div>
                <label for="buscar_producto" class="block text-sm font-medium text-gray-700">Buscar Producto</label>
                <input type="text" name="buscar_producto" id="buscar_producto" placeholder="Nombre del producto"
                    value="{{ request('buscar_producto') }}"
                    class="block w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
            </div>
            <div>
                <button type="submit"
                    class="mt-2 w-full bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 focus:ring-2 focus:ring-blue-500 transition">
                    <i class="fas fa-search mr-2"></i> Buscar
                </button>
            </div>
        </form>

        <!-- Tabla Kardex Valorado -->
        <div class="overflow-x-auto bg-white rounded-lg shadow-md">
            <table class="min-w-full bg-white border">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 border-b text-left text-sm font-medium text-gray-500 uppercase tracking-wider">
                            Producto</th>
                        <th class="px-6 py-3 border-b text-left text-sm font-medium text-gray-500 uppercase tracking-wider">
                            Documento</th>
                        <th class="px-6 py-3 border-b text-left text-sm font-medium text-gray-500 uppercase tracking-wider">
                            Precio Unitario</th>
                        <th class="px-6 py-3 border-b text-left text-sm font-medium text-gray-500 uppercase tracking-wider">
                            Fecha</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($kardexValorado as $item)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $item->producto }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $item->documento }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                {{ number_format($item->precio_unitario, 2) }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                {{ \Carbon\Carbon::parse($item->fecha)->format('d/m/Y') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-4 text-center text-gray-500">No se encontraron resultados</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Botón para exportar a PDF -->
        <form method="GET" action="{{ route('inventario.kardexvalorado.pdf') }}" class="mt-4">
            <input type="hidden" name="fecha_inicio" value="{{ $fechaInicio ?? '' }}">
            <input type="hidden" name="fecha_fin" value="{{ $fechaFin ?? '' }}">
            <input type="hidden" name="buscar_producto" value="{{ request('buscar_producto') }}">
            <button type="submit"
                class="w-full bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600 focus:ring-2 focus:ring-red-500 transition">
                <i class="fas fa-file-pdf mr-2"></i> Exportar PDF
            </button>
        </form>
    </div>
@endsection
