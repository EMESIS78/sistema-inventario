<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Almacen;

class AlmacenController extends Controller
{
    public function index()
    {
        // Obtenemos los almacenes desde la base de datos
        $almacenes = Almacen::paginate(10); // O usa paginate() si necesitas paginación.

        // Retornamos la vista con los almacenes
        return view('almacenes.index', compact('almacenes'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'ubicacion' => 'nullable|string|max:255',
        ]);

        Almacen::create($validated);

        return redirect()->route('almacenes.index')->with('success', 'Almacén creado exitosamente.');
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'ubicacion' => 'nullable|string|max:255',
        ]);

        $almacen = Almacen::findOrFail($id);
        $almacen->update($validated);

        return redirect()->route('almacenes.index')->with('success', 'Almacén actualizado exitosamente.');
    }

    public function destroy($id)
    {
        $almacen = Almacen::findOrFail($id);
        $almacen->delete();

        return redirect()->route('almacenes.index')->with('success', 'Almacén eliminado exitosamente.');
    }
}
