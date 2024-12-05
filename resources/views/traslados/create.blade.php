@extends('layouts.app')

@section('content')
    <div class="container mx-auto py-6">
        <h2 class="text-3xl font-semibold mb-6 text-center flex items-center justify-center text-indigo-700">
            <i class="fas fa-exchange-alt mr-3"></i> Registrar Nuevo Traslado
        </h2>

        <!-- Mostrar errores de validación -->
        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg mb-6">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li class="list-disc ml-4">{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('traslados.store') }}" method="POST" class="bg-white shadow-md rounded-lg p-6">
            @csrf

            <!-- Almacén de salida -->
            <div class="mb-4">
                <label for="id_almacen_salida" class="block text-sm font-medium text-gray-700">
                    <i class="fas fa-warehouse mr-1 text-indigo-500"></i> Almacén de Salida:
                </label>
                <select name="id_almacen_salida" id="id_almacen_salida"
                    class="block w-full mt-1 p-2 border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-indigo-500">
                    @foreach ($almacenes as $almacen)
                        <option value="{{ $almacen->id }}"
                            {{ old('id_almacen_salida') == $almacen->id ? 'selected' : '' }}>
                            {{ $almacen->nombre }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Almacén de entrada -->
            <div class="mb-4">
                <label for="id_almacen_entrada" class="block text-sm font-medium text-gray-700">
                    <i class="fas fa-warehouse mr-1 text-green-500"></i> Almacén de Entrada:
                </label>
                <select name="id_almacen_entrada" id="id_almacen_entrada"
                    class="block w-full mt-1 p-2 border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-green-500">
                    @foreach ($almacenes as $almacen)
                        <option value="{{ $almacen->id }}"
                            {{ old('id_almacen_entrada') == $almacen->id ? 'selected' : '' }}>
                            {{ $almacen->nombre }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Número de Guía -->
            <div class="mb-4">
                <label for="guia" class="block text-sm font-medium text-gray-700">
                    <i class="fas fa-file-alt mr-1 text-blue-500"></i> Número de Guía:
                </label>
                <input type="text" name="guia" id="guia"
                    class="block w-full mt-1 p-2 border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500"
                    required>
            </div>

            <!-- Motivo -->
            <div class="mb-4">
                <label for="motivo" class="block text-sm font-medium text-gray-700">
                    <i class="fas fa-sticky-note mr-1 text-yellow-500"></i> Motivo:
                </label>
                <input type="text" name="motivo" id="motivo"
                    class="block w-full mt-1 p-2 border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-yellow-500"
                    value="{{ old('motivo') }}" required>
            </div>

            <!-- Placa del Vehículo -->
            <div class="mb-4">
                <label for="placa_vehiculo" class="block text-sm font-medium text-gray-700">
                    <i class="fas fa-car-side mr-1 text-gray-500"></i> Placa del Vehículo:
                </label>
                <input type="text" name="placa_vehiculo" id="placa_vehiculo"
                    class="block w-full mt-1 p-2 border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-gray-500"
                    required>
            </div>

            <!-- Productos -->
            <div id="productos" class="space-y-6">
                <div class="producto flex space-x-4 items-center bg-gray-50 p-4 rounded-lg shadow">
                    <div class="flex-grow">
                        <label class="block text-sm font-medium text-gray-700">
                            <i class="fas fa-barcode mr-1"></i> Código de Barras:
                        </label>
                        <input type="text" name="productos[0][codigo]"
                            class="codigo-barra-input block w-full mt-1 p-2 border-gray-300 rounded-lg shadow-sm"
                            placeholder="Escanea o ingresa el código de barras">
                    </div>
                    <div class="flex-grow">
                        <label class="block text-sm font-medium text-gray-700">
                            <i class="fas fa-box mr-1"></i> Producto:
                        </label>
                        <input type="text" name="productos[0][nombre]"
                            class="producto-nombre-input block w-full mt-1 p-2 border-gray-300 rounded-lg shadow-sm"
                            readonly>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">
                            <i class="fas fa-sort-numeric-up-alt mr-1"></i> Cantidad:
                        </label>
                        <input type="number" name="productos[0][cantidad]"
                            class="cantidad-input block w-full mt-1 p-2 border-gray-300 rounded-lg shadow-sm" required>
                    </div>
                    <button type="button"
                        class="text-red-500 hover:text-red-700 focus:outline-none transition transform hover:scale-110">
                        <i class="fas fa-trash"></i>
                    </button>
                    <input type="hidden" name="productos[0][id_articulo]" class="producto-id-input">
                </div>
            </div>

            <!-- Botones -->
            <div class="mt-6 flex justify-end space-x-4">
                <button type="button" id="add-product"
                    class="bg-green-500 text-white px-4 py-2 rounded-lg shadow hover:bg-green-600 focus:ring-2 focus:ring-green-500 flex items-center">
                    <i class="fas fa-plus mr-2"></i> Añadir Producto
                </button>
                <button type="submit"
                    class="bg-blue-500 text-white px-4 py-2 rounded-lg shadow hover:bg-blue-600 focus:ring-2 focus:ring-blue-500 flex items-center">
                    <i class="fas fa-save mr-2"></i> Registrar Traslado
                </button>
            </div>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const productosContainer = document.getElementById('productos');
            let productIndex = {{ old('productos') ? count(old('productos')) : 1 }};

            // Añadir producto dinámico
            document.getElementById('add-product').addEventListener('click', () => {
                const container = document.createElement('div');
                container.classList.add('producto', 'flex', 'space-x-4', 'items-center', 'bg-gray-50', 'p-4', 'rounded-lg', 'shadow');
                container.innerHTML = `
                <div class="flex-grow">
                    <label class="block text-sm font-medium text-gray-700"><i class="fas fa-barcode mr-1"></i> Código de Barras:</label>
                    <input type="text" name="productos[${productIndex}][codigo]"
                        class="codigo-barra-input block w-full mt-1 p-2 border-gray-300 rounded-lg shadow-sm"
                        placeholder="Escanea o ingresa el código de barras">
                </div>
                <div class="flex-grow">
                    <label class="block text-sm font-medium text-gray-700"><i class="fas fa-box mr-1"></i> Producto:</label>
                    <input type="text" name="productos[${productIndex}][nombre]"
                        class="producto-nombre-input block w-full mt-1 p-2 border-gray-300 rounded-lg shadow-sm" readonly>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700"><i class="fas fa-sort-numeric-up-alt mr-1"></i> Cantidad:</label>
                    <input type="number" name="productos[${productIndex}][cantidad]"
                        class="block w-full mt-1 p-2 border-gray-300 rounded-lg shadow-sm" required>
                </div>
                <button type="button" class="text-red-500 hover:text-red-700 focus:outline-none transition transform hover:scale-110">
                    <i class="fas fa-trash"></i>
                </button>
                <input type="hidden" name="productos[${productIndex}][id_articulo]" class="producto-id-input">
            `;
                productosContainer.appendChild(container);
                productIndex++;
            });

            // Eliminar producto
            productosContainer.addEventListener('click', (event) => {
                if (event.target.closest('button')?.classList.contains('text-red-500')) {
                    event.target.closest('.producto').remove();
                }
            });
        });
    </script>
@endsection
