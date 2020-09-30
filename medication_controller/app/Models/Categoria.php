<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    //protected $table = "categorias";

    protected $fillable = ['nome'];

    public function medicamentos(){
        return $this->belongsToMany(Medicamento::class, 'medicamentos_categorias', 'categorias_id', 'medicamentos_id');
    }

    public function addMedicamento(Medicamento $medicamento){
        return $this->medicamentos()->save($medicamento);
    }

}
