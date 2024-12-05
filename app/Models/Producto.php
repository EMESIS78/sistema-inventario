<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    protected $table = 'productos'; // Asegúrate de que el nombre de la tabla coincida

    protected $primaryKey = 'id_producto'; // El nombre de la clave primaria

    protected $fillable = [
        'codigo',
        'nombre',
        'marca',
        'unidad_medida',
        'ubicacion',
        'imagen',
    ];
}
