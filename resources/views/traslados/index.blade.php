@extends('layouts.app')

@section('content')
    <div class="container mx-auto py-6">
        <h2 class="text-3xl font-semibold mb-6 text-center">Lista de Traslados</h2>

        <!-- Tabla de Traslados -->
        <div class="overflow-x-auto bg-white shadow rounded-lg">
            <table class="table-auto w-full text-sm text-left text-gray-600 border-collapse">
                <thead class="bg-gray-200 text-gray-800">
                    <tr>
                        <th class="px-6 py-3 border-b">ID</th>
                        <th class="px-6 py-3 border-b">Almacén de Salida</th>
                        <th class="px-6 py-3 border-b">Almacén de Entrada</th>
                        <th class="px-6 py-3 border-b">Motivo</th>
                        <th class="px-6 py-3 border-b text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($traslados as $traslado)
                        <tr class="hover:bg-gray-100">
                            <td class="px-6 py-4 border-b">{{ $traslado->id_traslado }}</td>
                            <td class="px-6 py-4 border-b">{{ $traslado->almacenSalida->nombre }}</td>
                            <td class="px-6 py-4 border-b">{{ $traslado->almacenEntrada->nombre }}</td>
                            <td class="px-6 py-4 border-b">{{ $traslado->motivo }}</td>
                            <td class="px-6 py-4 border-b text-center">
                                <!-- Aquí se puede redirigir a alguna acción específica si lo deseas -->
                                <span class="text-gray-500">Ver detalles</span>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Botón para añadir nuevo traslado -->
        <div class="mt-6 text-right">
            <a href="{{ route('traslados.create') }}" class="bg-green-500 hover:bg-green-600 text-white px-6 py-3 rounded-lg shadow-md">
                Nuevo Traslado
            </a>
        </div>
    </div>
@endsection
