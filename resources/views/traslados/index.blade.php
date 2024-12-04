@extends('layouts.app')

@section('content')
    <div class="container mx-auto py-6">
        <h2 class="text-3xl font-semibold mb-6 text-center">Lista de Traslados</h2>

        <!-- Barra de búsqueda -->
        <form action="{{ route('traslados.index') }}" method="GET" class="mb-4">
            <div class="flex items-center space-x-2">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Buscar motivo o almacén"
                    class="block w-full px-4 py-2 border rounded-lg">
                <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600">Buscar</button>
            </div>
        </form>

        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mt-4">
                {{ session('success') }}
            </div>
        @endif

        <!-- Tabla de Traslados -->
        <div class="overflow-x-auto bg-white shadow rounded-lg">
            <table class="table-auto w-full text-sm text-left text-gray-600 border-collapse">
                <thead class="bg-gray-200 text-gray-800">
                    <tr>
                        <th class="px-6 py-3 border-b">ID</th>
                        <th class="px-6 py-3 border-b">Almacén de Salida</th>
                        <th class="px-6 py-3 border-b">Almacén de Entrada</th>
                        <th class="px-6 py-3 border-b">Usuario</th>
                        <th class="px-6 py-3 border-b">Motivo</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($traslados as $traslado)
                        <tr class="hover:bg-gray-100">
                            <td class="px-6 py-4 border-b">{{ $traslado->id_traslado }}</td>
                            <td class="px-6 py-4 border-b">{{ $traslado->almacenSalida->nombre }}</td>
                            <td class="px-6 py-4 border-b">{{ $traslado->almacenEntrada->nombre }}</td>
                            <td class="px-6 py-4 border-b">{{ $traslado->usuario->name }}</td>
                            <td class="px-6 py-4 border-b">{{ $traslado->motivo }}</td>
                            <td class="px-6 py-4 border-b text-center">
                                <a href="{{ route('traslados.detalles', $traslado->id_traslado) }}"
                                    class="bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600">
                                    Ver Detalles
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Botón para añadir nuevo traslado -->
        <div class="mt-6 text-right">
            <a href="{{ route('traslados.create') }}"
                class="bg-green-500 hover:bg-green-600 text-white px-6 py-3 rounded-lg shadow-md">
                Nuevo Traslado
            </a>
        </div>

        @if (auth()->user()->rol === 'admin')
            <div class="mt-4 text-right">
                <a href="{{ route('traslados.reporte_pdf') }}"
                    class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">
                    Descargar Reporte PDF
                </a>
            </div>
        @endif
    </div>
@endsection
