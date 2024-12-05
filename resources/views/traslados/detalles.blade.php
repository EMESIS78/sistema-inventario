@extends('layouts.app')

@section('content')
    <div class="container mx-auto py-6">
        <h2 class="text-3xl font-semibold mb-6 text-center text-indigo-700 flex items-center justify-center">
            <i class="fas fa-exchange-alt mr-3"></i> Detalles del Traslado #{{ $traslado->id_traslado }}
        </h2>

        <div class="bg-white shadow-md rounded-lg p-6 mb-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <p class="text-lg">
                    <strong class="text-indigo-700"><i class="fas fa-warehouse mr-2"></i> Almacén de Salida:</strong>
                    {{ $traslado->almacenSalida->nombre }}
                </p>
                <p class="text-lg">
                    <strong class="text-green-700"><i class="fas fa-warehouse mr-2"></i> Almacén de Entrada:</strong>
                    {{ $traslado->almacenEntrada->nombre }}
                </p>
                <p class="text-lg">
                    <strong class="text-yellow-700"><i class="fas fa-clipboard-list mr-2"></i> Motivo:</strong>
                    {{ $traslado->motivo }}
                </p>
                <p class="text-lg">
                    <strong class="text-gray-700"><i class="fas fa-user mr-2"></i> Usuario:</strong>
                    {{ $traslado->usuario->name }}
                </p>
                <p class="text-lg">
                    <strong class="text-blue-700"><i class="fas fa-calendar-alt mr-2"></i> Fecha:</strong>
                    {{ $traslado->created_at->format('d-m-Y H:i') }}
                </p>
            </div>
        </div>

        <h3 class="text-2xl font-semibold text-indigo-700 mb-4 flex items-center">
            <i class="fas fa-box mr-3"></i> Productos
        </h3>

        <div class="overflow-x-auto bg-white shadow-md rounded-lg">
            <table class="table-auto w-full text-sm text-gray-700 border-collapse">
                <thead class="bg-indigo-100 text-indigo-800">
                    <tr>
                        <th class="px-6 py-3 border-b">Producto</th>
                        <th class="px-6 py-3 border-b">Cantidad</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($detalles as $detalle)
                        <tr class="hover:bg-gray-100">
                            <td class="px-6 py-4 border-b">{{ $detalle->producto }}</td>
                            <td class="px-6 py-4 border-b">{{ $detalle->cantidad }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-6 text-right">
            <a href="{{ route('traslados.index') }}"
                class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-3 rounded-lg shadow-md flex items-center justify-center inline-block">
                <i class="fas fa-arrow-left mr-2"></i> Volver a Traslados
            </a>
        </div>
    </div>
@endsection
