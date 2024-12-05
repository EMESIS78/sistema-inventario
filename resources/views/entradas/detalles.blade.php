@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-6">
        <!-- Título -->
        <h2 class="text-3xl font-bold text-gray-800 mb-6 flex items-center">
            <i class="fas fa-file-alt mr-3 text-indigo-600"></i> Detalles de Entrada #{{ $entrada->id_entrada }}
        </h2>

        <!-- Información general de la entrada -->
        <div class="bg-white shadow-md rounded-lg p-6 mb-6">
            <p class="text-lg mb-2"><strong>Documento:</strong> <i
                    class="fas fa-file-invoice mr-2 text-gray-600"></i>{{ $entrada->documento }}</p>
            <p class="text-lg mb-2"><strong>Almacén:</strong> <i
                    class="fas fa-warehouse mr-2 text-gray-600"></i>{{ $entrada->almacen->nombre }}</p>
            <p class="text-lg mb-2"><strong>Proveedor:</strong> <i
                    class="fas fa-truck mr-2 text-gray-600"></i>{{ $entrada->id_proveedor }}</p>
            <p class="text-lg mb-2"><strong>Fecha:</strong> <i
                    class="fas fa-calendar-alt mr-2 text-gray-600"></i>{{ $entrada->created_at->format('d-m-Y') }}</p>
        </div>

        <!-- Lista de productos -->
        <h3 class="text-2xl font-semibold text-gray-800 mb-4 flex items-center">
            <i class="fas fa-box-open mr-2 text-indigo-600"></i> Productos
        </h3>
        <div class="overflow-x-auto bg-white shadow-md rounded-lg">
            <table class="table-auto w-full text-sm text-left text-gray-600 border-collapse">
                <thead class="bg-gray-200 text-gray-800">
                    <tr>
                        <th class="px-6 py-3 border-b">Producto</th>
                        <th class="px-6 py-3 border-b">Cantidad</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($detalles as $detalle)
                        <tr class="hover:bg-gray-100">
                            <td class="px-6 py-4 border-b"><i
                                    class="fas fa-box mr-2 text-indigo-500"></i>{{ $detalle->producto }}</td>
                            <td class="px-6 py-4 border-b"><i
                                    class="fas fa-sort-numeric-up-alt mr-2 text-indigo-500"></i>{{ $detalle->cantidad }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Botón de volver -->
        <div class="mt-6">
            <a href="{{ route('entradas.index') }}"
                class="flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 transition">
                <i class="fas fa-arrow-left mr-2"></i> Volver a Entradas
            </a>
        </div>
    </div>
@endsection
