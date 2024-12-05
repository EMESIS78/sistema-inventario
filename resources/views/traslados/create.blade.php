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

            <div class="mb-4">
                <label for="guia" class="block text-sm font-medium text-gray-700">Número de Guía:</label>
                <input type="text" name="guia" id="guia"
                    class="block w-full mt-1 rounded border-gray-300 shadow-sm" required>
            </div>

            {{-- Motivo --}}
            <div class="mb-4">
                <label for="motivo" class="block text-sm font-medium text-gray-700">Motivo:</label>
                <input type="text" name="motivo" id="motivo"
                    class="block w-full mt-1 rounded border-gray-300 shadow-sm" value="{{ old('motivo') }}" required>
            </div>

            <div class="mb-4">
                <label for="placa_vehiculo" class="block text-sm font-medium text-gray-700">Placa del Vehículo:</label>
                <input type="text" name="placa_vehiculo" id="placa_vehiculo"
                    class="block w-full mt-1 rounded border-gray-300 shadow-sm" required>
            </div>

            {{-- Productos --}}
            <div id="productos" class="space-y-4">
                <div class="producto flex space-x-4">
                    <div class="flex-grow">
                        <label class="block text-sm font-medium text-gray-700">Código de Barras:</label>
                        <input type="text" name="productos[0][codigo]"
                            class="codigo-barra-input block w-full mt-1 rounded border-gray-300 shadow-sm"
                            placeholder="Escanea o ingresa el código de barras">
                    </div>
                    <div class="flex-grow">
                        <label class="block text-sm font-medium text-gray-700">Producto:</label>
                        <input type="text" name="productos[0][nombre]"
                            class="producto-nombre-input block w-full mt-1 rounded border-gray-300 shadow-sm" readonly>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Cantidad:</label>
                        <input type="number" name="productos[0][cantidad]"
                            class="cantidad-input block w-full mt-1 rounded border-gray-300 shadow-sm" required>
                    </div>
                    <button type="button" class="text-red-500 remove-product">Eliminar</button>
                    <input type="hidden" name="productos[0][id_articulo]" class="producto-id-input">
                </div>
            </div>

            <button type="button" id="add-product"
                class="mt-4 bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded">Añadir Producto</button>
            <button type="submit" class="mt-4 bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">Registrar
                Traslado</button>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const productosContainer = document.getElementById('productos');

            // Event delegation para manejar inputs dinámicos
            productosContainer.addEventListener('change', function(event) {
                if (event.target.classList.contains('codigo-barra-input')) {
                    const codigo = event.target.value;

                    if (codigo.trim() === '') return;

                    fetch('{{ route('productos.buscar.codigo') }}', {
                            method: 'POST', // IMPORTANTE: Debe coincidir con el método configurado en `web.php`
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            body: JSON.stringify({
                                codigo: codigo
                            }) // Los datos se envían en formato JSON
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                const productoInput = event.target.closest('.producto');
                                productoInput.querySelector('.producto-nombre-input').value = data
                                    .producto.nombre;
                                productoInput.querySelector('.producto-id-input').value = data.producto
                                    .id_producto; // Llenar id_articulo
                            } else {
                                alert(data.message);
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            alert('Ocurrió un error al buscar el producto.');
                        });
                }
            });

            let productIndex = {{ old('productos') ? count(old('productos')) : 1 }};

            // Añadir un producto más al formulario
            document.getElementById('add-product').addEventListener('click', () => {
                const container = document.createElement('div');
                container.classList.add('producto', 'flex', 'space-x-4', 'mt-4');
                container.innerHTML = `
            <div class="flex-grow">
                <label class="block text-sm font-medium text-gray-700">Código de Barras:</label>
                <input type="text" name="productos[${productIndex}][codigo]"
                    class="codigo-barra-input block w-full mt-1 rounded border-gray-300 shadow-sm"
                    placeholder="Escanea o ingresa el código de barras">
            </div>
            <div class="flex-grow">
                <label class="block text-sm font-medium text-gray-700">Producto:</label>
                <input type="text" name="productos[${productIndex}][nombre]"
                    class="producto-nombre-input block w-full mt-1 rounded border-gray-300 shadow-sm" readonly>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Cantidad:</label>
                <input type="number" name="productos[${productIndex}][cantidad]"
                    class="block w-full mt-1 rounded border-gray-300 shadow-sm" required>
            </div>
            <button type="button" class="text-red-500 remove-product">Eliminar</button>
            <input type="hidden" name="productos[${productIndex}][id_articulo]" class="producto-id-input">
        `;

                productosContainer.appendChild(container);
                productIndex++; // Incrementar el índice para el siguiente producto
            });

            // Eliminar un producto del formulario
            productosContainer.addEventListener('click', (event) => {
                if (event.target.classList.contains('remove-product')) {
                    event.target.closest('.producto').remove();
                }
            });
        });
    </script>
@endsection
