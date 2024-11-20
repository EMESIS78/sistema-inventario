<?php

namespace App\Exports;

use App\Models\Producto;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ReporteGlobalExport implements FromView
{
    public function view(): View
    {
        $reporteGlobal = DB::select('CALL sp_generar_reporte_global()');
        return view('inventario.reporte_excel', compact('reporteGlobal'));
    }
}
