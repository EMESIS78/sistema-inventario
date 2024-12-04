@extends('layouts.app')

@section('content')
    <div class="container mx-auto py-6">
        <h2 class="text-2xl font-semibold mb-6">Lista de Salidas</h2>

        <form action="{{ route('salidas.index') }}" method="GET" class="mb-4">
            <div class="flex items-center space-x-2">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Buscar motivo o almacén"
                    class="block w-full px-4 py-2 border rounded-lg">
                <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600">Buscar</button>
            </div>
        </form>

        
        <a href="{{ route('salidas.create') }}" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">Nueva
            Salida</a>

        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mt-4">
                {{ session('success') }}
            </div>
        @endif

        @if (auth()->user()->rol === 'admin')
            <div class="mt-4">
                <a href="{{ route('salidas.reporte_pdf') }}"
                    class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">
                    Descargar Reporte PDF
                </a>
            </div>
        @endif

        <div class="overflow-x-auto bg-white shadow rounded-lg">
            <table class="table-auto w-full text-sm text-left text-gray-600 border-collapse">
                <thead>
                    <tr>
                        <th class="px-6 py-3 border-b">#</th>
                        <th class="px-6 py-3 border-b">Almacén</th>
                        <th class="px-6 py-3 border-b">Motivo</th>
                        <th class="px-6 py-3 border-b">Usuario</th>
                        <th class="px-6 py-3 border-b">Fecha</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($salidas as $salida)
                        <tr>
                            <td class="px-6 py-4 border-b">{{ $salida->id_salida }}</td>
                            <td class="px-6 py-4 border-b">{{ $salida->almacen->nombre }}</td>
                            <td class="px-6 py-4 border-b">{{ $salida->motivo }}</td>
                            <td class="px-6 py-4 border-b">{{ $salida->usuario->name }}</td>
                            <td class="px-6 py-4 border-b">{{ $salida->created_at }}</td>
                            <td class="px-6 py-4 border-b text-center">
                                <a href="{{ route('salidas.detalles', $salida->id_salida) }}"
                                    class="bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600">
                                    Ver Detalles
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="border px-4 py-2 text-center">No hay salidas registradas.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
