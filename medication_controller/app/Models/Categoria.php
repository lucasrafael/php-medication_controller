<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Categoria
 * @package App\Models
 * @author lucasrafael
 */
class Categoria extends Model
{
    protected $fillable = ['nome'];

    /**
     * Retorna todos os medicamentos associados e ordenados por nome.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function medicamentos()
    {
        return $this->belongsToMany(Medicamento::class, 'medicamentos_categorias', 'categorias_id', 'medicamentos_id')->orderBy('nome');
    }

    /**
     * Persiste medicamento.
     * @param Medicamento $medicamento
     * @return Model
     */
    public function addMedicamento(Medicamento $medicamento)
    {
        return $this->medicamentos()->save($medicamento);
    }

}
