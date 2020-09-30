<?php

namespace App\Http\Controllers;

use Illuminate\Pagination\Paginator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Validator;

use App\Models\Medicamento;
use App\Models\Marca;
use App\Models\Categoria;

class MedicamentoController extends Controller
{
    protected function validarMedicamento($request)
    {
        $validatedData = Validator::make($request->all(), [
            "nome" => "required | max:50",
            "descricao" => "required | max:200",
            "validade" => "required",
            "quantidade" => "required | numeric | min:1",
            "marca_id" => "required",
        ]);
        return $validatedData;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $medicamentos = self::getModelPaginado($request, 'nome', Medicamento::class);

        return view('medicamentos.index', compact('medicamentos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $marcas = Marca::all();
        $categorias = Categoria::all();

        return view('medicamentos.create', compact('marcas', 'categorias'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = $this->validarMedicamento($request);
        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator->errors());
        }

        return self::execTrans(function () use ($request){
            $dados = $request->all();

            $medicamento = Medicamento::create($dados);
            $medicamento = Medicamento::find($medicamento->id);
            $medicamento->categorias()->attach($dados['categoria_id']);

        },'Medicamento inserido', 'medicamentos.index');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $medicamento = Medicamento::find($id);

        return view('medicamentos.show', compact('medicamento'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $medicamento = Medicamento::find($id);
        $marcas = Marca::all();
        $categorias = Categoria::all();

        return view('medicamentos.edit', compact('medicamento', 'marcas', 'categorias'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = $this->validarMedicamento($request);
        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator->errors());
        }

        return self::execTrans(function () use ($request, $id){
            $medicamento = Medicamento::find($id);
            $dados = $request->all();

            $medicamento->update($dados);

            $medicamento->categorias()->sync($dados['categoria_id']);

        },'Medicamento alterado', 'medicamentos.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return self::execTrans(function () use ($id){
            Medicamento::find($id)->delete();
        },'Medicamento excluído', 'medicamentos.index');
    }

    public function remover($id)
    {
        $medicamento = Medicamento::find($id);

        return view('medicamentos.remove', compact('medicamento'));
    }
}
