<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Entrada extends Model
{
    use HasFactory;

    // Nombre de la tabla en la base de datos
    protected $table = 'entradas';

    // La clave primaria
    protected $primaryKey = 'id_entrada';

    // Las columnas que son asignables masivamente
    protected $fillable = [
        'id_almacen',
        'documento',
        'id_proveedor',
    ];

    // Relación con el modelo Almacen
    public function almacen()
    {
        return $this->belongsTo(Almacen::class, 'id_almacen');
    }

    // Relación con el modelo Proveedor
    public function proveedor()
    {
        return $this->belongsTo(Proveedor::class, 'id_proveedor', 'id_ruc_proveedor');
    }
}
