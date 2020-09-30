<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Validator;

use App\Models\Medicamento;
use App\Models\Marca;

class MarcaController extends Controller
{
    protected function validarMarca($request){
        $validator = Validator::make($request->all(), [
            "nome" => "required | max:30"
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
        $marcas = self::getModelPaginado($request, 'nome', Marca::class);

        return view('marcas.index', compact('marcas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $marcas = Marca::all();
        return view('marcas.create', compact('marcas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = $this->validarMarca($request);
        if ($validator->fails()){
            return redirect()->back()->withInput()->withErrors($validator->errors());
        }

        return self::execTrans(function () use ($request){
            Marca::create($request->all());
        },'Marca incluída', 'marcas.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $marca = Marca::find($id);

        return view('marcas.show', compact('marca'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $marca = Marca::find($id);

        return view('marcas.edit', compact('marca'));
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
        $validator = $this->validarMarca($request);
        if ($validator->fails()){
            return redirect()->back()->withInput()->withErrors($validator->errors());
        }

        return self::execTrans(function () use ($request, $id){
            Marca::find($id)->update($request->all());
        },'Marca atualizada', 'marcas.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        return self::execTrans(function () use ($id){
            Marca::find($id)->delete();
        },'Marca excluída', 'marcas.index');
    }

    public function remover($id)
    {
        $marca = Marca::find($id);
        return view('marcas.remove', compact('marca'));
    }

    public function medicamentos($id)
    {
        $marca = Marca::find($id);
        return view('marcas.medicamentos', compact('marca'));
    }
}
