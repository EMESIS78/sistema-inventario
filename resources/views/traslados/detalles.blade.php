@extends('layouts.app')

@section('content')
<div class="container mx-auto py-6">
    <h2 class="text-2xl font-semibold mb-6">Detalles del Traslado #{{ $traslado->id_traslado }}</h2>
    <p><strong>Almacén de Salida:</strong> {{ $traslado->almacenSalida->nombre }}</p>
    <p><strong>Almacén de Entrada:</strong> {{ $traslado->almacenEntrada->nombre }}</p>
    <p><strong>Motivo:</strong> {{ $traslado->motivo }}</p>
    <p><strong>Usuario:</strong> {{ $traslado->usuario->name }}</p>
    <p><strong>Fecha:</strong> {{ $traslado->created_at }}</p>

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
