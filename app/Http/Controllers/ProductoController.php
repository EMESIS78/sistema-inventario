<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
class ProductoController extends Controller
{
    public function index()
    {
        // Aquí puedes obtener los artículos desde la base de datos
        $productos = Producto::paginate(10);  // O alguna consulta más específica

        // Retornar la vista con los artículos
        return view('articulos.index', compact('productos'));
    }

    public function create()
    {
        abort(404);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'marca' => 'required|string|max:255',
            'unidad_medida' => 'required|string|max:255',
            'ubicacion' => 'nullable|string|max:255',
            'imagen' => 'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('imagen')) {
            $path = $request->file('imagen')->store('productos', 'public'); // Guardar en storage/app/public/productos
            $validated['imagen'] = $path;
        }

        dd($request->file('imagen'));

        Producto::create($validated);

        return redirect()->route('articulos.index')->with('success', 'Producto añadido exitosamente.');
    }

    public function edit($id)
    {
        $producto = Producto::findOrFail($id); // Encuentra el producto por ID
        return view('articulos.edit', compact('producto'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'marca' => 'required|string|max:255',
            'unidad_medida' => 'required|string|max:255',
            'ubicacion' => 'nullable|string|max:255',
            'imagen' => 'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:2048',

        ]);

        $producto = Producto::findOrFail($id);
        if ($request->hasFile('imagen')) {
            // Eliminar la imagen actual si existe
            if ($producto->imagen) {
                Storage::disk('public')->delete($producto->imagen);
            }
            // Guardar la nueva imagen
            $validated['imagen'] = $request->file('imagen')->store('productos', 'public');
        }

        $producto->update($validated);

        return redirect()->route('articulos.index')->with('success', 'Producto actualizado exitosamente.');
    }

    public function destroy($id)
    {
        $producto = Producto::findOrFail($id);
        $producto->delete();

        return redirect()->route('articulos.index')->with('success', 'Producto eliminado exitosamente.');
    }
}