<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Traslado;
use Illuminate\Support\Facades\Route;
use App\Models\Almacen;
use App\Models\Producto;
use Illuminate\Support\Facades\DB;

class TrasladoController extends Controller
{
    // Mostrar todos los traslados
    public function index()
    {
        // Obtener todos los traslados con las relaciones de almacenes
        $traslados = Traslado::with(['almacenSalida', 'almacenEntrada'])->get();

        // Retornar la vista con los traslados y sus almacenes
        return view('traslados.index', compact('traslados'));
    }

    public function create()
    {
        $almacenes = Almacen::all();  // Obtiene todos los almacenes
        $productos = Producto::all();  // Obtiene todos los productos disponibles (puedes filtrar si es necesario)
        return view('traslados.create', compact('almacenes', 'productos'));
    }

    public function store(Request $request)
    {
        // Validación de los datos
        $validated = $request->validate([
            'id_almacen_salida' => 'required|exists:almacenes,id',
            'id_almacen_entrada' => 'required|exists:almacenes,id',
            'motivo' => 'required|string|max:255',
            'productos' => 'required|array',
            'productos.*.id_articulo' => 'required|exists:productos,id_producto',
            'productos.*.cantidad' => 'required|integer|min:1',
        ]);

        // Verificar que haya suficiente stock en el almacén de salida
        foreach ($validated['productos'] as $producto) {
            $stock = DB::table('stock')
                ->where('id_articulo', $producto['id_articulo'])
                ->where('id_almacen', $validated['id_almacen_salida'])
                ->value('stock');

            if ($stock < $producto['cantidad']) {
                return back()->withErrors("No hay suficiente stock para el producto: {$producto['id_articulo']} en el almacén de salida.");
            }
        }

        // Lógica para almacenar el traslado y modificar el stock
        try {
            DB::beginTransaction();

            // Registrar el traslado en la base de datos o llamar al procedimiento almacenado
            DB::statement('CALL RegistrarTraslado(?, ?, ?, ?)', [
                $validated['id_almacen_salida'],
                $validated['id_almacen_entrada'],
                $validated['motivo'],
                json_encode($validated['productos']), // Convertir productos a JSON
            ]);

            // Actualizar el stock en los almacenes
            foreach ($validated['productos'] as $producto) {
                // Reducir stock en el almacén de salida
                DB::table('stock')
                    ->where('id_articulo', $producto['id_articulo'])
                    ->where('id_almacen', $validated['id_almacen_salida'])
                    ->decrement('stock', $producto['cantidad']);

                // Aumentar stock en el almacén de entrada
                DB::table('stock')
                    ->where('id_articulo', $producto['id_articulo'])
                    ->where('id_almacen', $validated['id_almacen_entrada'])
                    ->increment('stock', $producto['cantidad']);
            }

            DB::commit();

            return redirect()->route('traslados.index')->with('success', 'Traslado registrado exitosamente.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('traslados.index')->with('error', 'Error al ejecutar el procedimiento: ' . $e->getMessage());
        }
    }


    // Mostrar un traslado específico
}
