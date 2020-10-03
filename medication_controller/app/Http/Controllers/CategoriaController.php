<?php

namespace App\Http\Controllers;

use Illuminate\Pagination\Paginator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Validator;

use App\Models\Util\OrmUtil;

use App\Models\Marca;
use App\Models\Categoria;
use App\Models\Medicamento;

/**
 * Class CategoriaController
 * @package App\Http\Controllers
 * @author lucasrafael
 */
class CategoriaController extends Controller
{
    /**
     * Validar os daddos da cetegoria informados.
     * @param $request
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validarCategoria($request)
    {
        $validator = Validator::make($request->all(), [
            "nome" => "required|max:50"
        ]);
        return $validator;
    }

    /**
     * Display a listing of the resource (Categoria).
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $categorias = self::getListaPaginada($request, 'nome', Categoria::class);
        return view('categorias.index', compact('categorias'));
    }

    /**
     * Show the form for creating a new resource (Categoria).
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $categorias = Categoria::all();
        return view('categorias.create', compact('categorias'));
    }

    /**
     * Store a newly created resource in storage (Categoria).
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $validator = $this->validarCategoria($request);
        if ($validator->fails()) {
            return self::getRedirectResponseWithErrors($validator->errors());
        }
        return OrmUtil::execTrans(function () use ($request) {
            Categoria::create($request->all());
        }, 'Categoria inserida', 'categorias.index');
    }

    /**
     * Display the specified resource (Categoria).
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id)
    {
        $categoria = Categoria::findOrFail($id);
        return view('categorias.show', compact('categoria'));
    }

    /**
     * Show the form for editing the specified resource (Categoria).
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $categoria = Categoria::findOrFail($id);
        return view('categorias.edit', compact('categoria'));
    }

    /**
     * Update the specified resource in storage (Categoria).
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $validator = $this->validarCategoria($request);
        if ($validator->fails()) {
            return self::getRedirectResponseWithErrors($validator->errors());
        }
        return OrmUtil::execTrans(function () use ($request, $id) {
            $categoria = Categoria::findOrFail($id);
            $categoria->update($request->all());
        }, 'Categoria inserida', 'categorias.index');
    }

    /**
     * Remove the specified resource from storage (Categoria).
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        return OrmUtil::execTrans(function () use ($id) {
            Categoria::findOrFail($id)->delete();
        }, 'Categoria excluída', 'categorias.index');
    }

    /**
     * Exibe tela para remover categoria.
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function remover($id)
    {
        $categoria = Categoria::findOrFail($id);
        return view('categorias.remove', compact('categoria'));
    }

    /**
     * Exibe listagem de medicamentos associados a categoria.
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function medicamentos($id)
    {
        $categoria = Categoria::findOrFail($id);
        return view('categorias.medicamentos', compact('categoria'));
    }
}
