@extends('layouts.app')

@section('content')
    <div class="container mx-auto py-6">
        <h2 class="text-2xl font-semibold mb-6">Registrar Nuevo Traslado</h2>

        <!-- Mostrar errores de validación -->
        @if ($errors->any())
            <div class="alert alert-danger bg-red-200 text-red-700 p-4 rounded mb-4">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('traslados.store') }}" method="POST">
            @csrf

            {{-- Almacén de salida --}}
            <div class="mb-4">
                <label for="id_almacen_salida" class="block text-sm font-medium text-gray-700">Almacén de Salida:</label>
                <select name="id_almacen_salida" id="id_almacen_salida"
                    class="block w-full mt-1 rounded border-gray-300 shadow-sm">
                    @foreach ($almacenes as $almacen)
                        <option value="{{ $almacen->id }}"
                            {{ old('id_almacen_salida') == $almacen->id ? 'selected' : '' }}>
                            {{ $almacen->nombre }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Almacén de entrada --}}
            <div class="mb-4">
                <label for="id_almacen_entrada" class="block text-sm font-medium text-gray-700">Almacén de Entrada:</label>
                <select name="id_almacen_entrada" id="id_almacen_entrada"
                    class="block w-full mt-1 rounded border-gray-300 shadow-sm">
                    @foreach ($almacenes as $almacen)
                        <option value="{{ $almacen->id }}"
                            {{ old('id_almacen_entrada') == $almacen->id ? 'selected' : '' }}>
                            {{ $almacen->nombre }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Motivo --}}
            <div class="mb-4">
                <label for="motivo" class="block text-sm font-medium text-gray-700">Motivo:</label>
                <input type="text" name="motivo" id="motivo"
                    class="block w-full mt-1 rounded border-gray-300 shadow-sm" value="{{ old('motivo') }}" required>
            </div>

            {{-- Productos --}}
            <div id="productos" class="space-y-4">
                @if (old('productos'))
                    @foreach (old('productos') as $index => $producto)
                        <div class="producto flex space-x-4 mt-4">
                            <div class="flex-grow">
                                <label class="block text-sm font-medium text-gray-700">Producto:</label>
                                <select name="productos[{{ $index }}][id_articulo]"
                                    class="block w-full mt-1 rounded border-gray-300 shadow-sm">
                                    @foreach ($productos as $prod)
                                        <option value="{{ $prod->id }}"
                                            {{ $prod->id == $producto['id_articulo'] ? 'selected' : '' }}>
                                            {{ $prod->nombre }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Cantidad:</label>
                                <input type="number" name="productos[{{ $index }}][cantidad]"
                                    value="{{ $producto['cantidad'] }}"
                                    class="block w-full mt-1 rounded border-gray-300 shadow-sm" required>
                            </div>
                            <button type="button" class="text-red-500 remove-product">Eliminar</button>
                        </div>
                    @endforeach
                @else
                    <div class="producto flex space-x-4">
                        <div class="flex-grow">
                            <label class="block text-sm font-medium text-gray-700">Producto:</label>
                            <select name="productos[0][id_articulo]"
                                class="block w-full mt-1 rounded border-gray-300 shadow-sm">
                                @foreach ($productos as $producto)
                                    <option value="{{ $producto->id_producto }}">{{ $producto->nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Cantidad:</label>
                            <input type="number" name="productos[0][cantidad]"
                                class="block w-full mt-1 rounded border-gray-300 shadow-sm" required>
                        </div>
                        <button type="button" class="text-red-500 remove-product">Eliminar</button>
                    </div>
                @endif
            </div>

            <button type="button" id="add-product"
                class="mt-4 bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded">Añadir Producto</button>
            <button type="submit" class="mt-4 bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">Registrar
                Traslado</button>
        </form>
    </div>

    <script>
        let productIndex = {{ old('productos') ? count(old('productos')) : 1 }};

        // Añadir un producto más al formulario
        document.getElementById('add-product').addEventListener('click', () => {
            const container = document.createElement('div');
            container.classList.add('producto', 'flex', 'space-x-4', 'mt-4');
            container.innerHTML = `
        <div class="flex-grow">
            <label class="block text-sm font-medium text-gray-700">Producto:</label>
            <select name="productos[${productIndex}][id_articulo]" class="block w-full mt-1 rounded border-gray-300 shadow-sm" required>
                <option value="" selected disabled>Seleccionar producto</option>
                @foreach ($productos as $producto)
                    <option value="{{ $producto->id_producto }}">{{ $producto->nombre }}</option>
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
            productIndex++; // Incrementar el índice para el siguiente producto
        });

        // Eliminar un producto del formulario
        document.getElementById('productos').addEventListener('click', (event) => {
            if (event.target.classList.contains('remove-product')) {
                event.target.parentElement.remove();
            }
        });
    </script>
@endsection
