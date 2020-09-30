<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medicamento extends Model
{
    use HasFactory;

    //protected $table = "medicamentos";

    protected $fillable = [
        'nome', 'descricao', 'prescricao', 'validade', 'quantidade', 'marca_id'
    ];

    public function categorias(){
        return $this->belongsToMany(Categoria::class, 'medicamentos_categorias', 'medicamentos_id', 'categorias_id');
    }

    public function marca(){
        return $this->belongsTo(Marca::class, 'marca_id');
    }

}
