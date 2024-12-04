@extends('layouts.app')

@section('content')
    <div class="container mx-auto py-6">
        <h2 class="text-3xl font-semibold mb-6 text-center">Listado de Entradas</h2>

        <!-- Barra de búsqueda -->
        <form action="{{ route('entradas.index') }}" method="GET" class="mb-4">
            <div class="flex items-center space-x-2">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Buscar documento o proveedor"
                    class="block w-full px-4 py-2 border rounded-lg">
                <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600">Buscar</button>
            </div>
        </form>

        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mt-4">
                {{ session('success') }}
            </div>
        @endif

        <div class="overflow-x-auto bg-white shadow rounded-lg">
            <table class="table-auto w-full text-sm text-left text-gray-600 border-collapse">
                <thead class="bg-gray-200 text-gray-800">
                    <tr>
                        <th class="px-6 py-3 border-b">ID</th>
                        <th class="px-6 py-3 border-b">Documento</th>
                        <th class="px-6 py-3 border-b">Almacén</th>
                        <th class="px-6 py-3 border-b">Proveedor</th>
                        <th class="px-6 py-3 border-b">Fecha</th>
                        @if (auth()->user()->rol === 'admin')
                            <th class="px-6 py-3 border-b">Usuario</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @forelse($entradas as $entrada)
                        <tr class="hover:bg-gray-100">
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
                                    class="bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600">
                                    Ver Detalles
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-4">No hay datos disponibles.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if (auth()->user()->rol === 'admin')
            <div class="mt-4">
                <a href="{{ route('entradas.reporte_pdf') }}"
                    class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">
                    Descargar Reporte PDF
                </a>
            </div>
        @endif

        <div class="mt-6">
            <a href="{{ route('entradas.create') }}"
                class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Registrar Nueva Entrada</a>
        </div>
    </div>
@endsection
