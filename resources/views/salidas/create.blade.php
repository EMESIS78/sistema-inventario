@extends('layouts.app')

@section('content')
<div class="container mx-auto py-6">
    <h2 class="text-2xl font-semibold mb-6">Registrar Nueva Salida</h2>

    <form action="{{ route('salidas.store') }}" method="POST">
        @csrf
        <div class="mb-4">
            <label for="id_almacen" class="block text-sm font-medium text-gray-700">Almacén de Salida:</label>
            <select name="id_almacen" id="id_almacen" class="block w-full mt-1 rounded border-gray-300 shadow-sm">
                @foreach($almacenes as $almacen)
                    <option value="{{ $almacen->id }}">{{ $almacen->nombre }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label for="motivo" class="block text-sm font-medium text-gray-700">Motivo:</label>
            <input type="text" name="motivo" id="motivo" class="block w-full mt-1 rounded border-gray-300 shadow-sm" required>
        </div>

        <div id="productos" class="space-y-4">
            <div class="producto flex space-x-4">
                <div class="flex-grow">
                    <label class="block text-sm font-medium text-gray-700">Producto:</label>
                    <select name="productos[0][id_articulo]" class="block w-full mt-1 rounded border-gray-300 shadow-sm">
                        @foreach($productos as $producto)
                            <option value="{{ $producto->nombre }}">{{ $producto->nombre }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Cantidad:</label>
                    <input type="number" name="productos[0][cantidad]" class="block w-full mt-1 rounded border-gray-300 shadow-sm" required>
                </div>
                <button type="button" class="text-red-500 remove-product">Eliminar</button>
            </div>
        </div>

        <button type="button" id="add-product" class="mt-4 bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded">Añadir Producto</button>
        <button type="submit" class="mt-4 bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">Registrar Salida</button>
    </form>
</div>

<script>
    let productIndex = 1;

    document.getElementById('add-product').addEventListener('click', () => {
        const container = document.createElement('div');
        container.classList.add('producto', 'flex', 'space-x-4', 'mt-4');
        container.innerHTML = `
            <div class="flex-grow">
                <label class="block text-sm font-medium text-gray-700">Producto:</label>
                <select name="productos[${productIndex}][id_articulo]" class="block w-full mt-1 rounded border-gray-300 shadow-sm">
                    @foreach($productos as $producto)
                        <option value="{{ $producto->nombre }}">{{ $producto->nombre }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Cantidad:</label>
                <input type="number" name="productos[${productIndex}][cantidad]" class="block w-full mt-1 rounded border-gray-300 shadow-sm" required>
            </div>
            <button type="button" class="text-red-500 remove-product">Eliminar</button>
        `;
        document.getElementById('productos').appendChild(container);
        productIndex++;
    });

    document.getElementById('productos').addEventListener('click', (event) => {
        if (event.target.classList.contains('remove-product')) {
            event.target.parentElement.remove();
        }
    });
</script>
@endsection
