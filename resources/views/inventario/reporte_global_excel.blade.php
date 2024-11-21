<table>
    <thead>
        <tr>
            <th>ID Producto</th>
            <th>Nombre</th>
            <th>Existencia Total</th>
        </tr>
    </thead>
    <tbody>
        @foreach($reporteGlobal as $item)
            <tr>
                <td>{{ $item->id_producto }}</td>
                <td>{{ $item->nombre }}</td>
                <td>{{ $item->existencia }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
