<?php

namespace App\Http\Controllers;

use Illuminate\Pagination\Paginator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Validator;

use App\Models\Util\OrmUtil;

use App\Models\Medicamento;
use App\Models\Marca;
use App\Models\Categoria;

use App\Http\Util\DateUtil;

/**
 * Class MedicamentoController
 * @package App\Http\Controllers
 * @author lucasrafael
 */
class MedicamentoController extends Controller
{
    /**
     * Validar os dados informados no "request".
     * @param $request
     * @return \Illuminate\Contracts\Validation\Validator
     * @throws \Exception
     */
    protected function validarMedicamento($request)
    {
        $request['validade'] = DateUtil::transformEurDateFormatToIso($request['validade']);
        $validate = Validator::make($request->all(), [
            "nome" => "required|max:50",
            "descricao" => "required|max:100",
            "prescricao" => "max:200",
            "validade" => "required|date",
            "quantidade" => "required|numeric|between:1,999",
            "marca_id" => "required",
        ]);
        return $validate;
    }

    /**
     * Display a listing of the resource (Medicamentos).
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $medicamentos = self::getListaPaginada($request, 'nome', Medicamento::class, 'validade');
        return view('medicamentos.index', compact('medicamentos'));
    }

    /**
     * Show the form for creating a new resource (Medicamento).
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $marcas = Marca::all();
        $categorias = Categoria::all();

        return view('medicamentos.create', compact('marcas', 'categorias'));
    }

    /**
     * Store a newly created resource in storage (Medicamento).
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function store(Request $request)
    {
        $validator = $this->validarMedicamento($request);
        if ($validator->fails()) {
            return self::getRedirectMedicamentoWithErrors($request, $validator->errors());
        }
        return OrmUtil::execTrans(function () use ($request) {
            $dados = $request->all();

            $medicamento = Medicamento::create($dados);
            $medicamento->categorias()->attach($dados['categoria_id']);

        }, 'Medicamento inserido', 'medicamentos.index');
    }

    /**
     * Display the specified resource (Medicamento).
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id)
    {
        $medicamento = Medicamento::findOrFail($id);
        return view('medicamentos.show', compact('medicamento'));
    }

    /**
     * Show the form for editing the specified resource (Medicamento).
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $medicamento = Medicamento::getByIdWithOtherDateFmt($id);
        $marcas = Marca::all();
        $categorias = Categoria::all();

        return view('medicamentos.edit', compact('medicamento', 'marcas', 'categorias'));
    }

    /**
     * Update the specified resource in storage (Medicamento).
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function update(Request $request, $id)
    {
        $validator = $this->validarMedicamento($request);
        if ($validator->fails()) {
            return self::getRedirectMedicamentoWithErrors($request, $validator->errors());
        }
        return OrmUtil::execTrans(function () use ($request, $id) {
            $medicamento = Medicamento::getByIdWithOtherDateFmt($id);

            $dados = $request->all();

            $medicamento->update($dados);
            $medicamento->categorias()->sync($dados['categoria_id']);

        }, 'Medicamento alterado', 'medicamentos.index');
    }

    /**
     * Remove the specified resource from storage (Medicamento).
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        return OrmUtil::execTrans(function () use ($id) {
            Medicamento::findOrFail($id)->delete();
        }, 'Medicamento excluído', 'medicamentos.index');
    }

    /**
     * Exibe tela para remover medicamento.
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function remover($id)
    {
        $medicamento = Medicamento::findOrFail($id);
        return view('medicamentos.remove', compact('medicamento'));
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    private function getRedirectMedicamentoWithErrors(Request $request, $obj)
    {
        // Revertendo a data...
        $request['validade'] = DateUtil::transformIsoDateFormatToEur($request['validade']);

        return parent::getRedirectResponseWithErrors($obj);
    }

}
