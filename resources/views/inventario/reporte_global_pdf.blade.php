<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Reporte Global de Inventario</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            margin: 20px;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .header .logo {
            max-width: 150px;
        }

        .header .info {
            text-align: right;
        }

        h1 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f4f4f4;
            font-weight: bold;
            color: #333;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        footer {
            text-align: center;
            margin-top: 30px;
            font-size: 10px;
            color: #777;
        }
    </style>
</head>

<body>
    <div class="header">
        <div class="logo">
            <img src="{{ asset('images/logo.png') }}" style="max-height: 50px;">
        </div>
        <div class="info">
            <p><strong>Empresa:</strong> Mi Empresa S.A.</p>
            <p><strong>Fecha:</strong> {{ now()->format('d-m-Y') }}</p>
            <p><strong>Usuario:</strong> {{ auth()->user()->name }}</p>
        </div>
    </div>

    <h1>Reporte Global de Inventario</h1>

    <table>
        <thead>
            <tr>
                <th>ID Producto</th>
                <th>Nombre</th>
                <th>Existencia Total</th>
            </tr>
        </thead>
        <tbody>
            @forelse($reporteGlobal as $item)
                <tr>
                    <td>{{ $item->id_producto }}</td>
                    <td>{{ $item->nombre }}</td>
                    <td>{{ $item->existencia }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" style="text-align: center; font-style: italic;">No hay datos disponibles.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <footer>
        Generado automáticamente por el sistema de inventario y almacén. {{ now()->format('Y') }} &copy; Mi Empresa S.A.
    </footer>
</body>

</html>
