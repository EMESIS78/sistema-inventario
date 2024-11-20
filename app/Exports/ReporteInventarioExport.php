<?php

namespace App\Exports;

use App\Models\Producto;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Support\Facades\DB;

class ReporteInventarioExport implements FromView
{
    public function view(): View
    {
        $reporte = DB::select('CALL sp_generar_informe_inventario()');
        return view('inventario.reporte_excel', compact('reporte'));
    }
}
