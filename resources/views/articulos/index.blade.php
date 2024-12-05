@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-6">
        <!-- Título -->
        <h2 class="text-3xl font-bold text-gray-800 mb-6 flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 mr-3 text-indigo-600" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M20 13V16a2 2 0 01-2 2H6a2 2 0 01-2-2V8a2 2 0 012-2h3M8 3h8m-4 0v5" />
            </svg>
            Gestión de Artículos
        </h2>

        <!-- Barra de búsqueda y botón de añadir artículo -->
        <div class="mb-6 flex justify-between items-center">
            <form action="{{ route('articulos.index') }}" method="GET" class="flex items-center space-x-3">
                <div class="relative w-96">
                    <input type="text" name="search" id="search" value="{{ request('search') }}"
                        class="block w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                        placeholder="Buscar artículo por nombre, marca o código...">
                    <span class="absolute left-3 top-2.5 text-gray-500">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M10 14l2-2m0 0l2-2m-2 2h.01M19 7l-7 7-4-4" />
                        </svg>
                    </span>
                </div>
                <button type="submit"
                    class="flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M10 14l2-2m0 0l2-2m-2 2h.01M19 7l-7 7-4-4" />
                    </svg>
                    Buscar
                </button>
            </form>
            @if (auth()->user()->rol === 'admin' || auth()->user()->rol === 'supervisor')
                <button onclick="toggleModal('addProductoModal')"
                    class="flex items-center px-6 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                    </svg>
                    Añadir Artículo
                </button>
            @endif
        </div>

        <!-- Listado de productos -->
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @foreach ($productos as $producto)
                <div
                    class="bg-gradient-to-r from-gray-50 to-gray-100 p-4 rounded-lg shadow-md hover:shadow-lg transform hover:-translate-y-1 transition duration-200">
                    @if ($producto->imagen)
                        <img src="{{ asset('storage/' . $producto->imagen) }}" alt="{{ $producto->nombre }}"
                            class="w-full h-32 object-cover rounded-md mb-4">
                    @else
                        <div
                            class="w-full h-32 bg-gray-200 rounded-md flex items-center justify-center text-gray-500 text-sm font-semibold">
                            Sin Imagen
                        </div>
                    @endif
                    <h3 class="text-lg font-semibold text-gray-800 truncate mb-2 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-indigo-500" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M20 13V16a2 2 0 01-2 2H6a2 2 0 01-2-2V8a2 2 0 012-2h3m2-5v5" />
                        </svg>
                        {{ $producto->nombre }}
                    </h3>
                    <p class="text-sm text-gray-600"><span class="font-semibold">Marca:</span> {{ $producto->marca }}</p>
                    <p class="text-sm text-gray-600"><span class="font-semibold">Código:</span> {{ $producto->codigo }}</p>
                    <p class="text-sm text-gray-600"><span class="font-semibold">Unidad:</span>
                        {{ $producto->unidad_medida }}</p>
                    <p class="text-sm text-gray-600"><span class="font-semibold">Ubicación:</span>
                        {{ $producto->ubicacion ?? 'No especificada' }}</p>
                    <div class="flex justify-between items-center mt-4">
                        @if (auth()->user()->rol === 'admin' || auth()->user()->rol === 'supervisor')
                            <a href="{{ route('articulos.edit', $producto->id_producto) }}"
                                class="flex items-center text-yellow-600 hover:text-yellow-700 transition">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M15.232 5.232l3.536 3.536M16.293 4.293a1 1 0 011.414 0L21 7.586a1 1 0 010 1.414l-9 9a1 1 0 01-.464.263l-4 1a1 1 0 01-1.263-1.263l1-4a1 1 0 01.263-.464l9-9z" />
                                </svg>
                                Actualizar
                            </a>
                            <form action="{{ route('articulos.destroy', $producto->id_producto) }}" method="POST"
                                class="flex items-center text-red-600 hover:text-red-700 transition">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('¿Estás seguro de eliminar este artículo?')"
                                    class="flex items-center focus:outline-none">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-7 7-7-7" />
                                    </svg>
                                    Eliminar
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Paginación -->
        <div class="mt-6">
            {{ $productos->links() }}
        </div>

        <!-- Modal para añadir artículo -->
        <div id="addProductoModal"
            class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 hidden transition-opacity">
            <div class="bg-white rounded-lg p-6 w-full max-w-lg transform transition-transform scale-95">
                <h2 class="text-lg font-bold mb-4 flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2 text-green-600" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                    </svg>
                    Añadir Producto
                </h2>
                <form action="{{ route('articulos.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-4">
                        <label for="codigo" class="block text-sm font-medium text-gray-700">Código</label>
                        <input type="text" name="codigo" id="codigo"
                            class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                    </div>
                    <div class="mb-4">
                        <label for="nombre" class="block text-sm font-medium text-gray-700">Nombre</label>
                        <input type="text" name="nombre" id="nombre"
                            class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                    </div>
                    <div class="mb-4">
                        <label for="marca" class="block text-sm font-medium text-gray-700">Marca</label>
                        <input type="text" name="marca" id="marca"
                            class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                    </div>
                    <div class="mb-4">
                        <label for="unidad_medida" class="block text-sm font-medium text-gray-700">Unidad de
                            Medida</label>
                        <select name="unidad_medida" id="unidad_medida"
                            class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                            <option value="UNIDAD">UNIDAD</option>
                            <option value="DOCENA">DOCENA</option>
                            <option value="MILLAR">MILLAR</option>
                            <option value="ROLLO">ROLLO</option>
                            <option value="METRO">METRO</option>
                            <option value="KILO">KILO</option>
                            <option value="CAJA">CAJA</option>
                            <option value="BOLSA">BOLSA</option>
                            <option value="LITRO">LITRO</option>
                        </select>
                    </div>
                    <div class="mb-4">
                        <label for="ubicacion" class="block text-sm font-medium text-gray-700">Ubicación
                            (opcional)</label>
                        <input type="text" name="ubicacion" id="ubicacion"
                            class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                    </div>
                    <div class="mb-4">
                        <label for="imagen" class="block text-sm font-medium text-gray-700">Imagen del Producto</label>
                        <input type="file" name="imagen" id="imagen"
                            class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                    </div>
                    <div class="flex justify-end">
                        <button type="button" onclick="toggleModal('addProductoModal')"
                            class="px-4 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500 mr-2">
                            Cancelar
                        </button>
                        <button type="submit"
                            class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            Guardar
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function toggleModal(id) {
            const modal = document.getElementById(id);
            if (modal.classList.contains('hidden')) {
                modal.classList.remove('hidden');
                modal.classList.add('scale-100');
            } else {
                modal.classList.add('hidden');
                modal.classList.remove('scale-100');
            }
        }
    </script>
@endsection
