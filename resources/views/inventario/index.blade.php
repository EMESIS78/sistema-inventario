@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-6">
        <h2 class="text-2xl font-semibold mb-6">Inventario</h2>

        <!-- Dropdown para seleccionar almacén -->
        <form method="GET" action="{{ route('inventario.index') }}" class="mb-4">
            <label for="almacen" class="block text-sm font-medium">Seleccionar Almacén:</label>
            <select name="almacen" id="almacen" onchange="this.form.submit()"
                class="w-full border-gray-300 rounded-lg shadow-sm">
                @foreach ($almacenes as $almacen)
                    <option value="{{ $almacen->id }}" {{ $almacen->id == $almacenSeleccionado ? 'selected' : '' }}>
                        {{ $almacen->nombre }}
                    </option>
                @endforeach
            </select>
        </form>

        <!-- Grilla de productos -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($productos as $producto)
                <div class="bg-white p-4 rounded-lg shadow-md">
                    <h3 class="text-lg font-semibold">{{ $producto->nombre }}</h3>
                    <p class="text-gray-600">Stock: {{ $producto->stock }}</p>

                    <!-- Botón para ajustar inventario -->
                    <button onclick="toggleModal('modalAjustar{{ $producto->id_producto }}')"
                        class="bg-yellow-500 text-white px-4 py-2 rounded mt-4 hover:bg-yellow-600">
                        Ajustar Inventario
                    </button>

                    <!-- Botón para consultar movimientos -->
                    <a href="{{ route('inventario.movimientos', $producto->id_producto) }}"
                        class="bg-blue-500 text-black px-4 py-2 rounded mt-4 hover:bg-blue-600">
                        Consultar Movimientos
                    </a>
                </div>

                <!-- Modal Ajustar Inventario -->
                <div id="modalAjustar{{ $producto->id_producto }}" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50">
                    <div class="bg-white rounded-lg p-6 mx-auto mt-20 max-w-md">
                        <h2 class="text-lg font-semibold mb-4">Ajustar Inventario: {{ $producto->nombre }}</h2>
                        <form action="{{ route('inventario.ajustar', $producto->id_producto) }}" method="POST">
                            @csrf
                            <!-- Campo oculto para enviar el ID del almacén -->
                            <input type="hidden" name="id_almacen" value="{{ $almacenSeleccionado }}">

                            <label for="nuevo_stock" class="block text-sm font-medium">Nuevo Stock:</label>
                            <input type="number" name="nuevo_stock" id="nuevo_stock"
                                class="w-full border-gray-300 rounded-lg shadow-sm" min="0">

                            <label for="descripcion" class="block text-sm font-medium mt-4">Descripción del Ajuste:</label>
                            <input type="text" name="descripcion" id="descripcion"
                                class="w-full border-gray-300 rounded-lg shadow-sm">

                            <div class="flex justify-end mt-4">
                                <x-button type="button" onclick="toggleModal('modalAjustar{{ $producto->id_producto }}')"
                                    class="bg-gray-300 text-black px-4 py-2 rounded hover:bg-gray-400">
                                    Cancelar
                                </x-button>
                                <x-button type="submit"
                                    class="bg-green-500 text-white px-4 py-2 rounded ml-2 hover:bg-green-600">
                                    Guardar
                                </x-button>
                            </div>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Botón Generar Reporte -->
        <a href="{{ route('inventario.reporte') }}"
            class="bg-green-500 text-black px-6 py-3 rounded-lg mt-6 hover:bg-green-600 inline-block">
            Generar Reporte de Inventario
        </a>

        <a href="{{ route('inventario.reporte_global') }}"
            class="bg-green-500 text-black px-4 py-2 rounded hover:bg-green-600">
            Generar Reporte Global
        </a>
    </div>

    <!-- Script para mostrar/ocultar modales -->
    <script>
        function toggleModal(id) {
            const modal = document.getElementById(id);
            modal.classList.toggle('hidden');
        }
    </script>
@endsection
