@extends('layouts.app')

@section('content')
    <div class="container mx-auto py-6">
        <!-- Título de la vista -->
        <h2 class="text-3xl font-bold mb-6 flex items-center text-gray-800">
            <i class="fas fa-truck-loading mr-3 text-indigo-600"></i> Lista de Salidas
        </h2>

        <!-- Barra de búsqueda -->
        <form action="{{ route('salidas.index') }}" method="GET" class="mb-6 flex items-center space-x-3">
            <div class="relative w-full">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Buscar por motivo o almacén"
                    class="block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
                <span class="absolute left-3 top-2.5 text-gray-500">
                    <i class="fas fa-search"></i>
                </span>
            </div>
            <button type="submit"
                class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 transition">
                <i class="fas fa-search mr-2"></i> Buscar
            </button>
        </form>

        <!-- Botones de acciones -->
        <div class="flex justify-between items-center mb-4">
            <a href="{{ route('salidas.create') }}"
                class="flex items-center px-4 py-2 bg-green-500 text-white rounded-lg hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-500 transition">
                <i class="fas fa-plus mr-2"></i> Nueva Salida
            </a>

            @if (auth()->user()->rol === 'admin')
                <a href="{{ route('salidas.reporte_pdf') }}"
                    class="flex items-center px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-500 transition">
                    <i class="fas fa-file-pdf mr-2"></i> Descargar Reporte PDF
                </a>
            @endif
        </div>

        <!-- Mensaje de éxito -->
        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
                <i class="fas fa-check-circle mr-2"></i> {{ session('success') }}
            </div>
        @endif

        <!-- Tabla de Salidas -->
        <div class="overflow-x-auto bg-white shadow-md rounded-lg">
            <table class="w-full table-auto text-sm text-left text-gray-600 border-collapse">
                <thead>
                    <tr class="bg-gray-200 text-gray-800">
                        <th class="px-6 py-3 border-b">#</th>
                        <th class="px-6 py-3 border-b">Almacén</th>
                        <th class="px-6 py-3 border-b">Motivo</th>
                        @if (auth()->user()->rol === 'admin')
                            <th class="px-6 py-3 border-b">Usuario</th>
                        @endif
                        <th class="px-6 py-3 border-b">Fecha</th>
                        <th class="px-6 py-3 border-b text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($salidas as $salida)
                        <tr class="hover:bg-gray-100">
                            <td class="px-6 py-4 border-b">{{ $salida->id_salida }}</td>
                            <td class="px-6 py-4 border-b">{{ $salida->almacen->nombre }}</td>
                            <td class="px-6 py-4 border-b">{{ $salida->motivo }}</td>
                            @if (auth()->user()->rol === 'admin')
                                <td class="px-6 py-4 border-b">{{ $salida->usuario->name }}</td>
                            @endif
                            <td class="px-6 py-4 border-b">{{ $salida->created_at->format('d-m-Y') }}</td>
                            <td class="px-6 py-4 border-b text-center">
                                <a href="{{ route('salidas.detalles', $salida->id_salida) }}"
                                    class="bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600 transition">
                                    <i class="fas fa-eye"></i> Ver Detalles
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-4 text-gray-500">No hay salidas registradas.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
