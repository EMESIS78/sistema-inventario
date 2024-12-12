@extends('layouts.app')

@section('content')
    <div class="container mx-auto py-8">
        <!-- Usamos una grid para disponer las tarjetas -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">

            @if (auth()->user()->rol === 'admin' || auth()->user()->rol === 'supervisor' || auth()->user()->rol === 'usuario')
                <!-- Card de Artículos -->
                <div
                    class="bg-gradient-to-r from-blue-500 to-blue-400 text-white rounded-lg shadow-lg hover:shadow-2xl hover:scale-105 transition-transform duration-300 flex flex-col items-center p-6">
                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="h-16 w-16 mb-4 opacity-80 hover:opacity-100 transition-opacity duration-300"
                        viewBox="0 0 24 24" fill="white">
                        <path d="M3 4a1 1 0 011-1h3a1 1 0 110 2H5v14h14v-2a1 1 0 112 0v3a1 1 0 01-1 1H4a1 1 0 01-1-1V4z" />
                        <path d="M12 6a1 1 0 011 1v7a1 1 0 11-2 0V7a1 1 0 011-1z" />
                        <path d="M17 10a1 1 0 110 2h-3a1 1 0 110-2h3z" />
                    </svg>
                    <h3 class="text-2xl font-bold mb-2">Artículos</h3>
                    <p class="text-center">Gestiona los artículos de inventario.</p>
                    <a href="{{ route('articulos.index') }}"
                        class="mt-4 bg-white text-blue-500 font-semibold px-4 py-2 rounded-lg hover:bg-gray-100 transition">Ir</a>
                </div>
            @endif

            @if (auth()->user()->rol === 'admin' || auth()->user()->rol === 'supervisor' || auth()->user()->rol === 'usuario')
                <!-- Card de Almacenes -->
                <div
                    class="bg-gradient-to-r from-green-500 to-green-400 text-white rounded-lg shadow-lg hover:shadow-2xl hover:scale-105 transition-transform duration-300 flex flex-col items-center p-6">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mb-4" viewBox="0 0 24 24" fill="white">
                        <path d="M3 4a1 1 0 011-1h16a1 1 0 011 1v16a1 1 0 01-1 1H4a1 1 0 01-1-1V4z" />
                        <path d="M12 8a1 1 0 011 1v6a1 1 0 11-2 0V9a1 1 0 011-1z" />
                    </svg>
                    <h3 class="text-2xl font-bold mb-2">Almacenes</h3>
                    <p class="text-center">Administra los diferentes almacenes.</p>
                    <a href="{{ route('almacenes.index') }}"
                        class="mt-4 bg-white text-green-500 font-semibold px-4 py-2 rounded-lg hover:bg-gray-100 transition">Ir</a>
                </div>
            @endif

            @if (auth()->user()->rol === 'admin' || auth()->user()->rol === 'supervisor' || auth()->user()->rol === 'usuario')
                <!-- Card de Inventario -->
                <div
                    class="bg-gradient-to-r from-purple-500 to-purple-400 text-white rounded-lg shadow-lg hover:shadow-2xl hover:scale-105 transition-transform duration-300 flex flex-col items-center p-6">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mb-4" viewBox="0 0 24 24" fill="white">
                        <path d="M4 4a1 1 0 011-1h14a1 1 0 011 1v14a1 1 0 01-1 1H4a1 1 0 01-1-1V4z" />
                        <path d="M8 6h8a1 1 0 110 2H8a1 1 0 110-2z" />
                        <path d="M8 10h8a1 1 0 110 2H8a1 1 0 110-2z" />
                        <path d="M8 14h4a1 1 0 110 2H8a1 1 0 110-2z" />
                    </svg>
                    <h3 class="text-2xl font-bold mb-2">Inventario</h3>
                    <p class="text-center">Consulta el estado del inventario.</p>
                    <a href="{{ route('inventario.index') }}"
                        class="mt-4 bg-white text-purple-500 font-semibold px-4 py-2 rounded-lg hover:bg-gray-100 transition">Ir</a>
                </div>
            @endif

            @if (auth()->user()->rol === 'admin' || auth()->user()->rol === 'usuario')
                <!-- Card de Entradas -->
                <div
                    class="bg-gradient-to-r from-orange-500 to-orange-400 text-white rounded-lg shadow-lg hover:shadow-2xl hover:scale-105 transition-transform duration-300 flex flex-col items-center p-6">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mb-4" viewBox="0 0 24 24" fill="white">
                        <path d="M12 2a1 1 0 011 1v16a1 1 0 11-2 0V3a1 1 0 011-1z" />
                        <path d="M7 14l5-5 5 5" />
                    </svg>
                    <h3 class="text-2xl font-bold mb-2">Entradas</h3>
                    <p class="text-center">Registra las entradas de productos.</p>
                    <a href="{{ route('entradas.index') }}"
                        class="mt-4 bg-white text-orange-500 font-semibold px-4 py-2 rounded-lg hover:bg-gray-100 transition">Ir</a>
                </div>
            @endif

            @if (auth()->user()->rol === 'admin' || auth()->user()->rol === 'usuario')
                <!-- Card de Salidas -->
                <div
                    class="bg-gradient-to-r from-red-500 to-red-400 text-white rounded-lg shadow-lg hover:shadow-2xl hover:scale-105 transition-transform duration-300 flex flex-col items-center p-6">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mb-4" viewBox="0 0 24 24" fill="white">
                        <path d="M12 22a1 1 0 01-1-1V5a1 1 0 012 0v16a1 1 0 01-1 1z" />
                        <path d="M17 10l-5 5-5-5" />
                    </svg>
                    <h3 class="text-2xl font-bold mb-2">Salidas</h3>
                    <p class="text-center">Registra las salidas de productos.</p>
                    <a href="{{ route('salidas.index') }}"
                        class="mt-4 bg-white text-red-500 font-semibold px-4 py-2 rounded-lg hover:bg-gray-100 transition">Ir</a>
                </div>
            @endif

            <!-- Tarjeta de Traslados -->
            @if (auth()->user()->rol === 'admin' || auth()->user()->rol === 'supervisor')
                <div
                    class="bg-gradient-to-r from-cyan-500 to-cyan-400 text-white rounded-lg shadow-lg hover:shadow-2xl hover:scale-105 transition-transform duration-300 flex flex-col items-center p-6">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mb-4" viewBox="0 0 24 24" fill="white">
                        <path d="M12 5v2M9 7h6a2 2 0 012 2v6a2 2 0 01-2 2H9a2 2 0 01-2-2V9a2 2 0 012-2zm9 12h2M3 19h2m-2-6h18" />
                    </svg>
                    <h3 class="text-2xl font-bold mb-2">Traslados</h3>
                    <p class="text-center">Gestiona los traslados de inventario.</p>
                    <a href="{{ route('traslados.index') }}"
                        class="mt-4 bg-white text-cyan-500 font-semibold px-4 py-2 rounded-lg hover:bg-gray-100 transition">Ir</a>
                </div>
            @endif

            @if (auth()->user()->rol === 'admin')
                <!-- Card de Usuarios -->
                <div
                    class="bg-gradient-to-r from-teal-500 to-teal-400 text-white rounded-lg shadow-lg hover:shadow-2xl hover:scale-105 transition-transform duration-300 flex flex-col items-center p-6">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mb-4" viewBox="0 0 24 24" fill="white">
                        <path
                            d="M12 12c2.2 0 4-1.8 4-4s-1.8-4-4-4-4 1.8-4 4 1.8 4 4 4zm0 2c-3.3 0-6 2.7-6 6a1 1 0 001 1h10a1 1 0 001-1c0-3.3-2.7-6-6-6z" />
                    </svg>
                    <h3 class="text-2xl font-bold mb-2">Usuarios</h3>
                    <p class="text-center">Administra los usuarios del sistema.</p>
                    <a href="{{ route('usuarios.index') }}"
                        class="mt-4 bg-white text-teal-500 font-semibold px-4 py-2 rounded-lg hover:bg-gray-100 transition">Ir</a>
                </div>
            @endif

            @if (auth()->user()->rol === 'admin')
                <!-- Card de Proveedores -->
                <div
                    class="bg-gradient-to-r from-indigo-500 to-indigo-400 text-white rounded-lg shadow-lg hover:shadow-2xl hover:scale-105 transition-transform duration-300 flex flex-col items-center p-6">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mb-4" viewBox="0 0 24 24" fill="white">
                        <path d="M12 2a9 9 0 110 18 9 9 0 010-18z" />
                        <path d="M8 12l3 3 5-5" />
                    </svg>
                    <h3 class="text-2xl font-bold mb-2">Proveedores</h3>
                    <p class="text-center">Gestiona los proveedores registrados.</p>
                    <a href="{{ route('proveedores.index') }}"
                        class="mt-4 bg-white text-indigo-500 font-semibold px-4 py-2 rounded-lg hover:bg-gray-100 transition">Ir</a>
                </div>
            @endif

        </div>
    </div>
@endsection
