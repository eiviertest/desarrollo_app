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

    public function categoria(){
        return $this->belongsTo('Models\Categoria');
    }
}
