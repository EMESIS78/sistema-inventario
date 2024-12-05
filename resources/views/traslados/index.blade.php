@extends('layouts.app')

@section('content')
    <div class="container mx-auto py-6">
        <h2 class="text-3xl font-semibold mb-6 text-center flex items-center justify-center text-indigo-700">
            <i class="fas fa-exchange-alt mr-3"></i> Lista de Traslados
        </h2>

        <!-- Barra de búsqueda -->
        <form action="{{ route('traslados.index') }}" method="GET" class="mb-6">
            <div class="flex items-center space-x-2">
                <div class="relative w-full">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Buscar motivo o almacén"
                        class="block w-full px-4 py-2 pl-10 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                        autofocus>
                    <span class="absolute left-3 top-2.5 text-gray-500">
                        <i class="fas fa-search"></i>
                    </span>
                </div>
                <button type="submit"
                    class="px-4 py-2 bg-blue-500 text-white rounded-lg shadow-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 transition">
                    <i class="fas fa-search mr-2"></i> Buscar
                </button>
            </div>
        </form>

        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg mt-4">
                {{ session('success') }}
            </div>
        @endif

        <!-- Tabla de Traslados -->
        <div class="overflow-x-auto bg-white shadow-md rounded-lg">
            <table class="table-auto w-full text-sm text-left text-gray-600 border-collapse">
                <thead class="bg-indigo-600 text-white">
                    <tr>
                        <th class="px-6 py-3 border-b">ID</th>
                        <th class="px-6 py-3 border-b">Almacén de Salida</th>
                        <th class="px-6 py-3 border-b">Almacén de Entrada</th>
                        @if (auth()->user()->rol === 'admin')
                            <th class="px-6 py-3 border-b">Usuario</th>
                        @endif
                        <th class="px-6 py-3 border-b">Motivo</th>
                        <th class="px-6 py-3 border-b text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($traslados as $traslado)
                        <tr class="hover:bg-gray-100 transition">
                            <td class="px-6 py-4 border-b">{{ $traslado->id_traslado }}</td>
                            <td class="px-6 py-4 border-b">{{ $traslado->almacenSalida->nombre }}</td>
                            <td class="px-6 py-4 border-b">{{ $traslado->almacenEntrada->nombre }}</td>
                            @if (auth()->user()->rol === 'admin')
                                <td class="px-6 py-4 border-b">{{ $traslado->usuario->name }}</td>
                            @endif
                            <td class="px-6 py-4 border-b">{{ $traslado->motivo }}</td>
                            <td class="px-6 py-4 border-b text-center">
                                <div class="flex justify-center items-center space-x-2">
                                    <a href="{{ route('traslados.detalles', $traslado->id_traslado) }}"
                                        class="bg-blue-500 text-white px-3 py-1 rounded-lg hover:bg-blue-600 shadow-sm">
                                        <i class="fas fa-eye"></i> Ver Detalles
                                    </a>
                                    <a href="{{ route('traslados.guia', $traslado->id_traslado) }}"
                                        class="bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-600 shadow-sm">
                                        <i class="fas fa-file-alt"></i> Ver Guía
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Botón para añadir nuevo traslado -->
        <div class="mt-6 text-right">
            <a href="{{ route('traslados.create') }}"
                class="bg-green-500 hover:bg-green-600 text-white px-6 py-3 rounded-lg shadow-md transition">
                <i class="fas fa-plus mr-2"></i> Nuevo Traslado
            </a>
        </div>

        @if (auth()->user()->rol === 'admin')
            <div class="mt-4 text-right">
                <a href="{{ route('traslados.reporte_pdf') }}"
                    class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded shadow-md transition">
                    <i class="fas fa-download mr-2"></i> Descargar Reporte PDF
                </a>
            </div>
        @endif
    </div>
@endsection
