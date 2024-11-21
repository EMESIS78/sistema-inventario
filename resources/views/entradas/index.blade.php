@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h2 class="text-2xl font-semibold mb-6">Listado de Entradas</h2>

    <table class="w-full border-collapse border border-gray-300">
        <thead>
            <tr class="bg-gray-100">
                <th class="border border-gray-300 px-4 py-2">ID</th>
                <th class="border border-gray-300 px-4 py-2">Documento</th>
                <th class="border border-gray-300 px-4 py-2">Almacén</th>
                <th class="border border-gray-300 px-4 py-2">Proveedor</th>
                <th class="border border-gray-300 px-4 py-2">Fecha</th>
                <th class="border border-gray-300 px-4 py-2">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse($entradas as $entrada)
                <tr>
                    <td class="border border-gray-300 px-4 py-2">{{ $entrada->id_entrada }}</td>
                    <td class="border border-gray-300 px-4 py-2">{{ $entrada->documento }}</td>
                    <td class="border border-gray-300 px-4 py-2">{{ $entrada->almacen->nombre }}</td>
                    <td class="border border-gray-300 px-4 py-2">{{ $entrada->proveedor->nombre }}</td>
                    <td class="border border-gray-300 px-4 py-2">{{ $entrada->created_at->format('d-m-Y') }}</td>
                    <td class="border border-gray-300 px-4 py-2">
                        
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center py-4">No hay datos disponibles.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="mt-6">
        <a href="{{ route('entradas.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Registrar Nueva Entrada</a>
    </div>
</div>
@endsection
