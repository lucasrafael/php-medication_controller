<?php

namespace App\Http\Controllers;

use App\Models\Marca;
use Illuminate\Pagination\Paginator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Validator;

use App\Models\Categoria;
use App\Models\Medicamento;

class CategoriaController extends Controller
{
    protected function validarCategoria($request){
        $validator = Validator::make($request->all(), [
            "nome" => "required | max:50"
        ]);
        return $validator;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $categorias = self::getModelPaginado($request, 'nome', Categoria::class);

        return view('categorias.index', compact('categorias'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categorias = Categoria::all();
        return view('categorias.create', compact('categorias'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = $this->validarCategoria($request);
        if($validator->fails()){
            return redirect()->back()->withInput()->withErrors($validator->errors());
        }

        return self::execTrans(function () use ($request){
            Categoria::create($request->all());
        },'Categoria inserida', 'categorias.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $categoria = Categoria::find($id);

        return view('categorias.show', compact('categoria'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categoria = Categoria::find($id);

        return view('categorias.edit', compact('categoria'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = $this->validarCategoria($request);
        if($validator->fails()){
            return redirect()->back()->withInput()->withErrors($validator->errors());
        }

        return self::execTrans(function () use ($request, $id){
            $categoria = Categoria::find($id);
            $categoria->update($request->all());

        },'Categoria inserida', 'categorias.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return self::execTrans(function () use ($id){
            Categoria::find($id)->delete();
        }, 'Categoria excluída', 'categorias.index');
    }

    public function remover($id)
    {
        $categoria = Categoria::find($id);

        return view('categorias.remove', compact('categoria'));
    }

    public function medicamentos($id)
    {
        $categoria = Categoria::find($id);
        return view('categorias.medicamentos', compact('categoria'));
    }
}
