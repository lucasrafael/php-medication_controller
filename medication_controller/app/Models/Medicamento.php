<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Http\Controllers\Controller;

use App\Http\Util\DateUtil;

/**
 * Class Medicamento
 * @package App\Models
 * @author lucasrafael
 */
class Medicamento extends Model
{
    protected $fillable = [
        'nome', 'descricao', 'prescricao', 'validade', 'quantidade', 'marca_id'
    ];

    /**
     * Retorna todas as categorias associadas.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function categorias()
    {
        return $this->belongsToMany(Categoria::class, 'medicamentos_categorias', 'medicamentos_id', 'categorias_id');
    }

    /**
     * Retorna a marca associada.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function marca()
    {
        return $this->belongsTo(Marca::class, 'marca_id');
    }

    /**
     * Retorna o medicamento de acordo com o identificador informado.
     * <p>Mas antes de retornar, a data do campo 'validade' é modificada do formato
     * 'Y-m-d' (ISO) para 'd/m/Y' (Europeu).</p>
     * @param int $id
     * @return Medicamento
     * @throws \Exception
     */
    public static function getByIdWithOtherDateFmt(int $id): Medicamento
    {
        $medicamento = Medicamento::findOrFail($id);

        $medicamento['validade'] = DateUtil::transformIsoDateFormatToEur($medicamento['validade']);

        return $medicamento;
    }

}
