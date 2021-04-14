<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dato extends Model
{
    use HasFactory;
    protected $table = 'datos';
    protected $primaryKey = 'id';
    protected $fillable = ['titulo', 'contenido', 'url_mas_info', 'url_imagen', 'estado', 'categoria_key'];

    public function scopeCategoria($query, $categoria)
    {
        if($categoria > 0) {
            return $query->where('datos.categoria_key', $categoria);
        }
    }

    public function scopeEstado($query, $estado)
    {
        if($estado >= 0 && $estado <= 2) {
            return $query->where('datos.estado', $estado);
        }
    }

    public function categoria(){
        return $this->belongsTo('Models\Categoria');
    }
}
