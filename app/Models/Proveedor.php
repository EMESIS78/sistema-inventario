<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{
    use HasFactory;

    // Nombre de la tabla
    protected $table = 'proveedores';

    // La clave primaria
    protected $primaryKey = 'id_ruc_proveedor';

    // No necesitamos auto-incremento para la clave primaria
    public $incrementing = false;


    // Las columnas que son asignables masivamente
    protected $fillable = [
        'id_ruc_proveedor',
        'nombres',
    ];

    // Los proveedores no utilizan timestamps por defecto en la base de datos
    public $timestamps = true;
}
