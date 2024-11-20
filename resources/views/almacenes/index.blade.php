@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h2 class="text-2xl font-semibold mb-6">Gestión de Almacenes</h2>

    <!-- Botón para abrir el modal de añadir almacén -->
    <div class="mb-6 flex justify-end">
        <x-button onclick="toggleModal('addAlmacenModal')" class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
            Añadir Almacén
        </x-button>
    </div>

    <!-- Listado de almacenes -->
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        @foreach($almacenes as $almacen)
        <div class="bg-white p-4 rounded-lg shadow-md hover:shadow-xl transition-shadow">
            <h3 class="text-lg font-semibold text-gray-800">{{ $almacen->nombre }}</h3>
            <p class="text-sm text-gray-600 mt-2">Ubicación: {{ $almacen->ubicacion }}</p>


            <div class="flex justify-between items-center mt-4">
                <!-- Botón para abrir el modal de actualizar -->
                <button onclick="openUpdateModal({{ $almacen }})" class="text-yellow-600 hover:text-yellow-700">
                    <i class="fas fa-edit"></i> Actualizar
                </button>

                <!-- Formulario para eliminar -->
                <form action="{{ route('almacenes.destroy', $almacen->id) }}" method="POST" class="text-red-600 hover:text-red-700">
                    @csrf
                    @method('DELETE')
                    <button type="submit" onclick="return confirm('¿Estás seguro de eliminar este almacén?')" class="focus:outline-none">
                        <i class="fas fa-trash"></i> Eliminar
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
    <div class="bg-white rounded-lg p-6 w-full max-w-lg">
        <h2 class="text-lg font-bold mb-4">Añadir Almacén</h2>
        <form action="{{ route('almacenes.store') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="nombre" class="block text-sm font-medium">Nombre</label>
                <input type="text" name="nombre" id="nombre" class="w-full border-gray-300 rounded-lg shadow-sm" required>
            </div>
            <div class="mb-4">
                <label for="ubicacion" class="block text-sm font-medium">Ubicación</label>
                <input type="text" name="ubicacion" id="ubicacion" class="w-full border-gray-300 rounded-lg shadow-sm">
            </div>
            <div class="flex justify-end">
                <button type="button" class="btn btn-secondary mr-2" onclick="toggleModal('addAlmacenModal')">Cancelar</button>
                <button type="submit" class="btn btn-primary bg-blue-600 text-white px-4 py-2 rounded-lg">Guardar</button>
            </div>
        </form>
    </div>
</div>

<!-- Modal para actualizar almacén -->
<div id="updateAlmacenModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 hidden">
    <div class="bg-white rounded-lg p-6 w-full max-w-lg">
        <h2 class="text-lg font-bold mb-4">Actualizar Almacén</h2>
        <form id="updateForm" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label for="nombre_update" class="block text-sm font-medium">Nombre</label>
                <input type="text" name="nombre" id="nombre_update" class="w-full border-gray-300 rounded-lg shadow-sm" required>
            </div>
            <div class="mb-4">
                <label for="ubicacion_update" class="block text-sm font-medium">Ubicación</label>
                <input type="text" name="ubicacion" id="ubicacion_update" class="w-full border-gray-300 rounded-lg shadow-sm">
            </div>
            <div class="flex justify-end">
                <button type="button" class="btn btn-secondary mr-2" onclick="toggleModal('updateAlmacenModal')">Cancelar</button>
                <button type="submit" class="btn btn-primary bg-blue-600 text-white px-4 py-2 rounded-lg">Guardar</button>
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
        // Rellenar los datos del modal de actualización
        document.getElementById('nombre_update').value = almacen.nombre;
        document.getElementById('ubicacion_update').value = almacen.ubicacion || '';
        // Cambiar la acción del formulario para actualizar
        const updateForm = document.getElementById('updateForm');
        updateForm.action = `{{ url('almacenes') }}/${almacen.id}`;
        // Abrir el modal
        toggleModal('updateAlmacenModal');
    }
</script>
@endsection
