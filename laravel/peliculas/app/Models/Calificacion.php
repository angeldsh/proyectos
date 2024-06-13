<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Calificacion extends Model
{
    use HasFactory;
    protected $table = 'calificaciones';
    protected $fillable = [
        'pelicula_id',
        'usuario_id',
        'calificacion',
        'comentario',
    ];
    // Relación uno a muchos, el belongsTo va en el modelo muchos, en este caso calificaciones
    public function pelicula()
    {
        return $this->belongsTo(Pelicula::class, 'pelicula_id');
    }
    public function usuario()
    {
        return $this->belongsTo(User::class);
    }

}
