@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h2 class="text-2xl font-semibold mb-6 text-center">Registrar Nueva Entrada</h2>

    <form action="{{ route('entradas.store') }}" method="POST">
        @csrf
        <div class="mb-4">
            <label for="id_almacen" class="block text-lg font-medium text-gray-700">Almacén de Ingreso:</label>
            <select name="id_almacen" id="id_almacen" class="block w-full mt-2 px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                @foreach($almacenes as $almacen)
                    <option value="{{ $almacen->id }}">{{ $almacen->nombre }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label for="documento" class="block text-lg font-medium text-gray-700">Documento (Boleta/Factura):</label>
            <input type="text" name="documento" id="documento" class="block w-full mt-2 px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" required>
        </div>

        <div class="mb-4">
            <label for="id_proveedor" class="block text-lg font-medium text-gray-700">Proveedor:</label>
            <input type="text" name="id_proveedor" id="id_proveedor" class="block w-full mt-2 px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" required>
        </div>

        <div id="productos" class="space-y-4">
            <div class="producto flex items-center space-x-4">
                <div class="w-1/2">
                    <label for="id_articulo" class="block text-lg font-medium text-gray-700">Producto:</label>
                    <input type="text" name="productos[0][id_articulo]" class="block w-full mt-2 px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" required>
                </div>
                <div class="w-1/4">
                    <label for="cantidad" class="block text-lg font-medium text-gray-700">Cantidad:</label>
                    <input type="number" name="productos[0][cantidad]" class="block w-full mt-2 px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" required>
                </div>
                <button type="button" id="add-product" class="ml-4 px-4 py-2 text-white bg-blue-500 rounded-md hover:bg-blue-600 focus:outline-none">Agregar Producto</button>
            </div>
        </div>

        <div class="mt-6">
            <button type="submit" class="px-6 py-3 w-full text-white bg-green-500 rounded-md hover:bg-green-600 focus:outline-none">Registrar Entrada</button>
        </div>
    </form>
</div>

<script>
    document.getElementById('add-product').addEventListener('click', function() {
        // Obtener el contenedor de los productos
        const productosContainer = document.getElementById('productos');

        // Contar cuántos productos existen actualmente
        const productosCount = productosContainer.getElementsByClassName('producto').length;

        // Crear nuevos campos para el producto
        const nuevoProducto = document.createElement('div');
        nuevoProducto.classList.add('producto', 'flex', 'items-center', 'space-x-4');

        // Contenido HTML para el nuevo producto
        nuevoProducto.innerHTML = `
            <div class="w-1/2">
                <label for="id_articulo" class="block text-lg font-medium text-gray-700">Producto:</label>
                <input type="text" name="productos[${productosCount}][id_articulo]" class="block w-full mt-2 px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" required>
            </div>
            <div class="w-1/4">
                <label for="cantidad" class="block text-lg font-medium text-gray-700">Cantidad:</label>
                <input type="number" name="productos[${productosCount}][cantidad]" class="block w-full mt-2 px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" required>
            </div>
            <button type="button" class="remove-product ml-4 px-4 py-2 text-white bg-red-500 rounded-md hover:bg-red-600 focus:outline-none">Eliminar Producto</button>
        `;

        // Añadir el nuevo producto al contenedor
        productosContainer.appendChild(nuevoProducto);

        // Agregar evento para eliminar el producto
        nuevoProducto.querySelector('.remove-product').addEventListener('click', function() {
            productosContainer.removeChild(nuevoProducto);
        });
    });
</script>
@endsection
