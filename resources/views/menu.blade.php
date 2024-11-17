@extends('layouts.app')

@section('content')
<div class="container mx-auto py-8">
    <!-- Usamos un grid para tener 3 columnas y las tarjetas ocupen todo el espacio -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        <!-- Card de Artículos -->
        <div class="bg-white shadow-lg rounded-lg overflow-hidden hover:shadow-xl transition-all duration-300 min-h-[300px] flex flex-col justify-between">
            <a href="{{ route('articulos.index') }}" class="block p-6 flex-grow text-center">
                <h3 class="text-xl font-semibold text-blue-500 mb-4">Artículos</h3>
                <p class="text-gray-700">Gestiona los artículos de inventario.</p>
            </a>
        </div>

        <!-- Card de Almacenes -->
        <div class="bg-white shadow-lg rounded-lg overflow-hidden hover:shadow-xl transition-all duration-300 min-h-[300px] flex flex-col justify-between">
            <a href="{{ route('almacenes.index') }}" class="block p-6 flex-grow text-center">
                <h3 class="text-xl font-semibold text-blue-500 mb-4">Almacenes</h3>
                <p class="text-gray-700">Administra los diferentes almacenes.</p>
            </a>
        </div>

        <!-- Card de Inventario -->
        <div class="bg-white shadow-lg rounded-lg overflow-hidden hover:shadow-xl transition-all duration-300 min-h-[300px] flex flex-col justify-between">
            <a href="{{ route('inventario.index') }}" class="block p-6 flex-grow text-center">
                <h3 class="text-xl font-semibold text-blue-500 mb-4">Inventario</h3>
                <p class="text-gray-700">Consulta el estado del inventario.</p>
            </a>
        </div>

        <!-- Card de Entradas -->
        <div class="bg-white shadow-lg rounded-lg overflow-hidden hover:shadow-xl transition-all duration-300 min-h-[300px] flex flex-col justify-between">
            <a href="{{ route('entradas.index') }}" class="block p-6 flex-grow text-center">
                <h3 class="text-xl font-semibold text-blue-500 mb-4">Entradas</h3>
                <p class="text-gray-700">Registra las entradas de productos.</p>
            </a>
        </div>

        <!-- Card de Salidas -->
        <div class="bg-white shadow-lg rounded-lg overflow-hidden hover:shadow-xl transition-all duration-300 min-h-[300px] flex flex-col justify-between">
            <a href="{{ route('salidas.index') }}" class="block p-6 flex-grow text-center">
                <h3 class="text-xl font-semibold text-blue-500 mb-4">Salidas</h3>
                <p class="text-gray-700">Registra las salidas de productos.</p>
            </a>
        </div>

        <!-- Card de Traslados -->
        <div class="bg-white shadow-lg rounded-lg overflow-hidden hover:shadow-xl transition-all duration-300 min-h-[300px] flex flex-col justify-between">
            <a href="{{ route('traslados.index') }}" class="block p-6 flex-grow text-center">
                <h3 class="text-xl font-semibold text-blue-500 mb-4">Traslados</h3>
                <p class="text-gray-700">Gestiona los traslados de inventario.</p>
            </a>
        </div>
    </div>
</div>
@endsection
