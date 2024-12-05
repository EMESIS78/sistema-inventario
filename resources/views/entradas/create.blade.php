@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <h2 class="text-3xl font-bold text-gray-800 mb-6">Registrar Nueva Entrada</h2>

        <form action="{{ route('entradas.store') }}" method="POST" class="bg-white shadow-md rounded-lg p-6">
            @csrf
            <div class="mb-4">
                <label for="id_almacen" class="block text-sm font-medium text-gray-700">Almacén de Ingreso</label>
                <select name="id_almacen" id="id_almacen" class="mt-1 block w-full p-2 border border-gray-300 rounded-lg">
                    @foreach ($almacenes as $almacen)
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
                <label for="id_proveedor" class="block text-sm font-medium text-gray-700">Proveedor (RUC)</label>
                <div class="flex">
                    <input type="text" name="id_proveedor" id="id_proveedor" required
                        class="block w-full p-2 border border-gray-300 rounded-l-lg">
                    <button type="button" id="buscar-proveedor"
                        class="bg-blue-500 text-white px-4 py-2 rounded-r-lg">Buscar</button>
                </div>
            </div>

            <div id="resultado-proveedor" class="text-sm text-gray-700 mt-2 hidden">
                <strong>Razón Social:</strong> <span id="razon-social"></span>
            </div>

            <div id="productos" class="mb-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-3">Productos</h3>
                <div class="producto flex space-x-4 items-center mb-4">
                    <div class="flex-1">
                        <label class="block text-sm font-medium text-gray-700">Código de Barras</label>
                        <input type="text" name="productos[0][codigo]" placeholder="Código de barras"
                            class="codigo-barra-input mt-1 block w-full p-2 border border-gray-300 rounded-lg">
                    </div>
                    <div class="flex-1">
                        <label class="block text-sm font-medium text-gray-700">Producto</label>
                        <input type="text" name="productos[0][id_articulo]" placeholder="Nombre del producto"
                            class="producto-nombre-input mt-1 block w-full p-2 border border-gray-300 rounded-lg">
                    </div>
                    <div class="w-32">
                        <label class="block text-sm font-medium text-gray-700">Cantidad</label>
                        <input type="number" name="productos[0][cantidad]" placeholder="0" required
                            class="mt-1 block w-full p-2 border border-gray-300 rounded-lg">
                    </div>
                    <button type="button"
                        class="remove-product bg-red-500 text-white px-3 py-2 rounded-lg">Eliminar</button>
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
        document.addEventListener('DOMContentLoaded', function() {
            const productosContainer = document.getElementById('productos');
            let productIndex = 1;

            // Event delegation para manejar productos dinámicos
            productosContainer.addEventListener('change', function(event) {
                if (event.target.classList.contains('codigo-barra-input')) {
                    const codigo = event.target.value;

                    if (codigo.trim() === '') return;

                    fetch('{{ route('productos.buscar.codigo') }}', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            },
                            body: JSON.stringify({
                                codigo
                            }),
                        })
                        .then(response => response.json())
                        .then(data => {
                            const productoRow = event.target.closest('.producto');
                            if (data.success) {

                                productoRow.querySelector('.producto-nombre-input').value = data
                                    .producto.nombre;
                            } else {
                                alert(data.message);
                            }
                        })
                        .catch(error => console.error('Error al buscar producto:', error));
                }
            });

            document.querySelector('form').addEventListener('submit', function(event) {
                event.preventDefault(); // Detener el envío del formulario para inspección
                const formData = new FormData(this);

                // Verificar y mostrar todos los datos que se enviarán
                for (const [key, value] of formData.entries()) {
                    console.log(key, value);
                }

                // Reanudar el envío después de la inspección
                this.submit();
            });

            document.getElementById('buscar-proveedor').addEventListener('click', async function() {
                const ruc = document.getElementById('id_proveedor').value.trim();

                if (!ruc) {
                    alert('Por favor, ingresa un RUC válido.');
                    return;
                }

                try {
                    const response = await fetch(`/proveedor/buscar/${ruc}`);
                    const data = await response.json();

                    if (data.success) {
                        document.getElementById('resultado-proveedor').classList.remove('hidden');
                        document.getElementById('razon-social').textContent = data.nombre;
                    } else {
                        console.error('Error del servidor:', data
                            .message); // Depurar mensaje del servidor
                        alert(data.message || 'No se encontró información para este RUC.');
                    }
                } catch (error) {
                    console.error('Error en la solicitud:', error); // Depurar errores en la solicitud
                    alert('Hubo un error al buscar el RUC. Inténtalo de nuevo.');
                }
            });

            // Añadir nuevo producto dinámico
            document.getElementById('add-product').addEventListener('click', function() {
                const container = document.createElement('div');
                container.classList.add('producto', 'flex', 'space-x-4', 'items-center', 'mb-4');

                container.innerHTML = `
                <div class="flex-1">
                    <label class="block text-sm font-medium text-gray-700">Código de Barras</label>
                    <input type="text" name="productos[${productIndex}][codigo]" placeholder="Código de barras"
                        class="codigo-barra-input mt-1 block w-full p-2 border border-gray-300 rounded-lg">
                </div>
                <div class="flex-1">
                    <label class="block text-sm font-medium text-gray-700">Producto</label>
                    <input type="text" name="productos[${productIndex}][id_articulo]" placeholder="Nombre del producto"
                        class="producto-nombre-input mt-1 block w-full p-2 border border-gray-300 rounded-lg">
                </div>
                <div class="w-32">
                    <label class="block text-sm font-medium text-gray-700">Cantidad</label>
                    <input type="number" name="productos[${productIndex}][cantidad]" placeholder="0" required
                        class="mt-1 block w-full p-2 border border-gray-300 rounded-lg">
                </div>
                <button type="button" class="remove-product bg-red-500 text-white px-3 py-2 rounded-lg">Eliminar</button>
                `;

                productosContainer.appendChild(container);
                productIndex++;
            });

            // Eliminar producto dinámico
            productosContainer.addEventListener('click', function(event) {
                if (event.target.classList.contains('remove-product')) {
                    event.target.closest('.producto').remove();
                }
            });
        });
    </script>
@endsection
