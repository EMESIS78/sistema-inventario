<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Salida extends Model
{
    use HasFactory;

    protected $table = 'salidas';
    protected $primaryKey = 'id_salida';
    protected $fillable = ['id_almacen', 'motivo'];

    public function almacen()
    {
        return $this->belongsTo(Almacen::class, 'id_almacen');
    }

    
}
