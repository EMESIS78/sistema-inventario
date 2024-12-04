<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Proveedor;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;

class ProveedorController extends Controller
{
    public function index()
    {
        $proveedores = Proveedor::all();
        return view('proveedores.index', compact('proveedores'));
    }

    public function buscar($ruc)
    {
        $proveedor = Proveedor::find($ruc);

        if ($proveedor) {
            return response()->json(['success' => true, 'nombre' => $proveedor->nombres]);
        }

        $response = Http::withHeaders([
            'Authorization' => 'apis-token-11995.mTQmgcINTb0VWszAJs4L9LEFkvF9mazQ',
        ])->get("https://api.apis.net.pe/v1/ruc?numero=$ruc");

        if ($response->ok() && isset($response['nombre'])) {
            return response()->json(['success' => true, 'nombre' => $response['nombre']]);
        }

        return response()->json(['success' => false]);
    }
}
