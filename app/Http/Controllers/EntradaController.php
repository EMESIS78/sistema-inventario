<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Entrada;
use App\Models\Almacen;
use App\Models\Proveedor;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class EntradaController extends Controller
{
    public function index()
    {
        // List all entries if needed
        $entradas = Entrada::with('almacen', 'usuario')->get();
        return view('entradas.index', compact('entradas'));
    }

    public function store(Request $request)
    {
        // Validar la entrada
        $validator = Validator::make($request->all(), [
            'id_almacen' => 'required|integer',
            'documento' => 'required|string|max:255',
            'id_proveedor' => 'required|string|max:20',
            'productos' => 'required|array',
            'productos.*.id_articulo' => 'required|string',
            'productos.*.cantidad' => 'required|integer|min:1',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Convertir los productos a formato JSON
        $productosJson = json_encode($request->productos);

        // Llamar al procedimiento almacenado RegistrarEntrada
        DB::statement('CALL RegistrarEntrada(?, ?, ?, ?)', [
            $request->id_almacen,
            $request->documento,
            $request->id_proveedor,
            $productosJson
        ]);

        // Registrar la entrada en la tabla con el usuario autenticado
        Entrada::create([
            'id_almacen' => $request->id_almacen,
            'documento' => $request->documento,
            'id_proveedor' => $request->id_proveedor,
            'user_id' => Auth::id(), // Registrar el usuario que realiza la entrada
        ]);

        // Redirigir al usuario con un mensaje de éxito
        return redirect()->route('entradas.index')->with('success', 'Entrada registrada correctamente.');
    }

    public function create()
    {
        // Obtener todos los almacenes para mostrar en el formulario
        $almacenes = Almacen::all();
        return view('entradas.create', compact('almacenes'));
    }
}
