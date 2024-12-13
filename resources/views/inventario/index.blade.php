@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h2 class="text-3xl font-bold text-gray-800 mb-6 flex items-center">
        <i class="fas fa-boxes mr-3 text-indigo-600"></i> Inventario
    </h2>

    <!-- Dropdown para seleccionar almacén -->
    <form method="GET" action="{{ route('inventario.index') }}" class="mb-6">
        <label for="almacen" class="block text-sm font-medium mb-2">Seleccionar Almacén:</label>
        <select name="almacen" id="almacen" onchange="this.form.submit()"
            class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
            @foreach ($almacenes as $almacen)
                <option value="{{ $almacen->id }}" {{ $almacen->id == $almacenSeleccionado ? 'selected' : '' }}>
                    {{ $almacen->nombre }}
                </option>
            @endforeach
        </select>
    </form>

    <!-- Grilla de productos -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach ($productos as $producto)
        <div class="bg-white p-4 rounded-lg shadow-md hover:shadow-xl transition-shadow">
            <h3 class="text-lg font-semibold text-gray-800 flex items-center">
                <i class="fas fa-box mr-2 text-indigo-600"></i> {{ $producto->nombre }}
            </h3>
            <p class="text-gray-600 mt-2 flex items-center">
                <i class="fas fa-warehouse mr-2 text-gray-500"></i> Stock: {{ $producto->stock }}
            </p>

            <!-- Botón para ajustar inventario -->
            <button onclick="toggleModal('modalAjustar{{ $producto->id_producto }}')"
                class="mt-4 flex items-center px-4 py-2 bg-yellow-500 text-white rounded-lg hover:bg-yellow-600 focus:outline-none focus:ring-2 focus:ring-yellow-500 transition">
                <i class="fas fa-tools mr-2"></i> Ajustar Inventario
            </button>

            <!-- Botón para consultar movimientos -->
            <a href="{{ route('inventario.movimientos', $producto->id_producto) }}"
                class="mt-4 flex items-center px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 transition">
                <i class="fas fa-history mr-2"></i> Consultar Movimientos
            </a>
        </div>

        <!-- Modal Ajustar Inventario -->
        <div id="modalAjustar{{ $producto->id_producto }}" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50">
            <div class="bg-white rounded-lg p-6 mx-auto mt-20 max-w-md shadow-xl transform scale-95 transition-transform">
                <h2 class="text-lg font-bold mb-4 text-yellow-600 flex items-center">
                    <i class="fas fa-tools mr-2"></i> Ajustar Inventario
                </h2>
                <form action="{{ route('inventario.ajustar', $producto->id_producto) }}" method="POST">
                    @csrf
                    <input type="hidden" name="id_almacen" value="{{ $almacenSeleccionado }}">

                    <label for="nuevo_stock" class="block text-sm font-medium">Nuevo Stock:</label>
                    <input type="number" name="nuevo_stock" id="nuevo_stock"
                        class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-yellow-500 focus:border-yellow-500 mt-2" min="0">

                    <label for="descripcion" class="block text-sm font-medium mt-4">Descripción del Ajuste:</label>
                    <input type="text" name="descripcion" id="descripcion"
                        class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-yellow-500 focus:border-yellow-500 mt-2">

                    <div class="flex justify-end mt-4">
                        <button type="button" onclick="toggleModal('modalAjustar{{ $producto->id_producto }}')"
                            class="flex items-center px-4 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500 transition mr-2">
                            <i class="fas fa-times mr-2"></i> Cancelar
                        </button>
                        <button type="submit"
                            class="flex items-center px-4 py-2 bg-green-500 text-white rounded-lg hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-500 transition">
                            <i class="fas fa-save mr-2"></i> Guardar
                        </button>
                    </div>
                </form>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Botón Generar Reporte -->
    <div class="flex space-x-4 mt-8">
        <a href="{{ route('inventario.reporte') }}"
            class="flex items-center px-6 py-3 bg-green-500 text-white rounded-lg hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-500 transition">
            <i class="fas fa-file-alt mr-2"></i> Generar Reporte de Inventario
        </a>
        <a href="{{ route('inventario.reporte_global') }}"
            class="flex items-center px-6 py-3 bg-green-500 text-white rounded-lg hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-500 transition">
            <i class="fas fa-globe mr-2"></i> Generar Reporte Global
        </a>
        <a href="{{ route('inventario.kardexvalorado') }}"
            class="flex items-center px-6 py-3 bg-green-500 text-white rounded-lg hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-500 transition">
            <i class="fas fa-globe mr-2"></i> Generar Reporte Kardex Valorado
        </a>
    </div>
</div>

<!-- Script para mostrar/ocultar modales -->
<script>
    function toggleModal(id) {
        const modal = document.getElementById(id);
        modal.classList.toggle('hidden');
    }
</script>
@endsection
