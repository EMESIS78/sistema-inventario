@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-6">
        <!-- Título -->
        <h2 class="text-3xl font-bold text-gray-800 mb-6 flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 mr-3 text-indigo-600" fill="none" viewBox="0 0 24 24"
                stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M16 5l-4-4m0 0L8 5m4-4v20" />
            </svg>
            Editar Producto
        </h2>

        <!-- Formulario de edición -->
        <form action="{{ route('articulos.update', $producto->id_producto) }}" method="POST" enctype="multipart/form-data"
            class="bg-white p-6 rounded-lg shadow-md">
            @csrf
            @method('PUT')

            <!-- Campo: Código -->
            <div class="mb-4">
                <label for="codigo" class="block text-sm font-medium text-gray-700">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1 inline text-gray-500" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M8 16H6a2 2 0 01-2-2V8a2 2 0 012-2h2m8 12h2a2 2 0 002-2v-4a2 2 0 00-2-2h-2" />
                    </svg>
                    Código
                </label>
                <input type="text" name="codigo" id="codigo" value="{{ $producto->codigo }}"
                    class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
            </div>

            <!-- Campo: Nombre -->
            <div class="mb-4">
                <label for="nombre" class="block text-sm font-medium text-gray-700">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1 inline text-gray-500" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 7H9m0 0v10m0-10l3-3m0 16v-7m0 7l3-3" />
                    </svg>
                    Nombre
                </label>
                <input type="text" name="nombre" id="nombre" value="{{ $producto->nombre }}"
                    class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
            </div>

            <!-- Campo: Marca -->
            <div class="mb-4">
                <label for="marca" class="block text-sm font-medium text-gray-700">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1 inline text-gray-500" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6" />
                    </svg>
                    Marca
                </label>
                <input type="text" name="marca" id="marca" value="{{ $producto->marca }}"
                    class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
            </div>

            <!-- Campo: Unidad de Medida -->
            <div class="mb-4">
                <label for="unidad_medida" class="block text-sm font-medium text-gray-700">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1 inline text-gray-500" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14m-7-7v14" />
                    </svg>
                    Unidad de Medida
                </label>
                <select name="unidad_medida" id="unidad_medida"
                    class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                    <option value="UNIDAD" {{ $producto->unidad_medida === 'UNIDAD' ? 'selected' : '' }}>UNIDAD</option>
                    <option value="DOCENA" {{ $producto->unidad_medida === 'DOCENA' ? 'selected' : '' }}>DOCENA</option>
                    <option value="MILLAR" {{ $producto->unidad_medida === 'MILLAR' ? 'selected' : '' }}>MILLAR</option>
                    <option value="ROLLO" {{ $producto->unidad_medida === 'ROLLO' ? 'selected' : '' }}>ROLLO</option>
                    <option value="METRO" {{ $producto->unidad_medida === 'METRO' ? 'selected' : '' }}>METRO</option>
                    <option value="KILO" {{ $producto->unidad_medida === 'KILO' ? 'selected' : '' }}>KILO</option>
                    <option value="ETC" {{ $producto->unidad_medida === 'ETC' ? 'selected' : '' }}>ETC</option>
                </select>
            </div>

            <!-- Campo: Ubicación -->
            <div class="mb-4">
                <label for="ubicacion" class="block text-sm font-medium text-gray-700">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1 inline text-gray-500" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6" />
                    </svg>
                    Ubicación
                </label>
                <input type="text" name="ubicacion" id="ubicacion" value="{{ $producto->ubicacion }}"
                    class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
            </div>

            <!-- Campo: Imagen del Producto -->
            <div class="mb-4">
                <label for="imagen" class="block text-sm font-medium text-gray-700">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1 inline text-gray-500" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 8h16M4 16h16" />
                    </svg>
                    Imagen del Producto
                </label>
                @if ($producto->imagen)
                    <img src="{{ asset('storage/' . $producto->imagen) }}" alt="Imagen actual"
                        class="w-32 h-32 object-cover rounded-md mb-4 shadow-md">
                @endif
                <input type="file" name="imagen" id="imagen"
                    class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
            </div>

            <!-- Botones -->
            <div class="flex justify-end">
                <a href="{{ route('articulos.index') }}"
                    class="flex items-center px-4 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500 transition mr-2">
                    Cancelar
                </a>
                <button type="submit"
                    class="flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 transition">
                    Guardar
                </button>
            </div>
        </form>
    </div>
@endsection
