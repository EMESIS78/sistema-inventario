<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Traslado extends Model
{
    use HasFactory;

    // Nombre de la tabla (opcional si sigue las convenciones de Laravel)
    protected $table = 'traslados';

    // Clave primaria personalizada
    protected $primaryKey = 'id_traslado';

    // Campos que pueden ser asignados masivamente
    protected $fillable = [
        'id_almacen_salida',
        'id_almacen_entrada',
        'motivo',
    ];

    /**
     * Relación con el almacén de salida.
     */
    public function almacenSalida()
    {
        return $this->belongsTo(Almacen::class, 'id_almacen_salida');
    }

    /**
     * Relación con el almacén de entrada.
     */
    public function almacenEntrada()
    {
        return $this->belongsTo(Almacen::class, 'id_almacen_entrada');
    }
}
