@extends('layouts.app')

@section('content')
<div class="container mx-auto py-6">
    <h2 class="text-2xl font-semibold mb-6">Lista de Salidas</h2>
    <a href="{{ route('salidas.create') }}" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">Nueva Salida</a>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mt-4">
            {{ session('success') }}
        </div>
    @endif

    <table class="min-w-full bg-white border mt-6">
        <thead>
            <tr>
                <th class="border px-4 py-2">#</th>
                <th class="border px-4 py-2">Almacén</th>
                <th class="border px-4 py-2">Motivo</th>
                <th class="border px-4 py-2">Fecha</th>
            </tr>
        </thead>
        <tbody>
            @forelse($salidas as $salida)
                <tr>
                    <td class="border px-4 py-2">{{ $salida->id_salida }}</td>
                    <td class="border px-4 py-2">{{ $salida->almacen_nombre }}</td>
                    <td class="border px-4 py-2">{{ $salida->motivo }}</td>
                    <td class="border px-4 py-2">{{ $salida->created_at }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="border px-4 py-2 text-center">No hay salidas registradas.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
