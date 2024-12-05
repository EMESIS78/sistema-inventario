@extends('layouts.app')

@section('content')
    <div class="container mx-auto py-6">
        <!-- Título -->
        <h2 class="text-3xl font-bold mb-6 flex items-center text-gray-800">
            <i class="fas fa-dolly mr-3 text-indigo-600"></i> Registrar Nueva Salida
        </h2>

        <!-- Campo para buscar por documento -->
        <div class="mb-6">
            <label for="documento" class="block text-sm font-medium text-gray-700">
                <i class="fas fa-file-alt mr-2"></i> Documento:
            </label>
            <div class="flex items-center space-x-3 mt-2">
                <input type="text" name="documento" id="documento"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:outline-none"
                    placeholder="Número de Factura/Boleta/Pedido">
                <button type="button" id="buscar-documento"
                    class="flex items-center px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 transition">
                    <i class="fas fa-search mr-2"></i> Buscar
                </button>
            </div>
        </div>

        <!-- Detalle de la entrada -->
        <div id="detalle-entrada" class="mb-6 hidden">
            <h3 class="text-lg font-semibold mb-4">
                <i class="fas fa-info-circle mr-2 text-green-600"></i> Detalle de la Entrada:
            </h3>
            <table class="w-full border-collapse border border-gray-300">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="border border-gray-300 px-4 py-2">ID</th>
                        <th class="border border-gray-300 px-4 py-2">Artículo</th>
                        <th class="border border-gray-300 px-4 py-2">Cantidad</th>
                    </tr>
                </thead>
                <tbody id="detalle-tabla">
                    <!-- Aquí se llenará con los datos -->
                </tbody>
            </table>
        </div>

        <!-- Formulario para registrar salida -->
        <form action="{{ route('salidas.store') }}" method="POST" class="bg-white p-6 rounded-lg shadow-md">
            @csrf
            <div class="mb-4">
                <label for="id_almacen" class="block text-sm font-medium text-gray-700">
                    <i class="fas fa-warehouse mr-2"></i> Almacén de Salida:
                </label>
                <select name="id_almacen" id="id_almacen"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
                    @foreach ($almacenes as $almacen)
                        <option value="{{ $almacen->id }}">{{ $almacen->nombre }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label for="motivo" class="block text-sm font-medium text-gray-700">
                    <i class="fas fa-sticky-note mr-2"></i> Motivo:
                </label>
                <input type="text" name="motivo" id="motivo"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:outline-none"
                    required>
            </div>

            <div id="productos" class="space-y-4">
                <div class="producto flex space-x-4 items-center">
                    <div class="flex-grow">
                        <label class="block text-sm font-medium text-gray-700">
                            <i class="fas fa-box mr-2"></i> Producto:
                        </label>
                        <select name="productos[0][id_articulo]"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
                            @foreach ($productos as $producto)
                                <option value="{{ $producto->nombre }}">{{ $producto->nombre }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">
                            <i class="fas fa-sort-numeric-up-alt mr-2"></i> Cantidad:
                        </label>
                        <input type="number" name="productos[0][cantidad]"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:outline-none"
                            required>
                    </div>
                    <button type="button"
                        class="text-red-500 hover:text-red-600 transition focus:outline-none remove-product">
                        <i class="fas fa-trash-alt"></i>
                    </button>
                </div>
            </div>

            <div class="mt-6 flex space-x-4">
                <button type="button" id="add-product"
                    class="flex items-center px-4 py-2 bg-green-500 text-white rounded-lg hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-500 transition">
                    <i class="fas fa-plus mr-2"></i> Añadir Producto
                </button>
                <button type="submit"
                    class="flex items-center px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 transition">
                    <i class="fas fa-save mr-2"></i> Registrar Salida
                </button>
            </div>
        </form>
    </div>

    <script>
        let productIndex = 1;

        document.getElementById('add-product').addEventListener('click', () => {
            const container = document.createElement('div');
            container.classList.add('producto', 'flex', 'space-x-4', 'items-center', 'mt-4');
            container.innerHTML = `
                <div class="flex-grow">
                    <label class="block text-sm font-medium text-gray-700">
                        <i class="fas fa-box mr-2"></i> Producto:
                    </label>
                    <select name="productos[${productIndex}][id_articulo]"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
                        @foreach ($productos as $producto)
                            <option value="{{ $producto->nombre }}">{{ $producto->nombre }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">
                        <i class="fas fa-sort-numeric-up-alt mr-2"></i> Cantidad:
                    </label>
                    <input type="number" name="productos[${productIndex}][cantidad]"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:outline-none"
                        required>
                </div>
                <button type="button"
                    class="text-red-500 hover:text-red-600 transition focus:outline-none remove-product">
                    <i class="fas fa-trash-alt"></i>
                </button>
            `;
            document.getElementById('productos').appendChild(container);
            productIndex++;
        });

        document.getElementById('productos').addEventListener('click', (event) => {
            if (event.target.classList.contains('remove-product')) {
                event.target.parentElement.remove();
            }
        });

        document.getElementById('buscar-documento').addEventListener('click', async () => {
            const documento = document.getElementById('documento').value;

            if (!documento.trim()) {
                alert('Por favor, ingresa un número de documento.');
                return;
            }

            try {
                const response = await fetch(`/salidas/buscar-detalle`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    },
                    body: JSON.stringify({ documento }),
                });

                const data = await response.json();

                if (data.success) {
                    const detalleTabla = document.getElementById('detalle-tabla');
                    detalleTabla.innerHTML = '';

                    data.data.forEach(item => {
                        const row = `
                            <tr>
                                <td class="border border-gray-300 px-4 py-2">${item.id_articulo}</td>
                                <td class="border border-gray-300 px-4 py-2">${item.articulo}</td>
                                <td class="border border-gray-300 px-4 py-2">${item.cantidad}</td>
                            </tr>
                        `;
                        detalleTabla.innerHTML += row;
                    });

                    document.getElementById('detalle-entrada').classList.remove('hidden');
                } else {
                    alert(data.message);
                }
            } catch (error) {
                console.error('Error al buscar el documento:', error);
                alert('Error al buscar el documento.');
            }
        });
    </script>
@endsection
