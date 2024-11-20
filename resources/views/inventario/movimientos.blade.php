@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h2 class="text-2xl font-semibold mb-6">Movimientos del Producto: {{ $producto->nombre }}</h2>

    <table class="w-full border-collapse border border-gray-300">
        <thead>
            <tr class="bg-gray-100">
                <th class="border border-gray-300 px-4 py-2">Tipo</th>
                <th class="border border-gray-300 px-4 py-2">Fecha</th>
                <th class="border border-gray-300 px-4 py-2">Cantidad</th>
                <th class="border border-gray-300 px-4 py-2">Almacén</th>
            </tr>
        </thead>
        <tbody>
            @forelse($movimientos as $movimiento)
                <tr>
                    <td class="border border-gray-300 px-4 py-2">{{ $movimiento->tipo }}</td>
                    <td class="border border-gray-300 px-4 py-2">{{ $movimiento->fecha }}</td>
                    <td class="border border-gray-300 px-4 py-2">{{ $movimiento->cantidad }}</td>
                    <td class="border border-gray-300 px-4 py-2">{{ $movimiento->nombre_almacen }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center py-4">No hay movimientos registrados para este producto.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="mt-6">
        <a href="{{ route('inventario.reporte_global') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Volver al Reporte Global</a>
    </div>
</div>
@endsection
