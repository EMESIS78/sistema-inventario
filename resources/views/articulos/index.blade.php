@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <!-- Título del formulario -->
    <h2 class="text-2xl font-semibold mb-6">Gestión de Artículos</h2>

    <!-- Cuadro de búsqueda y botón de añadir artículo -->
    <div class="mb-6 flex justify-between items-center">
        <div class="relative">
            <input
                type="text"
                id="search"
                class="block w-96 pl-10 pr-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                placeholder="Buscar artículo por nombre, marca...">
            <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-500">
                <i class="fas fa-search"></i>
            </span>
        </div>
        <!-- Botón para abrir el modal -->
        <x-button
            onclick="toggleModal('addProductoModal')"
            class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
            Añadir Artículo
        </x-button>
    </div>

    <!-- Listado de productos -->
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        @foreach($productos as $producto)
        <div class="bg-white p-4 rounded-lg shadow-md hover:shadow-xl transition-shadow">
            @if ($producto->imagen)
                <img src="{{ asset('storage/' . $producto->imagen) }}" alt="{{ $producto->nombre }}" class="w-full h-32 object-cover rounded-md mb-4">
            @else
                <div class="w-full h-32 bg-gray-200 rounded-md flex items-center justify-center text-gray-500">
                    Sin Imagen
                </div>
            @endif
            <div class="flex justify-between items-center">
                <h3 class="text-lg font-semibold text-gray-800">{{ $producto->nombre }}</h3>
            </div>
            <p class="text-sm text-gray-600 mt-2">Marca: {{ $producto->marca }}</p>
            <p class="text-sm text-gray-600">Unidad: {{ $producto->unidad_medida }}</p>
            <p class="text-sm text-gray-600">Ubicación: {{ $producto->ubicacion ?? 'No especificada' }}</p>

            <div class="flex justify-between items-center mt-4">
                <a href="{{ route('articulos.edit', $producto->id_producto) }}" class="text-yellow-600 hover:text-yellow-700">
                    <i class="fas fa-edit"></i> Actualizar
                </a>
                <form action="{{ route('articulos.destroy', $producto->id_producto) }}" method="POST" class="text-red-600 hover:text-red-700">
                    @csrf
                    @method('DELETE')
                    <button type="submit" onclick="return confirm('¿Estás seguro de eliminar este artículo?')" class="focus:outline-none">
                        <i class="fas fa-trash"></i> Eliminar
                    </button>
                </form>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Paginación de productos -->
    <div class="mt-6">
        {{ $productos->links() }}
    </div>
</div>

<!-- Modal para añadir artículo -->
<div id="addProductoModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 hidden">
    <div class="bg-white rounded-lg p-6 w-full max-w-lg">
        <h2 class="text-lg font-bold mb-4">Añadir Producto</h2>
        <form action="{{ route('articulos.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-4">
                <label for="nombre" class="block text-sm font-medium">Nombre</label>
                <input type="text" name="nombre" id="nombre" class="w-full border-gray-300 rounded-lg shadow-sm">
            </div>
            <div class="mb-4">
                <label for="marca" class="block text-sm font-medium">Marca</label>
                <input type="text" name="marca" id="marca" class="w-full border-gray-300 rounded-lg shadow-sm">
            </div>
            <div class="mb-4">
                <label for="unidad_medida" class="block text-sm font-medium">Unidad de Medida</label>
                <input type="text" name="unidad_medida" id="unidad_medida" class="w-full border-gray-300 rounded-lg shadow-sm">
            </div>
            <div class="mb-4">
                <label for="ubicacion" class="block text-sm font-medium">Ubicación (opcional)</label>
                <input type="text" name="ubicacion" id="ubicacion" class="w-full border-gray-300 rounded-lg shadow-sm">
            </div>
            <div class="mb-4">
                <label for="imagen" class="block text-sm font-medium">Imagen del Producto</label>
                <input type="file" name="imagen" id="imagen" class="w-full border-gray-300 rounded-lg shadow-sm">
            </div>
            <div class="flex justify-end">
                <x-button type="button" class="btn btn-secondary mr-2" onclick="toggleModal('addProductoModal')">Cancelar</x-button>
                <x-button type="submit" class="btn btn-primary bg-blue-600 text-white px-4 py-2 rounded-lg">Guardar</x-button>
            </div>
        </form>
    </div>
</div>

<!-- Script para manejar el modal -->
<script>
    function toggleModal(id) {
        const modal = document.getElementById(id);
        modal.classList.toggle('hidden');
    }
</script>
@endsection
