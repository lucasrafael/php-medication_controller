@extends('layouts.base')

@section('panel-heading')
    Detalhes do Medicamento
@endsection

@section('panel-button')
    <a href="{{ url()->previous() }}" class="btn btn-default">Voltar</a>
@endsection

@section('content')
    <div class="panel-body">
        <div class="row">
            <div class="col-md-12">
                <p>Identificador: {{$medicamento->id}}</p>
                <p>Nome: {{$medicamento->nome}}</p>
                <p>Descri&ccedil;&atilde;o: {{$medicamento->descricao}}</p>
                <p>Prescri&ccedil;&atilde;o: {{$medicamento->prescricao}}</p>
                <p>Validade: {{$medicamento->validade}}</p>
                <p>Quantidade: {{$medicamento->quantidade}}</p>
                <p>Marca: {{$medicamento->marca->nome}}</p>
                <p>Categorias:
                    @foreach($medicamento->categorias as $categoria)
                        <a href="{{route('categorias.show', $categoria->id)}}">{{$categoria->nome}}</a>
                    @endforeach
                </p>
            </div>
        </div>
    </div>
@endsection
