<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Entrada;
use App\Models\Almacen;
use App\Models\Proveedor;
use Illuminate\Support\Facades\DB;

class EntradaController extends Controller
{
    public function index()
    {
        // List all entries if needed
        $entradas = Entrada::all();
        return view('entradas.index', compact('entradas'));
    }

    public function store(Request $request)
    {
        // Validate the request data
        $data = $request->validate([
            'id_almacen' => 'required|integer',
            'documento' => 'required|string',
            'id_proveedor' => 'required|string',
            'productos' => 'required|array', // Array of products (id_articulo and cantidad)
        ]);

        // Call the stored procedure to register the entry
        DB::statement('CALL RegistrarEntrada(?, ?, ?, ?)', [
            $data['id_almacen'],
            $data['documento'],
            $data['id_proveedor'],
            json_encode($data['productos']) // Convert the products array to JSON
        ]);

        // Redirect back with success message
        return redirect()->route('entradas.index')->with('success', 'Entrada registrada correctamente.');
    }

    public function create()
    {
        // Obtener todos los almacenes para mostrar en el formulario
        $almacenes = Almacen::all();
        return view('entradas.create', compact('almacenes'));
    }
}
