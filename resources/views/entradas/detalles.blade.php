@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h2 class="text-2xl font-semibold mb-6">Detalles de Entrada #{{ $entrada->id_entrada }}</h2>
    <p><strong>Documento:</strong> {{ $entrada->documento }}</p>
    <p><strong>Almacén:</strong> {{ $entrada->almacen->nombre }}</p>
    <p><strong>Proveedor:</strong> {{ $entrada->id_proveedor }}</p>
    <p><strong>Fecha:</strong> {{ $entrada->created_at->format('d-m-Y') }}</p>

    <h3 class="text-xl font-semibold mt-6 mb-4">Productos:</h3>
    <table class="w-full border-collapse border border-gray-300">
        <thead>
            <tr class="bg-gray-100">
                <th class="border border-gray-300 px-4 py-2">Producto</th>
                <th class="border border-gray-300 px-4 py-2">Cantidad</th>
            </tr>
        </thead>
        <tbody>
            @foreach($detalles as $detalle)
                <tr>
                    <td class="border border-gray-300 px-4 py-2">{{ $detalle->producto }}</td>
                    <td class="border border-gray-300 px-4 py-2">{{ $detalle->cantidad }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
