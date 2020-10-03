<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Marca
 * @package App\Models
 * author lucasrafael
 */
class Marca extends Model
{
    protected $fillable = ['nome'];

    /**
     * Retorna todos os medicamentos associados e ordenados por nome.
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function medicamentos()
    {
        return $this->hasMany(Medicamento::class, 'marca_id')->orderBy('nome');
    }

}
