<?php

namespace App\Exports;

use App\Models\Producto;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Illuminate\Support\Facades\DB;

class ReporteInventarioExport implements FromView, WithStyles
{
    public function view(): View
    {
        $reporte = DB::select('CALL sp_generar_informe_inventario()');
        return view('inventario.reporte_excel', compact('reporte'));
    }

    public function styles(Worksheet $sheet)
    {
        $sheet->getStyle('A1:F1')->applyFromArray([
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

        // Obtener la última fila con datos
        $lastRow = $sheet->getHighestRow();

        // Aplicar bordes a todo el rango (A1:C$lastRow)
        $sheet->getStyle("A1:C$lastRow")->applyFromArray([
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
            ],
        ]);

        return [
            // Ajustar automáticamente las columnas
            'A:Z' => ['autoSize' => true],
        ];
    }
}
