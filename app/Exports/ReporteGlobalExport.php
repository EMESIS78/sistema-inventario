<?php

namespace App\Exports;

use App\Models\Producto;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ReporteGlobalExport implements FromView, WithStyles
{
    public function view(): View
    {
        $reporteGlobal = DB::select('CALL sp_generar_reporte_global()');
        return view('inventario.reporte_global_excel', compact('reporteGlobal'));
    }

    public function styles(Worksheet $sheet)
    {
        // Aplicar estilos a las cabeceras (primera fila)
        $sheet->getStyle('A1:C1')->applyFromArray([
            'font' => [
                'bold' => true,
                'color' => ['argb' => 'FFFFFFFF'],
            ],
            'fill' => [
                'fillType' => 'solid',
                'startColor' => ['argb' => 'FF4CAF50'], // Verde para cabeceras
            ],
            'alignment' => ['horizontal' => 'center'],
        ]);

        // Aplicar bordes a todo el rango dinámico
        $lastRow = $sheet->getHighestRow(); // Última fila con datos
        $sheet->getStyle("A1:C$lastRow")->applyFromArray([
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
            ],
        ]);

        // Ajustar automáticamente las columnas
        foreach (range('A', 'C') as $column) {
            $sheet->getColumnDimension($column)->setAutoSize(true);
        }
    }
}
