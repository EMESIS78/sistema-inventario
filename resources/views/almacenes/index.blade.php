@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-6">
        <h2 class="text-3xl font-bold text-gray-800 mb-6 flex items-center">
            <i class="fas fa-warehouse mr-3 text-indigo-600"></i> Gestión de Almacenes
        </h2>

        <!-- Botón para abrir el modal de añadir almacén -->
        <div class="mb-6 flex justify-end">
            <button onclick="toggleModal('addAlmacenModal')"
                class="flex items-center px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 transition">
                <i class="fas fa-plus mr-2"></i> Añadir Almacén
            </button>
        </div>

        <!-- Listado de almacenes -->
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @foreach ($almacenes as $almacen)
                <div class="bg-white p-4 rounded-lg shadow-md hover:shadow-xl transition-shadow">
                    <h3 class="text-lg font-semibold text-gray-800 flex items-center">
                        <i class="fas fa-warehouse mr-2 text-indigo-600"></i> {{ $almacen->nombre }}
                    </h3>
                    <p class="text-sm text-gray-600 mt-2 flex items-center">
                        <i class="fas fa-map-marker-alt mr-2 text-gray-500"></i> Ubicación: {{ $almacen->ubicacion }}
                    </p>

                    <div class="flex justify-between items-center mt-4">
                        <!-- Botón para abrir el modal de actualizar -->
                        <button onclick="openUpdateModal({{ $almacen }})"
                            class="text-yellow-600 hover:text-yellow-700 flex items-center">
                            <i class="fas fa-edit mr-1"></i> Actualizar
                        </button>

                        <!-- Formulario para eliminar -->
                        <form action="{{ route('almacenes.destroy', $almacen->id) }}" method="POST"
                            class="text-red-600 hover:text-red-700">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('¿Estás seguro de eliminar este almacén?')"
                                class="focus:outline-none flex items-center">
                                <i class="fas fa-trash mr-1"></i> Eliminar
                            </button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Paginación -->
        <div class="mt-6">
            {{ $almacenes->links() }}
        </div>
    </div>

    <!-- Modal para añadir almacén -->
    <div id="addAlmacenModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 hidden">
        <div class="bg-white rounded-lg p-6 w-full max-w-lg shadow-xl transition-transform transform scale-95">
            <h2 class="text-lg font-bold mb-4 text-blue-600 flex items-center">
                <i class="fas fa-plus-circle mr-2"></i> Añadir Almacén
            </h2>
            <form action="{{ route('almacenes.store') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="nombre" class="block text-sm font-medium text-gray-700">Nombre</label>
                    <input type="text" name="nombre" id="nombre"
                        class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500"
                        required>
                </div>
                <div class="mb-4">
                    <label for="ubicacion" class="block text-sm font-medium text-gray-700">Ubicación</label>
                    <input type="text" name="ubicacion" id="ubicacion"
                        class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
                </div>
                <div class="flex justify-end">
                    <button type="button" onclick="toggleModal('addAlmacenModal')"
                        class="flex items-center px-4 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500 transition mr-2">
                        <i class="fas fa-times mr-2"></i> Cancelar
                    </button>
                    <button type="submit"
                        class="flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 transition">
                        <i class="fas fa-save mr-2"></i> Guardar
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal para actualizar almacén -->
    <div id="updateAlmacenModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 hidden">
        <div class="bg-white rounded-lg p-6 w-full max-w-lg shadow-xl transition-transform transform scale-95">
            <h2 class="text-lg font-bold mb-4 text-yellow-600 flex items-center">
                <i class="fas fa-edit mr-2"></i> Actualizar Almacén
            </h2>
            <form id="updateForm" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-4">
                    <label for="nombre_update" class="block text-sm font-medium text-gray-700">Nombre</label>
                    <input type="text" name="nombre" id="nombre_update"
                        class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-yellow-500 focus:border-yellow-500"
                        required>
                </div>
                <div class="mb-4">
                    <label for="ubicacion_update" class="block text-sm font-medium text-gray-700">Ubicación</label>
                    <input type="text" name="ubicacion" id="ubicacion_update"
                        class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-yellow-500 focus:border-yellow-500">
                </div>
                <div class="flex justify-end">
                    <button type="button" onclick="toggleModal('updateAlmacenModal')"
                        class="flex items-center px-4 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500 transition mr-2">
                        <i class="fas fa-times mr-2"></i> Cancelar
                    </button>
                    <button type="submit"
                        class="flex items-center px-4 py-2 bg-yellow-600 text-white rounded-lg hover:bg-yellow-700 focus:outline-none focus:ring-2 focus:ring-yellow-500 transition">
                        <i class="fas fa-save mr-2"></i> Guardar
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Scripts para manejar los modales -->
    <script>
        function toggleModal(id) {
            const modal = document.getElementById(id);
            modal.classList.toggle('hidden');
        }

        function openUpdateModal(almacen) {
            document.getElementById('nombre_update').value = almacen.nombre;
            document.getElementById('ubicacion_update').value = almacen.ubicacion || '';
            const updateForm = document.getElementById('updateForm');
            updateForm.action = `{{ url('almacenes') }}/${almacen.id}`;
            toggleModal('updateAlmacenModal');
        }
    </script>
@endsection
