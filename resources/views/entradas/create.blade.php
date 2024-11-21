@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h2 class="text-3xl font-bold text-gray-800 mb-6">Registrar Nueva Entrada</h2>

    <form action="{{ route('entradas.store') }}" method="POST" class="bg-white shadow-md rounded-lg p-6">
        @csrf
        <div class="mb-4">
            <label for="id_almacen" class="block text-sm font-medium text-gray-700">Almacén de Ingreso</label>
            <select name="id_almacen" id="id_almacen" class="mt-1 block w-full p-2 border border-gray-300 rounded-lg">
                @foreach($almacenes as $almacen)
                    <option value="{{ $almacen->id }}">{{ $almacen->nombre }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label for="documento" class="block text-sm font-medium text-gray-700">Documento (Boleta/Factura)</label>
            <input type="text" name="documento" id="documento" required
                class="mt-1 block w-full p-2 border border-gray-300 rounded-lg">
        </div>

        <div class="mb-4">
            <label for="id_proveedor" class="block text-sm font-medium text-gray-700">Proveedor</label>
            <input type="text" name="id_proveedor" id="id_proveedor" required
                class="mt-1 block w-full p-2 border border-gray-300 rounded-lg">
        </div>

        <div id="productos" class="mb-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-3">Productos</h3>
            <div class="producto flex space-x-4 items-center mb-4">
                <div class="flex-1">
                    <label for="productos[0][id_articulo]" class="block text-sm font-medium text-gray-700">Producto</label>
                    <input type="text" name="productos[0][id_articulo]" placeholder="Nombre del producto" required
                        class="mt-1 block w-full p-2 border border-gray-300 rounded-lg">
                </div>
                <div class="w-32">
                    <label for="productos[0][cantidad]" class="block text-sm font-medium text-gray-700">Cantidad</label>
                    <input type="number" name="productos[0][cantidad]" placeholder="0" required
                        class="mt-1 block w-full p-2 border border-gray-300 rounded-lg">
                </div>
                <button type="button" class="remove-product bg-red-500 text-white px-3 py-2 rounded-lg">
                    Eliminar
                </button>
            </div>
        </div>

        <button type="button" id="add-product" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">
            Añadir Producto
        </button>

        <div class="mt-6">
            <button type="submit"
                class="w-full bg-green-500 text-white py-3 rounded-lg hover:bg-green-600 font-semibold">
                Registrar Entrada
            </button>
        </div>
    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        let productIndex = 1;

        document.getElementById('add-product').addEventListener('click', function () {
            const container = document.getElementById('productos');
            const newProduct = document.createElement('div');
            newProduct.classList.add('producto', 'flex', 'space-x-4', 'items-center', 'mb-4');

            newProduct.innerHTML = `
                <div class="flex-1">
                    <label class="block text-sm font-medium text-gray-700">Producto</label>
                    <input type="text" name="productos[${productIndex}][id_articulo]" placeholder="Nombre del producto" required
                        class="mt-1 block w-full p-2 border border-gray-300 rounded-lg">
                </div>
                <div class="w-32">
                    <label class="block text-sm font-medium text-gray-700">Cantidad</label>
                    <input type="number" name="productos[${productIndex}][cantidad]" placeholder="0" required
                        class="mt-1 block w-full p-2 border border-gray-300 rounded-lg">
                </div>
                <button type="button" class="remove-product bg-red-500 text-white px-3 py-2 rounded-lg">
                    Eliminar
                </button>
            `;

            container.appendChild(newProduct);
            productIndex++;
        });

        document.getElementById('productos').addEventListener('click', function (e) {
            if (e.target.classList.contains('remove-product')) {
                e.target.parentElement.remove();
            }
        });
    });
</script>
@endsection
