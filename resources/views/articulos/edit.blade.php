@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h2 class="text-2xl font-semibold mb-6">Editar Producto</h2>
    <form action="{{ route('articulos.update', $producto->id_producto) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-4">
            <label for="nombre" class="block text-sm font-medium">Nombre</label>
            <input type="text" name="nombre" id="nombre" value="{{ $producto->nombre }}" class="w-full border-gray-300 rounded-lg shadow-sm">
        </div>
        <div class="mb-4">
            <label for="marca" class="block text-sm font-medium">Marca</label>
            <input type="text" name="marca" id="marca" value="{{ $producto->marca }}" class="w-full border-gray-300 rounded-lg shadow-sm">
        </div>
        <div class="mb-4">
            <label for="unidad_medida" class="block text-sm font-medium">Unidad de Medida</label>
            <input type="text" name="unidad_medida" id="unidad_medida" value="{{ $producto->unidad_medida }}" class="w-full border-gray-300 rounded-lg shadow-sm">
        </div>
        <div class="mb-4">
            <label for="ubicacion" class="block text-sm font-medium">Ubicación</label>
            <input type="text" name="ubicacion" id="ubicacion" value="{{ $producto->ubicacion }}" class="w-full border-gray-300 rounded-lg shadow-sm">
        </div>
        <div class="flex justify-end">
            <a href="{{ route('articulos.index') }}" class="btn btn-secondary mr-2">Cancelar</a>
            <x-button type="submit" class="btn btn-primary bg-blue-600 text-white px-4 py-2 rounded-lg">Guardar</x-button>
        </div>
    </form>
</div>
@endsection
