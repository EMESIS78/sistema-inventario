@extends('layouts.app')

@section('content')
    <div class="container mx-auto py-6">
        <h2 class="text-3xl font-semibold mb-6 text-center text-gray-700">📋 Listado de Entradas</h2>

        <!-- Barra de búsqueda -->
        <form action="{{ route('entradas.index') }}" method="GET" class="mb-4">
            <div class="flex items-center space-x-2">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="🔍 Buscar documento o proveedor"
                    class="block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                <button type="submit"
                    class="flex items-center px-4 py-2 bg-blue-500 text-white rounded-lg shadow-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
                    <i class="fas fa-search mr-2"></i> Buscar
                </button>
            </div>
        </form>

        <div class="flex justify-between items-center mt-6">
            @if (auth()->user()->rol === 'admin')
                <a href="{{ route('entradas.reporte_pdf') }}"
                    class="flex items-center px-4 py-2 bg-red-500 text-white rounded-lg shadow-md hover:bg-green-600 transition-all">
                    <i class="fas fa-file-pdf mr-2"></i> Descargar Reporte PDF
                </a>
            @endif
            <a href="{{ route('entradas.create') }}"
                class="flex items-center px-4 py-2 bg-blue-500 text-white rounded-lg shadow-md hover:bg-blue-600 transition-all">
                <i class="fas fa-plus-circle mr-2"></i> Registrar Nueva Entrada
            </a>
        </div>

        <!-- Mensaje de éxito -->
        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mt-4">
                <i class="fas fa-check-circle mr-2"></i> {{ session('success') }}
            </div>
        @endif

        <!-- Tabla de entradas -->
        <div class="overflow-x-auto bg-white shadow-md rounded-lg">
            <table class="table-auto w-full text-sm text-left text-gray-600">
                <thead class="bg-gray-100 text-gray-800">
                    <tr>
                        <th class="px-6 py-3 border-b">ID</th>
                        <th class="px-6 py-3 border-b">Documento</th>
                        <th class="px-6 py-3 border-b">Almacén</th>
                        <th class="px-6 py-3 border-b">Proveedor</th>
                        <th class="px-6 py-3 border-b">Fecha</th>
                        @if (auth()->user()->rol === 'admin')
                            <th class="px-6 py-3 border-b">Usuario</th>
                        @endif
                        <th class="px-6 py-3 border-b text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($entradas as $entrada)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4 border-b">{{ $entrada->id_entrada }}</td>
                            <td class="px-6 py-4 border-b">{{ $entrada->documento }}</td>
                            <td class="px-6 py-4 border-b">{{ $entrada->almacen->nombre }}</td>
                            <td class="px-6 py-4 border-b">{{ $entrada->id_proveedor }}</td>
                            <td class="px-6 py-4 border-b">{{ $entrada->created_at->format('d-m-Y') }}</td>
                            @if (auth()->user()->rol === 'admin')
                                <td class="px-6 py-4 border-b">{{ $entrada->usuario->name }}</td>
                            @endif
                            <td class="px-6 py-4 border-b text-center">
                                <a href="{{ route('entradas.detalles', $entrada->id_entrada) }}"
                                    class="flex items-center justify-center bg-blue-500 text-white px-3 py-2 rounded-lg shadow-md hover:bg-blue-600 transition-all">
                                    <i class="fas fa-eye mr-2"></i> Ver Detalles
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-4 text-gray-500">No hay datos disponibles.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>
@endsection
