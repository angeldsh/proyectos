<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alquiler extends Model
{
    use HasFactory;
    protected $table = 'alquileres';
    protected $fillable = [
        'pelicula_id',
        'usuario_id',
        'fecha_alquiler',
        'fecha_devolucion',
    ];
    public function pelicula()
    {
        return $this->belongsTo(Pelicula::class, 'pelicula_id');
    }
    public function usuario()
    {
        return $this->belongsTo(User::class);
    }
}
