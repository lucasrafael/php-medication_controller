<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Validator;

use App\Models\Util\OrmUtil;

use App\Models\Medicamento;
use App\Models\Marca;

/**
 * Class MarcaController
 * @package App\Http\Controllers
 * @author lucasrafael
 */
class MarcaController extends Controller
{
    /**
     * Valida os dados informados para categoria.
     * @param $request
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validarMarca($request)
    {
        $validator = Validator::make($request->all(), [
            "nome" => "required|max:30"
        ]);
        return $validator;
    }

    /**
     * Display a listing of the resource (Marca).
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $marcas = self::getListaPaginada($request, 'nome', Marca::class);
        return view('marcas.index', compact('marcas'));
    }

    /**
     * Show the form for creating a new resource (Marca).
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $marcas = Marca::all();
        return view('marcas.create', compact('marcas'));
    }

    /**
     * Store a newly created resource in storage (Marca).
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $validator = $this->validarMarca($request);
        if ($validator->fails()) {
            return self::getRedirectResponseWithErrors($validator->errors());
        }
        return OrmUtil::execTrans(function () use ($request) {
            Marca::create($request->all());
        }, 'Marca incluída', 'marcas.index');
    }

    /**
     * Display the specified resource (Marca).
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id)
    {
        $marca = Marca::findOrFail($id);
        return view('marcas.show', compact('marca'));
    }

    /**
     * Show the form for editing the specified resource (Marca).
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $marca = Marca::findOrFail($id);
        return view('marcas.edit', compact('marca'));
    }

    /**
     * Update the specified resource in storage (Marca).
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $validator = $this->validarMarca($request);
        if ($validator->fails()) {
            return self::getRedirectResponseWithErrors($validator->errors());
        }
        return OrmUtil::execTrans(function () use ($request, $id) {
            Marca::findOrFail($id)->update($request->all());
        }, 'Marca atualizada', 'marcas.index');
    }

    /**
     * Remove the specified resource from storage (Marca).
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request, $id)
    {
        return OrmUtil::execTrans(function () use ($id) {
            Marca::findOrFail($id)->delete();
        }, 'Marca excluída', 'marcas.index');
    }

    /**
     * Exibe página de exclusão de marca.
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function remover($id)
    {
        $marca = Marca::findOrFail($id);
        return view('marcas.remove', compact('marca'));
    }

    /**
     * Listagem de todos os medicamentos pertecentes a determinada marca.
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function medicamentos($id)
    {
        $marca = Marca::findOrFail($id);
        return view('marcas.medicamentos', compact('marca'));
    }
}
