@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-6">
        <h2 class="text-3xl font-bold text-gray-800 mb-6 flex items-center">
            <i class="fas fa-chart-line mr-3 text-indigo-600"></i> Movimientos del Producto: <span
                class="ml-2 text-gray-700">{{ $producto->nombre }}</span>
        </h2>

        <div class="overflow-x-auto">
            <table class="w-full border-collapse border border-gray-300 shadow-md rounded-lg">
                <thead class="bg-indigo-600 text-white">
                    <tr>
                        <th class="border border-gray-300 px-6 py-3 text-left">Tipo</th>
                        <th class="border border-gray-300 px-6 py-3 text-left">Fecha</th>
                        <th class="border border-gray-300 px-6 py-3 text-left">Cantidad</th>
                        <th class="border border-gray-300 px-6 py-3 text-left">Almacén</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($movimientos as $movimiento)
                        <tr class="hover:bg-gray-100 transition">
                            <td class="border border-gray-300 px-6 py-3 text-gray-700 flex items-center">
                                <i
                                    class="{{ $movimiento->tipo == 'Entrada' ? 'fas fa-arrow-down text-green-500 mr-2' : 'fas fa-arrow-up text-red-500 mr-2' }}"></i>
                                {{ $movimiento->tipo }}
                            </td>
                            <td class="border border-gray-300 px-6 py-3 text-gray-700">{{ $movimiento->fecha }}</td>
                            <td class="border border-gray-300 px-6 py-3 text-gray-700">{{ $movimiento->cantidad }}</td>
                            <td class="border border-gray-300 px-6 py-3 text-gray-700">{{ $movimiento->nombre_almacen }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="border border-gray-300 text-center py-6 text-gray-600">
                                <i class="fas fa-info-circle text-indigo-500 mr-2"></i> No hay movimientos registrados para
                                este producto.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-8 flex justify-center">
            <a href="{{ route('inventario.reporte_global') }}"
                class="flex items-center bg-blue-500 text-white px-6 py-3 rounded-lg hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 transition">
                <i class="fas fa-arrow-left mr-2"></i> Volver al Reporte Global
            </a>
        </div>
    </div>
@endsection
